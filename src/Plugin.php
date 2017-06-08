<?php
namespace Carawebs\Contact;

use Carawebs\Settings;
use Carawebs\Contact\Data\Filters;
use Carawebs\Contact\Widgets\RegisterWidgets;
use Carawebs\Contact\Shortcodes\RegisterShortcodes;

if (!defined('ABSPATH')) exit;
/**
* Main plugin class
*/
class Plugin
{
    /**
     * Base path for this plugin.
     * @var string
     */
    private $basePath;

    /**
     * Path to settings config file.
     * @var string
     */
    private $settingsConfigFilePath;

    /**
     * Settings controller
     * @var Object
     */
    private $settingsController;

    /**
     * Flag - if true, exit early.
     * @var boolean
     */
    private $bail = false;

    public function __construct($basePath, $prefix)
    {
        $continue = $this->setPaths($basePath);
        if (true === $continue) {
            $this->prefix = $prefix;
            $this->initialiseObjects();
        } else {
            $this->bail = true;
        }
    }

    /**
     * Set the file path for the options page config.
     *
     * @param string $basePath Full path to plugin root directory.
     * @return boolean true if file exists, otherwise false.
     */
    public function setPaths($basePath)
    {
        $this->basePath = $basePath;
        $this->settingsConfigFilePath = $basePath . '/config/options-page.php';
        if (!file_exists($this->settingsConfigFilePath)) {
            return false;
        }
        return true;
    }

    /**
     * Initialise Objects
     */
    private function initialiseObjects()
    {
        if (true === $this->bail) return; // No config file for settings page
        $this->settingsController = new Settings\SettingsController;

        add_action('wp', function() {
            $this->autoloader = new Autoloader;
        });

        add_action('after_setup_theme', function() {
            $this->filters = new Filters;
            new RegisterWidgets;
            new RegisterShortcodes;
        });
    }


    public function init()
    {
        if (true === $this->bail) return;

        $this->settingsController->setOptionsPageArgs($this->settingsConfigFilePath)->initOptionsPage();
        add_action('wp', function() {
            $this->filters->addFilters();
            $this->onActivation();
            $this->onDeactivation();
        });
        add_action('wp_footer', function() {
            //$this->footerScripts->honeypot($this->allowedLocationsConfig->allowed());
        });
    }

    private function onActivation()
    {
        register_activation_hook( __FILE__, function() {
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
