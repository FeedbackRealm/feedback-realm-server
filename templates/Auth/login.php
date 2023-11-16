<?php
/**
 * @var AppView $this
 */

use App\View\AppView;

$this->extend('/layout/common/index');
$this->assign('title', 'Log In')
?>
<div class="users form">
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('email', ['required' => true]) ?>
        <?= $this->Form->control('password', ['required' => true]) ?>
    </fieldset>
    <?= $this->Form->button(__('Log In'), [
        'class' => 'btn btn-outline-success btn-lg',
    ]) ?>
    <?= $this->Form->end() ?>
</div>
