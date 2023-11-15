<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/layout/common/base');
$this->assign('viewMode', 'edit');
echo $this->fetch('content');
