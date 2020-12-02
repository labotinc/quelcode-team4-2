<div class="footer-container">
    <div class="footer-title">QUEL CINEMAS</div>
    <nav class="footer-nav">
        <ul class="footer-nav-list">
            <li class="footer-nav-list-after">
                <?= $this->Html->link(
                    __('トップ'),
                    '#' // 仮リンク、リンク作成後は削除
                    // 完成版はトップページの連想配列を作成
                    // ['movie' => 'home']
                ) ?>
            </li>
            <li class="footer-nav-list-after">
                <?= $this->Html->link(
                    __('上映スケジュール'),
                    '#'
                    // 上映スケジュール（予約開始画面）の連想配列
                    // ['movie_schedule' => 'home']
                ) ?>
            </li>
            <li>
                <?= $this->Html->link(
                    __('料金・割引'),
                    '#'
                    // 料金表の連想配列
                    //['price' => 'home']
                ) ?>
            </li>
        </ul>
    </nav>
</div>
