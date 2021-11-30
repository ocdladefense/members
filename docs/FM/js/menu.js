	$( document ).ready( function( ) {
		$('.pageSection > ul > li > ul').wrap('<div class="tree"></div>');
	

				
				$( '.tree li' ).each( function() {
						if( $( this ).children( 'ul' ).length > 0 ) {
								$( this ).addClass( 'parent' );     
						}
				});
				
				$( '.tree li.parent > a' ).each( function() {
					$link = $( this ).clone();
					$(this).next().prepend($link.wrap('<li></li>'));
				});
				
				/** click events here **/
				
				$( '.tree li.parent > a' ).click( function() {
						$( this ).parent().toggleClass( 'active' );
						$( this ).parent().children( 'ul' ).slideToggle( 'fast' );
						return false;
				});
				
				$( '#all' ).click( function() {
					
					$( '.tree li' ).each( function() {
						$( this ).toggleClass( 'active' );
						$( this ).children( 'ul' ).slideToggle( 'fast' );
					});
				});
				
				$( '.tree li' ).each( function() {
						$( this ).toggleClass( 'active' );
						$( this ).children( 'ul' ).slideToggle( 'fast' );
				});
				
		});
        