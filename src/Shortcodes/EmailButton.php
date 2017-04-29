<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Traits\CssClasses;

/**
* Hook function for Email Button shortcode
*/
class EmailButton extends EmailLink {

    use CssClasses;

    protected function output(array $args)
    {
        // Build all button classes
        $args['classes'] = $this->buttonClasses($args['classes']);
        $args['icon'] = '<i class="email-icon"></i>&nbsp;';
        var_dump($args);
        ob_start();
        echo \Carawebs\Contact\Views\MakeEmailLink::button( $args );
        return ob_get_clean();
    }
}
