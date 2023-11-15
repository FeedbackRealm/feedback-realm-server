<?php
/**
 * @var AppView $this
 * @var User $user
 */

use App\Model\Entity\User;
use App\View\AppView;

$this->extend('/layout/common/index');
$this->assign('title', 'Register');
?>
<div class="users form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('email');
        echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Register'), [
        'class' => 'btn btn-outline-success btn-lg',
    ]) ?>
    <?= $this->Form->end() ?>
</div>
