<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('movies') ?>
    <?= $this->Html->css('normalize') ?>
    <?= $this->Html->css('header') ?>
    <?= $this->Html->css('footer') ?>
    <?= $this->Html->css('error') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <?= $this->element('header') ?>
    </header>
    <main>
        <div class="error-container">
            <h1><?= __('Error') ?></h1>
            <div class="http-status">
                <?= $this->response->getStatusCode() . $this->fetch('content'); ?>
            </div>

            <?= $this->Html->link(__('戻る'), 'javascript:history.back()', ['class' => 'error-page-back']) ?>
        </div>
    </main>
    <footer>
        <?= $this->element('footer') ?>
    </footer>
</body>

</html>
