<?php
namespace Carawebs\Contact\Data;

/**
*
*/
class Combined extends Base
{
    public function __construct()
    {
        $this->setData();
    }

    public function setData()
    {
        $dataOptions = include dirname(__FILE__, 3) . '/config/options-page.php';
        $data = [];
        foreach ($dataOptions['sections'] as $key => $section) {
            $data[$section['option_name']] = get_option($section['option_name']);
        }
        $this->container = $data;
    }
}
