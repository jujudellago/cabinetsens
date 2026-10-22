(function($){
	"use strict";
	var defaults = {
		itemIdSelector: "#ql-license-item-id",
		verificationDateSelector: "#ql-license-verification-date",
		supportedUntilSelector: "#ql-license-supported-until",
		messageClasses: "updated error notice ql-license-hide",
		messageContainerSelector: ".ql-license-message",
		spinnerSelector: ".ql-spinner",
		verifyLicenseButtonSelector: "#ql-verify-license",
		removeLicenseButtonSelector: "#ql-remove-license",
		reauthorizeAPIButtonSelector: "#ql-reauthorize-api",
		purchaseCodeSelector: "#ql-license-purchase-code"
	};
	
	function startSpinner(spinnerSelector)
	{
		$(spinnerSelector).css({
			"display": "inline-block",
			"visibility": "visible"
		});
	}
	
	function stopSpinner(spinnerSelector)
	{
		$(spinnerSelector).css({
			"display": "none",
			"visibility": "hidden"
		});
	}

	var methods =
	{
		init: function(options){
			return this.each(function(){
				options = $.extend(false, defaults, options);
				var self = $(this);
				self.data("verify-license-options", options);
				$(options.verifyLicenseButtonSelector+":not('.button-disabled')").one("click", {do_verify_license: true}, function(event){self.purchaseVerification("saveLicense", event);});
				$(options.removeLicenseButtonSelector+":not('.button-disabled')").one("click", function(event){self.purchaseVerification("removeLicense", event);});
				$(options.reauthorizeAPIButtonSelector).on("click", function(event){
					event.preventDefault();
					if(!$(this).hasClass("button-disabled"))
					{
						ql_config.refresh_token = false;
						self.purchaseVerification("verifyLicense");
					}
				});
				self.on("click", ".button-disabled", function(event){
					event.preventDefault();
				});
				if(ql_config.run_verification)
				{
					self.purchaseVerification("verifyLicense");
				}
			});
		},
		saveLicense : function(event, args){
			var self = $(this);
			var options = self.data("verify-license-options");
			if(typeof(event.type)!="undefined" && event.type=="click")
			{
				event.preventDefault();
				$(options.messageContainerSelector).eq(1).remove();
				$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("notice").html('<p>'+ql_config.license_processing_message+'</p>');
				startSpinner(options.spinnerSelector);
				$(options.verifyLicenseButtonSelector + "," + options.reauthorizeAPIButtonSelector).addClass("button-disabled");
			}
			var purchase_code = $(options.purchaseCodeSelector).val();
			if(String(purchase_code).trim()!="")
			{
				var data = $("input", self).serializeArray();
				data.push({ name: "action", value: "ql_save_license" });
				data.push({ name: "ql_purchase_verification_ajax_nonce", value: ql_config.ql_purchase_verification_ajax_nonce });
				$.ajax({
					url: ajaxurl,
					type: "post",
					data: data,
					dataType: "json",
					success: function(json){
						if(typeof(json.isOk)!="undefined" && json.isOk)
						{
							if(typeof(event.data)!="undefined" && event.data.do_verify_license)
							{
								self.purchaseVerification("verifyLicense");
							}
							else
							{
								if(typeof(event.data)!="undefined" && event.data.license_verified)
								{
									$(options.purchaseCodeSelector).prop("readonly", true);
									$.each(json.licence, function(key, value){
										if(key=="verification_date" || key=="supported_until")
										{
											$("[name='ql_license_"+key+"']").val(value);
										}
									});
									$(".ql-license-hide", self).removeClass("ql-license-hide");
									$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("updated").html('<p>'+ql_config.license_verified_message+'</p>');
									$(options.removeLicenseButtonSelector).off("click");
									$(options.removeLicenseButtonSelector).one("click", function(event){self.purchaseVerification("removeLicense", event);}).removeClass("button-disabled");
								}
								else
								{
									$(options.verifyLicenseButtonSelector).off("click");
									$(options.verifyLicenseButtonSelector).one("click", {do_verify_license: true}, function(event){self.purchaseVerification("saveLicense", event);}).removeClass("button-disabled");
									$(options.reauthorizeAPIButtonSelector).removeClass("button-disabled");
								}
								stopSpinner(options.spinnerSelector);
							}
						} 
						else 
						{
							if(typeof(json.error_message)!="undefined")
							{
								$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("error").html('<p>'+ql_config.license_not_verified_message+"<br>"+json.error_message+'</p></div>');
								$(options.itemIdSelector).val(ql_config.item_id);
								$(options.verifyLicenseButtonSelector).off("click");
								$(options.verifyLicenseButtonSelector).one("click", {do_verify_license: true}, function(event){self.purchaseVerification("saveLicense", event);}).removeClass("button-disabled");
								$(options.reauthorizeAPIButtonSelector).removeClass("button-disabled");
								stopSpinner(options.spinnerSelector);
							}
						}
					}
				});
			}
			else
			{
				stopSpinner(options.spinnerSelector);
				$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("error").html('<p>'+ql_config.purchase_code_error_message+'</p></div>');
				$(options.verifyLicenseButtonSelector).off("click");
				$(options.verifyLicenseButtonSelector).one("click", {do_verify_license: true}, function(event){self.purchaseVerification("saveLicense", event);}).removeClass("button-disabled");
				$(options.reauthorizeAPIButtonSelector).removeClass("button-disabled");
			}
		},
		verifyLicense : function(event, args){
			var self = $(this);
			var options = self.data("verify-license-options");
			if(!ql_config.refresh_token)
			{
				window.location.href = ql_config.verify_url+"?site_url="+ql_config.verify_return_url;
				return false;
			}
			var purchase_code = $(options.purchaseCodeSelector).val();
			if(ql_config.run_verification)
			{
				if(String(purchase_code).trim()!="")
				{
					$(options.verifyLicenseButtonSelector).off("click").addClass("button-disabled");
					$(options.reauthorizeAPIButtonSelector).addClass("button-disabled");
				}
				$(options.messageContainerSelector).eq(1).remove();
				$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("notice").html('<p>'+ql_config.license_processing_message+'</p>');
				startSpinner(options.spinnerSelector);
			}
			if(String(purchase_code).trim()!="")
			{
				$.ajax({
						url: ql_config.verify_url,
						type: "post",
						data: "item_id="+ql_config.item_id+"&purchase_code="+purchase_code+"&refresh_token="+ql_config.refresh_token+"&domain="+ql_config.http_host,
						dataType: "json",
						success: function(json){
							if(typeof(json.isOk)!="undefined" && json.isOk)
							{
								if(json.buyer_purchase)
								{
									$.each(json.buyer_purchase, function(key, value){
										$("[name='ql_license_"+key+"']").val(value);
									});
									if(typeof(json.message)!="undefined")
									{
										$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("updated").html('<p>'+json.message+'</p></div>');
									}
									self.purchaseVerification("saveLicense", {data: {do_verify_license: false, license_verified: true}});
								}
							}
							else 
							{
								if(typeof(json.error_message)!="undefined")
								{
									$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("error").html('<p>'+ql_config.license_not_verified_message+"<br>"+json.error_message+'</p></div>');
								}
								$(options.verificationDateSelector).val("").parent().parent().addClass("ql-license-hide");
								$(options.supportedUntilSelector).val("").parent().parent().addClass("ql-license-hide");
								self.purchaseVerification("saveLicense", {data: {do_verify_license: false, license_verified: false}});
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
						}
				});
			}
			else
			{
				stopSpinner(options.spinnerSelector);
				$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("error").html('<p>'+ql_config.purchase_code_error_message+'</p></div>');
			}
		},
		removeLicense : function(event, args){
			event.preventDefault();
			var self = $(this);
			var options = self.data("verify-license-options");
			var consent = confirm(ql_config.license_confirm_remove_message);
			if(!consent)
			{
				$(options.removeLicenseButtonSelector).one("click", function(event){self.purchaseVerification("removeLicense", event);});
				return;
			}
			$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("notice").html('<p>'+ql_config.license_processing_message+'</p>');
			startSpinner(options.spinnerSelector);
			$(options.removeLicenseButtonSelector).addClass("button-disabled");
			var purchase_code = $(options.purchaseCodeSelector).val();
			$.ajax({
					url: ql_config.verify_url,
					type: "post",
					data: "action=remove&item_id="+ql_config.item_id+"&purchase_code="+purchase_code+"&refresh_token="+ql_config.refresh_token+"&domain="+ql_config.http_host,
					dataType: "json",
					success: function(json){
						if(typeof(json.isOk)!="undefined" && json.isOk)
						{
							var data = [
								{ name: "action", value: "ql_remove_license" },
								{ name: "ql_purchase_verification_ajax_nonce", value: ql_config.ql_purchase_verification_ajax_nonce }
							];
							$.ajax({
								url: ajaxurl,
								type: "post",
								data: data,
								dataType: "json",
								success: function(json){
									if(typeof(json.isOk)!="undefined" && json.isOk)
									{
										if(typeof(json.message)!="undefined")
										{
											$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("updated").html('<p>'+json.message+'</p></div>');
										}
										$(options.verificationDateSelector).val("").parent().parent().addClass("ql-license-hide");
										$(options.supportedUntilSelector).val("").parent().parent().addClass("ql-license-hide");
										$(".ql-license-field-clearable", self).val("");
										$(options.purchaseCodeSelector).prop("readonly", false);
										$(options.verifyLicenseButtonSelector).one("click", {do_verify_license: true}, function(event){self.purchaseVerification("saveLicense", event);}).removeClass("button-disabled");
										$(options.reauthorizeAPIButtonSelector).removeClass("button-disabled");
									} 
									else 
									{
										if(typeof(json.error_message)!="undefined")
										{
											$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("error").html('<p>'+json.error_message+'</p></div>');
										}
										$(options.removeLicenseButtonSelector).one("click", function(event){self.purchaseVerification("removeLicense", event);}).removeClass("button-disabled");
									}
									stopSpinner(options.spinnerSelector);
								}
							});
						}
						else
						{
							if(typeof(json.error_message)!="undefined")
							{
								$(options.messageContainerSelector).removeClass(options.messageClasses).addClass("error").html('<p>'+json.error_message+'</p></div>');
							}
							$(options.removeLicenseButtonSelector).one("click", function(event){self.purchaseVerification("removeLicense", event);}).removeClass("button-disabled");
							stopSpinner(options.spinnerSelector);
						}
					}
			});
		}
	};

	jQuery.fn.purchaseVerification = function(method){
		if(methods[method])
		{
			return methods[method].apply(this, Array.from(arguments).slice(1));
		}
		else if(typeof(method)==='object' || !method)
		{
			return methods.init.apply(this, arguments);
		}
	};
	
	$("#ql-license").purchaseVerification();
})(jQuery);