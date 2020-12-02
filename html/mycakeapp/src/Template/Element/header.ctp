<div class="header-container">
    <div class="header-container">
        <div class="header-title"><span id="header-text-quel">QUEL</span>CINEMAS</div>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <!-- 仮リンク、リンク作成後は削除// 完成版はトップページの連想配列を作成// ['movie' => 'home'] -->
                <li><?= $this->Html->link(__('トップ'), '#') ?></li>
                <!-- 上映スケジュール（予約開始画面）の連想配列// ['movie_schedule' => 'home'] -->
                <li><?= $this->Html->link(__('上映スケジュール'), '#') ?></li>
                <!-- 料金表の連想配列//['price' => 'home'] -->
                <li><?= $this->Html->link(__('料金・割引'), '#') ?></li>
            </ul>
        </nav>
    </div>
    <div class="login-btn">
        <a href="">ログイン</a>
    </div>
</div>
