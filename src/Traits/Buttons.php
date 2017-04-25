<?php
namespace Carawebs\Contact\Traits;

/**
 * Trait to set up button classes.
 */
trait Buttons
{
    /**
     * Return CSS classes for button
     * @param  [type] $value [description]
     * @return array  Button classes
     */
    public static function cssClasses($args)
    {

        $btn_base = ['btn', 'btn-default'];
        $mob_btn_base = ['btn', 'btn-default'];

        $btn_classes = isset( $args['classes'] )
            ? array_merge( $btn_base, $args['classes'] )
            : $btn_base;
        $btn_mobile_classes = isset( $args['mobileClasses'] )
            ? array_merge( $mob_btn_base, $args['mobileClasses'] )
            : $mob_btn_base;

        $desktop = implode( ' ', $btn_classes );
        $mobile  = implode( ' ', $btn_mobile_classes );

        return compact( 'desktop', 'mobile' );
    }
}
