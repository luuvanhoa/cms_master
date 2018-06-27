
CKEDITOR.editorConfig = function( config ) {
	config.language = 'vi';
	config.height	= 730;
  	config.toolbarGroups = [
        { name: 'tools' },
        { name: 'links' },
        { name: 'insert' },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'colors' },
        { name: 'paragraph',   groups: [ 'list', 'blocks', 'align'] },
        { name: 'styles' }
	];
};
