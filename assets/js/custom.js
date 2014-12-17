
window.onload = function() {

    'use strict';

    if (window.CKEDITOR) {
        CKEDITOR.replace( 'description', { 'height' : 300 } );
    }

    function deleteEventConfirmation() {
        return (confirm("Are you sure you want to delete this event?")) ? true : false;
    }

    function unjoinFromEventConfirmation() {
        return (confirm("Are you sure you want to unjoin from this event?")) ? true : false;
    }

};
