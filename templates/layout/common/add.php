<?php
/**
 * @var App\View\AppView $this
 */
$this->extend('/layout/common/base');
$this->assign('viewMode', 'create');
echo $this->fetch('content');
