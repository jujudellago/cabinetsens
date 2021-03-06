<?php
if ( post_password_required() ) { ?>

    <p class="qode-no-password">
        <?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'qode-lms' ); ?>
    </p>

<?php }
else {
    if ( have_comments() ) { ?>

        <div class="qode-comment-holder clearfix" id="comments">
            <div class="qode-comment-holder-inner">
                <div class="qode-comments-title-holder">
                    <h5 class="qode-comments-title">
                        <?php esc_html_e('Course Reviews', 'qode-lms' ); ?>
                    </h5>
                </div>
                <div class="qode-comments">
                    <ul class="qode-comment-list">
                        <?php
                        $post_comments = qode_lms_get_current_post_comments(get_the_ID());
                        echo qode_lms_post_reviews_html($post_comments, get_the_ID());
                        ?>
                    </ul>
                </div>
            </div>

        </div>

    <?php }

    else {
        if ( ! comments_open() ) { ?>
            <p>
                <?php esc_html_e('Sorry, the comment form is closed at this time.', 'qode-lms'); ?>
            </p>
        <?php }
    }
}
$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );
$button_params  = array(
    'text' => esc_html__('Write Your Review', 'qode-lms'),
    'custom_class' => 'qode-lms-button qode-button-shadow qode-rating-form-trigger',
    'html_type' => 'button'
);

$args = array(
    'id_form' => 'commentform',
    'id_submit' => 'submit_comment',
    'title_reply'=> esc_html__( 'POST A REVIEW','qode-lms' ),
    'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
    'title_reply_after' => '</h4>',
    'title_reply_to' => esc_html__( 'Post a Reply to %s','qode-lms' ),
    'cancel_reply_link' => esc_html__( 'cancel reply','qode-lms' ),
    'label_submit' => esc_html__( 'Send Review','qode-lms' ),
    'comment_field' => '<label>Write Your Message</label><textarea id="comment" placeholder="'.esc_html__( 'Your comment','qode-lms' ).'" name="comment" cols="45" rows="6" aria-required="true"></textarea>',
    'comment_notes_before' => '',
    'comment_notes_after' => '',
    'fields' => apply_filters( 'comment_form_default_fields', array(
            'author'    => '<label>' . esc_html__( 'Your Full Name','qode-lms') . '</label><input id="author" name="author" placeholder="'. esc_html__( 'Your Name','qode-lms' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
            'email'     => '<label>' . esc_html__( 'Your E-mail Address','qode-lms') . '</label><input id="email" name="email" placeholder="'. esc_html__( 'Your Email','qode-lms' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />'
        )
    )
);
$args['comment_field'] = '<textarea id="comment" placeholder="'.esc_html__( 'Your Experience','qode-lms' ).'" name="comment" cols="45" rows="8" aria-required="true"></textarea>';
$args['fields'] = apply_filters( 'comment_form_default_fields', array(
        'author' => '<input id="author" name="author" placeholder="'. esc_html__( 'Your full name','qode-lms' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />',
        'url' => '<input id="email" name="email" placeholder="'. esc_html__( 'E-mail address','qode-lms' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />',
    )
);

if(get_comment_pages_count() > 1){ ?>
    <div class="qode-comment-pager">
        <p>
            <?php paginate_comments_links(); ?>
        </p>
    </div>
<?php }

if(comments_open()) {
    $log_class = '';
    if ( is_user_logged_in() ) {
        $log_class = 'logged-in';
    }
    ?>
    <div class="qode-comment-form  <?php echo esc_attr($log_class);?>" >
        <div class="qode-comment-form-inner">

            <?php
            echo bridge_core_get_button_html($button_params);
            comment_form($args);
            ?>
        </div>
    </div>
<?php }