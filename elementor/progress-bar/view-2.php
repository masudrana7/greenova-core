<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if ( ! defined( 'ABSPATH' ) ) exit;

?>
<div class="rt-progress-bar rt-progress-<?php echo esc_attr($data['layout']);?>">
	<?php if ( $data['list'] ) { ?>
        <div class="rt-progress-bar-1">
            <div class="skill">
				<?php
				foreach ( $data['list'] as $key => $tab ) {
					$title_color     = $tab['title_color'];
					$bar_color       = $tab['bar_color'];
					$title_color_css = $bar_color_css = '';
					if ( $title_color ) {
						$title_color_css = "color: {$title_color}";
					}
					if ( $bar_color ) {
						$bar_color_css = "background-color: {$bar_color};";
					}

					?>
                    <div class="progress">
                        <div class="lead" style="<?php echo esc_attr( $title_color_css ); ?>;">
							<?php echo esc_html( $tab["title"] ); ?>
                        </div>
                        <div
                                class="progress-bar wow fadeInLeft"
                                data-progress="<?php echo esc_html( $tab["number"] ); ?>%"
                                style="width: <?php echo esc_html( $tab["number"] ); ?>%; <?php echo esc_attr( $bar_color_css ); ?>;"
                                data-wow-duration="1.5s"
                                data-wow-delay="1.2s">
                            <span><?php echo esc_html( $tab["number"] ); ?>%</span>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
	<?php } else { ?>
		<?php esc_html_e( 'Please insert some data', 'greenova-core' ); ?>
	<?php } ?>
</div>