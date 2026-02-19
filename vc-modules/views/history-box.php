<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
// phpcs:disable WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
if ( ! defined( 'ABSPATH' ) ) exit;

$custom_class = vc_shortcode_custom_css_class( $css );
$historypoints = vc_param_group_parse_atts($history_points);
?>
<div class="<?php echo esc_attr( $custom_class );?>">
	<div class="rt-history-box">
		<h2 class="title-bar50"><?php echo wp_kses_post( $title ); ?></h2>
		<p><?php echo esc_html( $historytext );?></p>		
		<?php if ( $historypoints ) { ?>
		<ul class="rtin-history-list">
		<?php
			foreach ( $historypoints as $key => $tab ) {
		?>		
			<li>
				<h3><?php echo esc_html( $tab["pointtitle"] ); ?></h3>
				<p><?php echo esc_html( $tab["pointtext"] ); ?></p>
			</li>
		<?php } ?>			
		</ul>
		<?php } ?>
	</div>
</div>