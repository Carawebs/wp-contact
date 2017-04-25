<?php

namespace Carawebs\Contact\Views;

/**
*
*/
class ControllableContactAction
{

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
    public static function display( $args = [] )
    {
        if ( ! is_array( $args['include'] ) || empty( $args['include'] ) ) {
            return;
        }
        // Set up rational defaults
        // ---------------------------------------------------------------------
        $display = $args['display'] ?? 'button';
        $align = $args['align'] ?? 'left';
        $type = $args['type'] ?? NULL;
        $include = $args['include'] ?? NULL;
        $format = $args['format'] ?? NULL;
        $CTA_title = $args['CTA_title'] ?? NULL;
        $CTA_intro = $args['CTA_intro'] ?? NULL;

        ob_start();
        echo ! empty( $CTA_title ) ? '<h2 class="call-to-action">' . esc_html( $CTA_title ) . '</h2>' : NULL;
        ?>
        <div class="call-to-action text-<?= $align; ?>">
            <?php
            echo ! empty( $CTA_intro ) ? '<p>' . esc_html( $CTA_intro ) . '</p>' : NULL;
            echo 'list' === $format ? "<ul class='call-to-action'>" : NULL;
            foreach ($include as $type => $values) {

                $classname = "Carawebs\\Display\\" . $type;
                $classname = __NAMESPACE__ ."\\". $type;
                $args['desktop_text'] = $values['desktop_text']   ?? NULL;
                $args['mobile_text'] = $values['mobile_text'] ?? NULL;
                $args['override'] = $values['override'] ?? NULL;
                unset( $args['include'] );                   // No need to pass `$args['include']`
                $class = strtolower( $type );                // CSS class for li
                $output = ( $classname::$display( $args ) ); // $display = 'button' | 'text'

                echo ! empty ( $output )
                    ? 'list' === $format
                        ? "<li class='$class'>$output</li>"
                        : $output
                    : NULL;

            }

            echo 'list' === $format ? "</ul>" : NULL;

            ?>
        </div>
        <?php

        echo ob_get_clean();
    }

    /**
    * Output buttons.
    *
    * @param  array $args  Arguments extracted to build the call to action
    * @return array        Amended arguments
    */
    public static function buttons( $args = [] )
    {
        $args['display'] = "button";
        return self::display( $args );
    }

    /**
    * Output text.
    *
    * @param  array $args  Arguments extracted to build the call to action
    * @return array        Amended arguments
    */
    public static function text( $args = [] )
    {
        $args['display'] = "text";
        return self::display( $args );
    }

    /**
    * Output <ul>.
    *
    * @param  array $args  Arguments extracted to build the call to action
    * @return array        Amended arguments
    */
    public static function list( $args = [] )
    {
        $args['display'] = 'text';
        $args['format'] = 'list';
        return self::display( $args );
    }
}
