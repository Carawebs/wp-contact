<?php
/*
Plugin Name:       Contact
Plugin URI:        http://carawebs.com
Description:       Build address & contact fields as a settings page. Displays address according to schema.org markup guidelines.
Version:           1.0.0
Author:            David Egan
Author URI:        http://dev-notes.eu
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:       address
Domain Path:       /languages
*/
namespace Carawebs\Address;
$optionsPageConfig = dirname(__FILE__) . '/options-page-config.php';
//$menuPageConfig = dirname(__FILE__) . '/menu-page-settings-config.php';

// Settings Page
$optionsPage = new SettingsController;
$optionsPage->setOptionsPageArgs($optionsPageConfig)->initOptionsPage();
