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
            'text' => $this->labels['emailText'],
        ]);
        $landline = MakePhoneLink::text([
            'icon' => '<i class="landline-icon"></i>&nbsp;',
            'number' => $this->data['landline_phone'],
            'text'  => $this->labels['landlineText'],
            'mobileViewText' => $this->labels['landlineClickText']
        ]);
        $mobile = MakePhoneLink::text([
            'icon' => '<i class="mobile-icon"></i>&nbsp;',
            'number' => $this->data['mobile_phone'],
            'text'  => $this->labels['mobileText'],
            'mobileViewText' => $this->labels['mobileClickText']
        ]);

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
    * Build markup for a given contact method.
    *
    * @param array $contactMethod Contact method arguments.
    * @param string $display 'text'|'button'|'list'
    */
    public function contactMethodMarkup($contactMethod, $display = 'text')
    {
        if ('list' === $display) {
            $display = 'text';
        }
        if ('buttons' === $display) {
            $display = 'button';
        }
        $output = NULL;
        switch ($contactMethod['type']) {
            case 'mobile':
            $output = MakePhoneLink::$display([
                'icon' => '<i class="mobile-icon"></i>&nbsp;',
                'text'  => $contactMethod['text'] ?? $this->labels['mobileText'],
                'mobileViewText'  => !empty($contactMethod['mobileViewText']) ? $contactMethod['mobileViewText'] : $this->labels['mobileClickText'],
                'number' => $contactMethod['value'],
            ]);
            break;

            case 'landline':
            $output = MakePhoneLink::buildLink([
                'icon' => '<i class="landline-icon"></i>&nbsp;',
                'text'  => !empty($contactMethod['text']) ? $contactMethod['text'] : $this->labels['landlineText'],
                'mobileViewText'  => !empty($contactMethod['mobileViewText']) ? $contactMethod['mobileViewText'] : $this->labels['landlineClickText'],
                'number' => $contactMethod['value'],
                // Pass classes if necessary
                //'classes' => ['desktop' => ['foo','bar']],
            ], $display);
            break;

            case 'email':
            $output = MakeEmailLink::$display([
                'icon' => '<i class="email-icon"></i>&nbsp;',
                'text'  => !empty($contactMethod['text']) ? $contactMethod['text'] : $this->labels['emailText'],
                'mobileViewText'  => !empty($contactMethod['mobileViewText']) ? $contactMethod['mobileViewText'] : $this->labels['emailMobileViewText'],
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
            $args['text'] = $attributes['text'];
            $args['mobileViewText'] = $attributes['mobileViewText'];
            $args['value'] = $attributes['value'];
            $args['type'] = $type;
            $output[] = $this->contactMethodMarkup($args, $display);
        }
        return $output;
    }
}
