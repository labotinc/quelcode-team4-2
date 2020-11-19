
// 参考サイト　https://www.mdn.co.jp/di/contents/4047/54019/

// .ctpファイルのliタグについてるclass info-menuを取得
const infoMenu = document.getElementsByClassName('info-menu');
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
            url: "/MoviesInfo/ajaxTest",
            dataType: "json",
            data: {
                time: $(infoMenuDOM).val()
            },
            success: function (data) {
                //取得成功したら実行する処理
                console.log("ファイルの取得に成功しました");
                if (data.length === 0) {
                    // スケジュールがなかったら
                    console.log('値がありません。');
                } else {
                    // スケジュールがあったら
                    console.log(data[0].movie.title);
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
