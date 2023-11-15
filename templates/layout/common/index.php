<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/layout/common/base');
$this->assign('viewMode', 'list');
?>

<div class="row">
    <?= $this->element('/layout/pagination') ?>
    <?= $this->fetch('content') ?>
    <?= $this->element('/layout/pagination') ?>
</div>
