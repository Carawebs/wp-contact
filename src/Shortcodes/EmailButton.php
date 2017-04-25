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
            'text'      => $this->defaultContactStrings['email_link_text'],
            'prefix'    => $this->defaultContactStrings['email_button_text']
        ]);
    }
}
