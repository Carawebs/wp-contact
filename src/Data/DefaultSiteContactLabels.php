<?php
namespace Carawebs\Contact\Data;

/**
* Class that holds variables to be used throughout the library.
*
* These can be overriden by theme-code by means of WordPress filter
* 'carawebs/themehelper_contact_text', which will receive an array.
*/
class DefaultSiteContactLabels extends Base {

    public function __construct()
    {
        $this->setSiteContactLabels();
    }

    /**
     * Set an array of site variables.
     *
     * These can be overridden by the WordPress filter system. The array is accepted
     * by a callback hooked to 'carawebs/themehelper_contact_text', where it can
     * be amended and returned.
     */
    public function setSiteContactLabels()
    {
        $this->container = apply_filters( 'carawebs-contact/default-contact-labels', [
            'email_link_text' => 'Email Us',
            'email_button_text' => 'Email Us',
            'landline_prefix' => 'Landline:',
            'landline_clicktext' => 'Click to Call Main Office',
            'mobile_prefix' => 'Mobile:',
            'mobile_clicktext' => 'Click to Call our Mobile',
            'linked_in_text' => 'Follow us on Linked In',
            'twitter_text' => 'Follow us on Twitter',
            'pinterest_text' => 'Our Pinterest',
            'facebook_text' => 'Find us on Facebook',
        ]);
    }
}
