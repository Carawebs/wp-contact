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
        $this->setDefaults([
            'type' => 'email',
            'classname' => 'EmailLink',
            'text' => $this->defaultContactStrings['emailText'],
            'mobileViewText' => $this->defaultContactStrings['emailMobileText']
        ]);
    }
}
