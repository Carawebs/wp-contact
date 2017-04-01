<?php
return [
    'type' => 'options_page',
    'setting' => [
        'option_name' => 'carawebs_address',
        'option_group' => 'main'
    ],
    'default_tab' => 'main',
    'page' => [
        'page_title' => 'Carawebs Address',
        'menu_title' => 'Address & Contact Details',
        'capability' => 'manage_options',
        'unique_page_slug' => 'carawebs-address-options-page',
    ],
    'sections' => [
        [
            'tab' => 'Main',
            'is_tab' => true,
            'option_name' => 'carawebs_address',
            'option_group' => 'main',
            'id' => 'main',
            'title' => 'Main Section',
            'description' => 'This is the main section.',
            'fields' =>[
                [
                    'type' => 'text',
                    'name' => 'company',
                    'title' => 'Company Name',
                    'default' => NULL,
                ],
                [
                    'type' => 'text',
                    'name' => 'line_1',
                    'title' => 'Address Line One',
                    'default' => NULL,
                    'placeholder' => 'Type here'
                ],
                [
                    'type' => 'text',
                    'name' => 'line_2',
                    'title' => 'Address Line Two',
                    'default' => NULL,
                ],
                [
                    'type' => 'text',
                    'name' => 'town',
                    'title' => 'Town',
                    'default' => NULL,
                ],
                [
                    'type' => 'text',
                    'name' => 'county',
                    'title' => 'County',
                    'default' => NULL,
                ],
                [
                    'type' => 'text',
                    'name' => 'postcode',
                    'title' => 'Postcode',
                    'default' => NULL,
                ],
                [
                    'type' => 'text',
                    'name' => 'country',
                    'title' => 'Country',
                    'default' => NULL,
                ],
            ]
        ],
        [
            'tab' => 'Social Media',
            'option_name' => 'carawebs_social',
            'option_group' => 'social-media', // At the moment, this MUST be the slugified 'tab' value @TODO Fix this!!
            'id' => 'social-media',
            'title' => 'Social Media',
            'description' => 'The social stuff.',
            'fields' =>[
                [
                    'type' => 'text',
                    'name' => 'facebook',
                    'title' => 'Facebook',
                    'desc' => 'Enter the URL of your Facebook page',
                    'placeholder' => ''
                ],
                [
                    'type' => 'text',
                    'name' => 'twitter',
                    'title' => 'Twitter',
                    'desc' => 'Enter the URL of your Twitter page',
                    'placeholder' => ''
                ],
                [
                    'type' => 'text',
                    'name' => 'pinterest',
                    'title' => 'Pinterest',
                    'desc' => 'Enter the URL of your Pinterest',
                    'placeholder' => ''
                ],
            ],
        ],
    ]
];
