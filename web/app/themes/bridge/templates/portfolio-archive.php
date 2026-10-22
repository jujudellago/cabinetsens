<?php
$bridge_qode_options = bridge_qode_return_global_options();
?>
<?php get_header(); ?>
	<?php get_template_part( 'title' ); ?>
	<div class="container">
		<?php if ( isset( $bridge_qode_options['overlapping_content'] ) && $bridge_qode_options['overlapping_content'] == 'yes' ) { ?>
			<div class="overlapping_content"><div class="overlapping_content_inner">
		<?php } ?>
			<div class="container_inner default_template_holder clearfix">
				<?php echo bridge_qode_get_portfolio_archive_list_html(); ?>
			</div>
		<?php if ( isset( $bridge_qode_options['overlapping_content'] ) && $bridge_qode_options['overlapping_content'] == 'yes' ) { ?>
			</div></div>
		<?php } ?>
	</div>
<?php get_footer(); ?>
