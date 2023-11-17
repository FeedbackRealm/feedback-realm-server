<?php
/**
 * @var AppView $this
 * @var App $app
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
                        $this->Html->link(
                            $app->user->name,
                            ['controller' => 'Users', 'action' => 'view', $app
                                ->user->id]
                        ) : '' ?>
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
                <th scope="row"><?= __('AppMember Count') ?></th>
                <td><?= $this->Number->format($app->app_member_count) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Customer Count') ?></th>
                <td><?= $this->Number->format($app->customer_count) ?></td>
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
        <h4><?= __('Related Customers') ?></h4>
        <?php if (!empty($app->customers)) : ?>
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
                    <?php foreach ($app->customers as $customers) : ?>
                        <tr>
                            <td><?= h($customers->id) ?></td>
                            <td><?= h($customers->app_id) ?></td>
                            <td><?= h($customers->identifier) ?></td>
                            <td><?= h($customers->name) ?></td>
                            <td><?= h($customers->meta) ?></td>
                            <td><?= h($customers->created) ?></td>
                            <td><?= h($customers->modified) ?></td>
                            <td><?= h($customers->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Customers', 'action' =>
                                    'view', $customers->id], ['class' => 'btn btn-secondary']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Customers', 'action' =>
                                    'edit', $customers->id], ['class' => 'btn btn-secondary']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Customers',
                                    'action' => 'delete', $customers->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $customers->id), 'class' => 'btn btn-danger']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Feedbacks') ?></h4>
        <?php if (!empty($app->feedbacks)) : ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('App Id') ?></th>
                        <th scope="col"><?= __('Customer Id') ?></th>
                        <th scope="col"><?= __('Type') ?></th>
                        <th scope="col"><?= __('Title') ?></th>
                        <th scope="col"><?= __('Body') ?></th>
                        <th scope="col"><?= __('Meta') ?></th>
                        <th scope="col"><?= __('Created') ?></th>
                        <th scope="col"><?= __('Modified') ?></th>
                        <th scope="col"><?= __('Deleted') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($app->feedbacks as $feedbacks) : ?>
                        <tr>
                            <td><?= h($feedbacks->id) ?></td>
                            <td><?= h($feedbacks->app_id) ?></td>
                            <td><?= h($feedbacks->customer_id) ?></td>
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
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Feedbacks',
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
        <?php if (!empty($app->notifications)) : ?>
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
                    <?php foreach ($app->notifications as $notifications) : ?>
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
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Notifications',
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
        <h4><?= __('Related AppMembers') ?></h4>
        <?php if (!empty($app->app_members)) : ?>
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
                    <?php foreach ($app->app_members as $app_members) : ?>
                        <tr>
                            <td><?= h($app_members->id) ?></td>
                            <td><?= h($app_members->user_id) ?></td>
                            <td><?= h($app_members->app_id) ?></td>
                            <td><?= h($app_members->notification_count) ?></td>
                            <td><?= h($app_members->created) ?></td>
                            <td><?= h($app_members->modified) ?></td>
                            <td><?= h($app_members->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'AppMembers', 'action' =>
                                    'view', $app_members->id], ['class' => 'btn btn-secondary']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'AppMembers', 'action' =>
                                    'edit', $app_members->id], ['class' => 'btn btn-secondary']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'AppMembers',
                                    'action' => 'delete', $app_members->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $app_members->id), 'class' => 'btn btn-danger']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
