<?php
namespace Carawebs\Contact\Output;

use Carawebs\Contact\Views\MakeEmailLink;
use Carawebs\Contact\Views\MakePhoneLink;
use Carawebs\Contact\Data\Address as Data;
use Carawebs\Contact\Data\DefaultSiteContactLabels as Labels;

class ContactMethods {

    public function __construct(Data $data, Labels $labels)
    {
        $this->data = $data;
        $this->labels = $labels;
    }
    /**
    * Contacts markup.
    *
    * @param  array $additional Additional contact methods to include.
    * @return array             Data to build contacts markup.
    */
    public function all(array $additional = NULL)
    {
        if (is_array($additional) && ! empty($additional)) {
            $extra = $this->contactMethodMarkup($additional);
        }

        $email = MakeEmailLink::text([
            'icon' => '<i class="email-icon"></i>&nbsp;',
            'email' => $this->data['email'],
            'link_text' => $this->labels['email_link_text'],
        ]);

        $landline = MakePhoneLink::text([
            'icon' => '<i class="landline-icon"></i>&nbsp;',
            'number' => $this->data['landline_phone'],
            'text'  => $this->labels['landline_prefix'],
            'xs_text' => $this->labels['landline_clicktext']
        ]);

        // $mobile = MakePhoneLink::text([
        //     'icon' => '<i class="mobile-icon"></i>&nbsp;',
        //     'number' => $this->data['mobile_phone'],
        //     'text'  => $this->labels['mobile_prefix'],
        //     'xs_text' => $this->labels['mobile_clicktext']
        // ]);
        $mobArgs = [
            'type' => 'mobile',
            'icon' => '<i class="mobile-icon"></i>&nbsp;',
            'value' => $this->data['mobile_phone'],
            'text' => $this->labels['mobile_prefix'],
            'xs_text' => $this->labels['mobile_clicktext']
        ];
        $mobile = $this->contactMethodMarkup($mobArgs, 'text');

        $contacts = [];
        if(!empty($email)) {
            $contacts['email'] = $email;
        }
        if (!empty($landline)) {
            $contacts['landline'] = $landline;
        }
        if (!empty($mobile)) {
            $contacts['mobile'] = $mobile;
        }
        if (!empty($extra)) {
            $class = 'extra '. $additional['type'];
            $contacts[$class] = $extra;
        }
        return $contacts;
    }

    /**
    * [contactMethodMarkup description]
    * @param [type] $additional [description]
    */
    public function contactMethodMarkup($contactMethod, $display = 'text')
    {
        if ('list' === $display) {
            $display = 'text';
        }
        $output = NULL;
        switch ($contactMethod['type']) {
            case 'mobile':
            $output = MakePhoneLink::$display([
                'icon' => '<i class="mobile-icon"></i>&nbsp;',
                'text'  => $contactMethod['label'] ?? $this->labels['mobile_prefix'],
                'mobile_text' => $contactMethod['mobile_label'] ?? $this->labels['mobile_clicktext'],
                'number' => $contactMethod['value'],
            ]);
            break;

            case 'landline':
            $output = MakePhoneLink::buildLink([
                'icon' => '<i class="landline-icon"></i>&nbsp;',
                'text'  => $contactMethod['label'],
                'mobile_text' => $contactMethod['mobile_label'],
                'number' => $contactMethod['value']
            ], $display);
            break;

            case 'email':
            $output = MakeEmailLink::$display([
                'icon' => '<i class="email-icon"></i>&nbsp;',
                'text'  => $contactMethod['label'],
                'email' => $contactMethod['value']
            ]);
            break;
        }
        return $output;
    }

    /**
     * [select description]
     * @param  [type] $args    [description]
     * @param  string $display 'buttons'|'list'|'text'
     * @return [type]          [description]
     */
    public function createContactMethod($contactMethods, $display = 'text')
    {
        $output = [];
        foreach ($contactMethods as $type => $attributes) {
            $args['label'] = $attributes['desktop_text'];
            $args['mobile_label'] = $attributes['mobile_text'];
            $args['value'] = $attributes['value'];
            $args['type'] = $type;
            $output[] = $this->contactMethodMarkup($args, $display);
        }
        return $output;
    }
}
