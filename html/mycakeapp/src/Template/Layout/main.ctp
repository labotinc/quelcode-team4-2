<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->fetch('meta') ?>
    <?= $this->Html->css('movies') ?>
    <?= $this->Html->css('normalize') ?>
    <?= $this->Html->css('header') ?>
    <?= $this->Html->css('footer') ?>
    <?= $this->Html->script('jquery.min'); ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <header>
        <?= $this->element('header') ?>
    </header>
    <main>
        <div class="main-contents">
            <?= $this->fetch('content') ?>
        </div>
    </main>
    <footer>
        <?= $this->element('footer') ?>
    </footer>
</body>

</html>
