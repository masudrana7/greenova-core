<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Greenova_Core;
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php if ( $data['list'] ) { ?>
    <div class="skill-area rt-progress-bar rt-style-<?php echo esc_attr($data['layout']);?>">
		<?php foreach ( $data['list'] as $item ) { ?>
			<?php
			if ( empty( $item['title'] ) || empty( $item['number'] ) ) {
				continue;
			}
			$title_color     = $item['title_color'];
			$bar_color       = $item['bar_color'];
			$title_color_css = $bar_color_css = '';
			if ( $title_color ) {
				$title_color_css = "border-color: {$title_color}; color: {$title_color}";
			}
			if ( $bar_color ) {
				$bar_color_css = "background-color: {$bar_color};";
			}
			$progressbar_value = (int) $item['number'];
			?>
            <div class="progress <?php echo esc_attr( $item['_id'] ) ?>">
                <div class="lead" style="<?php echo esc_attr( $title_color_css ); ?>"><?php echo esc_html( $item['title'] ); ?></div>
                <div
                        data-wow-delay="1.2s"
                        data-wow-duration="1.5s"
                        style="width: <?php echo esc_attr( $progressbar_value ); ?>%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft; <?php echo esc_attr( $bar_color_css ); ?>"
                        data-progress="<?php echo esc_attr( $progressbar_value ); ?>%"
                        class="progress-bar wow fadeInLeft animated">
                    <span><?php echo esc_attr( $progressbar_value ); ?>%</span>
                </div>
            </div>
		<?php } ?>
    </div>
<?php } else { ?>
	<?php esc_html_e( 'Please insert some data', 'greenova-core' ); ?>
<?php } ?>
