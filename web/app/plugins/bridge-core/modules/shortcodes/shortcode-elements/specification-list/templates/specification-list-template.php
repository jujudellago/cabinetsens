<div class="qode-specification-list">
	<?php if($image != '') : ?>
		<div class="qode-specification-list-image">
			<img src="<?php echo wp_get_attachment_url($image) ?>" alt="" />
		</div>
	<?php endif; ?>
	<div class="qode-specification-list-text-holder">
		<<?php echo bridge_qode_get_escape_title_tag($title_tag); ?> class="qode-specification-list-title">
			<?php echo esc_attr($title); ?>
		</<?php echo bridge_qode_get_escape_title_tag($title_tag); ?>>
		<?php if ( ! empty( $list_items ) && count( $list_items ) > 0 ) : ?>
			<div class="qode-specification-list-items">
				<?php foreach ( $list_items as $list_item ): ?>
					<div class="qode-specification-list-item">
						<?php if ( ! empty( $list_item['label'] ) ) : ?>
							<span class="qode-specification-list-item-label">
								<?php echo esc_attr($list_item['label']); ?>
							</span>
						<?php endif; ?>
						<?php if ( ! empty( $list_item['value'] ) ) : ?>
							<span class="qode-specification-list-item-value">
								<?php echo esc_attr($list_item['value']); ?>
							</span>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
	<?php if($enable_button): ?>
		<div class="qode-specification-list-holder">
			<a itemprop="url" class="qode-qbutton-main-color qode-qbutton-full-width qode-qbutton-square" href="<?php echo esc_url($button_link); ?>" target="<?php echo esc_attr($button_target); ?>" <?php echo bridge_qode_get_inline_style($button_style); ?>><span><?php echo esc_attr($button_text); ?></span></a>
		</div>
	<?php endif; ?>
</div>