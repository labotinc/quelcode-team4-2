let modal_cancel=()=>{
  /**
   * モーダルウィンドウの作成１
   * credit_info.ctpを描画する時のみfooterタグの下にモーダル用の<div class="modal js-modal">を用意
   * @var modalContentsMain は一番下に記載
   */
  $('footer').after(modalContentsMain);
  $('footer').after(modalContentsTemporary);

  /**
   * モーダルウィンドウの作成２
   * 削除ボタンクリック時、モーダルを表示させ背景を固定する（逆も然り）
   * 参考 => https://imasashi.net/modal-window_bg-fixed.html
   */
  let scrollPosition;
  $('#cancel-send-main').on('click',()=>{
    $('.js-modal-main').fadeIn();
    scrollPosition = $(window).scrollTop();
    $('body').addClass('fixed').css({'top': -scrollPosition});
    return false;
});
$('.js-modal-close-main').on('click',()=>{
    $('.js-modal-main').fadeOut();
    $('body').removeClass('fixed').css({'top': 0});
window.scrollTo( 0 , scrollPosition );
    return false;
});

/**
 * モーダルの削除ボタン押下時フォームを送信する
 */
$('#cancel-submit-main').on('click', () =>{
    $("form")[0].submit();
    return false;
});
$('#cancel-send-temporary').on('click',()=>{
    $('.js-modal-temporary').fadeIn();
    scrollPosition = $(window).scrollTop();
    $('body').addClass('fixed').css({'top': -scrollPosition});
    return false;
});
$('.js-modal-close-temporary').on('click',()=>{
    $('.js-modal-temporary').fadeOut();
    $('body').removeClass('fixed').css({'top': 0});
window.scrollTo( 0 , scrollPosition );
    return false;
});

/**
 * モーダルの削除ボタン押下時フォームを送信する
 */
$('#cancel-submit-temporary').on('click', () =>{
    $("form")[0].submit();
    return false;
});

};

let modalContentsMain = '<div class="modal js-modal-main">';
  modalContentsMain += '<div class="modal__bg js-modal-close-main"></div>';
  modalContentsMain += '<div class="modal__content">';
  modalContentsMain += '<p class="modal__text">本当にこの予約をキャンセルしますか？</p>';
  modalContentsMain += '<button class="js-modal-close-main link-button__middle" href="">戻る</button>';
  modalContentsMain += '<button class="link-button__small" id="cancel-submit-main" name="cancel-submit-main">予約キャンセル</button>';
  modalContentsMain += '</div></div>';

  let modalContentsTemporary = '<div class="modal js-modal-temporary">';
  modalContentsTemporary += '<div class="modal__bg js-modal-close-temporary"></div>';
  modalContentsTemporary += '<div class="modal__content">';
  modalContentsTemporary += '<p class="modal__text">本当にこの予約をキャンセルしますか？</p>';
  modalContentsTemporary += '<button class="js-modal-close-temporary link-button__middle" href="">戻る</button>';
  modalContentsTemporary += '<button class="link-button__small" id="cancel-submit-temporary" name="cancel-submit-temporary">予約キャンセル</button>';
  modalContentsTemporary += '</div></div>';

document.addEventListener('DOMContentLoaded',modal_cancel);
