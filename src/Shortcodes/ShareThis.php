<?php
namespace Carawebs\Contact\Shortcodes;

use Carawebs\Contact\Traits\PartialSelector;

/**
* Handler for Share This button shortcode
*/
class ShareThis implements Shortcode {

    use PartialSelector;

    public function handler ( $atts, $content = NULL ) {

        extract( shortcode_atts([
            'heading' => NULL,
            'display' => 'normal'
        ], $atts ));

        $args = [
            'heading' => $heading
        ];

        if ( 'justified' === $display ) {
            ob_start();
            ?>
            <div class="justified-social-container">
                <div class="social-sharing share-this btn-group btn-group-justified">
                    <?php include $this->partial_selector( 'share-this'); ?>
                </div>
            </div>
            <?php
            return ob_get_clean();

        } else {
            ob_start();
            echo apply_filters( 'carawebs\themehelper_share_title', '<h3>Share This:</h3>') ;
            ?>
            <p class="share-this">
                <?php include $this->partial_selector( 'share-this'); ?>
            </p>
            <?php
            return ob_get_clean();
        }
    }
}
