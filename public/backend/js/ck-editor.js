
    ClassicEditor
    .create( document.querySelector( '#event_description' ), {
      removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption', 'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed', 'Table' ,'BlockQuote' ,'List', 'Link' ],
    }) 
		.then( editor => {
			window.editor1 = editor;
		} )
		.catch( error => {
			console.log( error );
		} );

