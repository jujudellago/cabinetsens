<div class="qodef-re-profile-favorites-holder">
	<?php if ( ! empty( $user_favorites ) ) { ?>
        <h5 class="qodef-membership-page-title"><?php esc_html_e('Property Wishlist', 'qode-real-estate'); ?></h5>
		<?php foreach ( $user_favorites as $user_favorite ) { ?>
			<div class="qodef-re-profile-favorite-item">
				<div class="qodef-re-profile-favorite-item-image">
                    <a href="<?php echo get_the_permalink( $user_favorite ); ?>">
                        <?php
                        if ( has_post_thumbnail( $user_favorite ) ) {
                            $image = get_the_post_thumbnail_url( $user_favorite, 'thumbnail' );
                        } else {
                            $image = QODE_RE_CPT_URL_PATH . '/property/assets/img/property_featured_image.jpg';
                        }
                        ?>
                        <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( 'Property thumbnail', 'qode-real-estate' ) ?>"/>
                    </a>
                </div>
				<div class="qodef-re-profile-favorite-item-title">
					<h5>
						<a href="<?php echo get_the_permalink( $user_favorite ); ?>">
							<?php echo get_the_title( $user_favorite ); ?>
						</a>
                        <a href="javascript:void(0)" class="qodef-re-item-favorites" data-item-id="<?php echo esc_attr($user_favorite); ?>">
                            <i class="qodef-re-favorites-icon fa fa-heart"></i>
                        </a>
					</h5>
				</div>
			</div>
			<?php
		}
	} else { ?>
		<h5><?php esc_html_e( 'Your favorites list is empty.', 'qode-real-estate' ) ?> </h5>
	<?php } ?>
</div>