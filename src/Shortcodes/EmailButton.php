<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Traits\CssClasses;

/**
* Hook function for Email Button shortcode
*/
class EmailButton extends ContactAction {

    use CssClasses;

    public function __construct()
    {
        parent::__construct();
        $this->setDefaultContactStrings([
            'text' => 'Email Us',
            'mobileViewText' => 'Email Us'
        ]);
    }
    public function handler( $atts, $content = NULL )
    {
        $args = shortcode_atts([
            'align' => 'left',
            'text' => $this->defaultContactStrings['text'] ?? NULL,
            'mobile_view_text' => $this->defaults['mobileViewText'] ?? NULL,
            'classes' => '',
            'email' => NULL,
        ], $atts );

        $args['classes'] = explode( ',', preg_replace('/\s/', '', $args['classes']));
        $args['icon'] = '<i class="email-icon"></i>&nbsp;';

        // Build all button classes
        $args['classes'] = $this->buttonClasses($args['classes']);

        ob_start();
        echo \Carawebs\Contact\Views\MakeEmailLink::button( $args );
        return ob_get_clean();
    }
}
