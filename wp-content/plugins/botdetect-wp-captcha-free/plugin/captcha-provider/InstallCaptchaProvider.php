<?php
class BDWP_InstallCaptchaProvider {

    public static function InitDiagnostics() {
        return array(
            'database_version' => BDWP_PluginInfo::GetVersion(),
            'first_plugin_install' => array(
                'datetime' => '',
                'plugin_version' => '',
                'wp_version' => ''
            ),
            'last_plugin_install' => array(
                'datetime' => '',
                'plugin_version' => '',
                'wp_version' => ''
            ),
            'first_bdphplib_install' => array(
                'datetime' => '',
                'bdphplib_version' => '',
                'bdphplib_is_free' => true,
                'plugin_version' => '',
                'wp_version' => ''
            ),
            'last_bdphplib_install' => array(
                'datetime' => '',
                'bdphplib_version' => '',
                'bdphplib_is_free' => true,
                'plugin_version' => '',
                'wp_version' => ''
            )
        );
    }

    public static function InitSettings() {
        return array(
            'bdwp_instance_id' => BDWP_Guid::Generate(),
            'install_lib_automatically_on_plugin_update' => null,
            'customer_email' => '',
            'captcha_provider' => 'bdphplib'
        );
    }

    public static function AddDiagnosticsPluginInstall() {

        $diagnostics = get_option('bdwp_diagnostics');
        if (!is_array($diagnostics)) {
            $diagnostics = self::InitDiagnostics();
        }

        $last_plugin_install = array(
            'datetime' => current_time('mysql'),
            'plugin_version' => BDWP_PluginInfo::GetVersion(),
            'wp_version' => BDWP_Diagnostics::GetWordPressVersion()
        );

        if (empty($diagnostics['first_plugin_install']['plugin_version'])) {
            $diagnostics['first_plugin_install'] = $last_plugin_install;
        }

        $diagnostics['last_plugin_install'] = $last_plugin_install;
        update_option('bdwp_diagnostics', $diagnostics);
    }

    public static function AddDiagnosticsBDPHPLibInstall() {

        $diagnostics = get_option('bdwp_diagnostics');
        if (!is_array($diagnostics)) {
            return;
        }

        $bdphplib_info = Captcha::GetProductInfo();

        $last_bdphplib_install = array(
            'datetime' => current_time('mysql'),
            'bdphplib_version' => $bdphplib_info['version'],
            'bdphplib_is_free' => Captcha::IsFree(),
            'plugin_version' => BDWP_PluginInfo::GetVersion(),
            'wp_version' => BDWP_Diagnostics::GetWordPressVersion()
        );

        if (empty($diagnostics['first_bdphplib_install']['bdphplib_version'])) {
            $diagnostics['first_bdphplib_install'] = $last_bdphplib_install;
        }

        $diagnostics['last_bdphplib_install'] = $last_bdphplib_install;
        update_option('bdwp_diagnostics', $diagnostics);
    }

    /**
     * Start installation when press button
     */
    public static function StartInstallation() {
        $workflow = get_option('bdwp_workflow');
        if (is_array($workflow)) {
            $workflow = array_merge($workflow, array('bdphplib_is_installing' => true));
        } else {
            $workflow = array('bdphplib_is_installing' => true);
        }
        update_option('bdwp_workflow', $workflow);
    }

    public static function StopInstallation() {
        $workflow = get_option('bdwp_workflow');
        if (is_array($workflow)) {
            unset($workflow['bdphplib_is_installing']);
        }
        update_option('bdwp_workflow', $workflow);
    }

    public static function RenderCaptchaAlreadyChecked() {
        $workflow = get_option('bdwp_workflow');
        return is_array($workflow) && array_key_exists('render_captcha_is_checked', $workflow);
    }

    public static function UpdateCheckingRenderCaptchaStatus() {
        $workflow = get_option('bdwp_workflow');
        if (is_array($workflow)) {
            $workflow = array_merge($workflow, array('render_captcha_is_checked' => true));
        } else {
            $workflow = array('render_captcha_is_checked' => true);
        }
        update_option('bdwp_workflow', $workflow); 
    }

    /**
     *  Add bdwp_settings (generate guid) when first install plugin
     */
    public static function AddBDWPSettings() {
        $settings = get_option('bdwp_settings');
        if (!is_array($settings)) {
            $settings = self::InitSettings();
            update_option('bdwp_settings', $settings);
        }
    }

    public static function GetCustomerEmail() {
        $settings = get_option('bdwp_settings');
        $customerEmail = (is_array($settings)) ? $settings['customer_email'] : '';
        return $customerEmail;
    }

    public static function IsRegisteredUser() {
        $customerEmail = self::GetCustomerEmail();
        return (!empty($customerEmail));
    }

    /**
     *  Email store on client's WordPress database
     */
    public static function SaveCustomerEmail($p_Email) {
        $settings = get_option('bdwp_settings');
        if (!is_array($settings)) {
            $settings = self::InitSettings();
        }
        
        $settings['customer_email'] = $p_Email;
        update_option('bdwp_settings', $settings);
    }

    /**
     * Check the BotDetect Captcha Library is installed
     */
    public static function LibraryIsInstalled() {
        $generator = 'library';
        $options = get_option('botdetect_options');
        if (is_array($options) && array_key_exists('generator', $options)) {
            $generator = $options['generator'];
        }

        return ($generator == 'library' && class_exists('BDC_CaptchaBase'));
    }

    public static function DeleteFile($p_FilePath) {
        if (!empty($p_FilePath)) { 
            return @unlink($p_FilePath);
        }
        return false;
    }

}
