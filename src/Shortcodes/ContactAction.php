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
        $this->setDefaultContactDetails(new Combined);
    }

    public function setDefaultContactDetails(Combined $data)
    {
        $this->defaultContactDetails = $data['carawebs_social'] + [
            'email' => $data['carawebs_address']['email'],
            'landline' => $data['carawebs_address']['landline_phone'],
            'mobile' => $data['carawebs_address']['mobile_phone']
        ];

        $this->socialMediaDetails = $data['carawebs_social'];
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
}
