$(function(){
    $('footer').after(add_contents);

    /**
     * モーダルウィンドウの作成
     * 削除ボタンクリック時、モーダルを表示させ背景を固定する（逆も然り）
     */
    let scrollPosition;
    $('#delete_send').on('click',function(){
        $('.js-modal').fadeIn();
        scrollPosition = $(window).scrollTop();
        $('body').addClass('fixed').css({'top': -scrollPosition});
        return false;
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        $('body').removeClass('fixed').css({'top': 0});
		window.scrollTo( 0 , scrollPosition );
        return false;
    });

    /**
     * モーダルの削除ボタン押下時フォームを送信する
     */
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
