
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
                // // phpから変えてきたのがresponse
                if (data.length === 0) {
                    // スケジュールがなかったら
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
                        // phpから変えてきたのがresponse
                        if (data.length === 0) {
                            // スケジュールがなかったら
                            console.log('値がありません。');
                            $('#movie-main-area').empty();
                            $('#movie-main-area').append($('<div>').html('Coming Soon...').addClass('not-movie-list'));

                        } else {
                            // スケジュールがあったら
                            $('#movie-main-area').empty();
                            for (let i = 0; i < data.length; i++) {

                                const endDate = new Date(data[i].screening_end_date);
                                const m = ("00" + (endDate.getMonth() + 1)).slice(-2);
                                const d = ("00" + endDate.getDate()).slice(-2);
                                const weekday_list = ['日', '月', '火', '水', '木', '金', '土'];
                                const weekday = '(' + weekday_list[endDate.getDay()] + ')';

                                $('#movie-main-area').append($('<div>').addClass('movie-list')
                                    .append($('<div>').addClass('movie-list-head')
                                        .append($('<p>').html(data[i].title).addClass('movie-title'))
                                        .append($('<p>').html('[ 上映時間 : ' + data[i].total_minutes_with_trailer + '分 ]').addClass('movie-screening-time'))
                                        .append($('<p>').html(m + "月" + d + "日" + weekday + '終了予定').addClass('movie-scheduled-to-end')))
                                    .append($('<div>').addClass('movie-list-main')
                                        .append($('<p>').addClass('movie-img')
                                            // data[i].thumbnail_path写真だけど今のところ許容
                                            .append($('<img>').attr('src', '/img/' + data[i].thumbnail_path).attr('alt', '')))));


                                for (let j = 0; j < moviescheduleData.length; j++) {
                                    // ========= 始まり時刻 =========
                                    var date = new Date(moviescheduleData[j].screening_start_datetime);
                                    var startHours = date.getHours();
                                    var startMinutes = date.getMinutes();
                                    if (startMinutes < 10) {
                                        startMinutes = '0' + startMinutes;
                                    }
                                    if (startHours < 10) {
                                        startHours = '0' + startHours;
                                    }
                                    // ========= 終了時刻 =========
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
                                    const movieTime = startHours + ':' + startMinutes + '~' + finishHours + ':' + finishMinutes;
                                    console.log(movieTime);
                                    if (data[i].id === moviescheduleData[j].movie_id) {
                                        $('.movie-list-main').eq(i).append($('<div>').addClass('movie-schedule-for-the-day')
                                            .append($('<p>').html(movieTime).addClass('movie-time'))
                                            .append($('<form>', { action: "bookings/add_seat/" + moviescheduleData[j]['id'], method: '' }).append($('<p>').addClass('buy-button').append($('<button>').html('予約購入')))));
                                    }
                                }
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
