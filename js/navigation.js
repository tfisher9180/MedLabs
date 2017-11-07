/* global medlabsScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function( $ ) {
	var site, masthead, menuToggle, siteNavContain, siteNavigation;

	function initMobileNavigation( container ) {
		var parentLink = container.find( '.menu-item-has-children > a, .page_item_has_children > a' );
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

	//function initMainNavigation( container ) {

		// Add dropdown toggle that displays child menu items.
		//var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
			//.append( $( '<span />', { 'class': 'screen-reader-text', text: medlabsScreenReaderText.expand }) );
		//container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

		/*container.find( '.dropdown-toggle' ).click( function( e ) {
			var _this = $( this ),
				screenReaderSpan = _this.find( '.screen-reader-text' );

			e.preventDefault();
			_this.toggleClass( 'toggled-on' );
			_this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

			screenReaderSpan.text( screenReaderSpan.text() === medlabsScreenReaderText.expand ? medlabsScreenReaderText.collapse : medlabsScreenReaderText.expand );
		});*/
	//}

	initMobileNavigation( $( '#mobile-navigation' ) );

	site 					 = $( '#page' );
	masthead       = $( '#masthead' );
	menuToggle     = masthead.find( '.menu-toggle' );
	siteNavContain = $( '.site-navigation' );
	siteNavigation = siteNavContain.find( '> ul' );

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
			site.toggleClass( 'mobile-navigation-toggled' );
			siteNavContain.add( menuToggle ).toggleClass( 'toggled-on' );

			$( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
		});
	})();

	// Scroll to navbar stick
	$( window ).on( 'scroll resize load', function() {
		var scroll = $( window ).scrollTop();
		var header = $( '#masthead .site-branding' ).height();
		var navbar = $( '#masthead .site-navbar' ).height();

		$( 'body' ).toggleClass( 'sticky', scroll >= header );
		$( 'body' ).css( 'padding-top', $( 'body' ).hasClass( 'sticky' ) && $( window ).width() > 768 ? navbar+'px' : 0 );
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
