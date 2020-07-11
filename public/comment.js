$(function() {
    $('.comment-content').hide();

    $('.comment-span').click(function(e) {
        e.preventDefault();
        if ($(this).html() == 'hide comments') {
            $(this).hide();
            $(this).siblings('.comment-span').show();
            $(this).siblings('.comment-content').slideUp();
        } else {
            $(this).hide();
            $(this).siblings('.comment-span').show();
            $(this).siblings('.comment-content').slideDown();
        }
    });
});