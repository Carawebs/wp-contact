<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Traits\PartialSelector;
/**
 *
 */
class SocialFollow extends ContactAction
{
    use PartialSelector;

    public function handler( $atts, $content = NULL )
    {
        $args = shortcode_atts([

        ], $atts );

        $socialLinks = [];
        foreach ($this->socialMediaDetails as $key => $value) {
            if(empty($value)) continue;
            $socialLinks[$key] = [
                'name' => ucfirst($key),
                'link' => $value
            ];
        }
        if (empty($socialLinks)) return;

        ob_start();
        include($this->static_partial_selector('partials/social/list'));
        return ob_get_clean();
    }
}
