<?php
/**
* @var AppView $this
 * @var App $app
            * @var User[]|CollectionInterface $users
                * @var AppUser[]|CollectionInterface $appUsers
            * @var Feedback[]|CollectionInterface $feedbacks
            * @var Notification[]|CollectionInterface $notifications
            * @var Team[]|CollectionInterface $teams
     */

use App\Model\Entity\App;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

    use App\Model\Entity\User;
        use App\Model\Entity\AppUser;
    use App\Model\Entity\Feedback;
    use App\Model\Entity\Notification;
    use App\Model\Entity\Team;
    
$this->extend('/layout/common/add');
$this->assign('title', 'App');
$this->assign('subTitle', 'create');
$this->assign('entity', $app)
?>

<div class="apps form content">
    <?= $this->Form->create($app) ?>
    <fieldset>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
                echo $this->Form->control('name');
                echo $this->Form->control('logo');
                echo $this->Form->control('description');
                echo $this->Form->control('auth_token');
                echo $this->Form->control('team_count');
                echo $this->Form->control('app_user_count');
                echo $this->Form->control('feedback_count');
                echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add'), [
    'class' => 'btn btn-outline-success btn-lg'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
