<?php
/**
* @var AppView $this
 * @var Notification $notification
            * @var App[]|CollectionInterface $apps
            * @var User[]|CollectionInterface $users
            * @var Team[]|CollectionInterface $teams
     */

use App\Model\Entity\Notification;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

    use App\Model\Entity\App;
    use App\Model\Entity\User;
    use App\Model\Entity\Team;
    
$this->extend('/layout/common/edit');
$this->assign('title', 'Notification');
$this->assign('subTitle', 'edit');
$this->assign('entity', $notification)
?>

<div class="notifications form content">
    <?= $this->Form->create($notification) ?>
    <fieldset>
        <?php
            echo $this->Form->control('app_id', ['options' => $apps]);
            echo $this->Form->control('user_id', ['options' => $users]);
                echo $this->Form->control('type');
                echo $this->Form->control('title');
                echo $this->Form->control('body');
                echo $this->Form->control('seen', ['empty' => true]);
                echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Edit'), [
    'class' => 'btn btn-outline-success btn-lg'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
