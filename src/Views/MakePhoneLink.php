<?php
namespace Carawebs\Contact\Views;

use Carawebs\Contact\Traits\PartialSelector;

/**
* Prepares data and renders email elements
*
*/
class MakePhoneLink {

    use PartialSelector;

    /**
    * Render HTML markup for a phone button
    *
    * @param  array  $args   Array of arguments
    * @return string         HTML for a click to call button
    */
    public static function button(array $args = [])
    {
        return self::buildLink($args, 'button');
    }

    /**
    * Render HTML markup for a phone link
    *
    * @param  array  $args   Array of arguments
    * @return string         HTML for a click to call button
    */
    public static function text(array $args = [])
    {
        return self::buildLink($args, 'text');
    }

    /**
     * [buildLink description]
     * @param [type] $args [description]
     */
    public static function buildLink(array $args, $type)
    {
        $number = $args['number'];
        $desktopClasses = !empty($args['classes']['desktop']) ? $args['classes']['desktop'] : NULL;
        // var_dump($desktopClasses);
        // $desktopClasses = !empty($desktopClasses) ? ' ' . implode(' ', $desktopClasses) : NULL;
        $mobileClasses = !empty($args['classes']['mobile']) ? $args['classes']['mobile'] : NULL;
        $icon = !empty($args['icon']) ? $args['icon'] : NULL;
        $desktop_text = !empty($args['text']) ? $args['text'] : NULL;
        $mobile_text = !empty($args['mobileViewText']) ? $args['mobileViewText'] : NULL;

        ob_start();
        if ('button' === $type) {
            include(self::static_partial_selector('partials/buttons/phone-number'));
        } elseif ('text' === $type) {
            include(self::static_partial_selector('partials/text-link/phone-number'));
        }
        return ob_get_clean();
    }

    public static function link( array $args = [] )
    {
        echo self::text( $args );
    }
}
