<?php

namespace Carawebs\Contact\Views;

/**
*
*/
trait PartialSelector {

    public function partial_selector( $partial ) {

        if ( file_exists( get_template_directory() . '/partials/' . $partial . '.php' ) ) {
            return ( get_template_directory() . '/partials/' . $partial . '.php' );
        } else {
            return ( __DIR__ . '/partials/' . $partial . '.php' );
        }
    }

    // public static function static_partial_selector( $partial ) {
    //
    //     if ( file_exists( get_template_directory() . '/partials/' . $partial . '.php' ) ) {
    //         return ( get_template_directory() . '/partials/' . $partial . '.php' );
    //     } else {
    //         return ( __DIR__ . '/partials/' . $partial . '.php' );
    //     }
    // }
}
