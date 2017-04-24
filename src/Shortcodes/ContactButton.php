<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Data\Combined;

/**
* Hook function for CTA shortcode
*/
class ContactButton implements Shortcode {

    protected $defaults = [
        'text'    => NULL,
        'prefix'  => NULL
    ];

    /**
     * Site default text strings for Calls to Action.
     * @var array
     */
    protected $site_defaults;

    public function __construct() {
        $this->site_defaults = new Combined();
        var_dump($this->site_defaults);
    }

    public function handler( $atts, $content = NULL ) {
        // @TODO: Get rid of extract()!!!!
        extract( shortcode_atts([
            'intro_text' => '',
            'align'      => 'left',
            'text'       => $this->defaults['text'] ?? NULL,
            'prefix'     => $this->defaults['prefix'] ?? NULL,
            'classes'    => ''
        ], $atts )
        );

        $args = [
            'CTA_intro'   => $intro_text,
            'align'       => $align,
            'include'     => [$this->defaults['classname'] => ['prefix'=>$prefix, 'text'=>$text]],
            'type'        => $this->defaults['type'],
            'btn_classes' => explode( ', ', $classes)
        ];

        ob_start();
        echo \Carawebs\Display\ControllableCTA::buttons( $args );
        return ob_get_clean();
    }

    /**
     * Set default values for this button.
     *
     * This method is run from within the child class.
     *
     * @param [type] $args [description]
     */
    public function set_defaults($args = []) {
        $this->defaults = $args;
    }
}
