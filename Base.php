<?php
namespace Carawebs\Contact;

use Carawebs\Settings;

if ( ! defined( 'ABSPATH' ) ) exit;
/**
* Singleton class to start the plugin.
*/
class Base
{
    /**
    * Load Composer autoload if available, otherwise register a simple autoload callback.
    *
    * @return void
    */
    protected function autoload()
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
