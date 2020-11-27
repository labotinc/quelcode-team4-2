<div class="footer-container">
    <div class="footer-title">QUEL CINEMAS</div>
    <nav class="footer-nav">
        <ul class="footer-nav-list">
            <li class="footer-nav-list-after">
                <?= $this->Html->link(
                    __('トップ'),
                    // トップページに後から修正
                    ['controller' => 'MoviesInfo', 'action' => '#']
                ) ?>
            </li>
            <li class="footer-nav-list-after">
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
