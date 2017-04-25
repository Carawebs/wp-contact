<?php

namespace Carawebs\Contact\Traits;

/**
*
*/
trait PartialSelector {

    public function partial_selector( $partial )
    {
        if ( file_exists( get_template_directory() .'/'. $partial . '.php' ) ) {
            return ( get_template_directory() .'/'. $partial . '.php' );
        } else {
            return ( dirname(__DIR__) . '/partials/' . $partial . '.php' );
        }
    }
}
