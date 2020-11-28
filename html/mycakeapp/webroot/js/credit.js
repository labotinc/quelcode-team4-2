$(function(){
    //$('main, footer').wrapAll('<div class="modal js-modal">');
    $('footer').after(add_contents);

    $('#delete').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });
});

let add_contents = '<div class="modal js-modal">';
    add_contents += '<div class="modal__bg js-modal-close"></div>';
    add_contents += '<div class="modal__content">';
    add_contents += '<p class="modal__text">本当にこの決済情報を削除しますか？</p>';
    add_contents += '<a class="js-modal-close link-button__middle" href="">戻る</a>';
    add_contents += '<button type="submit" class="link-button__small">削除</button>';
    add_contents += '</div></div>';
