<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Data\Combined;

/**
* Class that sets up necessary data needed to build a contact shortcode.
*/
abstract class ContactAction implements Shortcode {

    protected $defaults = [
        'text' => NULL,
        'prefix'=> NULL
    ];

    /**
    * Site default text strings for Calls to Action.
    * @var array
    */
    protected $site_defaults;

    abstract function handler( $atts, $content = NULL );

    public function __construct()
    {
        //$this->setDefaultContactStrings();
        $this->setDefaultContactDetails(new Combined);
    }

    public function setDefaultContactDetails(Combined $data)
    {
        $this->defaultContactDetails = $data['carawebs_social'] + [
            'email' => $data['carawebs_address']['email'],
            'landline' => $data['carawebs_address']['landline_phone'],
            'mobile' => $data['carawebs_address']['mobile_phone']
        ];
    }

    /**
    * Set default values for this contact method.
    *
    * This method is run from within the child class.
    *
    * @param [type] $args [description]
    */
    public function setDefaults($args = [])
    {
        $this->defaults = $args;
    }

    public function setDefaultContactStrings(array $args = [])
    {
        $this->defaultContactStrings = $args;
    }

    /**
     * Return CSS classes for button.
     *
     * Merges in an editor defined array of CSS classes as required.
     * @param array $specificDefinedClasses Display specific & editor defined classes
     * @return array Final button classes
     */
    public static function cssClasses(array $specificDefinedClasses = NULL) : array
    {
        $btn_base = ['btn', 'btn-default'];
        $mob_btn_base = ['btn', 'btn-default'];

        $btn_classes = isset( $specificDefinedClasses )
            ? array_merge( $btn_base, $specificDefinedClasses )
            : $btn_base;
        $btn_mobile_classes = isset( $args['mobileClasses'] )
            ? array_merge( $mob_btn_base, $args['mobileClasses'] )
            : $mob_btn_base;

        $desktop = implode( ' ', $btn_classes );
        $mobile  = implode( ' ', $btn_mobile_classes );

        return compact( 'desktop', 'mobile' );
    }
}
