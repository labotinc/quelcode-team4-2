$(function(){
  /**
   * モーダルウィンドウの作成１
   * credit_info.ctpを描画する時のみfooterタグの下にモーダル用の<div class="modal js-modal">を用意
   * @var modalContents は一番下に記載
   */
  $('footer').after(modalContents);

  /**
   * モーダルウィンドウの作成２
   * 削除ボタンクリック時、モーダルを表示させ背景を固定する（逆も然り）
   * 参考 => https://imasashi.net/modal-window_bg-fixed.html
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

let modalContents = '<div class="modal js-modal">';
  modalContents += '<div class="modal__bg js-modal-close"></div>';
  modalContents += '<div class="modal__content">';
  modalContents += '<p class="modal__text">本当にこの予約をキャンセルしますか？</p>';
  modalContents += '<a class="js-modal-close link-button__middle" href="">戻る</a>';
  modalContents += '<button class="link-button__small" id="delete_submit" name="delete_submit">予約キャンセル</button>';
