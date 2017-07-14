<?php
include_once(BDWP_INCLUDE_PATH . 'BackwardCompatibility.php');
include_once(BDWP_INCLUDE_PATH . 'Database.php');
include_once(BDWP_INCLUDE_PATH . 'Localization.php');
include_once(BDWP_INCLUDE_PATH . 'PluginInfo.php');
include_once(BDWP_INCLUDE_PATH . 'Settings.php');
include_once(BDWP_INCLUDE_PATH . 'WordPressPlugin.php');

include_once(BDWP_INCLUDE_PATH . 'captcha-provider/InstallCaptchaProvider.php');

include_once(BDWP_INCLUDE_PATH . 'diagnostics/Diagnostics.php');
include_once(BDWP_INCLUDE_PATH . 'diagnostics/WordPress.php');

include_once(BDWP_INCLUDE_PATH . 'integration/CaptchaIntegration.php');
include_once(BDWP_INCLUDE_PATH . 'integration/Comments.php');
include_once(BDWP_INCLUDE_PATH . 'integration/ContactForm7.php');
include_once(BDWP_INCLUDE_PATH . 'integration/Login.php');
include_once(BDWP_INCLUDE_PATH . 'integration/LostPassword.php');
include_once(BDWP_INCLUDE_PATH . 'integration/Register.php');

include_once(BDWP_INCLUDE_PATH . 'tools/guid.php');
include_once(BDWP_INCLUDE_PATH . 'tools/HttpHelpers.php');

if (is_admin()) {
    include_once(BDWP_INCLUDE_PATH . 'Update.php'); 
}
