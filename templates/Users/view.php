<?php
/**
* @var AppView $this
 * @var User $user
    * @var App[]|CollectionInterface $apps
    * @var Notification[]|CollectionInterface $notifications
    * @var Team[]|CollectionInterface $teams
 */

use App\Model\Entity\User;
use App\Model\Entity\App;
use App\Model\Entity\Notification;
use App\Model\Entity\Team;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/view');
$this->assign('title', 'User');
$this->assign('subTitle', 'view');
$this->assign('entity', $user)
?>


<div class="users">
    <h4><?= h($user->name) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
                                                                        <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($user->name) ?></td>
                        </tr>
                                                                                <tr>
                            <th scope="row"><?= __('Email') ?></th>
                            <td><?= h($user->email) ?></td>
                        </tr>
                                                                                <tr>
                            <th scope="row"><?= __('Avatar') ?></th>
                            <td><?= h($user->avatar) ?></td>
                        </tr>
                                                                                                            <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($user->id) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('App Count') ?></th>
                        <td><?= $this->Number->format($user->app_count) ?></td>
                    </tr>
                                                                            <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($user->created) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($user->modified) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Deleted') ?></th>
                        <td><?= h($user->deleted) ?></td>
                    </tr>
                                                                            <tr>
                        <th scope="row"><?= __('Email Verified') ?></th>
                        <td><?= $user->email_verified ? __('Yes') : __('No'); ?></td>
                    </tr>
                                    </table>
    </div>
                                    <div class="related">
            <h4><?= __('Related Apps') ?></h4>
            <?php if (!empty($user->apps)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                                                    <th scope="col"><?= __('Id') ?></th>
                                                    <th scope="col"><?= __('User Id') ?></th>
                                                    <th scope="col"><?= __('Name') ?></th>
                                                    <th scope="col"><?= __('Logo') ?></th>
                                                    <th scope="col"><?= __('Description') ?></th>
                                                    <th scope="col"><?= __('Auth Token') ?></th>
                                                    <th scope="col"><?= __('Team Count') ?></th>
                                                    <th scope="col"><?= __('App User Count') ?></th>
                                                    <th scope="col"><?= __('Feedback Count') ?></th>
                                                    <th scope="col"><?= __('Created') ?></th>
                                                    <th scope="col"><?= __('Modified') ?></th>
                                                    <th scope="col"><?= __('Deleted') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->apps as $apps): ?>
                    <tr>
                                                    <td><?= h($apps->id) ?></td>
                                                    <td><?= h($apps->user_id) ?></td>
                                                    <td><?= h($apps->name) ?></td>
                                                    <td><?= h($apps->logo) ?></td>
                                                    <td><?= h($apps->description) ?></td>
                                                    <td><?= h($apps->auth_token) ?></td>
                                                    <td><?= h($apps->team_count) ?></td>
                                                    <td><?= h($apps->app_user_count) ?></td>
                                                    <td><?= h($apps->feedback_count) ?></td>
                                                    <td><?= h($apps->created) ?></td>
                                                    <td><?= h($apps->modified) ?></td>
                                                    <td><?= h($apps->deleted) ?></td>
                                                                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Apps', 'action' =>
                            'view', $apps->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Apps', 'action' =>
                            'edit', $apps->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Form->postLink( __('Delete'), ['controller' => 'Apps',
                            'action' => 'delete', $apps->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $apps->id), 'class' => 'btn btn-danger']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>
                            <div class="related">
            <h4><?= __('Related Notifications') ?></h4>
            <?php if (!empty($user->notifications)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                                                    <th scope="col"><?= __('Id') ?></th>
                                                    <th scope="col"><?= __('App Id') ?></th>
                                                    <th scope="col"><?= __('User Id') ?></th>
                                                    <th scope="col"><?= __('Type') ?></th>
                                                    <th scope="col"><?= __('Title') ?></th>
                                                    <th scope="col"><?= __('Body') ?></th>
                                                    <th scope="col"><?= __('Seen') ?></th>
                                                    <th scope="col"><?= __('Created') ?></th>
                                                    <th scope="col"><?= __('Modified') ?></th>
                                                    <th scope="col"><?= __('Deleted') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->notifications as $notifications): ?>
                    <tr>
                                                    <td><?= h($notifications->id) ?></td>
                                                    <td><?= h($notifications->app_id) ?></td>
                                                    <td><?= h($notifications->user_id) ?></td>
                                                    <td><?= h($notifications->type) ?></td>
                                                    <td><?= h($notifications->title) ?></td>
                                                    <td><?= h($notifications->body) ?></td>
                                                    <td><?= h($notifications->seen) ?></td>
                                                    <td><?= h($notifications->created) ?></td>
                                                    <td><?= h($notifications->modified) ?></td>
                                                    <td><?= h($notifications->deleted) ?></td>
                                                                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Notifications', 'action' =>
                            'view', $notifications->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Notifications', 'action' =>
                            'edit', $notifications->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Form->postLink( __('Delete'), ['controller' => 'Notifications',
                            'action' => 'delete', $notifications->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $notifications->id), 'class' => 'btn btn-danger']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>
                            <div class="related">
            <h4><?= __('Related Teams') ?></h4>
            <?php if (!empty($user->teams)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                                                    <th scope="col"><?= __('Id') ?></th>
                                                    <th scope="col"><?= __('User Id') ?></th>
                                                    <th scope="col"><?= __('App Id') ?></th>
                                                    <th scope="col"><?= __('Notification Count') ?></th>
                                                    <th scope="col"><?= __('Created') ?></th>
                                                    <th scope="col"><?= __('Modified') ?></th>
                                                    <th scope="col"><?= __('Deleted') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($user->teams as $teams): ?>
                    <tr>
                                                    <td><?= h($teams->id) ?></td>
                                                    <td><?= h($teams->user_id) ?></td>
                                                    <td><?= h($teams->app_id) ?></td>
                                                    <td><?= h($teams->notification_count) ?></td>
                                                    <td><?= h($teams->created) ?></td>
                                                    <td><?= h($teams->modified) ?></td>
                                                    <td><?= h($teams->deleted) ?></td>
                                                                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Teams', 'action' =>
                            'view', $teams->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Teams', 'action' =>
                            'edit', $teams->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Form->postLink( __('Delete'), ['controller' => 'Teams',
                            'action' => 'delete', $teams->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $teams->id), 'class' => 'btn btn-danger']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
