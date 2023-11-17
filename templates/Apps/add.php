<?php
/**
 * @var AppView $this
 * @var App $app
 * @var User[]|CollectionInterface $users
 * @var Customer[]|CollectionInterface $customers
 * @var Feedback[]|CollectionInterface $feedbacks
 * @var Notification[]|CollectionInterface $notifications
 * @var AppMember[]|CollectionInterface $app_members
 */

use App\Model\Entity\App;
use App\Model\Entity\AppMember;
use App\Model\Entity\Customer;
use App\Model\Entity\Feedback;
use App\Model\Entity\Notification;
use App\Model\Entity\User;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/add');
$this->assign('title', 'App');
$this->assign('subTitle', 'create');
$this->assign('entity', $app)
?>

<div class="apps form content">
    <?= $this->Form->create($app) ?>
    <fieldset>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('logo');
        echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Add'), [
        'class' => 'btn btn-outline-success btn-lg',
    ]) ?>
    <?= $this->Form->end() ?>
</div>
