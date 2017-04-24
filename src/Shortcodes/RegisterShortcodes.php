<?php
namespace Carawebs\Contact\Shortcodes;

/**
* Register custom shortcodes
*
* Create an instance of this class from within your theme, hooked to the
* 'after_setup_theme' WP hook.
*/
class RegisterShortcodes {
    function __construct( array $widgets = [] ) {
        $this->set_shortcodes();
        $this->init();
    }

    /**
     * Set shortcodes.
     *
     * @param [type] $override [description]
     */
    public function set_shortcodes( array $override = [] ) {
        $shortcodes = [
            'ShareThis'           => 'ShareThis',
            // 'MobileButton'    => 'MobileButton',
            // 'LandlineButton'  => 'LandlineButton',
            'EmailButton'     => 'EmailButton',
            // 'MailchimpForm'   => 'MailchimpForm',
            // 'PricingTable'    => 'PricingTable',
            // 'NextSection'     => 'NextSection',
            // 'ContactForm'     => 'ContactForm',
            // 'ContactModal'    => 'ContactModal',
        ];

        $this->shortcodes = apply_filters('carawebs/contact-shortcodes', $shortcodes);
    }

    /**
     * Add shortcodes.
     *
     * Loops through shortcodes and runs `add_shortcode()`. The object that holds
     * the hooked function is passed in to this class - this object conforms to
     * the `Shortcode()` interface, where the `Shortcode::handler()` method is
     * the hook to run when the shortcode is found.
     * @return void
     */
    public function init()
    {
        foreach ($this->shortcodes as $key => $value) {
            $shortcode = 'Carawebs\\Contact\\Shortcodes\\' . $value;
            if ( class_exists( $shortcode ) ) {
                add_shortcode( $key, [ new $shortcode(), 'handler'] );
            }
        }
    }
}
