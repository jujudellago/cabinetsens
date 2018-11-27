<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage CALLIE-BRITT
 * @since CALLIE-BRITT 1.0.10
 */

// Copyright area
?> 
<div class="footer_copyright_wrap<?php
				if (!callie_britt_is_inherit(callie_britt_get_theme_option('copyright_scheme')))
					echo ' scheme_' . esc_attr(callie_britt_get_theme_option('copyright_scheme'));
 				?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				$callie_britt_copyright = callie_britt_get_theme_option('copyright');
				if (!empty($callie_britt_copyright)) {
					// Replace {{Y}} or {Y} with the current year
					$callie_britt_copyright = str_replace(array('{{Y}}', '{Y}'), date('Y'), $callie_britt_copyright);
					// Replace {{...}} and ((...)) on the <i>...</i> and <b>...</b>
					$callie_britt_copyright = callie_britt_prepare_macros($callie_britt_copyright);
					// Display copyright
					echo wp_kses_post(nl2br($callie_britt_copyright));
				}
			?></div>
		</div>
	</div>
</div>
