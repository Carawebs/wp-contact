<?php
namespace Carawebs\Contact\Traits;

/**
 * Trait to set up button classes.
 */
trait Buttons {
    /**
     * Return CSS classes for button
     * @param  [type] $value [description]
     * @return array  Button classes
     */
    public static function CSS_classes($value) {

        $btn_base     = ['btn', 'btn-default'];
        $mob_btn_base = ['btn', 'btn-default'];
        $btn_classes        = isset( $args['btn_classes'] )
            ? array_merge( $btn_base, $args['btn_classes'] )
            : $btn_base;
        $btn_mobile_classes = isset( $args['btn_mobile_classes'] )
            ? array_merge( $mob_btn_base, $args['btn_mobile_classes'] )
            : $mob_btn_base;
        $desktop = implode( ' ', $btn_classes );
        $mobile  = implode( ' ', $btn_mobile_classes );

        return compact( 'desktop', 'mobile' );

    }
}
