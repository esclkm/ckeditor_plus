/*
 * Default CKEditor preset and connector
 */

var ckeditorClasses = Array();
ckeditorClasses['editor'] = 'Full'; // Full editor
ckeditorClasses['medieditor'] = 'Medium'; // Medium editor
ckeditorClasses['minieditor'] = 'Basic'; // Mini editor

function ckeditorReplace() {
    var textareas = document.getElementsByTagName('textarea');
    for (var i = 0; i < textareas.length; i++) {
        var classStr = textareas[i].getAttribute('class');
        if (classStr) {
            var classes = classStr.split(" ");
            for (var k = 0; k < classes.length; k++) {
                textareaClass = classes[k];
                if (ckeditorClasses[textareaClass] !== undefined) {
                    var textareasStyle = getComputedStyle(textareas[i], null) || textareas[i].currentStyle;
                    CKEDITOR.replace(textareas[i], {height:textareasStyle.height, width:'100%', toolbar: ckeditorClasses[textareaClass]});
                }
            }
        }
    }
}

$(function(){
    var css_array = [];
    $( "head link[type='text/css']" ).each(function( index ) {
       css_array.push($( this ).attr('href'));
    });
    css_array.push('plugins/ckeditor_plus/presets/body.css');
    if(css_array.length > 0)
    {
        CKEDITOR.config.contentsCss = css_array;
        console.log(css_array);
    }
});
//CKEDITOR.config.contentsCss="themes/klimova/css/klimova.css";
if (typeof jQuery == 'undefined') {
	if (window.addEventListener) {
		window.addEventListener('load', ckeditorReplace, false);
	} else if (window.attachEvent) {
		window.attachEvent('onload', ckeditorReplace);
	} else {
		window.onload = ckeditorReplace;
	}
} else {
	$(document).ready(ckeditorReplace);
	ajaxSuccessHandlers.push(ckeditorReplace);
} 
