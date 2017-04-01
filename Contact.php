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

if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Singleton class to start the plugin.
*/
class Contact
{
    /**
     * Refers to a single instance of this class
     * @var Object|NULL
     */
    private static $instance = NULL;

    private $optionsPageConfig;

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
        $optionsPage->setOptionsPageArgs($this->optionsPageConfig)->initOptionsPage();
        $dataFilters->addFilters();
    }

    /**
     * Define the paths to the config files for CPTs and custom taxonomies.
     */
    private function setPaths()
    {
        $path = dirname(__FILE__) . '/config/';
        $this->optionsPageConfig = $path . '/options-page.php';
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

    /**
    * Load Composer autoload if available, otherwise register a simple autoload callback.
    *
    * @return void
    */
    private function autoload()
    {
        static $done;
        // Go ahead if $done == NULL or the class doesn't exist
        if ( ! $done && ! class_exists( 'Carawebs\CustomContent\CPT\Setup', true ) ) {
            $done = true;
            file_exists( __DIR__.'/vendor/autoload.php' )
            ? require_once __DIR__.'/vendor/autoload.php'
            : spl_autoload_register( function ( $class ) {
                if (strpos($class, __NAMESPACE__) === 0) {
                    $name = str_replace('\\', '/', substr($class, strlen(__NAMESPACE__)));
                    require_once __DIR__."/src{$name}.php";
                }
            });
        }
    }
}

$plugin = Contact::getInstance();
$plugin->bootstrap(
    new Settings\SettingsController,
    new Data\Filters
);
