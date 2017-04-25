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

    public function __construct()
    {
        $this->setDefaultContactStrings();
        $this->defaultContactDetails = new Combined();
    }

    public function handler( $atts, $content = NULL )
    {
        $attributes = shortcode_atts([
            'intro_text' => '',
            'align'      => 'left',
            'text'       => $this->defaults['text'] ?? NULL,
            'prefix'     => $this->defaults['prefix'] ?? NULL,
            'classes'    => ''
        ], $atts );

        $args = [
            'CTA_intro'   => $attributes['intro_text'],
            'align'       => $attributes['align'],
            'include'     => [
                $this->defaults['classname'] => [
                    'prefix'=>$attributes['prefix'],
                    'text'=>$attributes['text']
                ]
            ],
            'type'        => $this->defaults['type'],
            'btn_classes' => explode( ', ', $attributes['classes'])
        ];

        ob_start();
        echo \Carawebs\Contact\Views\ControllableContactAction::buttons( $args );
        return ob_get_clean();
    }

    /**
    * Set default values for this button.
    *
    * This method is run from within the child class.
    *
    * @param [type] $args [description]
    */
    public function set_defaults($args = [])
    {
        $this->defaults = $args;
    }

    public function setDefaultContactStrings()
    {
        $this->defaultContactStrings = [
            'email_link_text' => 'Email Us',
            'email_button_text' => 'Button Email'
        ];
    }
}
