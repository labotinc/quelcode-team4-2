function click_cb(){
	//チェックカウント用変数
	let check_count = 0;
	// 箇所チェック数カウント
	$(".movie-seats-line th").each(function(){
		const parent_checkbox = $(this).children("input[type='checkbox']");
		if(parent_checkbox.prop('checked')){
			check_count = check_count+1;
		}
	});
	// 0個のとき（チェックがすべて外れたとき）
	// 3個以上の時（チェック可能上限数）
	if(check_count > 0){
		$(".movie-seats-line th").each( function() {
			// チェックされていないチェックボックスをロックする
			if(!$(this).children("input[type='checkbox']").prop('checked')){
				$(this).children("input[type='checkbox']").prop('disabled',true);
				$(this).addClass("locked");
			}
		});
	}else{
		$(".movie-seats-line th").each( function() {
			// チェックされていないチェックボックスを選択可能にする
			if(!$(this).children("input[type='checkbox']").prop('checked')){
				$(this).children("input[type='checkbox']").removeAttr('disabled');
				$(this).removeClass("locked");
			}
		});
  }
  console.log(check_count);
	return false;
}
