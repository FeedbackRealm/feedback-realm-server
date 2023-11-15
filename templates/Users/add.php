<?php
/**
* @var AppView $this
 * @var User $user
            * @var App[]|CollectionInterface $apps
            * @var Notification[]|CollectionInterface $notifications
            * @var Team[]|CollectionInterface $teams
     */

use App\Model\Entity\User;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

    use App\Model\Entity\App;
    use App\Model\Entity\Notification;
    use App\Model\Entity\Team;
    
$this->extend('/layout/common/add');
$this->assign('title', 'User');
$this->assign('subTitle', 'create');
$this->assign('entity', $user)
?>

<div class="users form content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
                echo $this->Form->control('name');
                echo $this->Form->control('email');
                echo $this->Form->control('password');
                echo $this->Form->control('avatar');
                echo $this->Form->control('email_verified');
                echo $this->Form->control('app_count');
                echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add'), [
    'class' => 'btn btn-outline-success btn-lg'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
