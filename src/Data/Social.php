<?php
namespace Carawebs\Contact\Data;

/**
*
*/
class Social extends Base
{
    public function __construct()
    {
        $this->setData();
    }

    public function setData()
    {
        $this->container = get_option('carawebs_social');
    }
}
