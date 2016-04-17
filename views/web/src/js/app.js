/**
 * Created by pawel on 09/04/16.
 */

//=require ./libs.js

$(document).ready(function () {
    var modalReview = $('#modal-review');

    modalReview.on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var name = button.data('name');
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').html('Add new review for <b>' + name + '</b>');

        modal.find('input[name="id"]').val(id);
        var stars = modal.find(".star-rating.--selectable");
        setRating(stars, 1);

        modal.find('#message-text').val('');
    });

    $(".star-rating.--selectable").each(function () {
        var container = $(this);
        var stars = $(container).find(".glyphicon");

        $(stars).hover(function () {
            toggleStars(this);
        });
        $(container).mouseleave(function () {
            var rating = container.data("rating") - 1;
            toggleStars(stars.get(rating));
        });
        $(stars).click(function () {
            var rating = $(this).index() + 1;
            setRating(container, rating);
        });
    });

    $('form.--validator').validator({
        custom: {
            'maxlength': function ($el) {
                var maxlength = $el.data('maxlength');
                return !$el.val() || $el.val().length <= maxlength;
            },
            'pattern': function ($el) {
                var pattern = $el.data('pattern');
                return !$el.val() || new RegExp(pattern, "g").test($el.val());
            }
        },
        errors: {
            'maxlength': "Too long",
            'pattern': "Invalid password"
        }
    });

    $('#modal-reviews').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var parent = button.closest('.hotel-fragment');

        var name = button.data('name');
        modal.find('.modal-title').html('Reviews for <b>' + name + '</b>');

        var reviews = parent.find('.hotel-reviews').html();

        modal.find('.modal-body').html(reviews);
    });
});

function setRating(container, rating) {
    var element = container.find(".glyphicon").get(rating - 1);

    toggleStars(element);
    container.data("rating", rating);
    var input = container.data("input");
    if (typeof input !== 'undefined') {
        $("input[name='" + input + "']").val(rating);
    }
}

function toggleStars(el) {
    var checked = "glyphicon-star";
    var unchecked = "glyphicon-star-empty";

    $(el).removeClass(unchecked);
    $(el).prevAll().removeClass(checked).removeClass(checked);
    $(el).prevAll().removeClass(unchecked).removeClass(unchecked);

    $(el).addClass(checked);
    $(el).prevAll().addClass(checked);
    $(el).nextAll().addClass(unchecked);
}