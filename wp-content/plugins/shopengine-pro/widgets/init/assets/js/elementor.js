!function(e,t){"use strict";var n={throttle:function(e,t){let n=0;return function(...i){let a=(new Date).getTime();if(a-n<t)return!1;window.intervalID=setTimeout((function(){e(...i)}),t),n=a}},debounce:function(e,t){let n;return function(...i){n&&clearTimeout(n),n=setTimeout((function(){e(...i)}),t)}},isInViewport:function(e){const t=e.getBoundingClientRect();return t.top>=0&&t.left>=0&&t.bottom<=(window.innerHeight||document.documentElement.clientHeight)&&t.right<=(window.innerWidth||document.documentElement.clientWidth)},setDefaultFilterData({name:t,classPrefix:n,setArray:i,addClass:a}){const o=new URLSearchParams(window.location.search);if(o.has(t)){o.get(t).split(",").map((t=>{i.add(t);const o=e(`${n}${t}`);a&&a.length&&o.addClass(a),o.prop("checked",!0)}))}},SwiperSlider:function(e,n){var i=e.get(0);if("function"!=typeof Swiper){return new(0,t.utils.swiper)(i,n).then((e=>e))}{const e=new Swiper(i,n);return Promise.resolve(e)}}},i={init:function(){var n={"shopengine-single-product-images.default":i.Single_Product_Images,"shopengine-product-filters.default":i.Product_Filters,"shopengine-product-size-charts.default":i.Product_Size_Charts,"shopengine-advanced-coupon.default":i.Advanced_Coupon,"shopengine-avatar.default":i.Avatar,"shopengine-product-carousel.default":i.Product_Carousel};e.each(n,(function(e,n){t.hooks.addAction("frontend/element_ready/"+e,n)}))},Single_Product_Images:function(t){setTimeout((function(){if(t.find(".flex-control-thumbs").length){function n(e){let n=e.el?e.el:t.find(".flex-active"),i=t.find(".flex-control-thumbs"),a=t.find(".flex-viewport"),o="bottom"==e.type?"left":"top",r="bottom"==e.type?n.outerWidth():n.outerHeight(),s="bottom"==e.type?a.outerWidth():a.outerHeight(),l="bottom"==e.type?"translateX":"translateY",f=n.offset()[o]+r-i.offset()[o];if(s<=f){let e=f-s;i.css("transform",l+"(-"+Math.abs(e)+"px)")}else i.css("transform",l+"(0px)")}e(window).width()<=980&&t.removeClass("shopengine_image_gallery_position_left").removeClass("shopengine_image_gallery_position_right").addClass("shopengine_image_gallery_position_bottom"),t.find(".flex-direction-nav, .flex-control-thumbs").wrapAll('<div class="shopengine-gallery-wrapper"></div>'),t.find(".flex-direction-nav a").on("click change input",(function(i,a){t.hasClass("shopengine_image_gallery_position_bottom")?n({type:"bottom",el:a?e(a):""}):n({type:"left-right",el:a?e(a):""})})),t.find(".flex-control-thumbs li").on("click",(function(){t.find(".flex-direction-nav a.flex-next").trigger("click",e(this))}))}else t.find(".flex-control-thumbs").length||(t.find(".shopengine-product-image-toggle").css("margin",0),t.find(".position-top-left").css("margin-left",0))}),0)},Advanced_Coupon:function(e){e.find(".shopengine-coupon-button").on("click",(function(e){let t=jQuery("<input>");jQuery("body").append(t),t.val(jQuery("#shopengine-coupon-code").text()).select(),document.execCommand("copy"),t.remove(),jQuery(".shopengine-coupon").addClass("shopengine-coupon-active"),setTimeout((()=>{jQuery(".shopengine-coupon").removeClass("shopengine-coupon-active")}),500)}))},Product_Filters:function(t){var i=t.find(".shopengine-product-filters-wrapper"),a=i.data("filter-price"),o=i.data("filter-rating"),r=i.data("filter-color"),s=i.data("filter-category"),l=i.data("filter-attribute"),f=i.data("filter-label"),c=i.data("filter-image"),p=i.data("filter-shipping"),g=i.data("filter-stock"),d=i.data("filter-onsale"),u=i.data("filter-view-mode"),h=t.find(".shopengine-filter-price"),m=t.find(".shopengine-filter-price-slider"),v=t.find(".shopengine-filter-price-reset"),_=t.find(".shopengine-filter-price-result"),y=i.find('input[name="min_price"]'),w=i.find('input[name="max_price"]'),b=_.data("sign"),x=h.data("default-range");let C=t.find(".shopengine-filter-rating__labels"),k=new Set,I=new Set,S=t.find(".shopengine-filter-group-toggle"),A=t.find(".shopengine-filter-group-content-wrapper"),P=t.find(".shopengine-filter-group-content-underlay"),D=t.find(".shopengine-filter-group-content-close");if(S.add(D).add(P).on("click",(function(){S.toggleClass("active"),A.toggleClass("isactive")})),e(document).on("click",(e=>{if(A.hasClass("isactive")){e.target.closest(".shopengine-filter-group-content-wrapper, .shopengine-filter-group-toggle")||(S.toggleClass("active"),A.toggleClass("isactive")),e.target==document.querySelector(".shopengine-filter-overlay")&&A.removeClass("isactive")}})),"collapse"===u){t.find(".shopengine-collapse .shopengine-product-filter-title").on("click",(e=>{e.preventDefault(),e.stopPropagation();const t=e.target.closest(".shopengine-filter");t.classList.toggle("open"),t.nextElementSibling.classList.toggle("open")}))}const R=({form:e,filterInput:t,formInput:i})=>{let a={};t.map(((e,t)=>{a[t.name]||(a[t.name]=new Set);const i={name:t.name,classPrefix:`.${t.name}-`,setArray:a[t.name]};n.setDefaultFilterData(i)})),t.on("change",(function(t){const n=t.target.value,o=t.target.name;a[o]||(a[o]=new Set),a[o].has(n)?a[o]["delete"](n):a[o].add(n),i.attr("name",o),i.attr("value",Array.from(a[o])),e.trigger("submit")}))};var F=t.find(".shopengine-filter-scroll-wrapper").data("scroll"),j=t.find(".shopengine-filter-scroll-wrapper").data("height"),E=t.find(".shopengine-filter-scroll-wrapper");if("yes"===F&&(e(E).css("height",j),e(E).css("padding-right","10px"),SimpleScrollbar.initEl(E[0])),"yes"===a){let n=t.find(".shopengine-filter-price"),i=!1;m.asRange("val",[10,300]);const a=new URLSearchParams(window.location.search);let o=n.data("exchange-rate");a.has("min_price")&&a.has("max_price")&&(i=0!==o?[a.get("min_price")*o,a.get("max_price")*o]:[a.get("min_price"),a.get("max_price")],_.text(b+i[0]+" - "+b+i[1])),m.asRange({range:!0,min:0,max:x[1],step:1,tip:!1,scale:!1,replaceFirst:0,value:i||x}).on("asRange::change",(function(e,t,n){_.text(b+n[0]+" - "+b+n[1])})).on("asRange::moveEnd",(function(){var t=e(this).data("asRange").value;if(0!==o)var i=t[0]/o,a=t[1]/o;else i=t[0],a=t[1];y.val(i),w.val(a),n.trigger("submit")})),v.on("click",(function(){m.asRange("val",x),n.trigger("reset").trigger("submit")}))}if("yes"===o){const e={name:"rating_filter",classPrefix:".shopengine-rating-name-",setArray:k,addClass:"checked"};n.setDefaultFilterData(e);let i=t.find(".shopengine-filter.shopengine-filter-rating");C.on("click",(function(e){e.preventDefault();let n=e.target.closest(".rating-label-triger");if(n){let e=n.dataset.rating,a=n.dataset.target,o=t.find(n),r=t.find(`#${a}`);k.has(e)?k["delete"](e):k.add(e),o.hasClass("checked")?o.removeClass("checked"):o.addClass("checked"),r.attr("value",Array.from(k)),i.trigger("submit")}}))}if("yes"===r){R({form:t.find("#shopengine_color_form"),filterInput:t.find(".shopengine-filter-colors"),formInput:t.find(".shopengine-filter-colors-value")})}if("yes"===s){let i=t.find("#shopengine_category_form"),a=t.find(".shopengine-filter-categories"),o=t.find("#shopengine_filter_category"),r=t.find(".shopengine-filter-category-toggle");const s={name:"shopengine_filter_category",classPrefix:".shopengine-category-name-",setArray:I};n.setDefaultFilterData(s),r.on("click",(function(){let t=e(this).data("target"),n=e(this).attr("aria-expanded"),i=e(this).parent().parent();"true"===n?(i.removeClass("isActive"),e(t).slideUp(),e(this).attr("aria-expanded","false")):(i.addClass("isActive"),e(t).slideDown(),e(this).attr("aria-expanded","true"))})),a.on("click",(function(n){let a=n.target.value;I.has(a)?I["delete"](a):I.add(a),o.attr("value",Array.from(I));let r=e(this).parent(),s=r.find(".shopengine-filter-category-toggle");r.parent().hasClass("isActive")||e(this).hasClass("shopengine-filter-subcategory")||t.find(".shopengine-filter-category-has-child.isActive").find(".shopengine-filter-category-toggle").trigger("click"),r.parent().hasClass("shopengine-filter-category-has-child")&&"true"!==s.attr("aria-expanded")&&s.trigger("click"),i.trigger("submit")}))}if("yes"===l){R({form:t.find("#shopengine_attribute_form"),filterInput:t.find(".shopengine-filter-attribute"),formInput:t.find(".shopengine-filter-attribute-value")})}if("yes"===f){R({form:t.find("#shopengine_label_form"),filterInput:t.find(".shopengine-filter-label"),formInput:t.find(".shopengine-filter-label-value")})}if("yes"===c){R({form:t.find("#shopengine_image_form"),filterInput:t.find(".shopengine-filter-image"),formInput:t.find(".shopengine-filter-image-value")})}if("yes"===p){R({form:t.find("#shopengine_shipping_form"),filterInput:t.find(".shopengine-filter-shipping"),formInput:t.find(".shopengine-filter-shipping-value")})}if("yes"===g){R({form:t.find("#shopengine_stock_form"),filterInput:t.find(".shopengine-filter-stock"),formInput:t.find(".shopengine-filter-stock-value")})}if("yes"===d){R({form:t.find("#shopengine_onsale_form"),filterInput:t.find(".shopengine-filter-onsale"),formInput:t.find(".shopengine-filter-onsale-value")})}},Product_Size_Charts:function(t){let n=t.find(".shopengine-product-size-chart-button"),i=t.find(".shopengine-product-size-chart");n.on("click",(function(){i.css({display:"flex"})})),i.on("click",(function(){"yes"===e(this).data("model")&&i.css({display:"none"})}))},Avatar:function(t){let n=t.find(".shopengine_avatar_image"),i=t.find(".shopengine-avatar__info--btn"),a=t.find(".shopengine-avatar__thumbnail .avatar"),o=t.find("#shopengine_avatar_image_cancel_button"),r=a.attr("src");"yes"===t.find(".shopengine-avatar-container").data("editor")&&(i.fadeIn(300),o.fadeIn(300)),a.closest("form").attr("enctype","multipart/form-data"),o.on("click",(function(){o.fadeOut(300),a.attr("src",r),e(".shopengine-avatar__thumbnail--file").val(""),i.fadeOut(300)})),e(n).on("change",(function(){let t=e(this)[0].files[0],n=URL.createObjectURL(t);a.attr("src",n),o.fadeIn(300),t&&i.fadeIn(300)})),e(i).on("click",(function(){e(this).fadeOut(500),o.fadeOut(300)}))},Product_Carousel:function(e){let t={},i=e.find(".shopengine-product-carousel").data("carousel-config"),a=e.find(".swiper");i?.autoplay&&(t.autoplay=!0,t.speed=1e3),t.loop=i?.loop,i?.arrow&&(t.navigation={nextEl:e.find(".swiper-button-next").get(0),prevEl:e.find(".swiper-button-prev").get(0)}),i?.dots&&(t.pagination={el:e.find(".swiper-pagination").get(0),type:"bullets",clickable:!0}),t.spaceBetween=i?.spaceBetween,t.breakpoints=i?.breakpoints,a.length&&n.SwiperSlider(a,t).then((function(e){}))}};e(window).on("elementor/frontend/init",i.init)}(jQuery,window.elementorFrontend);