<?php
namespace Carawebs\Contact\Data;

/**
*
*/
class Address extends Base
{
    public function __construct()
    {
        $this->setData();
    }

    public function setData()
    {
        $this->container = get_option('carawebs_address');
    }
}
