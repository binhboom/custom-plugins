jQuery((function(a){"use strict";var t=a(".shopengine-single-page-qc-btn"),e=a(".shopengine-quick-checkout-modal"),n=t.siblings(".single_add_to_cart_button"),r=t.siblings('[name="add-to-cart"]'),c=t.parents(".variations_form"),i=a(".shopengine_qc_btn"),o={fadeDuration:250,ifIframe:!0};function s(t){Array.from(t).forEach((t=>{t.addEventListener("click",(function(t){t.preventDefault();let n=a(this).siblings(".add_to_cart_button").attr("data-product_id");var r="?";window.wc_add_to_cart_params&&wc_add_to_cart_params.cart_url.includes("?")&&(r="&");let c=a(this).data("source-url")+`${r}add-to-cart=`+n+"&nonce="+shopEngineQuickCheckout.rest_nonce+"&shopengine_quick_checkout=modal-content&quantity=1";e.html('<iframe src="'+c+'"></iframe>').modal(o)}))}))}c.on("woocommerce_variation_has_changed",(function(){t.toggleClass("disabled",n.hasClass("disabled"))})).on("hide_variation",(function(){t.toggleClass("disabled",!0)})),(Array.from(i).length>0&&"redirect"!==a(i[0]).attr("data-checkout")&&!a(".shopengine-single-page-qc-btn")||Array.from(i).length>0&&"redirect"!==a(i[0]).attr("data-checkout")&&a(".shopengine-single-page-qc-btn"))&&s(i),"redirect"!==t.attr("data-checkout-single")&&t.on("click",(function(t){t.preventDefault();var c=a(this);if(c.hasClass("disabled"))n.trigger("click");else{var i="?";window.wc_add_to_cart_params&&wc_add_to_cart_params.cart_url.includes("?")&&(i="&");var s=c.parents("form.cart").serialize(),d=r.val(),l=c.data("source-url")+`${i}add-to-cart=`+d+"&nonce="+shopEngineQuickCheckout.rest_nonce+"&"+s;e.html('<iframe src="'+l+'"></iframe>').modal(o)}}))}));