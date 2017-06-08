<?php
/*
Plugin Name:       Carawebs Contact
Plugin URI:        http://carawebs.com
Description:       Set contacts for this website.
Version:           1.0.1
Author:            David Egan
Author URI:        http://dev-notes.eu
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain:       contact
Domain Path:       /languages
*/
namespace Carawebs\Contact;

if (!defined('ABSPATH')) exit;

$basePath = dirname(__FILE__);
$prefix = "carawebs_contact";
include __DIR__ . '/src/Plugin.php';
$plugin = new Plugin($basePath, $prefix);
$plugin->init();
