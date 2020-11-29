$(function(){
    //$('main, footer').wrapAll('<div class="modal js-modal">');
    $('footer').after(add_contents);

    $('#delete_send').on('click',function(){
        $('.js-modal').fadeIn();
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    });

    $('#delete_submit').on('click', function() {
        $("form")[0].submit();
        return false;
    });
    
});

let add_contents = '<div class="modal js-modal">';
    add_contents += '<div class="modal__bg js-modal-close"></div>';
    add_contents += '<div class="modal__content">';
    add_contents += '<p class="modal__text">本当にこの決済情報を削除しますか？</p>';
    add_contents += '<a class="js-modal-close link-button__middle" href="">戻る</a>';
    add_contents += '<button class="link-button__small" id="delete_submit">削除</button>';
    add_contents += '</div></div>';
