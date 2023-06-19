/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 932:
/***/ (function() {

/*!
 * Bootstrap v3.4.1 (https://getbootstrap.com/)
 * Copyright 2011-2019 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");!function(t){"use strict";var e=jQuery.fn.jquery.split(" ")[0].split(".");if(e[0]<2&&e[1]<9||1==e[0]&&9==e[1]&&e[2]<1||3<e[0])throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 4")}(),function(n){"use strict";n.fn.emulateTransitionEnd=function(t){var e=!1,i=this;n(this).one("bsTransitionEnd",function(){e=!0});return setTimeout(function(){e||n(i).trigger(n.support.transition.end)},t),this},n(function(){n.support.transition=function o(){var t=document.createElement("bootstrap"),e={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var i in e)if(t.style[i]!==undefined)return{end:e[i]};return!1}(),n.support.transition&&(n.event.special.bsTransitionEnd={bindType:n.support.transition.end,delegateType:n.support.transition.end,handle:function(t){if(n(t.target).is(this))return t.handleObj.handler.apply(this,arguments)}})})}(jQuery),function(s){"use strict";var e='[data-dismiss="alert"]',a=function(t){s(t).on("click",e,this.close)};a.VERSION="3.4.1",a.TRANSITION_DURATION=150,a.prototype.close=function(t){var e=s(this),i=e.attr("data-target");i||(i=(i=e.attr("href"))&&i.replace(/.*(?=#[^\s]*$)/,"")),i="#"===i?[]:i;var o=s(document).find(i);function n(){o.detach().trigger("closed.bs.alert").remove()}t&&t.preventDefault(),o.length||(o=e.closest(".alert")),o.trigger(t=s.Event("close.bs.alert")),t.isDefaultPrevented()||(o.removeClass("in"),s.support.transition&&o.hasClass("fade")?o.one("bsTransitionEnd",n).emulateTransitionEnd(a.TRANSITION_DURATION):n())};var t=s.fn.alert;s.fn.alert=function o(i){return this.each(function(){var t=s(this),e=t.data("bs.alert");e||t.data("bs.alert",e=new a(this)),"string"==typeof i&&e[i].call(t)})},s.fn.alert.Constructor=a,s.fn.alert.noConflict=function(){return s.fn.alert=t,this},s(document).on("click.bs.alert.data-api",e,a.prototype.close)}(jQuery),function(s){"use strict";var n=function(t,e){this.$element=s(t),this.options=s.extend({},n.DEFAULTS,e),this.isLoading=!1};function i(o){return this.each(function(){var t=s(this),e=t.data("bs.button"),i="object"==typeof o&&o;e||t.data("bs.button",e=new n(this,i)),"toggle"==o?e.toggle():o&&e.setState(o)})}n.VERSION="3.4.1",n.DEFAULTS={loadingText:"loading..."},n.prototype.setState=function(t){var e="disabled",i=this.$element,o=i.is("input")?"val":"html",n=i.data();t+="Text",null==n.resetText&&i.data("resetText",i[o]()),setTimeout(s.proxy(function(){i[o](null==n[t]?this.options[t]:n[t]),"loadingText"==t?(this.isLoading=!0,i.addClass(e).attr(e,e).prop(e,!0)):this.isLoading&&(this.isLoading=!1,i.removeClass(e).removeAttr(e).prop(e,!1))},this),0)},n.prototype.toggle=function(){var t=!0,e=this.$element.closest('[data-toggle="buttons"]');if(e.length){var i=this.$element.find("input");"radio"==i.prop("type")?(i.prop("checked")&&(t=!1),e.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==i.prop("type")&&(i.prop("checked")!==this.$element.hasClass("active")&&(t=!1),this.$element.toggleClass("active")),i.prop("checked",this.$element.hasClass("active")),t&&i.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var t=s.fn.button;s.fn.button=i,s.fn.button.Constructor=n,s.fn.button.noConflict=function(){return s.fn.button=t,this},s(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(t){var e=s(t.target).closest(".btn");i.call(e,"toggle"),s(t.target).is('input[type="radio"], input[type="checkbox"]')||(t.preventDefault(),e.is("input,button")?e.trigger("focus"):e.find("input:visible,button:visible").first().trigger("focus"))}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(t){s(t.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(t.type))})}(jQuery),function(p){"use strict";var c=function(t,e){this.$element=p(t),this.$indicators=this.$element.find(".carousel-indicators"),this.options=e,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",p.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",p.proxy(this.pause,this)).on("mouseleave.bs.carousel",p.proxy(this.cycle,this))};function r(n){return this.each(function(){var t=p(this),e=t.data("bs.carousel"),i=p.extend({},c.DEFAULTS,t.data(),"object"==typeof n&&n),o="string"==typeof n?n:i.slide;e||t.data("bs.carousel",e=new c(this,i)),"number"==typeof n?e.to(n):o?e[o]():i.interval&&e.pause().cycle()})}c.VERSION="3.4.1",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(t){if(!/input|textarea/i.test(t.target.tagName)){switch(t.which){case 37:this.prev();break;case 39:this.next();break;default:return}t.preventDefault()}},c.prototype.cycle=function(t){return t||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(p.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(t){return this.$items=t.parent().children(".item"),this.$items.index(t||this.$active)},c.prototype.getItemForDirection=function(t,e){var i=this.getItemIndex(e);if(("prev"==t&&0===i||"next"==t&&i==this.$items.length-1)&&!this.options.wrap)return e;var o=(i+("prev"==t?-1:1))%this.$items.length;return this.$items.eq(o)},c.prototype.to=function(t){var e=this,i=this.getItemIndex(this.$active=this.$element.find(".item.active"));if(!(t>this.$items.length-1||t<0))return this.sliding?this.$element.one("slid.bs.carousel",function(){e.to(t)}):i==t?this.pause().cycle():this.slide(i<t?"next":"prev",this.$items.eq(t))},c.prototype.pause=function(t){return t||(this.paused=!0),this.$element.find(".next, .prev").length&&p.support.transition&&(this.$element.trigger(p.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){if(!this.sliding)return this.slide("next")},c.prototype.prev=function(){if(!this.sliding)return this.slide("prev")},c.prototype.slide=function(t,e){var i=this.$element.find(".item.active"),o=e||this.getItemForDirection(t,i),n=this.interval,s="next"==t?"left":"right",a=this;if(o.hasClass("active"))return this.sliding=!1;var r=o[0],l=p.Event("slide.bs.carousel",{relatedTarget:r,direction:s});if(this.$element.trigger(l),!l.isDefaultPrevented()){if(this.sliding=!0,n&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var h=p(this.$indicators.children()[this.getItemIndex(o)]);h&&h.addClass("active")}var d=p.Event("slid.bs.carousel",{relatedTarget:r,direction:s});return p.support.transition&&this.$element.hasClass("slide")?(o.addClass(t),"object"==typeof o&&o.length&&o[0].offsetWidth,i.addClass(s),o.addClass(s),i.one("bsTransitionEnd",function(){o.removeClass([t,s].join(" ")).addClass("active"),i.removeClass(["active",s].join(" ")),a.sliding=!1,setTimeout(function(){a.$element.trigger(d)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(i.removeClass("active"),o.addClass("active"),this.sliding=!1,this.$element.trigger(d)),n&&this.cycle(),this}};var t=p.fn.carousel;p.fn.carousel=r,p.fn.carousel.Constructor=c,p.fn.carousel.noConflict=function(){return p.fn.carousel=t,this};var e=function(t){var e=p(this),i=e.attr("href");i&&(i=i.replace(/.*(?=#[^\s]+$)/,""));var o=e.attr("data-target")||i,n=p(document).find(o);if(n.hasClass("carousel")){var s=p.extend({},n.data(),e.data()),a=e.attr("data-slide-to");a&&(s.interval=!1),r.call(n,s),a&&n.data("bs.carousel").to(a),t.preventDefault()}};p(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),p(window).on("load",function(){p('[data-ride="carousel"]').each(function(){var t=p(this);r.call(t,t.data())})})}(jQuery),function(a){"use strict";var r=function(t,e){this.$element=a(t),this.options=a.extend({},r.DEFAULTS,e),this.$trigger=a('[data-toggle="collapse"][href="#'+t.id+'"],[data-toggle="collapse"][data-target="#'+t.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};function n(t){var e,i=t.attr("data-target")||(e=t.attr("href"))&&e.replace(/.*(?=#[^\s]+$)/,"");return a(document).find(i)}function l(o){return this.each(function(){var t=a(this),e=t.data("bs.collapse"),i=a.extend({},r.DEFAULTS,t.data(),"object"==typeof o&&o);!e&&i.toggle&&/show|hide/.test(o)&&(i.toggle=!1),e||t.data("bs.collapse",e=new r(this,i)),"string"==typeof o&&e[o]()})}r.VERSION="3.4.1",r.TRANSITION_DURATION=350,r.DEFAULTS={toggle:!0},r.prototype.dimension=function(){return this.$element.hasClass("width")?"width":"height"},r.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var t,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(t=e.data("bs.collapse"))&&t.transitioning)){var i=a.Event("show.bs.collapse");if(this.$element.trigger(i),!i.isDefaultPrevented()){e&&e.length&&(l.call(e,"hide"),t||e.data("bs.collapse",null));var o=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[o](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var n=function(){this.$element.removeClass("collapsing").addClass("collapse in")[o](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return n.call(this);var s=a.camelCase(["scroll",o].join("-"));this.$element.one("bsTransitionEnd",a.proxy(n,this)).emulateTransitionEnd(r.TRANSITION_DURATION)[o](this.$element[0][s])}}}},r.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var t=a.Event("hide.bs.collapse");if(this.$element.trigger(t),!t.isDefaultPrevented()){var e=this.dimension();this.$element[e](this.$element[e]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var i=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};if(!a.support.transition)return i.call(this);this.$element[e](0).one("bsTransitionEnd",a.proxy(i,this)).emulateTransitionEnd(r.TRANSITION_DURATION)}}},r.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},r.prototype.getParent=function(){return a(document).find(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(t,e){var i=a(e);this.addAriaAndCollapsedClass(n(i),i)},this)).end()},r.prototype.addAriaAndCollapsedClass=function(t,e){var i=t.hasClass("in");t.attr("aria-expanded",i),e.toggleClass("collapsed",!i).attr("aria-expanded",i)};var t=a.fn.collapse;a.fn.collapse=l,a.fn.collapse.Constructor=r,a.fn.collapse.noConflict=function(){return a.fn.collapse=t,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(t){var e=a(this);e.attr("data-target")||t.preventDefault();var i=n(e),o=i.data("bs.collapse")?"toggle":e.data();l.call(i,o)})}(jQuery),function(a){"use strict";var r='[data-toggle="dropdown"]',o=function(t){a(t).on("click.bs.dropdown",this.toggle)};function l(t){var e=t.attr("data-target");e||(e=(e=t.attr("href"))&&/#[A-Za-z]/.test(e)&&e.replace(/.*(?=#[^\s]*$)/,""));var i="#"!==e?a(document).find(e):null;return i&&i.length?i:t.parent()}function s(o){o&&3===o.which||(a(".dropdown-backdrop").remove(),a(r).each(function(){var t=a(this),e=l(t),i={relatedTarget:this};e.hasClass("open")&&(o&&"click"==o.type&&/input|textarea/i.test(o.target.tagName)&&a.contains(e[0],o.target)||(e.trigger(o=a.Event("hide.bs.dropdown",i)),o.isDefaultPrevented()||(t.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",i)))))}))}o.VERSION="3.4.1",o.prototype.toggle=function(t){var e=a(this);if(!e.is(".disabled, :disabled")){var i=l(e),o=i.hasClass("open");if(s(),!o){"ontouchstart"in document.documentElement&&!i.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",s);var n={relatedTarget:this};if(i.trigger(t=a.Event("show.bs.dropdown",n)),t.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),i.toggleClass("open").trigger(a.Event("shown.bs.dropdown",n))}return!1}},o.prototype.keydown=function(t){if(/(38|40|27|32)/.test(t.which)&&!/input|textarea/i.test(t.target.tagName)){var e=a(this);if(t.preventDefault(),t.stopPropagation(),!e.is(".disabled, :disabled")){var i=l(e),o=i.hasClass("open");if(!o&&27!=t.which||o&&27==t.which)return 27==t.which&&i.find(r).trigger("focus"),e.trigger("click");var n=i.find(".dropdown-menu li:not(.disabled):visible a");if(n.length){var s=n.index(t.target);38==t.which&&0<s&&s--,40==t.which&&s<n.length-1&&s++,~s||(s=0),n.eq(s).trigger("focus")}}}};var t=a.fn.dropdown;a.fn.dropdown=function e(i){return this.each(function(){var t=a(this),e=t.data("bs.dropdown");e||t.data("bs.dropdown",e=new o(this)),"string"==typeof i&&e[i].call(t)})},a.fn.dropdown.Constructor=o,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=t,this},a(document).on("click.bs.dropdown.data-api",s).on("click.bs.dropdown.data-api",".dropdown form",function(t){t.stopPropagation()}).on("click.bs.dropdown.data-api",r,o.prototype.toggle).on("keydown.bs.dropdown.data-api",r,o.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",o.prototype.keydown)}(jQuery),function(a){"use strict";var s=function(t,e){this.options=e,this.$body=a(document.body),this.$element=a(t),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.fixedContent=".navbar-fixed-top, .navbar-fixed-bottom",this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};function r(o,n){return this.each(function(){var t=a(this),e=t.data("bs.modal"),i=a.extend({},s.DEFAULTS,t.data(),"object"==typeof o&&o);e||t.data("bs.modal",e=new s(this,i)),"string"==typeof o?e[o](n):i.show&&e.show(n)})}s.VERSION="3.4.1",s.TRANSITION_DURATION=300,s.BACKDROP_TRANSITION_DURATION=150,s.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},s.prototype.toggle=function(t){return this.isShown?this.hide():this.show(t)},s.prototype.show=function(i){var o=this,t=a.Event("show.bs.modal",{relatedTarget:i});this.$element.trigger(t),this.isShown||t.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){o.$element.one("mouseup.dismiss.bs.modal",function(t){a(t.target).is(o.$element)&&(o.ignoreBackdropClick=!0)})}),this.backdrop(function(){var t=a.support.transition&&o.$element.hasClass("fade");o.$element.parent().length||o.$element.appendTo(o.$body),o.$element.show().scrollTop(0),o.adjustDialog(),t&&o.$element[0].offsetWidth,o.$element.addClass("in"),o.enforceFocus();var e=a.Event("shown.bs.modal",{relatedTarget:i});t?o.$dialog.one("bsTransitionEnd",function(){o.$element.trigger("focus").trigger(e)}).emulateTransitionEnd(s.TRANSITION_DURATION):o.$element.trigger("focus").trigger(e)}))},s.prototype.hide=function(t){t&&t.preventDefault(),t=a.Event("hide.bs.modal"),this.$element.trigger(t),this.isShown&&!t.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(s.TRANSITION_DURATION):this.hideModal())},s.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(t){document===t.target||this.$element[0]===t.target||this.$element.has(t.target).length||this.$element.trigger("focus")},this))},s.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(t){27==t.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},s.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},s.prototype.hideModal=function(){var t=this;this.$element.hide(),this.backdrop(function(){t.$body.removeClass("modal-open"),t.resetAdjustments(),t.resetScrollbar(),t.$element.trigger("hidden.bs.modal")})},s.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},s.prototype.backdrop=function(t){var e=this,i=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var o=a.support.transition&&i;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+i).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(t){this.ignoreBackdropClick?this.ignoreBackdropClick=!1:t.target===t.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide())},this)),o&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!t)return;o?this.$backdrop.one("bsTransitionEnd",t).emulateTransitionEnd(s.BACKDROP_TRANSITION_DURATION):t()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var n=function(){e.removeBackdrop(),t&&t()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",n).emulateTransitionEnd(s.BACKDROP_TRANSITION_DURATION):n()}else t&&t()},s.prototype.handleUpdate=function(){this.adjustDialog()},s.prototype.adjustDialog=function(){var t=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&t?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!t?this.scrollbarWidth:""})},s.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},s.prototype.checkScrollbar=function(){var t=window.innerWidth;if(!t){var e=document.documentElement.getBoundingClientRect();t=e.right-Math.abs(e.left)}this.bodyIsOverflowing=document.body.clientWidth<t,this.scrollbarWidth=this.measureScrollbar()},s.prototype.setScrollbar=function(){var t=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"";var n=this.scrollbarWidth;this.bodyIsOverflowing&&(this.$body.css("padding-right",t+n),a(this.fixedContent).each(function(t,e){var i=e.style.paddingRight,o=a(e).css("padding-right");a(e).data("padding-right",i).css("padding-right",parseFloat(o)+n+"px")}))},s.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad),a(this.fixedContent).each(function(t,e){var i=a(e).data("padding-right");a(e).removeData("padding-right"),e.style.paddingRight=i||""})},s.prototype.measureScrollbar=function(){var t=document.createElement("div");t.className="modal-scrollbar-measure",this.$body.append(t);var e=t.offsetWidth-t.clientWidth;return this.$body[0].removeChild(t),e};var t=a.fn.modal;a.fn.modal=r,a.fn.modal.Constructor=s,a.fn.modal.noConflict=function(){return a.fn.modal=t,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(t){var e=a(this),i=e.attr("href"),o=e.attr("data-target")||i&&i.replace(/.*(?=#[^\s]+$)/,""),n=a(document).find(o),s=n.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(i)&&i},n.data(),e.data());e.is("a")&&t.preventDefault(),n.one("show.bs.modal",function(t){t.isDefaultPrevented()||n.one("hidden.bs.modal",function(){e.is(":visible")&&e.trigger("focus")})}),r.call(n,s,this)})}(jQuery),function(g){"use strict";var o=["sanitize","whiteList","sanitizeFn"],a=["background","cite","href","itemtype","longdesc","poster","src","xlink:href"],t={"*":["class","dir","id","lang","role",/^aria-[\w-]*$/i],a:["target","href","title","rel"],area:[],b:[],br:[],col:[],code:[],div:[],em:[],hr:[],h1:[],h2:[],h3:[],h4:[],h5:[],h6:[],i:[],img:["src","alt","title","width","height"],li:[],ol:[],p:[],pre:[],s:[],small:[],span:[],sub:[],sup:[],strong:[],u:[],ul:[]},r=/^(?:(?:https?|mailto|ftp|tel|file):|[^&:/?#]*(?:[/?#]|$))/gi,l=/^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[a-z0-9+/]+=*$/i;function u(t,e){var i=t.nodeName.toLowerCase();if(-1!==g.inArray(i,e))return-1===g.inArray(i,a)||Boolean(t.nodeValue.match(r)||t.nodeValue.match(l));for(var o=g(e).filter(function(t,e){return e instanceof RegExp}),n=0,s=o.length;n<s;n++)if(i.match(o[n]))return!0;return!1}function n(t,e,i){if(0===t.length)return t;if(i&&"function"==typeof i)return i(t);if(!document.implementation||!document.implementation.createHTMLDocument)return t;var o=document.implementation.createHTMLDocument("sanitization");o.body.innerHTML=t;for(var n=g.map(e,function(t,e){return e}),s=g(o.body).find("*"),a=0,r=s.length;a<r;a++){var l=s[a],h=l.nodeName.toLowerCase();if(-1!==g.inArray(h,n))for(var d=g.map(l.attributes,function(t){return t}),p=[].concat(e["*"]||[],e[h]||[]),c=0,f=d.length;c<f;c++)u(d[c],p)||l.removeAttribute(d[c].nodeName);else l.parentNode.removeChild(l)}return o.body.innerHTML}var m=function(t,e){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",t,e)};m.VERSION="3.4.1",m.TRANSITION_DURATION=150,m.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0},sanitize:!0,sanitizeFn:null,whiteList:t},m.prototype.init=function(t,e,i){if(this.enabled=!0,this.type=t,this.$element=g(e),this.options=this.getOptions(i),this.$viewport=this.options.viewport&&g(document).find(g.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var o=this.options.trigger.split(" "),n=o.length;n--;){var s=o[n];if("click"==s)this.$element.on("click."+this.type,this.options.selector,g.proxy(this.toggle,this));else if("manual"!=s){var a="hover"==s?"mouseenter":"focusin",r="hover"==s?"mouseleave":"focusout";this.$element.on(a+"."+this.type,this.options.selector,g.proxy(this.enter,this)),this.$element.on(r+"."+this.type,this.options.selector,g.proxy(this.leave,this))}}this.options.selector?this._options=g.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},m.prototype.getDefaults=function(){return m.DEFAULTS},m.prototype.getOptions=function(t){var e=this.$element.data();for(var i in e)e.hasOwnProperty(i)&&-1!==g.inArray(i,o)&&delete e[i];return(t=g.extend({},this.getDefaults(),e,t)).delay&&"number"==typeof t.delay&&(t.delay={show:t.delay,hide:t.delay}),t.sanitize&&(t.template=n(t.template,t.whiteList,t.sanitizeFn)),t},m.prototype.getDelegateOptions=function(){var i={},o=this.getDefaults();return this._options&&g.each(this._options,function(t,e){o[t]!=e&&(i[t]=e)}),i},m.prototype.enter=function(t){var e=t instanceof this.constructor?t:g(t.currentTarget).data("bs."+this.type);if(e||(e=new this.constructor(t.currentTarget,this.getDelegateOptions()),g(t.currentTarget).data("bs."+this.type,e)),t instanceof g.Event&&(e.inState["focusin"==t.type?"focus":"hover"]=!0),e.tip().hasClass("in")||"in"==e.hoverState)e.hoverState="in";else{if(clearTimeout(e.timeout),e.hoverState="in",!e.options.delay||!e.options.delay.show)return e.show();e.timeout=setTimeout(function(){"in"==e.hoverState&&e.show()},e.options.delay.show)}},m.prototype.isInStateTrue=function(){for(var t in this.inState)if(this.inState[t])return!0;return!1},m.prototype.leave=function(t){var e=t instanceof this.constructor?t:g(t.currentTarget).data("bs."+this.type);if(e||(e=new this.constructor(t.currentTarget,this.getDelegateOptions()),g(t.currentTarget).data("bs."+this.type,e)),t instanceof g.Event&&(e.inState["focusout"==t.type?"focus":"hover"]=!1),!e.isInStateTrue()){if(clearTimeout(e.timeout),e.hoverState="out",!e.options.delay||!e.options.delay.hide)return e.hide();e.timeout=setTimeout(function(){"out"==e.hoverState&&e.hide()},e.options.delay.hide)}},m.prototype.show=function(){var t=g.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(t);var e=g.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(t.isDefaultPrevented()||!e)return;var i=this,o=this.tip(),n=this.getUID(this.type);this.setContent(),o.attr("id",n),this.$element.attr("aria-describedby",n),this.options.animation&&o.addClass("fade");var s="function"==typeof this.options.placement?this.options.placement.call(this,o[0],this.$element[0]):this.options.placement,a=/\s?auto?\s?/i,r=a.test(s);r&&(s=s.replace(a,"")||"top"),o.detach().css({top:0,left:0,display:"block"}).addClass(s).data("bs."+this.type,this),this.options.container?o.appendTo(g(document).find(this.options.container)):o.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var l=this.getPosition(),h=o[0].offsetWidth,d=o[0].offsetHeight;if(r){var p=s,c=this.getPosition(this.$viewport);s="bottom"==s&&l.bottom+d>c.bottom?"top":"top"==s&&l.top-d<c.top?"bottom":"right"==s&&l.right+h>c.width?"left":"left"==s&&l.left-h<c.left?"right":s,o.removeClass(p).addClass(s)}var f=this.getCalculatedOffset(s,l,h,d);this.applyPlacement(f,s);var u=function(){var t=i.hoverState;i.$element.trigger("shown.bs."+i.type),i.hoverState=null,"out"==t&&i.leave(i)};g.support.transition&&this.$tip.hasClass("fade")?o.one("bsTransitionEnd",u).emulateTransitionEnd(m.TRANSITION_DURATION):u()}},m.prototype.applyPlacement=function(t,e){var i=this.tip(),o=i[0].offsetWidth,n=i[0].offsetHeight,s=parseInt(i.css("margin-top"),10),a=parseInt(i.css("margin-left"),10);isNaN(s)&&(s=0),isNaN(a)&&(a=0),t.top+=s,t.left+=a,g.offset.setOffset(i[0],g.extend({using:function(t){i.css({top:Math.round(t.top),left:Math.round(t.left)})}},t),0),i.addClass("in");var r=i[0].offsetWidth,l=i[0].offsetHeight;"top"==e&&l!=n&&(t.top=t.top+n-l);var h=this.getViewportAdjustedDelta(e,t,r,l);h.left?t.left+=h.left:t.top+=h.top;var d=/top|bottom/.test(e),p=d?2*h.left-o+r:2*h.top-n+l,c=d?"offsetWidth":"offsetHeight";i.offset(t),this.replaceArrow(p,i[0][c],d)},m.prototype.replaceArrow=function(t,e,i){this.arrow().css(i?"left":"top",50*(1-t/e)+"%").css(i?"top":"left","")},m.prototype.setContent=function(){var t=this.tip(),e=this.getTitle();this.options.html?(this.options.sanitize&&(e=n(e,this.options.whiteList,this.options.sanitizeFn)),t.find(".tooltip-inner").html(e)):t.find(".tooltip-inner").text(e),t.removeClass("fade in top bottom left right")},m.prototype.hide=function(t){var e=this,i=g(this.$tip),o=g.Event("hide.bs."+this.type);function n(){"in"!=e.hoverState&&i.detach(),e.$element&&e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),t&&t()}if(this.$element.trigger(o),!o.isDefaultPrevented())return i.removeClass("in"),g.support.transition&&i.hasClass("fade")?i.one("bsTransitionEnd",n).emulateTransitionEnd(m.TRANSITION_DURATION):n(),this.hoverState=null,this},m.prototype.fixTitle=function(){var t=this.$element;(t.attr("title")||"string"!=typeof t.attr("data-original-title"))&&t.attr("data-original-title",t.attr("title")||"").attr("title","")},m.prototype.hasContent=function(){return this.getTitle()},m.prototype.getPosition=function(t){var e=(t=t||this.$element)[0],i="BODY"==e.tagName,o=e.getBoundingClientRect();null==o.width&&(o=g.extend({},o,{width:o.right-o.left,height:o.bottom-o.top}));var n=window.SVGElement&&e instanceof window.SVGElement,s=i?{top:0,left:0}:n?null:t.offset(),a={scroll:i?document.documentElement.scrollTop||document.body.scrollTop:t.scrollTop()},r=i?{width:g(window).width(),height:g(window).height()}:null;return g.extend({},o,a,r,s)},m.prototype.getCalculatedOffset=function(t,e,i,o){return"bottom"==t?{top:e.top+e.height,left:e.left+e.width/2-i/2}:"top"==t?{top:e.top-o,left:e.left+e.width/2-i/2}:"left"==t?{top:e.top+e.height/2-o/2,left:e.left-i}:{top:e.top+e.height/2-o/2,left:e.left+e.width}},m.prototype.getViewportAdjustedDelta=function(t,e,i,o){var n={top:0,left:0};if(!this.$viewport)return n;var s=this.options.viewport&&this.options.viewport.padding||0,a=this.getPosition(this.$viewport);if(/right|left/.test(t)){var r=e.top-s-a.scroll,l=e.top+s-a.scroll+o;r<a.top?n.top=a.top-r:l>a.top+a.height&&(n.top=a.top+a.height-l)}else{var h=e.left-s,d=e.left+s+i;h<a.left?n.left=a.left-h:d>a.right&&(n.left=a.left+a.width-d)}return n},m.prototype.getTitle=function(){var t=this.$element,e=this.options;return t.attr("data-original-title")||("function"==typeof e.title?e.title.call(t[0]):e.title)},m.prototype.getUID=function(t){for(;t+=~~(1e6*Math.random()),document.getElementById(t););return t},m.prototype.tip=function(){if(!this.$tip&&(this.$tip=g(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},m.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},m.prototype.enable=function(){this.enabled=!0},m.prototype.disable=function(){this.enabled=!1},m.prototype.toggleEnabled=function(){this.enabled=!this.enabled},m.prototype.toggle=function(t){var e=this;t&&((e=g(t.currentTarget).data("bs."+this.type))||(e=new this.constructor(t.currentTarget,this.getDelegateOptions()),g(t.currentTarget).data("bs."+this.type,e))),t?(e.inState.click=!e.inState.click,e.isInStateTrue()?e.enter(e):e.leave(e)):e.tip().hasClass("in")?e.leave(e):e.enter(e)},m.prototype.destroy=function(){var t=this;clearTimeout(this.timeout),this.hide(function(){t.$element.off("."+t.type).removeData("bs."+t.type),t.$tip&&t.$tip.detach(),t.$tip=null,t.$arrow=null,t.$viewport=null,t.$element=null})},m.prototype.sanitizeHtml=function(t){return n(t,this.options.whiteList,this.options.sanitizeFn)};var e=g.fn.tooltip;g.fn.tooltip=function i(o){return this.each(function(){var t=g(this),e=t.data("bs.tooltip"),i="object"==typeof o&&o;!e&&/destroy|hide/.test(o)||(e||t.data("bs.tooltip",e=new m(this,i)),"string"==typeof o&&e[o]())})},g.fn.tooltip.Constructor=m,g.fn.tooltip.noConflict=function(){return g.fn.tooltip=e,this}}(jQuery),function(n){"use strict";var s=function(t,e){this.init("popover",t,e)};if(!n.fn.tooltip)throw new Error("Popover requires tooltip.js");s.VERSION="3.4.1",s.DEFAULTS=n.extend({},n.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),((s.prototype=n.extend({},n.fn.tooltip.Constructor.prototype)).constructor=s).prototype.getDefaults=function(){return s.DEFAULTS},s.prototype.setContent=function(){var t=this.tip(),e=this.getTitle(),i=this.getContent();if(this.options.html){var o=typeof i;this.options.sanitize&&(e=this.sanitizeHtml(e),"string"===o&&(i=this.sanitizeHtml(i))),t.find(".popover-title").html(e),t.find(".popover-content").children().detach().end()["string"===o?"html":"append"](i)}else t.find(".popover-title").text(e),t.find(".popover-content").children().detach().end().text(i);t.removeClass("fade top bottom left right in"),t.find(".popover-title").html()||t.find(".popover-title").hide()},s.prototype.hasContent=function(){return this.getTitle()||this.getContent()},s.prototype.getContent=function(){var t=this.$element,e=this.options;return t.attr("data-content")||("function"==typeof e.content?e.content.call(t[0]):e.content)},s.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var t=n.fn.popover;n.fn.popover=function e(o){return this.each(function(){var t=n(this),e=t.data("bs.popover"),i="object"==typeof o&&o;!e&&/destroy|hide/.test(o)||(e||t.data("bs.popover",e=new s(this,i)),"string"==typeof o&&e[o]())})},n.fn.popover.Constructor=s,n.fn.popover.noConflict=function(){return n.fn.popover=t,this}}(jQuery),function(s){"use strict";function n(t,e){this.$body=s(document.body),this.$scrollElement=s(t).is(document.body)?s(window):s(t),this.options=s.extend({},n.DEFAULTS,e),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",s.proxy(this.process,this)),this.refresh(),this.process()}function e(o){return this.each(function(){var t=s(this),e=t.data("bs.scrollspy"),i="object"==typeof o&&o;e||t.data("bs.scrollspy",e=new n(this,i)),"string"==typeof o&&e[o]()})}n.VERSION="3.4.1",n.DEFAULTS={offset:10},n.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},n.prototype.refresh=function(){var t=this,o="offset",n=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),s.isWindow(this.$scrollElement[0])||(o="position",n=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var t=s(this),e=t.data("target")||t.attr("href"),i=/^#./.test(e)&&s(e);return i&&i.length&&i.is(":visible")&&[[i[o]().top+n,e]]||null}).sort(function(t,e){return t[0]-e[0]}).each(function(){t.offsets.push(this[0]),t.targets.push(this[1])})},n.prototype.process=function(){var t,e=this.$scrollElement.scrollTop()+this.options.offset,i=this.getScrollHeight(),o=this.options.offset+i-this.$scrollElement.height(),n=this.offsets,s=this.targets,a=this.activeTarget;if(this.scrollHeight!=i&&this.refresh(),o<=e)return a!=(t=s[s.length-1])&&this.activate(t);if(a&&e<n[0])return this.activeTarget=null,this.clear();for(t=n.length;t--;)a!=s[t]&&e>=n[t]&&(n[t+1]===undefined||e<n[t+1])&&this.activate(s[t])},n.prototype.activate=function(t){this.activeTarget=t,this.clear();var e=this.selector+'[data-target="'+t+'"],'+this.selector+'[href="'+t+'"]',i=s(e).parents("li").addClass("active");i.parent(".dropdown-menu").length&&(i=i.closest("li.dropdown").addClass("active")),i.trigger("activate.bs.scrollspy")},n.prototype.clear=function(){s(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var t=s.fn.scrollspy;s.fn.scrollspy=e,s.fn.scrollspy.Constructor=n,s.fn.scrollspy.noConflict=function(){return s.fn.scrollspy=t,this},s(window).on("load.bs.scrollspy.data-api",function(){s('[data-spy="scroll"]').each(function(){var t=s(this);e.call(t,t.data())})})}(jQuery),function(r){"use strict";var a=function(t){this.element=r(t)};function e(i){return this.each(function(){var t=r(this),e=t.data("bs.tab");e||t.data("bs.tab",e=new a(this)),"string"==typeof i&&e[i]()})}a.VERSION="3.4.1",a.TRANSITION_DURATION=150,a.prototype.show=function(){var t=this.element,e=t.closest("ul:not(.dropdown-menu)"),i=t.data("target");if(i||(i=(i=t.attr("href"))&&i.replace(/.*(?=#[^\s]*$)/,"")),!t.parent("li").hasClass("active")){var o=e.find(".active:last a"),n=r.Event("hide.bs.tab",{relatedTarget:t[0]}),s=r.Event("show.bs.tab",{relatedTarget:o[0]});if(o.trigger(n),t.trigger(s),!s.isDefaultPrevented()&&!n.isDefaultPrevented()){var a=r(document).find(i);this.activate(t.closest("li"),e),this.activate(a,a.parent(),function(){o.trigger({type:"hidden.bs.tab",relatedTarget:t[0]}),t.trigger({type:"shown.bs.tab",relatedTarget:o[0]})})}}},a.prototype.activate=function(t,e,i){var o=e.find("> .active"),n=i&&r.support.transition&&(o.length&&o.hasClass("fade")||!!e.find("> .fade").length);function s(){o.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),t.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),n?(t[0].offsetWidth,t.addClass("in")):t.removeClass("fade"),t.parent(".dropdown-menu").length&&t.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),i&&i()}o.length&&n?o.one("bsTransitionEnd",s).emulateTransitionEnd(a.TRANSITION_DURATION):s(),o.removeClass("in")};var t=r.fn.tab;r.fn.tab=e,r.fn.tab.Constructor=a,r.fn.tab.noConflict=function(){return r.fn.tab=t,this};var i=function(t){t.preventDefault(),e.call(r(this),"show")};r(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',i).on("click.bs.tab.data-api",'[data-toggle="pill"]',i)}(jQuery),function(l){"use strict";var h=function(t,e){this.options=l.extend({},h.DEFAULTS,e);var i=this.options.target===h.DEFAULTS.target?l(this.options.target):l(document).find(this.options.target);this.$target=i.on("scroll.bs.affix.data-api",l.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",l.proxy(this.checkPositionWithEventLoop,this)),this.$element=l(t),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};function i(o){return this.each(function(){var t=l(this),e=t.data("bs.affix"),i="object"==typeof o&&o;e||t.data("bs.affix",e=new h(this,i)),"string"==typeof o&&e[o]()})}h.VERSION="3.4.1",h.RESET="affix affix-top affix-bottom",h.DEFAULTS={offset:0,target:window},h.prototype.getState=function(t,e,i,o){var n=this.$target.scrollTop(),s=this.$element.offset(),a=this.$target.height();if(null!=i&&"top"==this.affixed)return n<i&&"top";if("bottom"==this.affixed)return null!=i?!(n+this.unpin<=s.top)&&"bottom":!(n+a<=t-o)&&"bottom";var r=null==this.affixed,l=r?n:s.top;return null!=i&&n<=i?"top":null!=o&&t-o<=l+(r?a:e)&&"bottom"},h.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(h.RESET).addClass("affix");var t=this.$target.scrollTop(),e=this.$element.offset();return this.pinnedOffset=e.top-t},h.prototype.checkPositionWithEventLoop=function(){setTimeout(l.proxy(this.checkPosition,this),1)},h.prototype.checkPosition=function(){if(this.$element.is(":visible")){var t=this.$element.height(),e=this.options.offset,i=e.top,o=e.bottom,n=Math.max(l(document).height(),l(document.body).height());"object"!=typeof e&&(o=i=e),"function"==typeof i&&(i=e.top(this.$element)),"function"==typeof o&&(o=e.bottom(this.$element));var s=this.getState(n,t,i,o);if(this.affixed!=s){null!=this.unpin&&this.$element.css("top","");var a="affix"+(s?"-"+s:""),r=l.Event(a+".bs.affix");if(this.$element.trigger(r),r.isDefaultPrevented())return;this.affixed=s,this.unpin="bottom"==s?this.getPinnedOffset():null,this.$element.removeClass(h.RESET).addClass(a).trigger(a.replace("affix","affixed")+".bs.affix")}"bottom"==s&&this.$element.offset({top:n-t-o})}};var t=l.fn.affix;l.fn.affix=i,l.fn.affix.Constructor=h,l.fn.affix.noConflict=function(){return l.fn.affix=t,this},l(window).on("load",function(){l('[data-spy="affix"]').each(function(){var t=l(this),e=t.data();e.offset=e.offset||{},null!=e.offsetBottom&&(e.offset.bottom=e.offsetBottom),null!=e.offsetTop&&(e.offset.top=e.offsetTop),i.call(t,e)})})}(jQuery);

/***/ }),

/***/ 856:
/***/ (function() {

/*
* Copyright (C) 2009 Joel Sutherland
* Licenced under the MIT license
* http://www.newmediacampaigns.com/page/jquery-flickr-plugin
*
* Available tags for templates:
* title, link, date_taken, description, published, author, author_id, tags, image*
*/
(function($) {
	$.fn.jflickrfeed = function(settings, callback) {
		settings = $.extend(true, {
			flickrbase: 'http://api.flickr.com/services/feeds/',
			feedapi: 'photos_public.gne',
			limit: 20,
			qstrings: {
				lang: 'en-us',
				format: 'json',
				jsoncallback: '?'
			},
			cleanDescription: true,
			useTemplate: true,
			itemTemplate: '',
			itemCallback: function(){}
		}, settings);

		var url = settings.flickrbase + settings.feedapi + '?';
		var first = true;

		for(var key in settings.qstrings){
			if(!first)
				url += '&';
			url += key + '=' + settings.qstrings[key];
			first = false;
		}

		return $(this).each(function(){
			var $container = $(this);
			var container = this;
			$.getJSON(url, function(data){
				$.each(data.items, function(i,item){
					if(i < settings.limit){
					
						// Clean out the Flickr Description
						if(settings.cleanDescription){
							var regex = /<p>(.*?)<\/p>/g;
							var input = item.description;
							if(regex.test(input)) {
								item.description = input.match(regex)[2]
								if(item.description!=undefined)
									item.description = item.description.replace('<p>','').replace('</p>','');
							}
						}
						
						// Add Image Sizes
						// http://www.flickr.com/services/api/misc.urls.html
						item['image_s'] = item.media.m.replace('_m', '_s');
						item['image_t'] = item.media.m.replace('_m', '_t');
						item['image_m'] = item.media.m.replace('_m', '_m');
						item['image'] = item.media.m.replace('_m', '');
						item['image_b'] = item.media.m.replace('_m', '_b');
						delete item.media;
						
						// Use Template
						if(settings.useTemplate){
							var template = settings.itemTemplate;
							for(var key in item){
								var rgx = new RegExp('{{' + key + '}}', 'g');
								template = template.replace(rgx, item[key]);
							}
							$container.append(template)
						}
						
						//itemCallback
						settings.itemCallback.call(container, item);
					}
				});
				if($.isFunction(callback)){
					callback.call(container, data);
				}
			});
		});
	}
})(jQuery);

/***/ }),

/***/ 278:
/***/ (function(module, exports, __webpack_require__) {

var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_ARRAY__, __WEBPACK_AMD_DEFINE_RESULT__;/*!
 * jQuery Cookie Plugin v1.4.0
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2013 Klaus Hartl
 * Released under the MIT license
 */
(function (factory) {
	if (true) {
		// AMD. Register as anonymous module.
		!(__WEBPACK_AMD_DEFINE_ARRAY__ = [__webpack_require__(311)], __WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
		__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
		(__WEBPACK_AMD_DEFINE_FACTORY__.apply(exports, __WEBPACK_AMD_DEFINE_ARRAY__)) : __WEBPACK_AMD_DEFINE_FACTORY__),
		__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	} else {}
}(function ($) {

	var pluses = /\+/g;

	function encode(s) {
		return config.raw ? s : encodeURIComponent(s);
	}

	function decode(s) {
		return config.raw ? s : decodeURIComponent(s);
	}

	function stringifyCookieValue(value) {
		return encode(config.json ? JSON.stringify(value) : String(value));
	}

	function parseCookieValue(s) {
		if (s.indexOf('"') === 0) {
			// This is a quoted cookie as according to RFC2068, unescape...
			s = s.slice(1, -1).replace(/\\"/g, '"').replace(/\\\\/g, '\\');
		}

		try {
			// Replace server-side written pluses with spaces.
			// If we can't decode the cookie, ignore it, it's unusable.
			s = decodeURIComponent(s.replace(pluses, ' '));
		} catch(e) {
			return;
		}

		try {
			// If we can't parse the cookie, ignore it, it's unusable.
			return config.json ? JSON.parse(s) : s;
		} catch(e) {}
	}

	function read(s, converter) {
		var value = config.raw ? s : parseCookieValue(s);
		return $.isFunction(converter) ? converter(value) : value;
	}

	var config = $.cookie = function (key, value, options) {

		// Write
		if (value !== undefined && !$.isFunction(value)) {
			options = $.extend({}, config.defaults, options);

			if (typeof options.expires === 'number') {
				var days = options.expires, t = options.expires = new Date();
				t.setDate(t.getDate() + days);
			}

			return (document.cookie = [
				encode(key), '=', stringifyCookieValue(value),
				options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
				options.path    ? '; path=' + options.path : '',
				options.domain  ? '; domain=' + options.domain : '',
				options.secure  ? '; secure' : ''
			].join(''));
		}

		// Read

		var result = key ? undefined : {};

		// To prevent the for loop in the first place assign an empty array
		// in case there are no cookies at all. Also prevents odd result when
		// calling $.cookie().
		var cookies = document.cookie ? document.cookie.split('; ') : [];

		for (var i = 0, l = cookies.length; i < l; i++) {
			var parts = cookies[i].split('=');
			var name = decode(parts.shift());
			var cookie = parts.join('=');

			if (key && key === name) {
				// If second argument (value) is a function it's a converter...
				result = read(cookie, value);
				break;
			}

			// Prevent storing a cookie that we couldn't decode.
			if (!key && (cookie = read(cookie)) !== undefined) {
				result[name] = cookie;
			}
		}

		return result;
	};

	config.defaults = {};

	$.removeCookie = function (key, options) {
		if ($.cookie(key) === undefined) {
			return false;
		}

		// Must not alter options, thus extending a fresh object...
		$.cookie(key, '', $.extend({}, options, { expires: -1 }));
		return !$.cookie(key);
	};

}));


/***/ }),

/***/ 754:
/***/ (function() {

/**
 * Isotope v1.5.25
 * An exquisite jQuery plugin for magical layouts
 * http://isotope.metafizzy.co
 *
 * Commercial use requires one-time license fee
 * http://metafizzy.co/#licenses
 *
 * Copyright 2012 David DeSandro / Metafizzy
 */
(function(a,b,c){"use strict";var d=a.document,e=a.Modernizr,f=function(a){return a.charAt(0).toUpperCase()+a.slice(1)},g="Moz Webkit O Ms".split(" "),h=function(a){var b=d.documentElement.style,c;if(typeof b[a]=="string")return a;a=f(a);for(var e=0,h=g.length;e<h;e++){c=g[e]+a;if(typeof b[c]=="string")return c}},i=h("transform"),j=h("transitionProperty"),k={csstransforms:function(){return!!i},csstransforms3d:function(){var a=!!h("perspective");if(a){var c=" -o- -moz- -ms- -webkit- -khtml- ".split(" "),d="@media ("+c.join("transform-3d),(")+"modernizr)",e=b("<style>"+d+"{#modernizr{height:3px}}"+"</style>").appendTo("head"),f=b('<div id="modernizr" />').appendTo("html");a=f.height()===3,f.remove(),e.remove()}return a},csstransitions:function(){return!!j}},l;if(e)for(l in k)e.hasOwnProperty(l)||e.addTest(l,k[l]);else{e=a.Modernizr={_version:"1.6ish: miniModernizr for Isotope"};var m=" ",n;for(l in k)n=k[l](),e[l]=n,m+=" "+(n?"":"no-")+l;b("html").addClass(m)}if(e.csstransforms){var o=e.csstransforms3d?{translate:function(a){return"translate3d("+a[0]+"px, "+a[1]+"px, 0) "},scale:function(a){return"scale3d("+a+", "+a+", 1) "}}:{translate:function(a){return"translate("+a[0]+"px, "+a[1]+"px) "},scale:function(a){return"scale("+a+") "}},p=function(a,c,d){var e=b.data(a,"isoTransform")||{},f={},g,h={},j;f[c]=d,b.extend(e,f);for(g in e)j=e[g],h[g]=o[g](j);var k=h.translate||"",l=h.scale||"",m=k+l;b.data(a,"isoTransform",e),a.style[i]=m};b.cssNumber.scale=!0,b.cssHooks.scale={set:function(a,b){p(a,"scale",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.scale?d.scale:1}},b.fx.step.scale=function(a){b.cssHooks.scale.set(a.elem,a.now+a.unit)},b.cssNumber.translate=!0,b.cssHooks.translate={set:function(a,b){p(a,"translate",b)},get:function(a,c){var d=b.data(a,"isoTransform");return d&&d.translate?d.translate:[0,0]}}}var q,r;e.csstransitions&&(q={WebkitTransitionProperty:"webkitTransitionEnd",MozTransitionProperty:"transitionend",OTransitionProperty:"oTransitionEnd otransitionend",transitionProperty:"transitionend"}[j],r=h("transitionDuration"));var s=b.event,t=b.event.handle?"handle":"dispatch",u;s.special.smartresize={setup:function(){b(this).bind("resize",s.special.smartresize.handler)},teardown:function(){b(this).unbind("resize",s.special.smartresize.handler)},handler:function(a,b){var c=this,d=arguments;a.type="smartresize",u&&clearTimeout(u),u=setTimeout(function(){s[t].apply(c,d)},b==="execAsap"?0:100)}},b.fn.smartresize=function(a){return a?this.bind("smartresize",a):this.trigger("smartresize",["execAsap"])},b.Isotope=function(a,c,d){this.element=b(c),this._create(a),this._init(d)};var v=["width","height"],w=b(a);b.Isotope.settings={resizable:!0,layoutMode:"masonry",containerClass:"isotope",itemClass:"isotope-item",hiddenClass:"isotope-hidden",hiddenStyle:{opacity:0,scale:.001},visibleStyle:{opacity:1,scale:1},containerStyle:{position:"relative",overflow:"hidden"},animationEngine:"best-available",animationOptions:{queue:!1,duration:800},sortBy:"original-order",sortAscending:!0,resizesContainer:!0,transformsEnabled:!0,itemPositionDataEnabled:!1},b.Isotope.prototype={_create:function(a){this.options=b.extend({},b.Isotope.settings,a),this.styleQueue=[],this.elemCount=0;var c=this.element[0].style;this.originalStyle={};var d=v.slice(0);for(var e in this.options.containerStyle)d.push(e);for(var f=0,g=d.length;f<g;f++)e=d[f],this.originalStyle[e]=c[e]||"";this.element.css(this.options.containerStyle),this._updateAnimationEngine(),this._updateUsingTransforms();var h={"original-order":function(a,b){return b.elemCount++,b.elemCount},random:function(){return Math.random()}};this.options.getSortData=b.extend(this.options.getSortData,h),this.reloadItems(),this.offset={left:parseInt(this.element.css("padding-left")||0,10),top:parseInt(this.element.css("padding-top")||0,10)};var i=this;setTimeout(function(){i.element.addClass(i.options.containerClass)},0),this.options.resizable&&w.bind("smartresize.isotope",function(){i.resize()}),this.element.delegate("."+this.options.hiddenClass,"click",function(){return!1})},_getAtoms:function(a){var b=this.options.itemSelector,c=b?a.filter(b).add(a.find(b)):a,d={position:"absolute"};return c=c.filter(function(a,b){return b.nodeType===1}),this.usingTransforms&&(d.left=0,d.top=0),c.css(d).addClass(this.options.itemClass),this.updateSortData(c,!0),c},_init:function(a){this.$filteredAtoms=this._filter(this.$allAtoms),this._sort(),this.reLayout(a)},option:function(a){if(b.isPlainObject(a)){this.options=b.extend(!0,this.options,a);var c;for(var d in a)c="_update"+f(d),this[c]&&this[c]()}},_updateAnimationEngine:function(){var a=this.options.animationEngine.toLowerCase().replace(/[ _\-]/g,""),b;switch(a){case"css":case"none":b=!1;break;case"jquery":b=!0;break;default:b=!e.csstransitions}this.isUsingJQueryAnimation=b,this._updateUsingTransforms()},_updateTransformsEnabled:function(){this._updateUsingTransforms()},_updateUsingTransforms:function(){var a=this.usingTransforms=this.options.transformsEnabled&&e.csstransforms&&e.csstransitions&&!this.isUsingJQueryAnimation;a||(delete this.options.hiddenStyle.scale,delete this.options.visibleStyle.scale),this.getPositionStyles=a?this._translate:this._positionAbs},_filter:function(a){var b=this.options.filter===""?"*":this.options.filter;if(!b)return a;var c=this.options.hiddenClass,d="."+c,e=a.filter(d),f=e;if(b!=="*"){f=e.filter(b);var g=a.not(d).not(b).addClass(c);this.styleQueue.push({$el:g,style:this.options.hiddenStyle})}return this.styleQueue.push({$el:f,style:this.options.visibleStyle}),f.removeClass(c),a.filter(b)},updateSortData:function(a,c){var d=this,e=this.options.getSortData,f,g;a.each(function(){f=b(this),g={};for(var a in e)!c&&a==="original-order"?g[a]=b.data(this,"isotope-sort-data")[a]:g[a]=e[a](f,d);b.data(this,"isotope-sort-data",g)})},_sort:function(){var a=this.options.sortBy,b=this._getSorter,c=this.options.sortAscending?1:-1,d=function(d,e){var f=b(d,a),g=b(e,a);return f===g&&a!=="original-order"&&(f=b(d,"original-order"),g=b(e,"original-order")),(f>g?1:f<g?-1:0)*c};this.$filteredAtoms.sort(d)},_getSorter:function(a,c){return b.data(a,"isotope-sort-data")[c]},_translate:function(a,b){return{translate:[a,b]}},_positionAbs:function(a,b){return{left:a,top:b}},_pushPosition:function(a,b,c){b=Math.round(b+this.offset.left),c=Math.round(c+this.offset.top);var d=this.getPositionStyles(b,c);this.styleQueue.push({$el:a,style:d}),this.options.itemPositionDataEnabled&&a.data("isotope-item-position",{x:b,y:c})},layout:function(a,b){var c=this.options.layoutMode;this["_"+c+"Layout"](a);if(this.options.resizesContainer){var d=this["_"+c+"GetContainerSize"]();this.styleQueue.push({$el:this.element,style:d})}this._processStyleQueue(a,b),this.isLaidOut=!0},_processStyleQueue:function(a,c){var d=this.isLaidOut?this.isUsingJQueryAnimation?"animate":"css":"css",f=this.options.animationOptions,g=this.options.onLayout,h,i,j,k;i=function(a,b){b.$el[d](b.style,f)};if(this._isInserting&&this.isUsingJQueryAnimation)i=function(a,b){h=b.$el.hasClass("no-transition")?"css":d,b.$el[h](b.style,f)};else if(c||g||f.complete){var l=!1,m=[c,g,f.complete],n=this;j=!0,k=function(){if(l)return;var b;for(var c=0,d=m.length;c<d;c++)b=m[c],typeof b=="function"&&b.call(n.element,a,n);l=!0};if(this.isUsingJQueryAnimation&&d==="animate")f.complete=k,j=!1;else if(e.csstransitions){var o=0,p=this.styleQueue[0],s=p&&p.$el,t;while(!s||!s.length){t=this.styleQueue[o++];if(!t)return;s=t.$el}var u=parseFloat(getComputedStyle(s[0])[r]);u>0&&(i=function(a,b){b.$el[d](b.style,f).one(q,k)},j=!1)}}b.each(this.styleQueue,i),j&&k(),this.styleQueue=[]},resize:function(){this["_"+this.options.layoutMode+"ResizeChanged"]()&&this.reLayout()},reLayout:function(a){this["_"+this.options.layoutMode+"Reset"](),this.layout(this.$filteredAtoms,a)},addItems:function(a,b){var c=this._getAtoms(a);this.$allAtoms=this.$allAtoms.add(c),b&&b(c)},insert:function(a,b){this.element.append(a);var c=this;this.addItems(a,function(a){var d=c._filter(a);c._addHideAppended(d),c._sort(),c.reLayout(),c._revealAppended(d,b)})},appended:function(a,b){var c=this;this.addItems(a,function(a){c._addHideAppended(a),c.layout(a),c._revealAppended(a,b)})},_addHideAppended:function(a){this.$filteredAtoms=this.$filteredAtoms.add(a),a.addClass("no-transition"),this._isInserting=!0,this.styleQueue.push({$el:a,style:this.options.hiddenStyle})},_revealAppended:function(a,b){var c=this;setTimeout(function(){a.removeClass("no-transition"),c.styleQueue.push({$el:a,style:c.options.visibleStyle}),c._isInserting=!1,c._processStyleQueue(a,b)},10)},reloadItems:function(){this.$allAtoms=this._getAtoms(this.element.children())},remove:function(a,b){this.$allAtoms=this.$allAtoms.not(a),this.$filteredAtoms=this.$filteredAtoms.not(a);var c=this,d=function(){a.remove(),b&&b.call(c.element)};a.filter(":not(."+this.options.hiddenClass+")").length?(this.styleQueue.push({$el:a,style:this.options.hiddenStyle}),this._sort(),this.reLayout(d)):d()},shuffle:function(a){this.updateSortData(this.$allAtoms),this.options.sortBy="random",this._sort(),this.reLayout(a)},destroy:function(){var a=this.usingTransforms,b=this.options;this.$allAtoms.removeClass(b.hiddenClass+" "+b.itemClass).each(function(){var b=this.style;b.position="",b.top="",b.left="",b.opacity="",a&&(b[i]="")});var c=this.element[0].style;for(var d in this.originalStyle)c[d]=this.originalStyle[d];this.element.unbind(".isotope").undelegate("."+b.hiddenClass,"click").removeClass(b.containerClass).removeData("isotope"),w.unbind(".isotope")},_getSegments:function(a){var b=this.options.layoutMode,c=a?"rowHeight":"columnWidth",d=a?"height":"width",e=a?"rows":"cols",g=this.element[d](),h,i=this.options[b]&&this.options[b][c]||this.$filteredAtoms["outer"+f(d)](!0)||g;h=Math.floor(g/i),h=Math.max(h,1),this[b][e]=h,this[b][c]=i},_checkIfSegmentsChanged:function(a){var b=this.options.layoutMode,c=a?"rows":"cols",d=this[b][c];return this._getSegments(a),this[b][c]!==d},_masonryReset:function(){this.masonry={},this._getSegments();var a=this.masonry.cols;this.masonry.colYs=[];while(a--)this.masonry.colYs.push(0)},_masonryLayout:function(a){var c=this,d=c.masonry;a.each(function(){var a=b(this),e=Math.ceil(a.outerWidth(!0)/d.columnWidth);e=Math.min(e,d.cols);if(e===1)c._masonryPlaceBrick(a,d.colYs);else{var f=d.cols+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.colYs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryPlaceBrick(a,g)}})},_masonryPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=this.masonry.columnWidth*d,h=c;this._pushPosition(a,g,h);var i=c+a.outerHeight(!0),j=this.masonry.cols+1-f;for(e=0;e<j;e++)this.masonry.colYs[d+e]=i},_masonryGetContainerSize:function(){var a=Math.max.apply(Math,this.masonry.colYs);return{height:a}},_masonryResizeChanged:function(){return this._checkIfSegmentsChanged()},_fitRowsReset:function(){this.fitRows={x:0,y:0,height:0}},_fitRowsLayout:function(a){var c=this,d=this.element.width(),e=this.fitRows;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.x!==0&&f+e.x>d&&(e.x=0,e.y=e.height),c._pushPosition(a,e.x,e.y),e.height=Math.max(e.y+g,e.height),e.x+=f})},_fitRowsGetContainerSize:function(){return{height:this.fitRows.height}},_fitRowsResizeChanged:function(){return!0},_cellsByRowReset:function(){this.cellsByRow={index:0},this._getSegments(),this._getSegments(!0)},_cellsByRowLayout:function(a){var c=this,d=this.cellsByRow;a.each(function(){var a=b(this),e=d.index%d.cols,f=Math.floor(d.index/d.cols),g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByRowGetContainerSize:function(){return{height:Math.ceil(this.$filteredAtoms.length/this.cellsByRow.cols)*this.cellsByRow.rowHeight+this.offset.top}},_cellsByRowResizeChanged:function(){return this._checkIfSegmentsChanged()},_straightDownReset:function(){this.straightDown={y:0}},_straightDownLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,0,c.straightDown.y),c.straightDown.y+=d.outerHeight(!0)})},_straightDownGetContainerSize:function(){return{height:this.straightDown.y}},_straightDownResizeChanged:function(){return!0},_masonryHorizontalReset:function(){this.masonryHorizontal={},this._getSegments(!0);var a=this.masonryHorizontal.rows;this.masonryHorizontal.rowXs=[];while(a--)this.masonryHorizontal.rowXs.push(0)},_masonryHorizontalLayout:function(a){var c=this,d=c.masonryHorizontal;a.each(function(){var a=b(this),e=Math.ceil(a.outerHeight(!0)/d.rowHeight);e=Math.min(e,d.rows);if(e===1)c._masonryHorizontalPlaceBrick(a,d.rowXs);else{var f=d.rows+1-e,g=[],h,i;for(i=0;i<f;i++)h=d.rowXs.slice(i,i+e),g[i]=Math.max.apply(Math,h);c._masonryHorizontalPlaceBrick(a,g)}})},_masonryHorizontalPlaceBrick:function(a,b){var c=Math.min.apply(Math,b),d=0;for(var e=0,f=b.length;e<f;e++)if(b[e]===c){d=e;break}var g=c,h=this.masonryHorizontal.rowHeight*d;this._pushPosition(a,g,h);var i=c+a.outerWidth(!0),j=this.masonryHorizontal.rows+1-f;for(e=0;e<j;e++)this.masonryHorizontal.rowXs[d+e]=i},_masonryHorizontalGetContainerSize:function(){var a=Math.max.apply(Math,this.masonryHorizontal.rowXs);return{width:a}},_masonryHorizontalResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_fitColumnsReset:function(){this.fitColumns={x:0,y:0,width:0}},_fitColumnsLayout:function(a){var c=this,d=this.element.height(),e=this.fitColumns;a.each(function(){var a=b(this),f=a.outerWidth(!0),g=a.outerHeight(!0);e.y!==0&&g+e.y>d&&(e.x=e.width,e.y=0),c._pushPosition(a,e.x,e.y),e.width=Math.max(e.x+f,e.width),e.y+=g})},_fitColumnsGetContainerSize:function(){return{width:this.fitColumns.width}},_fitColumnsResizeChanged:function(){return!0},_cellsByColumnReset:function(){this.cellsByColumn={index:0},this._getSegments(),this._getSegments(!0)},_cellsByColumnLayout:function(a){var c=this,d=this.cellsByColumn;a.each(function(){var a=b(this),e=Math.floor(d.index/d.rows),f=d.index%d.rows,g=(e+.5)*d.columnWidth-a.outerWidth(!0)/2,h=(f+.5)*d.rowHeight-a.outerHeight(!0)/2;c._pushPosition(a,g,h),d.index++})},_cellsByColumnGetContainerSize:function(){return{width:Math.ceil(this.$filteredAtoms.length/this.cellsByColumn.rows)*this.cellsByColumn.columnWidth}},_cellsByColumnResizeChanged:function(){return this._checkIfSegmentsChanged(!0)},_straightAcrossReset:function(){this.straightAcross={x:0}},_straightAcrossLayout:function(a){var c=this;a.each(function(a){var d=b(this);c._pushPosition(d,c.straightAcross.x,0),c.straightAcross.x+=d.outerWidth(!0)})},_straightAcrossGetContainerSize:function(){return{width:this.straightAcross.x}},_straightAcrossResizeChanged:function(){return!0}},b.fn.imagesLoaded=function(a){function h(){a.call(c,d)}function i(a){var c=a.target;c.src!==f&&b.inArray(c,g)===-1&&(g.push(c),--e<=0&&(setTimeout(h),d.unbind(".imagesLoaded",i)))}var c=this,d=c.find("img").add(c.filter("img")),e=d.length,f="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==",g=[];return e||h(),d.bind("load.imagesLoaded error.imagesLoaded",i).each(function(){var a=this.src;this.src=f,this.src=a}),c};var x=function(b){a.console&&a.console.error(b)};b.fn.isotope=function(a,c){if(typeof a=="string"){var d=Array.prototype.slice.call(arguments,1);this.each(function(){var c=b.data(this,"isotope");if(!c){x("cannot call methods on isotope prior to initialization; attempted to call method '"+a+"'");return}if(!b.isFunction(c[a])||a.charAt(0)==="_"){x("no such method '"+a+"' for isotope instance");return}c[a].apply(c,d)})}else this.each(function(){var d=b.data(this,"isotope");d?(d.option(a),d._init(c)):b.data(this,"isotope",new b.Isotope(a,this,c))});return this}})(window,jQuery);

/***/ }),

/***/ 783:
/***/ (function() {

/*! SmartMenus jQuery Plugin Bootstrap Addon - v0.1.0 - March 27, 2014
 * http://www.smartmenus.org/
 * Copyright 2014 Vasil Dinkov, Vadikom Web Ltd. http://vadikom.com; Licensed MIT */(function(t){t(function(){t("ul.navbar-nav").each(function(){var s=t(this);s.addClass("sm").smartmenus({subMenusSubOffsetX:2,subMenusSubOffsetY:-6,subIndicatorsPos:"append",subIndicatorsText:"...",collapsibleShowFunction:null,collapsibleHideFunction:null,rightToLeftSubMenus:s.hasClass("navbar-right"),bottomToTopSubMenus:s.closest(".navbar").hasClass("navbar-fixed-bottom")}).find("a.current").parent().addClass("active")}).bind({"show.smapi":function(s,e){var i=t(e),o=i.dataSM("scroll-arrows"),a=t(this).data("smartmenus");o&&o.css("background-color",t(document.body).css("background-color")),i.parent().addClass("open"+(a.isCollapsible()?" collapsible":""))},"hide.smapi":function(s,e){t(e).parent().removeClass("open collapsible")},"click.smapi":function(s,e){var i=t(this).data("smartmenus");if(i.isCollapsible()){var o=t(e),a=o.parent().dataSM("sub");if(a&&a.dataSM("shown-before")&&a.is(":visible"))return i.itemActivate(o),i.menuHide(a),!1}}})}),t.SmartMenus.prototype.isCollapsible=function(){return"left"!=this.$firstLink.parent().css("float")}})(jQuery);

/***/ }),

/***/ 666:
/***/ (function() {

/*! SmartMenus jQuery Plugin - v0.9.6 - March 27, 2014
 * http://www.smartmenus.org/
 * Copyright 2014 Vasil Dinkov, Vadikom Web Ltd. http://vadikom.com; Licensed MIT */(function(t){function s(s){if(h||s)h&&s&&(t(document).unbind(".smartmenus_mouse"),h=!1);else{var e=!0,o=null;t(document).bind({"mousemove.smartmenus_mouse":function(s){var a={x:s.pageX,y:s.pageY,timeStamp:(new Date).getTime()};if(o){var r=Math.abs(o.x-a.x),h=Math.abs(o.y-a.y);if((r>0||h>0)&&2>=r&&2>=h&&300>=a.timeStamp-o.timeStamp&&(n=!0,e)){var u=t(s.target).closest("a");u.is("a")&&t.each(i,function(){return t.contains(this.$root[0],u[0])?(this.itemEnter({currentTarget:u[0]}),!1):void 0}),e=!1}}o=a},"touchstart.smartmenus_mouse pointerover.smartmenus_mouse MSPointerOver.smartmenus_mouse":function(t){/^(4|mouse)$/.test(t.originalEvent.pointerType)||(n=!1)}}),h=!0}}var i=[],e=!!window.createPopup,o=e&&!document.defaultView,a=e&&!document.querySelector,r=e&&document.documentElement.currentStyle.minWidth===void 0,n=!1,h=!1;t.SmartMenus=function(s,i){this.$root=t(s),this.opts=i,this.rootId="",this.$subArrow=null,this.subMenus=[],this.activatedItems=[],this.visibleSubMenus=[],this.showTimeout=0,this.hideTimeout=0,this.scrollTimeout=0,this.clickActivated=!1,this.zIndexInc=0,this.$firstLink=null,this.$firstSub=null,this.disabled=!1,this.$disableOverlay=null,this.init()},t.extend(t.SmartMenus,{hideAll:function(){t.each(i,function(){this.menuHideAll()})},destroy:function(){for(;i.length;)i[0].destroy();s(!0)},prototype:{init:function(e){var o=this;if(!e){i.push(this),this.rootId=((new Date).getTime()+Math.random()+"").replace(/\D/g,""),this.$root.hasClass("sm-rtl")&&(this.opts.rightToLeftSubMenus=!0),this.$root.data("smartmenus",this).attr("data-smartmenus-id",this.rootId).dataSM("level",1).bind({"mouseover.smartmenus focusin.smartmenus":t.proxy(this.rootOver,this),"mouseout.smartmenus focusout.smartmenus":t.proxy(this.rootOut,this)}).delegate("a",{"mouseenter.smartmenus":t.proxy(this.itemEnter,this),"mouseleave.smartmenus":t.proxy(this.itemLeave,this),"mousedown.smartmenus":t.proxy(this.itemDown,this),"focus.smartmenus":t.proxy(this.itemFocus,this),"blur.smartmenus":t.proxy(this.itemBlur,this),"click.smartmenus":t.proxy(this.itemClick,this),"touchend.smartmenus":t.proxy(this.itemTouchEnd,this)});var a=".smartmenus"+this.rootId;this.opts.hideOnClick&&t(document).bind("touchstart"+a,t.proxy(this.docTouchStart,this)).bind("touchmove"+a,t.proxy(this.docTouchMove,this)).bind("touchend"+a,t.proxy(this.docTouchEnd,this)).bind("click"+a,t.proxy(this.docClick,this)),t(window).bind("resize"+a+" orientationchange"+a,t.proxy(this.winResize,this)),this.opts.subIndicators&&(this.$subArrow=t("<span/>").addClass("sub-arrow"),this.opts.subIndicatorsText&&this.$subArrow.html(this.opts.subIndicatorsText)),s()}if(this.$firstSub=this.$root.find("ul").each(function(){o.menuInit(t(this))}).eq(0),this.$firstLink=this.$root.find("a").eq(0),this.opts.markCurrentItem){var r=/(index|default)\.[^#\?\/]*/i,n=/#.*/,h=window.location.href.replace(r,""),u=h.replace(n,"");this.$root.find("a").each(function(){var s=this.href.replace(r,""),i=t(this);(s==h||s==u)&&(i.addClass("current"),o.opts.markCurrentTree&&i.parents("li").each(function(){var s=t(this);s.dataSM("sub")&&s.children("a").addClass("current")}))})}},destroy:function(){this.menuHideAll(),this.$root.removeData("smartmenus").removeAttr("data-smartmenus-id").removeDataSM("level").unbind(".smartmenus").undelegate(".smartmenus");var s=".smartmenus"+this.rootId;t(document).unbind(s),t(window).unbind(s),this.opts.subIndicators&&(this.$subArrow=null);var e=this;t.each(this.subMenus,function(){this.hasClass("mega-menu")&&this.find("ul").removeDataSM("in-mega"),this.dataSM("shown-before")&&(a&&this.children().css({styleFloat:"",width:""}),(e.opts.subMenusMinWidth||e.opts.subMenusMaxWidth)&&(r?this.css({width:"",overflowX:"",overflowY:""}).children().children("a").css("white-space",""):this.css({width:"",minWidth:"",maxWidth:""}).removeClass("sm-nowrap")),this.dataSM("scroll-arrows")&&this.dataSM("scroll-arrows").remove(),this.css({zIndex:"",top:"",left:"",marginLeft:"",marginTop:"",display:""})),e.opts.subIndicators&&this.dataSM("parent-a").removeClass("has-submenu").children("span.sub-arrow").remove(),this.removeDataSM("shown-before").removeDataSM("ie-shim").removeDataSM("scroll-arrows").removeDataSM("parent-a").removeDataSM("level").removeDataSM("beforefirstshowfired").parent().removeDataSM("sub")}),this.opts.markCurrentItem&&this.$root.find("a.current").removeClass("current"),this.$root=null,this.$firstLink=null,this.$firstSub=null,this.$disableOverlay&&(this.$disableOverlay.remove(),this.$disableOverlay=null),i.splice(t.inArray(this,i),1)},disable:function(s){if(!this.disabled){if(this.menuHideAll(),!s&&!this.opts.isPopup&&this.$root.is(":visible")){var i=this.$root.offset();this.$disableOverlay=t('<div class="sm-jquery-disable-overlay"/>').css({position:"absolute",top:i.top,left:i.left,width:this.$root.outerWidth(),height:this.$root.outerHeight(),zIndex:this.getStartZIndex()+1,opacity:0}).appendTo(document.body)}this.disabled=!0}},docClick:function(s){(this.visibleSubMenus.length&&!t.contains(this.$root[0],s.target)||t(s.target).is("a"))&&this.menuHideAll()},docTouchEnd:function(){if(this.lastTouch){if(!(!this.visibleSubMenus.length||void 0!==this.lastTouch.x2&&this.lastTouch.x1!=this.lastTouch.x2||void 0!==this.lastTouch.y2&&this.lastTouch.y1!=this.lastTouch.y2||this.lastTouch.target&&t.contains(this.$root[0],this.lastTouch.target))){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0);var s=this;this.hideTimeout=setTimeout(function(){s.menuHideAll()},350)}this.lastTouch=null}},docTouchMove:function(t){if(this.lastTouch){var s=t.originalEvent.touches[0];this.lastTouch.x2=s.pageX,this.lastTouch.y2=s.pageY}},docTouchStart:function(t){var s=t.originalEvent.touches[0];this.lastTouch={x1:s.pageX,y1:s.pageY,target:s.target}},enable:function(){this.disabled&&(this.$disableOverlay&&(this.$disableOverlay.remove(),this.$disableOverlay=null),this.disabled=!1)},getHeight:function(t){return this.getOffset(t,!0)},getOffset:function(t,s){var i;"none"==t.css("display")&&(i={position:t[0].style.position,visibility:t[0].style.visibility},t.css({position:"absolute",visibility:"hidden"}).show());var e=t[0].ownerDocument.defaultView,o=e&&e.getComputedStyle&&e.getComputedStyle(t[0],null),a=o&&parseFloat(o[s?"height":"width"]);return a?a+=parseFloat(o[s?"paddingTop":"paddingLeft"])+parseFloat(o[s?"paddingBottom":"paddingRight"])+parseInt(o[s?"borderTopWidth":"borderLeftWidth"])+parseInt(o[s?"borderBottomWidth":"borderRightWidth"]):a=s?t[0].offsetHeight:t[0].offsetWidth,i&&t.hide().css(i),a},getWidth:function(t){return this.getOffset(t)},getStartZIndex:function(){var t=parseInt(this.$root.css("z-index"));return isNaN(t)?1:t},handleEvents:function(){return!this.disabled&&this.isCSSOn()},handleItemEvents:function(t){return this.handleEvents()&&!this.isLinkInMegaMenu(t)},isCollapsible:function(){return"static"==this.$firstSub.css("position")},isCSSOn:function(){return"block"==this.$firstLink.css("display")},isFixed:function(){return"fixed"==this.$root.css("position")},isLinkInMegaMenu:function(t){return!t.parent().parent().dataSM("level")},isTouchMode:function(){return!n||this.isCollapsible()},itemActivate:function(s){var i=s.parent(),e=i.parent(),o=e.dataSM("level");if(o>1&&(!this.activatedItems[o-2]||this.activatedItems[o-2][0]!=e.dataSM("parent-a")[0])){var a=this;t(e.parentsUntil("[data-smartmenus-id]","ul").get().reverse()).add(e).each(function(){a.itemActivate(t(this).dataSM("parent-a"))})}if(this.visibleSubMenus.length>o)for(var r=this.visibleSubMenus.length-1,n=this.activatedItems[o-1]&&this.activatedItems[o-1][0]==s[0]?o:o-1;r>n;r--)this.menuHide(this.visibleSubMenus[r]);if(this.activatedItems[o-1]=s,this.visibleSubMenus[o-1]=e,this.$root.triggerHandler("activate.smapi",s[0])!==!1){var h=i.dataSM("sub");h&&(this.isTouchMode()||!this.opts.showOnClick||this.clickActivated)&&this.menuShow(h)}},itemBlur:function(s){var i=t(s.currentTarget);this.handleItemEvents(i)&&this.$root.triggerHandler("blur.smapi",i[0])},itemClick:function(s){var i=t(s.currentTarget);if(this.handleItemEvents(i)){if(i.removeDataSM("mousedown"),this.$root.triggerHandler("click.smapi",i[0])===!1)return!1;var e=i.parent().dataSM("sub");if(this.isTouchMode()){if(i.dataSM("href")&&i.attr("href",i.dataSM("href")).removeDataSM("href"),e&&(!e.dataSM("shown-before")||!e.is(":visible"))&&(this.itemActivate(i),e.is(":visible")))return!1}else if(this.opts.showOnClick&&1==i.parent().parent().dataSM("level")&&e)return this.clickActivated=!0,this.menuShow(e),!1;return i.hasClass("disabled")?!1:this.$root.triggerHandler("select.smapi",i[0])===!1?!1:void 0}},itemDown:function(s){var i=t(s.currentTarget);this.handleItemEvents(i)&&i.dataSM("mousedown",!0)},itemEnter:function(s){var i=t(s.currentTarget);if(this.handleItemEvents(i)){if(!this.isTouchMode()){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0);var e=this;this.showTimeout=setTimeout(function(){e.itemActivate(i)},this.opts.showOnClick&&1==i.parent().parent().dataSM("level")?1:this.opts.showTimeout)}this.$root.triggerHandler("mouseenter.smapi",i[0])}},itemFocus:function(s){var i=t(s.currentTarget);this.handleItemEvents(i)&&(this.isTouchMode()&&i.dataSM("mousedown")||this.activatedItems.length&&this.activatedItems[this.activatedItems.length-1][0]==i[0]||this.itemActivate(i),this.$root.triggerHandler("focus.smapi",i[0]))},itemLeave:function(s){var i=t(s.currentTarget);this.handleItemEvents(i)&&(this.isTouchMode()||(i[0].blur&&i[0].blur(),this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0)),i.removeDataSM("mousedown"),this.$root.triggerHandler("mouseleave.smapi",i[0]))},itemTouchEnd:function(s){var i=t(s.currentTarget);if(this.handleItemEvents(i)){var e=i.parent().dataSM("sub");"#"===i.attr("href").charAt(0)||!e||e.dataSM("shown-before")&&e.is(":visible")||(i.dataSM("href",i.attr("href")),i.attr("href","#"))}},menuFixLayout:function(t){t.dataSM("shown-before")||(t.hide().dataSM("shown-before",!0),a&&t.children().css({styleFloat:"left",width:"100%"}))},menuHide:function(t){if(this.$root.triggerHandler("beforehide.smapi",t[0])!==!1&&(t.stop(!0,!0),t.is(":visible"))){var s=function(){o?t.parent().css("z-index",""):t.css("z-index","")};this.isCollapsible()?this.opts.collapsibleHideFunction?this.opts.collapsibleHideFunction.call(this,t,s):t.hide(this.opts.collapsibleHideDuration,s):this.opts.hideFunction?this.opts.hideFunction.call(this,t,s):t.hide(this.opts.hideDuration,s),t.dataSM("ie-shim")&&t.dataSM("ie-shim").remove(),t.dataSM("scroll")&&t.unbind(".smartmenus_scroll").removeDataSM("scroll").dataSM("scroll-arrows").hide(),t.dataSM("parent-a").removeClass("highlighted");var i=t.dataSM("level");this.activatedItems.splice(i-1,1),this.visibleSubMenus.splice(i-1,1),this.$root.triggerHandler("hide.smapi",t[0])}},menuHideAll:function(){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0);for(var t=this.visibleSubMenus.length-1;t>0;t--)this.menuHide(this.visibleSubMenus[t]);this.opts.isPopup&&(this.$root.stop(!0,!0),this.$root.is(":visible")&&(this.opts.hideFunction?this.opts.hideFunction.call(this,this.$root):this.$root.hide(this.opts.hideDuration),this.$root.dataSM("ie-shim")&&this.$root.dataSM("ie-shim").remove())),this.activatedItems=[],this.visibleSubMenus=[],this.clickActivated=!1,this.zIndexInc=0},menuIframeShim:function(s){e&&this.opts.overlapControlsInIE&&!s.dataSM("ie-shim")&&s.dataSM("ie-shim",t("<iframe/>").attr({src:"javascript:0",tabindex:-9}).css({position:"absolute",top:"auto",left:"0",opacity:0,border:"0"}))},menuInit:function(t){if(!t.dataSM("in-mega")){this.subMenus.push(t),t.hasClass("mega-menu")&&t.find("ul").dataSM("in-mega",!0);for(var s=2,i=t[0];(i=i.parentNode.parentNode)!=this.$root[0];)s++;t.dataSM("parent-a",t.prevAll("a").eq(-1)).dataSM("level",s).parent().dataSM("sub",t),this.opts.subIndicators&&t.dataSM("parent-a").addClass("has-submenu")[this.opts.subIndicatorsPos](this.$subArrow.clone())}},menuPosition:function(s){var i,e,o=s.dataSM("parent-a"),a=s.parent().parent(),r=s.dataSM("level"),h=this.getWidth(s),u=this.getHeight(s),l=o.offset(),d=l.left,c=l.top,m=this.getWidth(o),p=this.getHeight(o),f=t(window),v=f.scrollLeft(),b=f.scrollTop(),M=f.width(),S=f.height(),w=a.hasClass("sm")&&!a.hasClass("sm-vertical"),g=2==r?this.opts.mainMenuSubOffsetX:this.opts.subMenusSubOffsetX,T=2==r?this.opts.mainMenuSubOffsetY:this.opts.subMenusSubOffsetY;if(w?(i=this.opts.rightToLeftSubMenus?m-h-g:g,e=this.opts.bottomToTopSubMenus?-u-T:p+T):(i=this.opts.rightToLeftSubMenus?g-h:m-g,e=this.opts.bottomToTopSubMenus?p-T-u:T),this.opts.keepInViewport&&!this.isCollapsible()){this.isFixed()&&(d-=v,c-=b,v=b=0);var $=d+i,I=c+e;if(this.opts.rightToLeftSubMenus&&v>$?i=w?v-$+i:m-g:!this.opts.rightToLeftSubMenus&&$+h>v+M&&(i=w?v+M-h-$+i:g-h),w||(S>u&&I+u>b+S?e+=b+S-u-I:(u>=S||b>I)&&(e+=b-I)),n&&(w&&(I+u>b+S+.49||b>I)||!w&&u>S+.49)){var y=this;s.dataSM("scroll-arrows")||s.dataSM("scroll-arrows",t([t('<span class="scroll-up"><span class="scroll-up-arrow"></span></span>')[0],t('<span class="scroll-down"><span class="scroll-down-arrow"></span></span>')[0]]).bind({mouseenter:function(){y.menuScroll(s,t(this).hasClass("scroll-up"))},mouseleave:function(t){y.menuScrollStop(s),y.menuScrollOut(s,t)},"mousewheel DOMMouseScroll":function(t){t.preventDefault()}}).insertAfter(s));var x=b-(c+p);s.dataSM("scroll",{vportY:x,subH:u,winH:S,step:1}).bind({"mouseover.smartmenus_scroll":function(t){y.menuScrollOver(s,t)},"mouseout.smartmenus_scroll":function(t){y.menuScrollOut(s,t)},"mousewheel.smartmenus_scroll DOMMouseScroll.smartmenus_scroll":function(t){y.menuScrollMousewheel(s,t)}}).dataSM("scroll-arrows").css({top:"auto",left:"0",marginLeft:i+(parseInt(s.css("border-left-width"))||0),width:this.getWidth(s)-(parseInt(s.css("border-left-width"))||0)-(parseInt(s.css("border-right-width"))||0),zIndex:this.getStartZIndex()+this.zIndexInc}).eq(0).css("margin-top",x).end().eq(1).css("margin-top",x+S-this.getHeight(s.dataSM("scroll-arrows").eq(1))).end().eq(w&&this.opts.bottomToTopSubMenus?0:1).show()}}s.css({top:"auto",left:"0",marginLeft:i,marginTop:e-p}),this.menuIframeShim(s),s.dataSM("ie-shim")&&s.dataSM("ie-shim").css({zIndex:s.css("z-index"),width:h,height:u,marginLeft:i,marginTop:e-p})},menuScroll:function(t,s,i){var e=parseFloat(t.css("margin-top")),o=t.dataSM("scroll"),a=o.vportY+(s?0:o.winH-o.subH),r=i||!this.opts.scrollAccelerate?this.opts.scrollStep:Math.floor(t.dataSM("scroll").step);if(t.add(t.dataSM("ie-shim")).css("margin-top",Math.abs(a-e)>r?e+(s?r:-r):a),e=parseFloat(t.css("margin-top")),(s&&e+o.subH>o.vportY+o.winH||!s&&o.vportY>e)&&t.dataSM("scroll-arrows").eq(s?1:0).show(),!i&&this.opts.scrollAccelerate&&t.dataSM("scroll").step<this.opts.scrollStep&&(t.dataSM("scroll").step+=.5),1>Math.abs(e-a))t.dataSM("scroll-arrows").eq(s?0:1).hide(),t.dataSM("scroll").step=1;else if(!i){var n=this;this.scrollTimeout=setTimeout(function(){n.menuScroll(t,s)},this.opts.scrollInterval)}},menuScrollMousewheel:function(s,i){for(var e=t(i.target).closest("ul");e.dataSM("in-mega");)e=e.parent().closest("ul");if(e[0]==s[0]){var o=(i.originalEvent.wheelDelta||-i.originalEvent.detail)>0;s.dataSM("scroll-arrows").eq(o?0:1).is(":visible")&&this.menuScroll(s,o,!0)}i.preventDefault()},menuScrollOut:function(s,i){for(var e=/^scroll-(up|down)/,o=t(i.relatedTarget).closest("ul");o.dataSM("in-mega");)o=o.parent().closest("ul");e.test((i.relatedTarget||"").className)||(s[0]==i.relatedTarget||t.contains(s[0],i.relatedTarget))&&o[0]==s[0]||s.dataSM("scroll-arrows").css("visibility","hidden")},menuScrollOver:function(s,i){for(var e=/^scroll-(up|down)/,o=t(i.target).closest("ul");o.dataSM("in-mega");)o=o.parent().closest("ul");e.test(i.target.className)||o[0]!=s[0]||s.dataSM("scroll-arrows").css("visibility","visible")},menuScrollStop:function(t){this.scrollTimeout&&(clearTimeout(this.scrollTimeout),this.scrollTimeout=0,t.dataSM("scroll").step=1)},menuShow:function(t){if((t.dataSM("beforefirstshowfired")||(t.dataSM("beforefirstshowfired",!0),this.$root.triggerHandler("beforefirstshow.smapi",t[0])!==!1))&&this.$root.triggerHandler("beforeshow.smapi",t[0])!==!1&&(this.menuFixLayout(t),t.stop(!0,!0),!t.is(":visible"))){var s=this.getStartZIndex()+ ++this.zIndexInc;if(o?t.parent().css("z-index",s):t.css("z-index",s),(this.opts.keepHighlighted||this.isCollapsible())&&t.dataSM("parent-a").addClass("highlighted"),this.opts.subMenusMinWidth||this.opts.subMenusMaxWidth)if(a){if(t.children().css("styleFloat","none"),r?t.width(this.opts.subMenusMinWidth?this.opts.subMenusMinWidth:1).children().children("a").css("white-space","nowrap"):(t.css({width:"auto",minWidth:"",maxWidth:""}).addClass("sm-nowrap"),this.opts.subMenusMinWidth&&t.css("min-width",this.opts.subMenusMinWidth)),this.opts.subMenusMaxWidth){var i=t.width();if(r){var e=t.css({width:this.opts.subMenusMaxWidth,overflowX:"hidden",overflowY:"hidden"}).width();i>e?t.css({width:e,overflowX:"visible",overflowY:"visible"}).children().children("a").css("white-space",""):t.css({width:i,overflowX:"visible",overflowY:"visible"})}else t.css("max-width",this.opts.subMenusMaxWidth),i>t.width()?t.removeClass("sm-nowrap").css("width",this.opts.subMenusMaxWidth):t.width(i)}else t.width(t.width());t.children().css("styleFloat","left")}else if(t.css({width:"auto",minWidth:"",maxWidth:""}).addClass("sm-nowrap"),this.opts.subMenusMinWidth&&t.css("min-width",this.opts.subMenusMinWidth),this.opts.subMenusMaxWidth){var i=this.getWidth(t);t.css("max-width",this.opts.subMenusMaxWidth),i>this.getWidth(t)&&t.removeClass("sm-nowrap").css("width",this.opts.subMenusMaxWidth)}this.menuPosition(t),t.dataSM("ie-shim")&&t.dataSM("ie-shim").insertBefore(t);var n=function(){t.css("overflow","")};this.isCollapsible()?this.opts.collapsibleShowFunction?this.opts.collapsibleShowFunction.call(this,t,n):t.show(this.opts.collapsibleShowDuration,n):this.opts.showFunction?this.opts.showFunction.call(this,t,n):t.show(this.opts.showDuration,n),this.visibleSubMenus[t.dataSM("level")-1]=t,this.$root.triggerHandler("show.smapi",t[0])}},popupHide:function(t){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0);var s=this;this.hideTimeout=setTimeout(function(){s.menuHideAll()},t?1:this.opts.hideTimeout)},popupShow:function(t,s){return this.opts.isPopup?(this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0),this.menuFixLayout(this.$root),this.$root.stop(!0,!0),this.$root.is(":visible")||(this.$root.css({left:t,top:s}),this.menuIframeShim(this.$root),this.$root.dataSM("ie-shim")&&this.$root.dataSM("ie-shim").css({zIndex:this.$root.css("z-index"),width:this.getWidth(this.$root),height:this.getHeight(this.$root),left:t,top:s}).insertBefore(this.$root),this.opts.showFunction?this.opts.showFunction.call(this,this.$root):this.$root.show(this.opts.showDuration),this.visibleSubMenus[0]=this.$root),void 0):(alert('SmartMenus jQuery Error:\n\nIf you want to show this menu via the "popupShow" method, set the isPopup:true option.'),void 0)},refresh:function(){this.menuHideAll(),this.$root.find("ul").each(function(){var s=t(this);s.dataSM("scroll-arrows")&&s.dataSM("scroll-arrows").remove()}).removeDataSM("in-mega").removeDataSM("shown-before").removeDataSM("ie-shim").removeDataSM("scroll-arrows").removeDataSM("parent-a").removeDataSM("level").removeDataSM("beforefirstshowfired"),this.$root.find("a.has-submenu").removeClass("has-submenu").parent().removeDataSM("sub"),this.opts.subIndicators&&this.$root.find("span.sub-arrow").remove(),this.opts.markCurrentItem&&this.$root.find("a.current").removeClass("current"),this.subMenus=[],this.init(!0)},rootOut:function(t){if(this.handleEvents()&&!this.isTouchMode()&&t.target!=this.$root[0]&&(this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0),!this.opts.showOnClick||!this.opts.hideOnClick)){var s=this;this.hideTimeout=setTimeout(function(){s.menuHideAll()},this.opts.hideTimeout)}},rootOver:function(t){this.handleEvents()&&!this.isTouchMode()&&t.target!=this.$root[0]&&this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0)},winResize:function(t){if(this.handleEvents())this.isCollapsible()||"onorientationchange"in window&&"orientationchange"!=t.type||(this.activatedItems.length&&this.activatedItems[this.activatedItems.length-1][0].blur(),this.menuHideAll());else if(this.$disableOverlay){var s=this.$root.offset();this.$disableOverlay.css({top:s.top,left:s.left,width:this.$root.outerWidth(),height:this.$root.outerHeight()})}}}}),t.fn.dataSM=function(t,s){return s?this.data(t+"_smartmenus",s):this.data(t+"_smartmenus")},t.fn.removeDataSM=function(t){return this.removeData(t+"_smartmenus")},t.fn.smartmenus=function(s){if("string"==typeof s){var i=arguments,e=s;return Array.prototype.shift.call(i),this.each(function(){var s=t(this).data("smartmenus");s&&s[e]&&s[e].apply(s,i)})}var o=t.extend({},t.fn.smartmenus.defaults,s);return this.each(function(){new t.SmartMenus(this,o)})},t.fn.smartmenus.defaults={isPopup:!1,mainMenuSubOffsetX:0,mainMenuSubOffsetY:0,subMenusSubOffsetX:0,subMenusSubOffsetY:0,subMenusMinWidth:"10em",subMenusMaxWidth:"20em",subIndicators:!0,subIndicatorsPos:"prepend",subIndicatorsText:"+",scrollStep:30,scrollInterval:30,scrollAccelerate:!0,showTimeout:250,hideTimeout:500,showDuration:0,showFunction:null,hideDuration:0,hideFunction:function(t,s){t.fadeOut(200,s)},collapsibleShowDuration:0,collapsibleShowFunction:function(t,s){t.slideDown(200,s)},collapsibleHideDuration:0,collapsibleHideFunction:function(t,s){t.slideUp(200,s)},showOnClick:!1,hideOnClick:!0,keepInViewport:!0,keepHighlighted:!0,markCurrentItem:!1,markCurrentTree:!0,rightToLeftSubMenus:!1,bottomToTopSubMenus:!1,overlapControlsInIE:!0}})(jQuery);

/***/ }),

/***/ 504:
/***/ (function() {

const toggle = document.getElementById( 'cmb-toggle' );
const runner = document.getElementById( 'cmb-i-r' );
const hidable = document.getElementById( 'cmb-hidable' );
const thickness = document.getElementById( 'cmb-thickness' );
const color = document.getElementById( 'cmb-color' );
const padding = document.getElementById( 'cmb-padding' );
const borderPattern = document.getElementById( 'cmb-pattern' );

const infos = {
	'bordered?': false,
	thickness: 5,
	color: '#7a7a7a',
	padding: 10,
	borderPattern: 'none',
};

/* eslint-disable require-jsdoc */
const setThickness = () => infos.thickness = thickness?.value ?? '';
const setColor = () => infos.color = color?.value ?? '';
const setPadding = () => infos.padding = padding?.value ?? '';
const setPattern = () => infos.borderPattern = borderPattern?.value ?? '';
/* eslint-enable */

/**
 * Custom Meta Box: Border maker.
 */
const applyToggle = () => {
	if ( toggle && runner && hidable ) {
		if ( toggle.checked ) {
			hidable.classList.remove( 'cmb-hidable' );
			runner.classList.remove( 'cmb-temp-off' );
			runner.classList.add( 'cmb-temp-on' );
			runner.style.animationName = 'cmb-slider-on';
			infos[ 'bordered?' ] = true;
		} else {
			toggle.removeAttribute( 'checked', '' );
			hidable.classList.add( 'cmb-hidable' );
			runner.classList.remove( 'cmb-temp-on' );
			runner.classList.add( 'cmb-temp-off' );
			runner.style.animationName = 'cmb-slider-off';
			infos[ 'bordered?' ] = false;
		}
	}
};
// eslint-disable-next-line require-jsdoc
const applyBorder = () => borderPattern ? borderPattern.style.border = '4px ' + infos.borderPattern + ' ' + infos.color : null;

setThickness();
setColor();
setPadding();
setPattern();
applyToggle();
applyBorder();

toggle?.addEventListener( 'click', ( event ) => {
	event.stopPropagation();
	applyToggle();
} );

thickness?.addEventListener( 'keyup', ( event ) => {
	event.stopPropagation();
	setThickness();
} );

color?.addEventListener( 'change', ( event ) => {
	event.stopPropagation();
	setColor();
	applyBorder();
} );

padding?.addEventListener( 'keyup', ( event ) => {
	event.stopPropagation();
	setPadding();
} );

borderPattern?.addEventListener( 'change', ( event ) => {
	event.stopPropagation();
	setPattern();
	applyBorder();
} );



/***/ }),

/***/ 90:
/***/ (function(__unused_webpack_module, __unused_webpack_exports, __webpack_require__) {

const jQuery = __webpack_require__( 311 );

( function( ) {
	jQuery( document ).ready( function( $ ) {

		( function() {
			// Fixed Navigation Bar
			// $('#menu-bar').scrollToFixed();

			// Moving Logo from Logo-Bar to Navbar-header on Tab size of 768px or Minimum
			$( window ).on( 'load resize orientationchange', function() {
				if ( 768 > $( window ).width() ) {
					$( '#logo' ).detach().appendTo( $( '.navbar-static-top' ) );
				} else {
					$( '#logo' ).detach().appendTo( '#menu-bar .container .col-sm-3' );
				}

				// Dynamic Header Height Set in Home Page
				$( '.home #header' ).height( $( '#header-top' ).height() + $( '.slider_block' ).height() );

			} );

		}() );

		const abc = $( '.vertical-tab  .nav-tabs' ).width();
		$( '.vertical-tab  .tab-content' ).css( 'margin-left', abc - 1 );

		/*----------------------------------------------------*/
		/*	Sticky Header
         /*----------------------------------------------------*/
		if ( 'function' === typeof jQuery.fn.sticky ) {
			$( window ).load( function() {
				$( '#menu-bar' ).sticky( { topSpacing: 0 } );
			} );
		}
		/*----------------------------------------------------*/
		/*	Same Height Div's
         /*----------------------------------------------------*/
		if ( 'function' === typeof jQuery.fn.matchHeight ) {
			$( '.same-height' ).matchHeight();
		}

		/*--------------------------------------------------
                      Search-Icon
        * ----------------------------------------------------*/
		$( function() {
			$( '.search-label .search-button' ).on( 'click', function( e ) {
				e.preventDefault();
				$( 'html' ).addClass( 'search-exp' );
				$( '.search-input' ).focus();
			} );
			$( '.search-input' ).blur( function() {
				// Do not hide input if contains text
				if ( '' === $( '.search-input' ).val() ) {
					$( 'html' ).removeClass( 'search-exp' );
				}
			} );
		} );

		/*----------------------------------------------------*/
		/*	FlexSlider
         /*----------------------------------------------------*/
		if ( 'function' === typeof jQuery.fn.fractionSlider ) {
			$( '.flexslider.top_slider' ).flexslider( {
				animation: 'fade',
				controlNav: false,
				directionNav: true,
				prevText: '&larr;',
				nextText: '&rarr;',
			} );
		}

		/*----------------------------------------------------*/
		/*	Owl Carousel
         /*----------------------------------------------------*/
		if ( 'function' === typeof jQuery.fn.owlCarousel ) {

			// Recent Work Slider
			$( '#recent-work-slider' ).owlCarousel( {
				navigation: true,
				pagination: false,
				items: 4,
				itemsDesktop: [ 1199, 4 ],
				itemsTablet: [ 768, 3 ],
				itemsDesktopSmall: [ 992, 3 ],
				itemsMobile: [ 480, 1 ],
				navigationText: [ '', '' ],
			} );

			// Post News Slider
			$( '#post-slider' ).owlCarousel( {
				navigation: true,
				pagination: false,
				items: 4,
				itemsDesktop: [ 1199, 3 ],
				itemsDesktopSmall: [ 980, 2 ],
				itemsMobile: [ 479, 1 ],
				navigationText: [ '', '' ],
			} );
		}
		if ( 'function' === typeof jQuery.fn.tooltip ) {
			$( 'body' ).tooltip( {
				selector: '[data-toggle="tooltip"]',
			} );
		}

		//  ============================
		//  = Scroll event function =
		//  ===========================
		/**
		 *
		 * @param {HTMLElement} elem element on which scrolling functionality implemented.
		 * @return {boolean} return if scroll.
		 */
		const goScrolling = function( elem ) {
			const docViewTop = $( window ).scrollTop();
			const docViewBottom = docViewTop + $( window ).height();
			const elemTop = elem.offset().top;
			const elemBottom = elemTop + elem.height();
			return ( ( elemBottom <= docViewBottom ) && ( elemTop >= docViewTop ) );
		};

		//  =======================
		//  = Progress bars =
		//  =======================
		$( '.progress_skill .bar' ).data( 'width', $( this ).width() ).css( {
			width: 0,
			height: 0,
		} );
		$( window ).scroll( function() {
			$( '.progress_skill .bar' ).each( function() {
				if ( goScrolling( $( this ) ) ) {
					$( this ).css( {
						width: $( this ).attr( 'data-value' ) + '%',
						height: $( this ).attr( 'data-height' ) + '%',
					} );
				}
			} );
		} );

		//  ===================
		//  = Flickr Gallery =
		//  ===================
		$( '#flickrFeed' ).jflickrfeed( {
			limit: 9,
			qstrings: {
				//id: '124787947@N07' our id //
				id: '124787947@N07',
			},
			itemTemplate: '<li><a class="mfp-gallery" title="{{title}}" href="{{image_b}}"><i class="fa fa-search"></i><div class="hover"></div></a><img src="{{image_s}}" alt="{{title}}" /></li>',
		} );

		/*===========================================================*/
		/*	Isotope Posrtfolio
         /*===========================================================*/
		if ( 'function' === typeof jQuery.fn.isotope ) {
			jQuery( '.portfolio_list' ).isotope( {
				itemSelector: '.list_item',
				layoutMode: 'fitRows',
				animationEngine: 'jquery',
			} );

			/* ---- Filtering ----- */
			jQuery( '#filter li' ).on( 'click', function() {
				const $this = jQuery( this );
				if ( $this.hasClass( 'selected' ) ) {
					return false;
				} else {
					jQuery( '#filter .selected' ).removeClass( 'selected' );
					const selector = $this.attr( 'data-filter' );
					$this.parent().next().isotope( { filter: selector } );
					$this.addClass( 'selected' );
					return false;
				}
			} );
		}

		/*----------------------------------------------------*/
		/*	Accordians
         /*----------------------------------------------------*/
		$( '.accordion' ).on( 'shown.bs.collapse', function ( e ) {
			$( e.target ).parent().addClass( 'active_acc' );
			$( e.target ).prev().find( '.switch' ).removeClass( 'fa-plus' );
			$( e.target ).prev().find( '.switch' ).addClass( 'fa-minus' );
		} );
		$( '.accordion' ).on( 'hidden.bs.collapse', function ( e ) {
			$( e.target ).parent().removeClass( 'active_acc' );
			$( e.target ).prev().find( '.switch' ).addClass( 'fa-plus' );
			$( e.target ).prev().find( '.switch' ).removeClass( 'fa-minus' );
		} );

		/*----------------------------------------------------*/
		/*	Toggles
         /*----------------------------------------------------*/
		$( '.toggle' ).on( 'shown.bs.collapse', function ( e ) {
			$( e.target ).parent().addClass( 'active_acc' );
			$( e.target ).prev().find( '.switch' ).removeClass( 'fa-plus' );
			$( e.target ).prev().find( '.switch' ).addClass( 'fa-minus' );
		} );
		$( '.toggle' ).on( 'hidden.bs.collapse', function ( e ) {
			$( e.target ).parent().removeClass( 'active_acc' );
			$( e.target ).prev().find( '.switch' ).addClass( 'fa-plus' );
			$( e.target ).prev().find( '.switch' ).removeClass( 'fa-minus' );
		} );

		/* ------------------ End Document ------------------ */
	} );
}( this.jQuery ) );

(
/**
 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch, iPad, and Android mobile phones
 * Common usage: wipe images (left and right to show the previous or next image)
 *
 * @param {Object} $ jQuery instance
 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
 */
	function( $ ) {
		$.fn.touchwipe = function( settings ) {
			/* eslint-disable */
			const config = {
				min_move_x: 20,
				min_move_y: 20,
				wipeLeft: function(){},
				wipeRight: function(){},
				wipeUp: function(){},
				wipeDown: function(){},
				preventDefaultEvents: true,
			};
			/* eslint-enable */
			if ( settings ) {
				$.extend( config, settings );
			}
			this.each( function() {
				let startX;
				let startY;
				let isMoving = false;
				// eslint-disable-next-line require-jsdoc, jsdoc/require-jsdoc
				function cancelTouch() {
					this.removeEventListener( 'touchmove', onTouchMove );
					startX = null;
					isMoving = false;
				}
				// eslint-disable-next-line require-jsdoc, jsdoc/require-jsdoc
				function onTouchMove( e ) {
					if ( config.preventDefaultEvents ) {
						e.preventDefault();
					}
					if ( isMoving ) {
						const x = e.touches[ 0 ].pageX;
						const y = e.touches[ 0 ].pageY;
						const dx = startX - x;
						const dy = startY - y;
						if ( Math.abs( dx ) >= config.min_move_x ) {
							cancelTouch();
							if ( 0 < dx ) {
								config.wipeLeft();
							} else {
								config.wipeRight();
							}
						} else if ( Math.abs( dy ) >= config.min_move_y ) {
							cancelTouch();
							if ( 0 < dy ) {
								config.wipeDown();
							} else {
								config.wipeUp();
							}
						}
					}
				}
				// eslint-disable-next-line require-jsdoc, jsdoc/require-jsdoc
				function onTouchStart( e ) {
					if ( 1 === e.touches.length ) {
						startX = e.touches[ 0 ].pageX;
						startY = e.touches[ 0 ].pageY;
						isMoving = true;
						this.addEventListener( 'touchmove', onTouchMove, false );
					}
				}
				if ( 'ontouchstart' in document.documentElement ) {
					this.addEventListener( 'touchstart', onTouchStart, false );
				}
			} );
			return this;
		};
	}( jQuery )
);


/***/ }),

/***/ 311:
/***/ (function(module) {

"use strict";
module.exports = jQuery;

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";

;// CONCATENATED MODULE: ./src/js/meta-boxes/the-one-bordered-post-posts.js
/**
 * Pulls out the border data and apply it to the element.
 */
function painter () {
	const featureImgs = document.querySelectorAll( 'img.border-it' );
	featureImgs.forEach( ( img ) => {
		let data = img.getAttribute( 'data' );
		data = data.split( '?' );
		img.style.border = data[ 1 ];
		img.style.padding = data[ 2 ];
	} );
}

/* harmony default export */ var the_one_bordered_post_posts = (painter);

;// CONCATENATED MODULE: ./src/js/the-one-add-on.js

(
	function() {
		/**
		 * Set text into the clipboard.
		 *
		 * @param {String}      text    Text to be copied.
		 * @param {HTMLElement} element element which is used for representation at front end as a copy button.
		 */
		function setClipboard ( text, element ) {
			const type = 'text/plain';
			const blob = new Blob( [ text ], { type } );
			const data = [ new ClipboardItem( { [ type ]: blob } ) ];
			const originalBg = element.style.backgroundColor;

			navigator.clipboard.write( data ).then(
				() => {
					if ( null !== originalBg || '' !== originalBg ) {
						element.style.backgroundColor = '#82AF53';
						setTimeout( () => {
							element.style.backgroundColor = originalBg;
						}, 2500 );
					}
					return 'Copied';
				},
				() => {

					if ( null !== originalBg || '' !== originalBg ) {
						element.style.backgroundColor = '#fc1e1e';
						setTimeout( () => {
							element.style.backgroundColor = originalBg;
						}, 2500 );
					}
					return 'Unable to copy';
				}
			);
		}
		the_one_bordered_post_posts();
		const copyElement = document.getElementById( 'copy-it' );
		if ( copyElement ) {
			copyElement.addEventListener( 'click', ( event ) => {
				event.preventDefault();
				const copyString = copyElement.getAttribute( 'copy' );
				setClipboard( copyString, event.target );
			} );
		}
	}()
);

;// CONCATENATED MODULE: ./src/js/the-one-infinite-scroll.js

(
	function infiniteScroll() {
		let safetyLock = false;
		let currentReadingPage = 1;
		document.addEventListener( 'scroll', () => {
			const trigger = document.getElementById( 'load-trigger' );
			// eslint-disable-next-line no-unused-expressions
			checkForTriggerPush( trigger ) && ! safetyLock ? ajaxCaller( trigger ) : '';
			return '';
		} );

		/**
		 * check if user scroll reached to the point where next posts need to loaded or not.
		 *
		 * @param {HTMLElement} trigger is an HTML Element at which this function keeps eye on.
		 * @return {boolean} if given element has reached inside the viewport or not?
		 */
		function checkForTriggerPush( trigger ) {
			if ( trigger ) {
				const location = trigger.getBoundingClientRect();
				const clientHeight = window.innerHeight || document.documentElement.clientHeight;
				return (
					0 <= location.top &&
                    0 <= location.left &&
                    location.bottom <= 1.5 * parseInt( clientHeight ) &&
                    location.right <= ( window.innerWidth || document.documentElement.clientWidth )
				);
			}
			return false;
		}

		/**
		 * Make an AJAX request for next feed
		 *
		 * @param {HTMLElement} trigger is an element which need to be moved from the current end of page to new upcoming end of page.
		 */
		function ajaxCaller( trigger ) {
			safetyLock = true;
			// eslint-disable-next-line no-undef
			const url = siteConfig?.ajax_url ?? '';
			// eslint-disable-next-line no-undef
			const nonce = siteConfig?.ajax_nonce ?? '';

			if ( url && nonce ) {
				const ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function () {
					if ( 4 === this.readyState && 200 === this.status ) {
						trigger.remove();
						safetyLock = false;
						let response = this.response;
						const suspect = JSON.parse( response );
						if ( ! suspect.success ) {
							location.reload();
						} else if ( suspect.hasOwnProperty( 'data' ) && suspect.hasOwnProperty( 'page' ) ) {
							response = suspect.data;
							currentReadingPage = suspect.page;
							const accessPoint = document.getElementById( 'append_here' );
							if ( accessPoint && response ) {
								response = response.split( '</article>' );
								response[ response.length - 2 ] = response[ response.length - 2 ] + response[ response.length - 1 ];
								response.pop();
								response.forEach( ( rawArticle ) => {
									const article = rawArticle.replace( '<article class="post">', '' );
									if ( ! ( '' === article || null === article || 5 > article.length ) ) {
										const articleDiv = document.createElement( 'article' );
										articleDiv.innerHTML = article;
										articleDiv.classList.add( 'post' );
										accessPoint.append( articleDiv );
									}
								} );
								the_one_bordered_post_posts();
							}
							if ( suspect.hasOwnProperty( 'isEnd' ) ) {
								if ( suspect.isEnd ) {
									safetyLock = true;
								}
							}
						}
					}
				};
				ajax.open( 'POST', url, true );
				ajax.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
				ajax.send( 'action=infiscroll&ajax_nonce=' + nonce + '&page=' + currentReadingPage );
			}
		}
	}() );

// EXTERNAL MODULE: ./src/js/bootstrap.min.js
var bootstrap_min = __webpack_require__(932);
// EXTERNAL MODULE: ./src/js/jflickrfeed.js
var jflickrfeed = __webpack_require__(856);
// EXTERNAL MODULE: ./src/js/jquery.cookie.js
var jquery_cookie = __webpack_require__(278);
// EXTERNAL MODULE: ./src/js/jquery.isotope.min.js
var jquery_isotope_min = __webpack_require__(754);
// EXTERNAL MODULE: ./src/js/jquery.smartmenus.min.js
var jquery_smartmenus_min = __webpack_require__(666);
// EXTERNAL MODULE: ./src/js/jquery.smartmenus.bootstrap.min.js
var jquery_smartmenus_bootstrap_min = __webpack_require__(783);
// EXTERNAL MODULE: ./src/js/the-one-main.js
var the_one_main = __webpack_require__(90);
// EXTERNAL MODULE: ./src/js/meta-boxes/the-one-custom-meta-box.js
var the_one_custom_meta_box = __webpack_require__(504);
;// CONCATENATED MODULE: ./src/js/load/generic/index.js











}();
/******/ })()
;
//# sourceMappingURL=the-one-generic.js.map