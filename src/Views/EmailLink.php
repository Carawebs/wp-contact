<?php
namespace Carawebs\Contact\Views;

use Carawebs\Contact\Traits\Buttons;

/**
* Prepares data and renders email elements
*
*/
class EmailLink {

    use Buttons;

    /**
    * Render HTML markup for an email button
    *
    * At large screen sizes, display the number. At small screen sizes, show a
    * button that calls the relevant number on click.
    * @param  array  $args   Array of arguments
    * @return string         HTML for a click to call button
    */
    public static function button( array $args = [] ) {

        $btn_classes  = self::CSS_classes( $args );
        $icon         = ! empty( $args['icon'] ) ? $args['icon'] : '<i class="email-icon"></i>';
        $desktop_text = ! empty( $args['desktop_text'] ) ? $args['desktop_text'] : "Email Us";
        $mobile_text  = ! empty( $args['mobile_text'] ) ? $args['mobile_text'] : "Email Us";

        $email = empty( $email ) ? self::get_email() : $email;
        if( empty( $email ) ) { return; }

        ob_start();

        ?>
        <span class="hidden-xs hidden-sm-down">
            <a href="mailto:<?= $email; ?>" class="<?= $btn_classes['desktop']; ?>">
                <?= $icon; ?>&nbsp;<?= ! empty( $desktop_text ) ? $desktop_text . ' ' : NULL; ?>
            </a>
        </span>
        <span class="hidden-sm hidden-md hidden-lg hidden-md-up">
            <a href="mailto:<?= $email; ?>" class="<?= $btn_classes['mobile']; ?>">
                <?= $mobile_text; ?>
                <?= $icon; ?>
            </a>
        </span>
        <?php

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
    public static function text ( array $args = [] ) {

        $email = empty( $args['email'] ) ? self::get_email() : $args['email'];
        if( empty( $email ) ) {
            return;
        }

        $icon = ! empty( $args['icon'] ) ? $args['icon'] : NULL;
        $desktop_text = ! empty( $args['desktop_text'] ) ? $args['desktop_text'] : antispambot($email);

        ob_start();
        ?>
        <a href="mailto:<?= antispambot($email); ?>" class="email"><?= $icon; ?><?= $desktop_text; ?></a>
        <?php

        return ob_get_clean();

    }

    public static function get_email() {
        return "info@carawebs.com";//Fetch\Options::get_options_array( 'carawebs_address_data' )['email'];
    }

    public static function link( array $args = [] ) {

        echo self::text( $args );

    }

    // /**
    //  * Return CSS classes for button
    //  * @param  [type] $value [description]
    //  * @return array  Button classes
    //  */
    // public static function button_classes($value) {
    //
    //     $btn_base     = ['btn', 'btn-default'];
    //     $mob_btn_base = ['btn', 'btn-default'];
    //     $btn_classes        = isset( $args['btn_classes'] )
    //         ? array_merge( $btn_base, $args['btn_classes'] )
    //         : $btn_base;
    //     $btn_mobile_classes = isset( $args['btn_mobile_classes'] )
    //         ? array_merge( $mob_btn_base, $args['btn_mobile_classes'] )
    //         : $mob_btn_base;
    //     $desktop = implode( ' ', $btn_classes );
    //     $mobile  = implode( ' ', $btn_mobile_classes );
    //
    //     return compact( 'desktop', 'mobile' );
    //
    // }

}
