/**
 * @license Modifica e usa come vuoi
 *
 * Creato da TurboLab.it - 01/01/2014 (buon anno!)
 */
CKEDITOR.plugins.add( 'youtubebootstrap', {
    icons: 'youtubebootstrap',
    init: function( editor ) {
        editor.addCommand( 'youtubebootstrapDialog', new CKEDITOR.dialogCommand( 'youtubebootstrapDialog' ) );
        editor.ui.addButton( 'youtubebootstrap', {
            label: 'Insert youtube',
            command: 'youtubebootstrapDialog',
            toolbar: 'paragraph'
        });

        CKEDITOR.dialog.add( 'youtubebootstrapDialog', this.path + 'dialogs/youtubebootstrap.js' );
    }
});