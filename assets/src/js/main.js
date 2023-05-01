const jQuery = require( 'jquery' );

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
