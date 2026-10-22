<?php

$item_id = get_the_ID();
$user_id = get_current_user_id();

$current_items_array    = get_user_meta( $user_id, 'qodef_item_favorites', true);
$current_items_array 	= !empty($current_items_array) ? $current_items_array : array();

if ( ! empty( $current_items_array ) && in_array( $item_id, $current_items_array ) ) {
    $text = esc_html__( 'Remove From Wishlist', 'qode-real-estate' );
    $icon_class = 'fa-heart';
} else {
    $text = esc_html__( 'Add To Wishlist', 'qode-real-estate' );
    $icon_class = 'fa-heart-o';
}

?>
<a href="javascript:void(0)" class="qodef-re-item-favorites" data-item-id="<?php echo esc_attr($item_id); ?>">
    <i class="qodef-re-favorites-icon fa <?php echo esc_attr( $icon_class ); ?>"></i>
    <span class="qodef-re-favorites-text">
        <?php echo esc_html( $text ); ?>
    </span>
</a>
