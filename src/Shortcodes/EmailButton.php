<?php
namespace Carawebs\Contact\Shortcodes;

// use Carawebs\Display;
// use Carawebs\Fetch;

/**
* Hook function for CTA shortcode
*/
class EmailButton extends ContactButton {

    public function __construct() {

        parent::__construct();

        $this->set_defaults([
            'type'      => 'email',
            'classname' => 'EmailLink',
            'text'      => $this->site_defaults['email_link_text'],
            'prefix'    => $this->site_defaults['email_button_text']
        ]);

    }

}
