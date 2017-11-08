/* global medlabsScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function( $ ) {

	// init vars
	var site, masthead, menuToggle, siteNavContain, siteNavigation, drawerToggle;

	function initMobileNavigation( container ) {
		var parentLink = container.find( '.menu-item-has-children > a, .page_item_has_children > a' );
		// make sure all mobile navigation links with sub-menus activate their sub-menus.
		parentLink.attr( 'href', '#' );

		parentLink.click( function( e ) {
			if ( $( window ).width() < 768 ) {
				e.preventDefault();
			}

			$( this ).closest( '.nav-menu, .sub-menu' ).toggleClass( 'move-out' );
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'sub-menu-active' );
		});

		var goBack = $( '<li />', { 'class': 'go-back menu-item' } )
			.append( $( '<a />', { 'href': '#' } )
				.append( $( '<span />', { 'class': 'screen-reader-text', text: medlabsScreenReaderText.back_sr } ) )
				.append( $( '<span />', { text: medlabsScreenReaderText.back_menu } ) )
		  );
		container.find( '.menu-item-has-children .sub-menu, .page_item_has_children .sub-menu' ).prepend( goBack );

		container.find( '.go-back > a' ).click( function( e ) {
			e.preventDefault();

			$( this ).closest( '.sub-menu-active' ).toggleClass( 'sub-menu-active' );
			$( this ).closest( '.move-out' ).toggleClass( 'move-out' );
		});
	}

	initMobileNavigation( $( '#mobile-navigation' ) );

	site 					 = $( '#page' );
	masthead       = $( '#masthead' );
	menuToggle     = masthead.find( '.menu-toggle' );
	siteNavContain = $( '.site-navigation' );
	siteNavigation = siteNavContain.find( '> ul' );
	drawerToggle	 = $( '.nav-drawer > a' );

	// Enable menuToggle.
	(function() {

		// Return early if menuToggle is missing.
		if ( ! menuToggle.length ) {
			return;
		}

		// Add an initial value for the attribute.
		menuToggle.attr( 'aria-expanded', 'false' );

		menuToggle.on( 'click.medlabs', function( e ) {
			e.preventDefault();

			// close any drawers
			drawerToggle.closest( '.drawer-open' ).removeClass( 'drawer-open' );

			site.add( $( 'body' ) ).toggleClass( 'mobile-navigation-toggled' );
			siteNavContain.add( menuToggle ).toggleClass( 'toggled-on' );

			$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
		});
	})();

	// Scroll to navbar stick
	$( window ).on( 'scroll resize load', function() {
		var scroll = $( window ).scrollTop();
		var header = $( '#masthead .site-branding' ).height();
		var supernav = $( '#supernav' ).is( ':visible' ) ? $( '#supernav' ).outerHeight() : 0;
		var navbar = $( '#masthead .site-navbar' ).height();
		var adminBar = $( '#wpadminbar' ).is( ':visible' ) ? $( '#wpadminbar' ).outerHeight() : 0;

		var stick;

		// below 600px admin bar is position: absolute so we include it in the scroll distance
		if ( $( window ).width() < 600 ) {
			stick = scroll >= header + adminBar + supernav;
		} else {
			stick = scroll >= header + supernav;
		}

		$( 'body' ).toggleClass( 'sticky', stick );
		$( 'body' ).css( 'padding-top', $( 'body' ).hasClass( 'sticky' ) ? navbar+'px' : 0 );
	});

	// Toggle mobile drawers
	drawerToggle.on( 'click.medlabs', function( e ) {
		e.preventDefault();

		// prevents click event from bubbling to document (function below)
		// essentially prevents two click events from firing each time
		e.stopPropagation();

		$( 'body' ).toggleClass( 'drawer-click-handle' );
		$( this ).parents( '.nav-drawer' ).toggleClass( 'drawer-open' );
	});

	$( document ).on( 'click.medlabs', '.drawer-click-handle', function( e ) {
		// if the click target does not reside inside a drawer element
		if ( ! $( e.target ).closest( '.nav-drawer' ).length ) {
			$( 'body' ).removeClass( 'drawer-click-handle' );
			drawerToggle.parents( '.drawer-open' ).removeClass( 'drawer-open' );
		}
	});

	// Desktop search menu
	$( '#supernav .nav-search > a' ).on( 'click', function( e ) {
		e.preventDefault();

		if ( $( this ).hasClass( 'submit' ) && $( '#supernav input[name=s]' ).val() ) {
			$( '#supernav form' ).submit();
			return;
		} else {
			$( 'body' ).toggleClass( 'desktop-search' );
			$( this ).toggleClass( 'submit' );
			setTimeout( function() {
				$( '#supernav input[name=s]' ).focus();
			}, 400);
		}
	});

	// Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
	(function() {
		if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
			return;
		}

		// Toggle `focus` class to allow submenu access on tablets.
		function toggleFocusClassTouchScreen() {
			if ( 'none' === $( '.mobile-navbar' ).css( 'display' ) ) {

				$( document.body ).on( 'touchstart.medlabs', function( e ) {
					if ( ! $( e.target ).closest( '.site-navigation li' ).length ) {
						$( '.site-navigation li' ).removeClass( 'focus' );
					}
				});

				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
					.on( 'touchstart.medlabs', function( e ) {
						var el = $( this ).parent( 'li' );

						if ( ! el.hasClass( 'focus' ) ) {
							e.preventDefault();
							el.toggleClass( 'focus' );
							el.siblings( '.focus' ).removeClass( 'focus' );
						}
					});

			} else {
				siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.medlabs' );
			}
		}

		if ( 'ontouchstart' in window ) {
			$( window ).on( 'resize.medlabs', toggleFocusClassTouchScreen );
			toggleFocusClassTouchScreen();
		}

		siteNavigation.find( 'a' ).on( 'focus.medlabs blur.medlabs', function() {
			$( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
		});
	})();
})( jQuery );

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
( function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
} )();
