<?php
namespace Carawebs\Contact\Shortcodes;

/**
 *
 */
class LandlineButton extends PhoneButton
{
    public function __construct()
    {
        parent::__construct();
        $this->setupData();
    }

    public function setupData()
    {
        $this->setDefaultContactStrings([
            'text' => 'Call Office: ',
            'mobileViewText' => 'Click to Call Landline'
        ]);

        $this->setnumber($this->defaultContactDetails['landline']);

        $icon = '<i class="mobile-icon"></i>&nbsp;';
        $this->setIcon($icon);
    }
}
