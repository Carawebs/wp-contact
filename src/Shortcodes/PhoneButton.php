<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Traits\CssClasses;

/**
* Common code for Phone Buttons (Mobile & Landline)
*/
class PhoneButton extends ContactAction {

    use CssClasses;

    public function handler( $atts, $content = NULL )
    {
        $args = shortcode_atts([
            'text' => $this->defaultContactStrings['text'] ?? NULL,
            'mobile_view_text' => $this->defaultContactStrings['mobileViewText'] ?? NULL,
            'classes' => '',
            'number' => $this->number,
        ], $atts );

        if (empty($args['number'])) return;
        $args['mobileViewText'] = $args['mobile_view_text'];
        $args['classes'] = explode( ',', preg_replace('/\s/', '', $args['classes']));
        $args['icon'] = $this->icon;
        $args['classes'] = $this->buttonClasses($args['classes']);

        ob_start();
        echo \Carawebs\Contact\Views\MakePhoneLink::button($args);
        return ob_get_clean();
    }

    /**
     * Run this in a child class so that number can be properly controlled whilst
     * avoiding code duplication.
     *
     * @param string $number The phone number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * Run this in a child class so that the icon can be properly controlled whilst
     * avoiding code duplication.
     *
     * @param string $icon [description]
     */
    public function setIcon(string $icon)
    {
        $this->icon = $icon;
    }
}
