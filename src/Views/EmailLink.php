<?php
namespace Carawebs\Contact\Views;

use Carawebs\Contact\Traits\Buttons;
use Carawebs\Contact\Traits\PartialSelector;

/**
* Prepares data and renders email elements
*
*/
class EmailLink {

    use Buttons;
    use PartialSelector;

    /**
    * Render HTML markup for an email button
    *
    * @param  array  $args   Array of arguments
    * @return string         HTML for a click to call button
    */
    public static function button( array $args = [] )
    {
        $classes = self::cssClasses( $args );
        $desktopClasses = $classes['desktop'];
        $mobileClasses = $classes['mobile'];
        $icon = ! empty( $args['icon'] )
            ? $args['icon']
            : '<i class="email-icon"></i>';
        $desktop_text = ! empty( $args['text'] )
            ? $args['text']
            : "Email Us";
        $mobile_text = ! empty( $args['mobileViewText'] )
            ? $args['mobileViewText']
            : "Email Us";

        $email = empty( $email ) ? self::get_email() : $email;
        if( empty( $email ) ) { return; }

        ob_start();
        include( self::static_partial_selector('partials/buttons/email') );
        return ob_get_clean();
    }

    /**
    * Render HTML markup for a click to call link/text showing the number
    *
    * At large screen sizes, display the number as text. At small screen sizes, show a
    * link that calls the relevant number on click.
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
