/**
 * Created by pawel on 09/04/16.
 */

//=require ./libs.js

$(document).ready(function(){
    $('#review-hotel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var modal = $(this);
        modal.find('.modal-title').text('Add new review for ' + name);
    })
    $('#review-hotel').on('hidden.bs.modal', function (event) {
        $(document).focus();
    })

});