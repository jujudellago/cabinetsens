/* global jQuery:false */
/* global CALLIE_BRITT_STORAGE:false */

jQuery(document).ready(function() {
	"use strict";

	// Switch active skin
	jQuery('#callie_britt_about_section_skins a.callie_britt_about_block_link_choose_skin').on('click', function(e) {
		if (confirm(CALLIE_BRITT_STORAGE['msg_switch_skin'])) {
			var link = jQuery(this);
			jQuery.post( CALLIE_BRITT_STORAGE['ajax_url'], {
					'action': 'callie_britt_switch_skin',
					'skin': link.data('skin'),
					'nonce': CALLIE_BRITT_STORAGE['ajax_nonce']
				},
				function(response){
					var rez = {};
					if (response=='' || response==0) {
						rez = { error: CALLIE_BRITT_STORAGE['msg_ajax_error'] };
					} else {
						try {
							rez = JSON.parse(response);
						} catch (e) {
							rez = { error: CALLIE_BRITT_STORAGE['msg_ajax_error'] };
							console.log(response);
						}
					}
					// Show result
					alert(rez.error ? rez.error : CALLIE_BRITT_STORAGE['msg_switch_skin_success']);
					// Reload current page after the skin is switched (if success)
					if (rez.error == '')
						location.reload(true);
				});
		}
		e.preventDefault();
		return false;
	});
});