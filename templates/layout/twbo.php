<?php
/**
 * @var AppView $this
 */

use App\View\AppView;
use Cake\Core\Configure;

$titlePrefix = 'FeedbackRealm: ';

$cssAssets = [
    '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
    '//cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.min.css',
    'styles.css',
];
$scriptAssets = [
    '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.js',
];
if (Configure::read('debug')) {
    $cssAssets = [
        '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.css',
        '//cdn.jsdelivr.net/npm/@mdi/font@7.3.67/css/materialdesignicons.css',
        'styles.css',
    ];
    $scriptAssets = [
        '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
    ];
}
$this->prepend('css', $this->Html->css($cssAssets));
$this->prepend('script', $this->Html->script($scriptAssets));
?>
<!DOCTYPE html>
<?= sprintf('<html lang="%s">', Configure::read('App.language')) ?>
<head>
    <?= $this->Html->charset() ?>

    <title>
        <?= $titlePrefix . $this->fetch('title') ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <?= $this->Html->meta('icon') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
    <?= $this->element('layout/navbar') ?>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
</main>
<?= $this->element('layout/footer') ?>
<?= $this->fetch('script') ?>
</body>
</html>
