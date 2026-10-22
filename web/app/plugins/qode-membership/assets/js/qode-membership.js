// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
if (typeof qodeSocialLoginVars !== 'undefined') {
    var facebookAppId = qodeSocialLoginVars.social.facebookAppId;
}
if (facebookAppId) {
    window.fbAsyncInit = function () {
        FB.init({
            appId: facebookAppId, //265124653818954 - test app ID
            cookie: true,  // enable cookies to allow the server to access
            xfbml: true,  // parse social plugins on this page
            version: 'v2.5' // use version 2.5
        });

        window.FB = FB;
    };
}

(function ($) {
    "use strict";

    var socialLogin = {};
    if ( typeof qode !== 'undefined' ) {
        qode.modules.socialLogin = socialLogin;
    }

    socialLogin.qodeUserLogin = qodeUserLogin;
    socialLogin.qodeUserRegister = qodeUserRegister;
    socialLogin.qodeUserLostPassword = qodeUserLostPassword;
    socialLogin.qodeInitLoginWidgetModal = qodeInitLoginWidgetModal;
    socialLogin.qodeInitFacebookLogin = qodeInitFacebookLogin;
    socialLogin.qodeUpdateUserProfile = qodeUpdateUserProfile;

    $(document).ready(qodeOnDocumentReady);
    $(window).on('load', qodeOnWindowLoad);
    $(window).resize(qodeOnWindowResize);
    $(window).scroll(qodeOnWindowScroll);

    /**
     * All functions to be called on $(document).ready() should be in this function
     */
    function qodeOnDocumentReady() {
        qodeInitLoginWidgetModal();
        qodeUserLogin();
        qodeUserRegister();
        qodeUserLostPassword();
        qodeUpdateUserProfile();
	    qodeInitLoginDropDownPosition();
    }

    function qodeOnWindowLoad() {
        qodeInitFacebookLogin();
    }

    /**
     * All functions to be called on $(window).resize() should be in this function
     */
    function qodeOnWindowResize() {
    }

    /**
     * All functions to be called on $(window).scroll() should be in this function
     */
    function qodeOnWindowScroll() {
    }
    
    $( document.body ).on(
        'qode_membership_trigger_login_modal',
        function () {
            qodeOpenModal();
        }
    );

    /**
     * Initialize login widget modal
     */
    function qodeInitLoginWidgetModal() {

        var modalOpener = $('.qode-login-opener');

        if (modalOpener) {
            //Init opening login modal
            modalOpener.click(function (e) {
                e.preventDefault();
                qodeOpenModal();
            });
            
            qodeInitCloseModal();
        }
    }
    
    function qodeOpenModal() {
        var modalHolder = $('.qode-login-register-holder'),
            tabsHolder = $('.qode-login-register-content');
        
        if( modalHolder.length ) {
            modalHolder.fadeIn(300);
            modalHolder.addClass('opened');
        }
        
        //Init tabs
        tabsHolder.tabs();
    }
    
    function qodeInitCloseModal() {
        var modalHolder = $('.qode-login-register-holder'),
            modalCloser = $('.qode-membership-close-modal .icon_close')
            
        if( modalHolder.length ) {
            modalHolder.click(function (e) {
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            $('.qode-login-register-content').click(function (e) {
                e.stopPropagation();
            });
            
            //Closing of modal when X is pressed
            modalCloser.click(function (e) {
                e.preventDefault();
                if (modalHolder.hasClass('opened')) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
            
            // on esc too
            $(window).on('keyup', function (e) {
                if (modalHolder.hasClass('opened') && e.keyCode == 27) {
                    modalHolder.fadeOut(300);
                    modalHolder.removeClass('opened');
                }
            });
        }
    }

	/**
	 * Initialize login dropdown position
	 */
	function qodeInitLoginDropDownPosition() {

		var dropdown = $('.header_bottom .qode-login-dropdown');

		if (dropdown && dropdown.parent().offset()) {
				var browserWidth = $(window).width();
				var boxedLayout; // boxed layout width

				var menuItemPosition = dropdown.parent().offset().left;
				var subMenuWidth = dropdown.width();
				var menuItemFromLeft = browserWidth - menuItemPosition;

				if(menuItemFromLeft < subMenuWidth){
					dropdown.addClass('qode-dd-right-position');
				}


		}
	}

    /**
     * Login user via Ajax
     */
    function qodeUserLogin() {
        $('.qode-login-form').on('submit', function (e) {
            e.preventDefault();
            var ajaxData = {
                action: 'qode_membership_login_user',
                security: $(this).find('#qode-login-security').val(),
                login_data: $(this).serialize()
            };
            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: QodeAdminAjax.ajaxurl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    qodeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        setTimeout( function() {
                            window.location = response.redirect;
                        }, 1000 );
                    }
                }

            });
            return false;
        });
    }

    /**
     * Register New User via Ajax
     */
    function qodeUserRegister() {

        $('.qode-register-form').on('submit', function (e) {

            e.preventDefault();
            var ajaxData = {
                action: 'qode_membership_register_user',
                security: $(this).find('#qode-register-security').val(),
                register_data: $(this).serialize()
            };

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: QodeAdminAjax.ajaxurl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    qodeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

            return false;
        });
    }

    /**
     * Reset user password
     */
    function qodeUserLostPassword() {

        var lostPassForm = $('.qode-reset-pass-form');
        lostPassForm.submit(function (e) {
            e.preventDefault();
            var data = {
                action: 'qode_membership_user_lost_password',
                security: lostPassForm.find('#qode-reset-security').val(),
                user_login: lostPassForm.find('#user_reset_password_login').val()
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: QodeAdminAjax.ajaxurl,
                success: function (data) {
                    var response = JSON.parse(data);
                    qodeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });
        });
    }

    /**
     * Response notice for users
     * @param response
     */
    function qodeRenderAjaxResponseMessage(response) {

        var responseHolder = $('.qode-membership-response-holder'), //response holder div
            responseTemplate = _.template($('.qode-membership-response-template').html()); //Locate template for info window and insert data from marker options (via underscore)

        var messageClass;
        if (response.status === 'success') {
            messageClass = 'qode-membership-message-succes';
        } else {
            messageClass = 'qode-membership-message-error';
        }

        var templateData = {
            messageClass: messageClass,
            message: response.message
        };

        var template = responseTemplate(templateData);
        responseHolder.html(template);
    }

    /**
     * Facebook Login
     */
    function qodeInitFacebookLogin() {
        var loginForm = $('.qode-facebook-login-holder');
        loginForm.submit(function (e) {
            e.preventDefault();
            window.FB.login(function (response) {
                qodeFacebookCheckStatus(response);
            }, {scope: 'email, public_profile'});
        });

    }

    /**
     * Check if user is logged into Facebook and App
     *
     * @param response
     */
    function qodeFacebookCheckStatus(response) {
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            qodeGetFacebookUserData( response.authResponse.accessToken );
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            console.log('Please log into this app');
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            console.log('Please log into Facebook');
        }
    }

    /**
     * Get user data from Facebook and login user
     */
    function qodeGetFacebookUserData( accessToken ) {
        console.log('Welcome! Fetching information from Facebook...');
        FB.api('/me', 'GET', {'fields': 'id, name, email, link, picture'}, function (response) {
            var nonce = $('.qode-facebook-login-holder [name^=qode_nonce_facebook_login]').val();
            response.nonce = nonce;
            response.image = response.picture.data.url;
            response.accessToken = accessToken;
            
            var data = {
                action: 'qode_membership_check_facebook_user',
                response: response
            };
            $.ajax({
                type: 'POST',
                data: data,
                url: QodeAdminAjax.ajaxurl,
                success: function (data) {
                    var response;
                    response = JSON.parse(data);

                    qodeRenderAjaxResponseMessage(response);
                    if (response.status == 'success') {
                        window.location = response.redirect;
                    }
                }
            });

        });
    }

    /**
     * Update User Profile
     */
    function qodeUpdateUserProfile() {
        var updateForm = $('#qode-membership-update-profile-form');
        if ( updateForm.length ) {
            var btnText = updateForm.find('button'),
                updatingBtnText = btnText.data('updating-text'),
                updatedBtnText = btnText.data('updated-text');

            updateForm.on('submit', function (e) {
                e.preventDefault();
                var prevBtnText = btnText.html();
                btnText.html(updatingBtnText);

                var ajaxData = {
                    action: 'qode_membership_update_user_profile',
                    data: $(this).serialize()
                };

                $.ajax({
                    type: 'POST',
                    data: ajaxData,
                    url: QodeAdminAjax.ajaxurl,
                    success: function (data) {
                        var response;
                        response = JSON.parse(data);

                        // append ajax response html
                        qodeRenderAjaxResponseMessage(response);
                        if (response.status == 'success') {
                            btnText.html(updatedBtnText);
                            window.location = response.redirect;
                        } else {
                            btnText.html(prevBtnText);
                        }
                    }
                });
                return false;
            });
        }
    }

})(jQuery);