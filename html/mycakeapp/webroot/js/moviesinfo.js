
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

        $.ajax({
            type: "GET",
            url: "/MoviesInfo/ajaxMovieSchedules",
            dataType: "json",
            data: {
                time: $(infoMenuDOM).val()
            },
            success: function (data) {
                //取得成功したら実行する処理
                // console.log("ファイルの取得に成功しました");
                // phpから変えてきたのがdata
                if (data.length === 0) {
                    // クリックした日の日付を検索しスケジュールがなかったら
                    $('.movie-list-main').html('値がありません。');
                } else {
                    // スケジュールがあったら
                    var moviescheduleData = data;
                }

                $.ajax({
                    type: "GET",
                    url: "/MoviesInfo/ajaxMovieList",
                    dataType: "json",
                    data: {
                        time: $(infoMenuDOM).val()
                    },
                    success: function (data) {
                        //取得成功したら実行する処理
                        // console.log("ファイルの取得に成功しました");
                        if (data.length === 0) {
                            //クリックした日の日付を検索し、映画がなかったら ==
                            // イベントが発火したらとりあえず、ctpファイルの #movie-main-areaを消す
                            $('#movie-main-area').empty();
                            $('#movie-main-area').append($('<div>').html('Coming Soon...').addClass('not-movie-list'));

                        } else {
                            // 映画があったら ==

                            // イベントが発火したらとりあえず、ctpファイルの #movie-main-areaを消す
                            $('#movie-main-area').empty();
                            for (let i = 0; i < data.length; i++) {

                                const endDate = new Date(data[i].screening_end_date);
                                const m = ("00" + (endDate.getMonth() + 1)).slice(-2);
                                const d = ("00" + endDate.getDate()).slice(-2);
                                const weekday_list = ['日', '月', '火', '水', '木', '金', '土'];
                                const weekday = '(' + weekday_list[endDate.getDay()] + ')';


                                // appendはタグを追加したい時などに使う
                                // ========== 映画のタイトル、上映時間、終了予定、画像を書き込み start ==========
                                $('#movie-main-area').append($('<div>').addClass('movie-list')
                                    .append($('<div>').addClass('movie-list-head')
                                        .append($('<p>').html(data[i].title).addClass('movie-title'))
                                        .append($('<p>').html('[ 上映時間 : ' + data[i].total_minutes_with_trailer + '分 ]').addClass('movie-screening-time'))
                                        .append($('<p>').html(m + "月" + d + "日" + weekday + '終了予定').addClass('movie-scheduled-to-end')))
                                    .append($('<div>').addClass('movie-list-main')
                                        .append($('<p>').addClass('movie-img')
                                            // 画像パスは今のところ適当に入れているので許容
                                            .append($('<img>').attr('src', '/img/' + data[i].thumbnail_path).attr('alt', '')))));
                                // ========== 映画のタイトル、上映時間、終了予定、画像を書き込み end ==========



                                for (let j = 0; j < moviescheduleData.length; j++) {
                                    // ========= 始まり時刻 start =========
                                    var date = new Date(moviescheduleData[j].screening_start_datetime);
                                    var startHours = date.getHours();
                                    var startMinutes = date.getMinutes();
                                    if (startMinutes < 10) {
                                        startMinutes = '0' + startMinutes;
                                    }
                                    if (startHours < 10) {
                                        startHours = '0' + startHours;
                                    }
                                    // ========= 始まり時刻 end =========
                                    // ========= 終了時刻 start =========
                                    var finishDateTime = date.setMinutes(date.getMinutes() + data[i].total_minutes_with_trailer);
                                    var finishDate = new Date(finishDateTime);
                                    var finishHours = finishDate.getHours();
                                    var finishMinutes = finishDate.getMinutes();
                                    if (finishHours < 10) {
                                        finishHours = '0' + finishHours;
                                    }
                                    if (finishMinutes < 10) {
                                        finishMinutes = '0' + finishMinutes;
                                    }
                                    // ========= 終了時刻 end =========

                                    // 何時から何時まで映画があるかの部分を代入 ↓ (予約購入ボタンの上の時刻)
                                    const movieTime = startHours + ':' + startMinutes + '~' + finishHours + ':' + finishMinutes;


                                    // 予約購入ボタン周辺の書き込みstart
                                    if (data[i].id === moviescheduleData[j].movie_id) {
                                        // eq(i)で映画のリストを選んでいる。例えば$('.movie-list-main').eq(i)の$eq(i)が0だったら一番上に表示されている映画に書き込み
                                        $('.movie-list-main').eq(i).append($('<div>').addClass('movie-schedule-for-the-day')
                                            .append($('<p>').html(movieTime).addClass('movie-time'))
                                            .append($('<p>').addClass('buy-button').append($('<a>').attr('href', 'bookings/add_seat/' + moviescheduleData[j]['id']).html('予約購入'))));
                                    }
                                    // 予約購入ボタン周辺の書き込みend
                                }
                                // その映画のスケジュールがなかった場合の書き込み
                                if ($('.movie-list-main')[i].childNodes.length <= 1) {
                                    $('.movie-list-main').eq(i).wrap('<p />').append($('<p>').html('Coming Soon...').addClass('not-movie-schedule-for-the-day'));
                                }
                            }
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
