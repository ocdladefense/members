/**
 ** @file - Functions to display a CKEditor instance; 
 ** 	also includes functions to save the data from an editor instance
 ** @date - 2013-03-28
 ** @author - José Bernal
 ** @see the CKEDITOR API at: http://docs.ckeditor.com/#!/api/CKEDITOR
 ** @see the jQuery post() API at: http://api.jquery.com/jQuery.post/
**/

var ed;
var html_markup = '';


		// This code is generally not necessary, but it is here to demonstrate
		// how to customize specific editor instances on the fly. This fits well
		// this demo because we have editable elements (like headers) that
		// require less features.

		// The "instanceCreated" event is fired for every editor instance created.
	CKEDITOR.on( 'instanceCreated', function( event ) {
			var editor = event.editor,
				element = editor.element;

			// Customize editors for headers and tag list.
			// These editors don't need features like smileys, templates, iframes etc.
			if ( element.is( 'h1', 'h2', 'h3' ) || element.getAttribute( 'id' ) == 'taglist' ) {
				// Customize the editor configurations on "configLoaded" event,
				// which is fired after the configuration file loading and
				// execution. This makes it possible to change the
				// configurations before the editor initialization takes place.
				editor.on( 'configLoaded', function() {

					// Remove unnecessary plugins to make the editor simpler.
					editor.config.removePlugins = 'colorbutton,find,flash,font,' +
						'forms,iframe,image,newpage,removeformat,' +
						'smiley,specialchar,stylescombo,templates';

					// Rearrange the layout of the toolbar.
					editor.config.toolbarGroups = [
						{ name: 'editing',		groups: [ 'basicstyles', 'links' ] },
						{ name: 'undo' },
						{ name: 'clipboard',	groups: [ 'selection', 'clipboard' ] },
						{ name: 'about' }
					];
				});
			}
		});

var something = "hello";


function getInstances() {
	return CKEDITOR.instances;
}
function getEditorContents( ed ) {
	return CKEDITOR.instances[ed].getData();
}
function createEditor( elem_id ) {
	// if ( ed ) return;
	// Create a new editor inside the <div id="editor">, setting its value to html
	config = {};
	// ed = CKEDITOR.replace( 'editor', config );
	elem = document.getElementById('editor');
	ed = CKEDITOR.inline( 'editor' );
	alert(ed.getData());
}

function removeEditor() {
	if ( !ed )
		return;

	// Retrieve the editor contents. In an Ajax application, this data would be
	// sent to the server or used in any other way.
	document.getElementById( 'editorcontents' ).innerHTML = html = ed.getData();
	document.getElementById( 'contents' ).style.display = '';

	// Destroy the editor.
	ed.destroy();
	ed = null;
}

// More information on jQuery post() can be found at
// http://api.jquery.com/jQuery.post/
function saveData( ed ) {
	title = CKEDITOR.instances["title-1"];
	body = CKEDITOR.instances["body-1"];
	var d = { 'title':title.getData(),'author':'Jose Bernal','body':body.getData() }
	$posting = $.ajax({
	type: "POST",
	dataType: "json",
	url: "index.php?q=node/1/save",
	data: d
	}).done(function(obj){ 
		$status = $('#status');
		$status.html(obj['message']);
		$status.addClass('success');
		$status.fadeIn().delay(2000);
		$status.fadeOut();
		
		//alert(obj['message']);
	});
	
}