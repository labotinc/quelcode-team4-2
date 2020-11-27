<div class="header-container">
    <div class="header-container">
        <div class="header-title"><span id="header-text-quel">QUEL</span>CINEMAS</div>
        <nav class="header-nav">
            <ul class="header-nav-list">
                <!-- 仮リンク、リンク作成後は削除// 完成版はトップページの連想配列を作成// ['movie' => 'home'] -->
                <li>
                    <?= $this->Html->link(
                        __('トップ'),
                        // トップページに後から修正
                        ['controller' => 'MoviesInfo', 'action' => '#']
                    ) ?>
                </li>
                <li>
                    <?= $this->Html->link(
                        __('上映スケジュール'),
                        ['controller' => 'MoviesInfo', 'action' => 'schedule']
                    ) ?>
                </li>
                <li>
                    <?= $this->Html->link(
                        __('料金・割引'),
                        ['controller' => 'MoviesInfo', 'action' => 'pricelist']
                    ) ?>
                </li>
            </ul>
        </nav>
    </div>
    <div class="login-btn">
        <!-- ログイン状態を判別するために認証状態のセッションを確認
        参照:https://level-up-notebook.com/php/2216/ -->
        <?php if ($this->request->getSession()->read('Auth.User.id')) : ?>
            <?= $this->Html->link(
                __('ログアウト'),
                ['controller' => 'Users', 'action' => 'logout']
            ) ?>
        <?php else : ?>
            <?= $this->Html->link(
                __('ログイン'),
                ['controller' => 'Users', 'action' => 'login']
            ) ?>
        <?php endif; ?>
    </div>
</div>
