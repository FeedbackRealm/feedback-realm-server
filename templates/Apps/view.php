<?php
/**
* @var AppView $this
 * @var App $app
    * @var AppUser[]|CollectionInterface $appUsers
    * @var Feedback[]|CollectionInterface $feedbacks
    * @var Notification[]|CollectionInterface $notifications
    * @var Team[]|CollectionInterface $teams
 */

use App\Model\Entity\App;
use App\Model\Entity\AppUser;
use App\Model\Entity\Feedback;
use App\Model\Entity\Notification;
use App\Model\Entity\Team;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/view');
$this->assign('title', 'App');
$this->assign('subTitle', 'view');
$this->assign('entity', $app)
?>


<div class="apps">
    <h4><?= h($app->name) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
                                                                                                <tr>
                            <th scope="row"><?= __('User') ?></th>
                            <td><?= $app->has('user') ?
                                $this->Html->link($app->user->name
                                , ['controller' => 'Users', 'action' => 'view', $app
                                ->user->id]) : '' ?>
                            </td>
                        </tr>
                                                                                <tr>
                            <th scope="row"><?= __('Name') ?></th>
                            <td><?= h($app->name) ?></td>
                        </tr>
                                                                                <tr>
                            <th scope="row"><?= __('Logo') ?></th>
                            <td><?= h($app->logo) ?></td>
                        </tr>
                                                                                <tr>
                            <th scope="row"><?= __('Description') ?></th>
                            <td><?= h($app->description) ?></td>
                        </tr>
                                                                                <tr>
                            <th scope="row"><?= __('Auth Token') ?></th>
                            <td><?= h($app->auth_token) ?></td>
                        </tr>
                                                                                                            <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($app->id) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Team Count') ?></th>
                        <td><?= $this->Number->format($app->team_count) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('App User Count') ?></th>
                        <td><?= $this->Number->format($app->app_user_count) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Feedback Count') ?></th>
                        <td><?= $this->Number->format($app->feedback_count) ?></td>
                    </tr>
                                                                            <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($app->created) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($app->modified) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Deleted') ?></th>
                        <td><?= h($app->deleted) ?></td>
                    </tr>
                                                </table>
    </div>
                                    <div class="related">
            <h4><?= __('Related App Users') ?></h4>
            <?php if (!empty($app->app_users)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                                                    <th scope="col"><?= __('Id') ?></th>
                                                    <th scope="col"><?= __('App Id') ?></th>
                                                    <th scope="col"><?= __('Identifier') ?></th>
                                                    <th scope="col"><?= __('Name') ?></th>
                                                    <th scope="col"><?= __('Meta') ?></th>
                                                    <th scope="col"><?= __('Created') ?></th>
                                                    <th scope="col"><?= __('Modified') ?></th>
                                                    <th scope="col"><?= __('Deleted') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($app->app_users as $appUsers): ?>
                    <tr>
                                                    <td><?= h($appUsers->id) ?></td>
                                                    <td><?= h($appUsers->app_id) ?></td>
                                                    <td><?= h($appUsers->identifier) ?></td>
                                                    <td><?= h($appUsers->name) ?></td>
                                                    <td><?= h($appUsers->meta) ?></td>
                                                    <td><?= h($appUsers->created) ?></td>
                                                    <td><?= h($appUsers->modified) ?></td>
                                                    <td><?= h($appUsers->deleted) ?></td>
                                                                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'AppUsers', 'action' =>
                            'view', $appUsers->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'AppUsers', 'action' =>
                            'edit', $appUsers->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Form->postLink( __('Delete'), ['controller' => 'AppUsers',
                            'action' => 'delete', $appUsers->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $appUsers->id), 'class' => 'btn btn-danger']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>
                            <div class="related">
            <h4><?= __('Related Feedbacks') ?></h4>
            <?php if (!empty($app->feedbacks)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                                                    <th scope="col"><?= __('Id') ?></th>
                                                    <th scope="col"><?= __('App Id') ?></th>
                                                    <th scope="col"><?= __('App User Id') ?></th>
                                                    <th scope="col"><?= __('Type') ?></th>
                                                    <th scope="col"><?= __('Title') ?></th>
                                                    <th scope="col"><?= __('Body') ?></th>
                                                    <th scope="col"><?= __('Meta') ?></th>
                                                    <th scope="col"><?= __('Created') ?></th>
                                                    <th scope="col"><?= __('Modified') ?></th>
                                                    <th scope="col"><?= __('Deleted') ?></th>
                                                <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($app->feedbacks as $feedbacks): ?>
                    <tr>
                                                    <td><?= h($feedbacks->id) ?></td>
                                                    <td><?= h($feedbacks->app_id) ?></td>
                                                    <td><?= h($feedbacks->app_user_id) ?></td>
                                                    <td><?= h($feedbacks->type) ?></td>
                                                    <td><?= h($feedbacks->title) ?></td>
                                                    <td><?= h($feedbacks->body) ?></td>
                                                    <td><?= h($feedbacks->meta) ?></td>
                                                    <td><?= h($feedbacks->created) ?></td>
                                                    <td><?= h($feedbacks->modified) ?></td>
                                                    <td><?= h($feedbacks->deleted) ?></td>
                                                                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Feedbacks', 'action' =>
                            'view', $feedbacks->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Feedbacks', 'action' =>
                            'edit', $feedbacks->id], ['class' => 'btn btn-secondary']) ?>
                            <?= $this->Form->postLink( __('Delete'), ['controller' => 'Feedbacks',
                            'action' => 'delete', $feedbacks->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $feedbacks->id), 'class' => 'btn btn-danger']) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php endif; ?>
        </div>
                            <div class="related">
            <h4><?= __('Related Notifications') ?></h4>
            <?php if (!empty($app->notifications)): ?>
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
                    <?php foreach ($app->notifications as $notifications): ?>
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
            <?php if (!empty($app->teams)): ?>
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
                    <?php foreach ($app->teams as $teams): ?>
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
