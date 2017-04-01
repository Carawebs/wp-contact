<?php
namespace Carawebs\Contact\Data;

/**
 *
 */
class Filters
{

    public function addFilters()
    {
        $this->addAddressFilter();
    }

    public function addAddressFilter()
    {
        add_filter('carawebs/address-data', function($address) {
            return get_option('carawebs_address');
        });
    }
}
