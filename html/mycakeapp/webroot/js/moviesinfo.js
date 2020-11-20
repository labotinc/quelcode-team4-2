
// 参考サイト　https://www.mdn.co.jp/di/contents/4047/54019/

// .ctpファイルのliタグについてるclass info-menuを取得
const infoMenu = document.getElementsByClassName('info-menu');
const movieTitle = document.getElementsByClassName('movie-title');
const scheduledDate = document.getElementById('scheduled-date');

if (infoMenu.classList === undefined) {
    infoMenu[0].classList.add('info-menu-active')
}
// 各日付をイベントリスナーに登録
for (var i = 0; i < infoMenu.length; i++) {
    infoMenuAction(infoMenu[i], i);
    // infoMenu[i]には7日分の日付が配列で格納されている。第２引数のiは配列番号。
}

function infoMenuAction(infoMenuDOM, infoMenuId) {
    infoMenuDOM.addEventListener("click", function () {
        // thisは、クリックされたオブジェクト
        // クリックされた日付と配列番号を呼び出してinfo-menu-activeクラスの追加と削除
        this.classList.add('info-menu-active');
        scheduledDate.innerHTML = (this.innerHTML);

        // クリックされていないボタンにinfo-menu-activeがついていたら外す
        for (var i = 0; i < infoMenu.length; i++) {
            if (infoMenuId !== i) {
                // classList.containsでクラスが含まれているか確認
                if (infoMenu[i].classList.contains('info-menu-active')) {
                    infoMenu[i].classList.remove('info-menu-active');
                }
            }
        }
        // console.log($(infoMenuDOM).val());
        $.ajax({
            type: "GET",
            url: "/MoviesInfo/ajaxTest",
            dataType: "json",

            data: {
                time: $(infoMenuDOM).val()
            },
            success: function (data) {
                //取得成功したら実行する処理
                console.log("ファイルの取得に成功しました");
                // phpから変えてきたのがresponse
                if (data.length === 0) {
                    // スケジュールがなかったら
                    console.log('値がありません。');
                    $('#test').empty();
                } else {
                    // スケジュールがあったら
                    $('#test').empty();
                    // console.log(data);
                    for (let i = 0; i < data.length; i++) {

                        const endDate = new Date(data[i].screening_end_date);
                        const m = ("00" + (endDate.getMonth() + 1)).slice(-2);
                        const d = ("00" + endDate.getDate()).slice(-2);
                        const weekday_list = ['日', '月', '火', '水', '木', '金', '土'];
                        const weekday = '(' + weekday_list[endDate.getDay()] + ')';

                        // console.log(data[i].thumbnail_path);
                        $('#test').append($('<div>').addClass('movie-list')
                            .append($('<div>').addClass('movie-list-head')
                                .append($('<p>').html(data[i].title).addClass('movie-title'))
                                .append($('<p>').html('[上映時間:' + data[i].total_minutes_with_trailer + '分]').addClass('movie-screening-time'))
                                .append($('<p>').html(m + "月" + d + "日" + weekday + '終了予定').addClass('movie-scheduled-to-end')))
                            .append($('<div>').addClass('movie-list-main')
                                .append($('<p>').addClass('movie-img')
                                    // data[i].thumbnail_path写真だけど今のところ許容
                                    .append($('<img>').attr('src', '').attr('alt', '')))));
                    }

                    // 予約の時間
                    // for (let i = 0; i < data.length; i++) {
                    //     $('.movie-list-main').append($('<div>').addClass('movie-schedule-for-the-day')
                    //         .append($('<p>').html('00:00~00:00').addClass('movie-time'))
                    //         .append($('<p>').html('予約購入').addClass('buy-button')));
                    // }

                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                //取得失敗時に実行する処理
                console.log("何らかの理由で失敗しました");
                console.log("XMLHttpRequest : " + XMLHttpRequest.status);
                console.log("textStatus     : " + textStatus);
                console.log("errorThrown    : " + errorThrown.message);
            }
        });
    })
}
