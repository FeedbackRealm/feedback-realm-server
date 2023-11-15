<?php
/**
* @var AppView $this
 * @var Team $team
    * @var Notification[]|CollectionInterface $notifications
 */

use App\Model\Entity\Team;
use App\Model\Entity\Notification;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/view');
$this->assign('title', 'Team');
$this->assign('subTitle', 'view');
$this->assign('entity', $team)
?>


<div class="teams">
    <h4><?= h($team->display_value) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
                                                                                                <tr>
                            <th scope="row"><?= __('User') ?></th>
                            <td><?= $team->has('user') ?
                                $this->Html->link($team->user->name
                                , ['controller' => 'Users', 'action' => 'view', $team
                                ->user->id]) : '' ?>
                            </td>
                        </tr>
                                                                                                        <tr>
                            <th scope="row"><?= __('App') ?></th>
                            <td><?= $team->has('app') ?
                                $this->Html->link($team->app->name
                                , ['controller' => 'Apps', 'action' => 'view', $team
                                ->app->id]) : '' ?>
                            </td>
                        </tr>
                                                                                                            <tr>
                        <th scope="row"><?= __('Id') ?></th>
                        <td><?= $this->Number->format($team->id) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Notification Count') ?></th>
                        <td><?= $this->Number->format($team->notification_count) ?></td>
                    </tr>
                                                                            <tr>
                        <th scope="row"><?= __('Created') ?></th>
                        <td><?= h($team->created) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Modified') ?></th>
                        <td><?= h($team->modified) ?></td>
                    </tr>
                                    <tr>
                        <th scope="row"><?= __('Deleted') ?></th>
                        <td><?= h($team->deleted) ?></td>
                    </tr>
                                                </table>
    </div>
                                    <div class="related">
            <h4><?= __('Related Notifications') ?></h4>
            <?php if (!empty($team->notifications)): ?>
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
                    <?php foreach ($team->notifications as $notifications): ?>
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
    </div>
