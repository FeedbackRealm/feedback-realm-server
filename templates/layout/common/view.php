<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/layout/common/base');
$this->assign('viewMode', 'view');
echo $this->fetch('content');
