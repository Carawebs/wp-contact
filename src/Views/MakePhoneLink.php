<?php
namespace Carawebs\Contact\Views;

use Carawebs\Contact\Traits\PartialSelector;

/**
* Prepares data and renders email elements
*
*/
class MakePhoneLink {

    use PartialSelector;

    /**
    * Render HTML markup for an email button
    *
    * @param  array  $args   Array of arguments
    * @return string         HTML for a click to call button
    */
    public static function button(array $args = [])
    {
        return self::buildLink($args, 'button');
    }

    /**
     * [buildLink description]
     * @param [type] $args [description]
     */
    private static function buildLink(array $args, $type)
    {
        $number = $args['number'];
        $desktopClasses = $args['classes']['desktop'];
        $mobileClasses = $args['classes']['mobile'];
        $icon = !empty($args['icon']) ? $args['icon'] : NULL;
        $desktop_text = $args['text'];
        $mobile_text = $args['mobileViewText'];

        ob_start();
        if ('button' === $type) {
            include(self::static_partial_selector('partials/buttons/phone-number'));
        } elseif ('text' === $type) {
            include(self::static_partial_selector('partials/text-link/phone-number'));
        }
        return ob_get_clean();
    }


    /**
    * Render HTML markup for an email link
    *
    * @param  array  $args   Array of arguments
    * @return string         HTML for the number/number link
    */
    public static function text ( array $args = [] )
    {
        $email = empty( $args['email'] ) ? self::get_email() : $args['email'];
        if( empty( $email ) ) {
            return;
        }

        $icon = !empty( $args['icon'] ) ? $args['icon'] : NULL;
        $desktop_text = ! empty( $args['desktop_text'] ) ? $args['desktop_text'] : antispambot($email);

        ob_start();
        ?>
        <a href="mailto:<?= antispambot($email); ?>" class="email"><?= $icon; ?><?= $desktop_text; ?></a>
        <?php

        return ob_get_clean();
    }

    public static function get_email()
    {
        return "info@carawebs.com";//Fetch\Options::get_options_array( 'carawebs_address_data' )['email'];
    }

    public static function link( array $args = [] )
    {
        echo self::text( $args );
    }
}
