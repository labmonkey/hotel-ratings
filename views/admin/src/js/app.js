/**
 * Created by pawel on 09/04/16.
 */

//=require ./libs.js

$(document).ready(function () {
    var modalReview = $('#modal-review-form');

    modalReview.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var name = button.data('hotel');
        var id = button.data('id');
        var text = button.data('message');
        var rating = button.data('rating');

        var modal = $(this);
        modal.find('.modal-title').html('Moderate review for <b>' + name + '</b>');

        modal.find('input[name="id"]').val(id);
        var stars = modal.find(".star-rating");
        setRating(stars, rating);

        modal.find('#message-text').val(text);
    });
});