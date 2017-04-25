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
            'align' => 'left',
            'text' => $this->defaults['text'] ?? NULL,
            'mobile_view_text' => $this->defaults['mobileViewText'] ?? NULL,
            'classes' => ''
        ], $atts );

        $args = [
            'intro' => $attributes['intro_text'],
            'align' => $attributes['align'],
            'include' => [
                $this->defaults['classname'] => [
                    'mobileViewText'=>$attributes['mobile_view_text'],
                    'text'=>$attributes['text']
                ]
            ],
            'type' => $this->defaults['type'],
            'classes' => explode( ',', preg_replace('/\s/', '', $attributes['classes']))
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
    public function setDefaults($args = [])
    {
        $this->defaults = $args;
    }

    public function setDefaultContactStrings()
    {
        $this->defaultContactStrings = [
            'emailText' => 'Email Us',
            'emailMobileText' => 'Button Email'
        ];
    }
}
