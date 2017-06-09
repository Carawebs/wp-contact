<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Traits\CssClasses;
use Carawebs\Contact\Views\MakeEmailLink;

/**
* Hook function for Email Button shortcode
*/
class EmailLink extends ContactAction {

    use CssClasses;

    public function __construct()
    {
        parent::__construct();
        $this->setDefaultContactStrings([
            'text' => 'Email Us',
            'mobileViewText' => 'Email Us'
        ]);
    }

    /**
     * Override the handler method from parent.
     *
     * This method is called when the shortcode is registered.
     * @param  array $atts Shortcode arguments
     * @param  string $content Shortcode contents
     * @return string Shortcode output
     */
    public function handler($atts, $content = NULL)
    {
        $args = shortcode_atts([
            'align' => 'left',
            'text' => $this->defaultContactStrings['text'] ?? NULL,
            'mobile_view_text' => $this->defaults['mobileViewText'] ?? NULL,
            'classes' => '',
            'email' => $this->defaultContactDetails['email'],
        ], $atts );
        $args['text'] = !empty($content) ? $content : $args['text'];
        $args['classes'] = !empty($args['classes'])
            ? explode( ',', preg_replace('/\s/', '', $args['classes']))
            : [];
        return $this->output($args);
    }

    protected function output(array $args)
    {
        $args['linkClasses'] = array_merge(['email-link'], $args['classes']);
        ob_start();
        echo MakeEmailLink::text($args);
        return ob_get_clean();
    }
}
