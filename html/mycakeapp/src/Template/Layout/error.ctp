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

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('movies') ?>
    <?= $this->Html->css('normalize') ?>
    <?= $this->Html->css('header') ?>
    <?= $this->Html->css('footer') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <?= $this->element('header') ?>
    </header>
    <main>
        <div id="container">

            <h1><?= __('Error') ?></h1>
            <?php
            // $http_response = $this->response->getStatusCode();
            // if ($http_response === 404) {
            //     echo $http_response . "Not Found";
            // } elseif ($http_response === 500) {
            //     echo $http_response . "An Internal Error Has Occurred";
            // }
            ?>
            <div id="content">
                <?= var_dump($this->fetch('content')) ?>
            </div>

            <?= $this->Html->link(__('Back'), 'javascript:history.back()') ?>
        </div>
    </main>
    <footer>
        <?= $this->element('footer') ?>
    </footer>
</body>

</html>
