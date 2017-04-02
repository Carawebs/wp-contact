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

use Carawebs\Settings;
include __DIR__.'/Base.php';

if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Singleton class to start the plugin.
*/
class Contact extends Base
{
    private $config;

    /**
     * Refers to a single instance of this class
     * @var Object|NULL
     */
    private static $instance = NULL;

    /**
     * Plugin instantiation by singleton method.
     * @return Object Object instantiated from this class
     */
    public static function getInstance()
    {
        if ( NULL == self::$instance ) {
            self::$instance = new self;
        }
         return self::$instance;
    }

    public function bootstrap(Settings\SettingsController $optionsPage, Data\Filters $dataFilters = NULL)
    {
        $this->autoload();
        $this->setPaths();
        $optionsPage->setOptionsPageArgs($this->config)->initOptionsPage();
        $dataFilters->addFilters();
    }

    /**
     * Define the paths to the config files for CPTs and custom taxonomies.
     */
    private function setPaths()
    {
        $path = dirname(__FILE__) . '/config/';
        $this->config = $path . '/options-page.php';
    }

    private function onActivation()
    {
        register_activation_hook( __FILE__, function() {
            $this->autoload();
            //$this->setPaths();
            //$this->setupCustomPostTypes->setupCPTs(); // --------------------
            //$this->setupCustomTaxonomies(); // -------------------
            flush_rewrite_rules();
        });
    }

    private function onDeactivation()
    {
        register_deactivation_hook( __FILE__, function(){
            flush_rewrite_rules();
        });
    }
}

$plugin = Contact::getInstance();
$plugin->bootstrap(
    new Settings\SettingsController,
    new Data\Filters
);
