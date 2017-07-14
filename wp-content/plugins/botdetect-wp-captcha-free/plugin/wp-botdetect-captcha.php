<?php

/*  Copyright 2014  Captcha, Inc. (email : development@captcha.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * WordPress DB defaults & options
 */
define('BDWP_PLUGIN_PATH', dirname(dirname(__FILE__)));
define('BDWP_INCLUDE_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

$BDC_WP_Defaults = array();
$BDC_WP_Defaults['generator'] = 'library';
$BDC_WP_Defaults['library_path'] = BDWP_PLUGIN_PATH . DIRECTORY_SEPARATOR;
$BDC_WP_Defaults['library_assets_url'] = plugin_dir_url(BDWP_INCLUDE_PATH) . 'botdetect/public/';
$BDC_WP_Defaults['on_login'] = true;
$BDC_WP_Defaults['on_comments'] = true;
$BDC_WP_Defaults['on_lost_password'] = true;
$BDC_WP_Defaults['on_registration'] = true;
$BDC_WP_Defaults['on_contact_form7'] = false;
$BDC_WP_Defaults['audio'] = true;
$BDC_WP_Defaults['image_width'] = 235;
$BDC_WP_Defaults['image_height'] = 50;
$BDC_WP_Defaults['captcha_for_user_logged_in'] = true;
$BDC_WP_Defaults['min_code_length'] = 3;
$BDC_WP_Defaults['max_code_length'] = 5;
$BDC_WP_Defaults['min_code_length_for_user_logged_in'] = 2;
$BDC_WP_Defaults['max_code_length_for_user_logged_in'] = 3;
$BDC_WP_Defaults['helplink'] = 'image';
$BDC_WP_Defaults['remote'] = true;

$BDC_WP_Options = get_option('botdetect_options');
if (is_array($BDC_WP_Options)) {
    // Reset plugin settings to default values on 'Save Changes'
    if (array_key_exists('chk_default_options_db', $BDC_WP_Options) && $BDC_WP_Options['chk_default_options_db']) {
        $BDC_WP_Options = $BDC_WP_Defaults;
        unset($BDC_WP_Options['chk_default_options_db']);
        update_option('botdetect_options', $BDC_WP_Options);
    } else {
        $BDC_WP_Options = array_merge($BDC_WP_Defaults, $BDC_WP_Options);
    }
} else {
    $BDC_WP_Options = $BDC_WP_Defaults;
}

/**
 * In case of a local library generator, include the botdetect.php file
 */
if ($BDC_WP_Options['generator'] == 'library' && is_file($BDC_WP_Options['library_path'] . 'botdetect/CaptchaIncludes.php')) {

    define('BDC_INCLUDE_PATH', $BDC_WP_Options['library_path'] . 'botdetect/');
    define('BDC_URL_ROOT', $BDC_WP_Options['library_assets_url']);
    define('BDC_CONFIG_OVERRIDE_PATH', dirname(__FILE__) . '/');

    require_once($BDC_WP_Options['library_path'] . 'botdetect/CaptchaIncludes.php');
    require_once($BDC_WP_Options['library_path'] . 'botdetect/CaptchaConfigDefaults.php');

    // optional config override
    function BDC_ApplyUserConfigOverride($CaptchaConfig, $CurrentCaptchaId) {
        $BotDetect = clone $CaptchaConfig;
        $BDC_ConfigOverridePath = BDC_CONFIG_OVERRIDE_PATH . 'CaptchaConfig.php';
        if (is_file($BDC_ConfigOverridePath)) {
            include($BDC_ConfigOverridePath);
            CaptchaConfiguration::ProcessGlobalDeclarations($BotDetect);
            // 2nd pass correctly takes global declarations such as DisabledImageStyles into account
            // even if they're declared after affected values in the CaptchaConfig.php file
            // e.g. ImageStyle setting needs to be re-calculated according to DisabledImageStyles value
            include($BDC_ConfigOverridePath);
        }
        return $BotDetect;
    }

    // Configure BotDetect with WP settings
    $BDC_CaptchaConfig = CaptchaConfiguration::GetSettings();
    $BDC_CaptchaConfig->HandlerUrl = home_url( '/' ) . 'index.php?botdetect-request=1'; //handle trough the WP stack

    $BDC_CaptchaConfig->ImageWidth = $BDC_WP_Options['image_width'];
    $BDC_CaptchaConfig->ImageHeight = $BDC_WP_Options['image_height'];

    $BDC_CaptchaConfig->SoundEnabled = $BDC_WP_Options['audio'];
    $BDC_CaptchaConfig->RemoteScriptEnabled = $BDC_WP_Options['remote'];

    include_once(ABSPATH . WPINC . '/pluggable.php');

    // Captcha code length for user is anonymous or user is logged in
    if (is_user_logged_in() && $BDC_WP_Options['captcha_for_user_logged_in']) {
        $minCodeLength = $BDC_WP_Options['min_code_length_for_user_logged_in'];
        $maxCodeLength = $BDC_WP_Options['max_code_length_for_user_logged_in'];
    } else {
        $minCodeLength = $BDC_WP_Options['min_code_length'];
        $maxCodeLength = $BDC_WP_Options['max_code_length'];
    }

    $BDC_CaptchaConfig->CodeLength = CaptchaRandomization::GetRandomCodeLength($minCodeLength, $maxCodeLength);

    switch ($BDC_WP_Options['helplink']) {
        case 'image':
            $BDC_CaptchaConfig->HelpLinkMode = HelpLinkMode::Image;
            break;

        case 'text':
            $BDC_CaptchaConfig->HelpLinkMode = HelpLinkMode::Text;
            break;

        case 'off':
            $BDC_CaptchaConfig->HelpLinkEnabled = false;
            break;

        default:
            $BDC_CaptchaConfig->HelpLinkMode = HelpLinkMode::Image;
            break;
    }

    // Save Captcha settings
    CaptchaConfiguration::SaveSettings($BDC_CaptchaConfig);

    // Route the request
    if (isset($_GET['botdetect-request']) && $_GET['botdetect-request']) {
        // direct access, proceed as Captcha handler (serving images and sounds), terminates on output.
        require_once(BDC_INCLUDE_PATH . 'CaptchaHandler.php');
    } else {
        // included in another file, proceed as Captcha class (form helper)
        require_once(BDC_INCLUDE_PATH . 'CaptchaClass.php');
    }
}

// Included in another file
include_once(BDWP_INCLUDE_PATH . 'BDWPIncludes.php');

$pluginFolder =  plugin_basename(BDWP_PLUGIN_PATH);
$currentFileName = basename(__FILE__);

// Update plugin
if (is_admin()) {
    $pluginInfoForUpdate = array(
        'plugin_basename' => $pluginFolder . '/' . $currentFileName,
        'plugin_folder' => $pluginFolder,
        'plugin_version' => BDWP_PluginInfo::GetVersion()
    );
    new BDWP_Update($pluginInfoForUpdate);
}

// BotDetect Plugin
$pluginInfo = array(
    'plugin_basename' => $pluginFolder . '/' . $currentFileName,
    'plugin_path' => BDWP_PLUGIN_PATH . DIRECTORY_SEPARATOR . $currentFileName
);
new WP_BotDetect_Plugin($BDC_WP_Options, $pluginInfo);
