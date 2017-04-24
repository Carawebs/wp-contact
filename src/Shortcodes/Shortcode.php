<?php
namespace Carawebs\Contact\Shortcodes;

interface Shortcode {

    public function handler( $atts, $content );

}
