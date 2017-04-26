<?php
namespace Carawebs\Contact\Traits;

/**
 *
 */
trait CssClasses
{
    function buttonClasses($editorDefinedClasses)
    {
        $btn_base = ['btn', 'btn-default'];
        $mob_btn_base = ['btn', 'btn-default'];

        $btn_classes = isset( $editorDefinedClasses )
            ? array_merge( $btn_base, $editorDefinedClasses )
            : $btn_base;
        $btn_mobile_classes = isset( $args['mobileClasses'] )
            ? array_merge( $mob_btn_base, $args['mobileClasses'] )
            : $mob_btn_base;

        $desktop = implode( ' ', $btn_classes );
        $mobile  = implode( ' ', $btn_mobile_classes );

        return compact( 'desktop', 'mobile' );
    }
}
