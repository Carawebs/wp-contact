<?php
namespace Carawebs\Contact\Views;

use Carawebs\Contact\Traits\PartialSelector;

/**
* Prepares data and renders email elements*
*/
class MakeEmailLink {

    use PartialSelector;

    /**
    * Return HTML markup for an email button
    *
    * @param array $args Array of arguments
    * @return string HTML for an email button
    */
    public static function button(array $args = [])
    {
        return self::buildLink($args, 'button');
    }

    /**
    * Return HTML markup for an email link.
    *
    * @param array $args Array of arguments
    * @return string HTML for the email link
    */
    public static function text (array $args = [])
    {
        return self::buildLink($args, 'text');
    }

    /**
     * Return mailto anchor tag markup.
     *
     * @param array $args Required arguments
     * @param string $type button|text|link
     */
    private static function buildLink(array $args, $type)
    {
        $email = $args['email'] ?? NULL;
        if(empty($email)) return;
        $email = antispambot($email);
        $desktopClasses = !empty($args['classes']['desktop']) ? $args['classes']['desktop'] : NULL;
        $mobileClasses = !empty($args['classes']['mobile']) ? $args['classes']['mobile'] : NULL;
        $icon = !empty($args['icon']) ? $args['icon'] : NULL;
        $desktop_text = !empty($args['text']) ? $args['text'] : "Email Us";
        $mobile_text = !empty($args['mobileViewText']) ? $args['mobileViewText'] : "Email Us";

        ob_start();
        if ('button' === $type) {
            include(self::static_partial_selector('partials/buttons/email'));
        } elseif ('text' === $type) {
            include(self::static_partial_selector('partials/text-link/email'));
        }
        return ob_get_clean();
    }

    /**
     * Alias to the text() method.
     * @param array $args Array of arguments
     * @return string HTML for the email link
     */
    public static function link(array $args = [])
    {
        return self::buildLink($args, 'text');
    }
}
