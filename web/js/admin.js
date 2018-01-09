$(document).ready(function () {

    var links = $('.sidebar-links > div');

    links.on('click', function () {

        links.removeClass('selected');
        $(this).addClass('selected');

    });
    CKEDITOR.editorConfig = function( config ) {
        config.language = 'fr';
        config.uiColor = '#AADC6E';
        config.copyFormatting_allowedContexts = true;
    };
    

    $('#tableClients').dynatable();
    $('#tableCommandes').dynatable();
   
    

});
