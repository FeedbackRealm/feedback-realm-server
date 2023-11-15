<?php
/**
* @var AppView $this
 * @var Team $team
            * @var User[]|CollectionInterface $users
            * @var App[]|CollectionInterface $apps
                * @var Notification[]|CollectionInterface $notifications
     */

use App\Model\Entity\Team;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

    use App\Model\Entity\User;
    use App\Model\Entity\App;
        use App\Model\Entity\Notification;
    
$this->extend('/layout/common/add');
$this->assign('title', 'Team');
$this->assign('subTitle', 'create');
$this->assign('entity', $team)
?>

<div class="teams form content">
    <?= $this->Form->create($team) ?>
    <fieldset>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('app_id', ['options' => $apps]);
                echo $this->Form->control('notification_count');
                echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add'), [
    'class' => 'btn btn-outline-success btn-lg'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
