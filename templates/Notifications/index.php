<?php
/**
 * @var AppView $this
 * @var Notification[]|CollectionInterface $notifications
 */

use App\Model\Entity\Notification;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'Notifications')
?>
<?php if ($notifications->count() === 0) : ?>
    <p class="lead">There are currently no Notifications.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type') ?></th>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('body') ?></th>
            <th scope="col"><?= $this->Paginator->sort('seen') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($notifications as $notification) : ?>
            <tr>
                <td><?= $this->Number->format($notification->id) ?></td>
                <td><?= $notification->has('app') ? $this->Html->link($notification
                        ->app->name, ['controller' =>
                        'Apps', 'action' => 'view', $notification->app
                        ->id]) : '' ?>
                </td>
                <td><?= $notification->has('user') ? $this->Html->link($notification
                        ->user->name, ['controller' =>
                        'Users', 'action' => 'view', $notification->user
                        ->id]) : '' ?>
                </td>
                <td><?= h($notification->type) ?></td>
                <td><?= h($notification->title) ?></td>
                <td><?= h($notification->body) ?></td>
                <td><?= h($notification->seen) ?></td>
                <td><?= h($notification->created) ?></td>
                <td><?= h($notification->modified) ?></td>
                <td><?= h($notification->deleted) ?></td>
                <td class="actions">
                    <?= $this->element('/layout/table_row_actions', ['entity' => $notification]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
