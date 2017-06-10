<?php

namespace Carawebs\Contact\Views;

use Carawebs\Contact\Traits\PartialSelector;

/**
*
*/
class OutputMultipleContacts {

    use PartialSelector;

    /**
    * Output the call to action.
    *
    * Outputs multiple contact methods. These are determined by the `$args['include']`
    * array, which is structured in the format `[$classname => ['prefix'=>$prefix, 'text'=>$text]]`.
    * `$classname` can be `ClickMobile`, `ClickLandline` or `ClickEmail`. These refer
    * to the classes in the `Display` namespace that are used to construct
    * contact elements.
    *
    * @see http://stackoverflow.com/a/30647705/3590673 re: accessing classes through variables
    * @see http://php.net/manual/en/language.namespaces.dynamic.php
    * @param  array $args Arguments extracted to build the call to action
    * @return string      HTML markup of the call to action
    */
    public function display($args = [])
    {
        var_dump($args);
        if ( !is_array($args['includeContactMethods']) || empty($args['includeContactMethods'])) return;

        ob_start();
        echo !empty($args['CTA_title'])
        ? '<h2 class="call-to-action">' . esc_html($args['CTA_title']) . '</h2>'
        : NULL;
        ?>
        <div class="call-to-action text-<?= $args['align']; ?>">
            <?php
            echo !empty($args['CTA_intro']) ? '<p>' . esc_html($args['CTA_intro']) . '</p>' : NULL;
            $output = $this->buildContactMethods($args['includeContactMethods']);
            var_dump($output);
            switch ($args['display']) {
                case 'list':
                    include $this->partialSelector('contact-list');
                    break;
                case 'buttons':
                    include $this->partialSelector('contact-list');
                    break;
                default:
                    include $this->partialSelector('contact-list');
                    break;
            }
            ?>
        </div>
        <?php
        echo ob_get_clean();
    }

    private function buildContactMethods(array $includeContactMethods)
    {
        $output = [];
        foreach ($includeContactMethods as $type => $values) {
            $output[] = array_merge(['type' => $type], $values);
        }
        return $output;
    }

    /**
    * Output buttons.
    *
    * @param  array $args  Arguments extracted to build the call to action
    * @return array        Amended arguments
    */
    public function buttons($args = [])
    {
        $args['display'] = "button";
        return $this->display($args);
    }

    /**
    * Output text.
    *
    * @param  array $args  Arguments extracted to build the call to action
    * @return array        Amended arguments
    */
    public function text($args = [])
    {
        $args['display'] = "text";
        return $this->display($args);
    }

    /**
    * Output <ul>.
    *
    * @param  array $args  Arguments extracted to build the call to action
    * @return array        Amended arguments
    */
    public function list($args = [])
    {
        $args['display'] = 'text';
        $args['format'] = 'list';
        return $this->display( $args );
    }
}
