<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Views;
use Carawebs\Contact\Views\PartialSelector;

/**
* Hook function for CTA shortcode
*/
class MailchimpForm implements Shortcode {

    use PartialSelector;

    public function __construct() {
        $this->form_data = apply_filters( 'carawebs/mailchimp_endpoint', NULL);
    }

    public function handler( $atts, $content = NULL ) {

        $defaults = apply_filters( 'carawebs-contact/mailchimp-defaults', NULL);
        $attributes = shortcode_atts(
            [
                'post_to_url' => !empty($defaults['post_to_url']) ? $defaults['post_to_url'] : '#',
                'title' => !empty($defaults['title']) ? $defaults['title'] : NULL,
            ], $atts );

        $partial = !empty($defaults['partial']) ? $defaults['partial'] : 'forms/mailchimp';

        ob_start();
        //include( self::static_partial_selector( 'forms/mailchimp' ) );
        include( $this->partial_selector( $partial ) );
        return ob_get_clean();

    }

    public function set_defaults($args = []) {
        $this->defaults = $args;
    }
}
