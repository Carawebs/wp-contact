<?php
namespace Carawebs\Contact\Shortcodes;

/**
 *
 */
class MobileButton extends PhoneButton
{

    public function __construct()
    {
        parent::__construct();
        $this->setupData();
    }

    public function setupData()
    {
        $this->setDefaultContactStrings([
            'text' => 'Call Us: ',
            'mobileViewText' => 'Click to Call'
        ]);

        $this->setnumber($this->defaultContactDetails['mobile']);

        $icon = '<i class="mobile-icon"></i>&nbsp;';
        $this->setIcon($icon);
    }

}
