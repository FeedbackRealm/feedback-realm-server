<?php
/**
 * @var AppView $this
 * @var Notification $notification
 */

use App\Model\Entity\Notification;
use App\View\AppView;

$this->extend('/layout/common/view');
$this->assign('title', 'Notification');
$this->assign('subTitle', 'view');
$this->assign('entity', $notification)
?>


<div class="notifications">
    <h4><?= h($notification->title) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('App') ?></th>
                <td><?= $notification->has('app') ?
                        $this->Html->link(
                            $notification->app->name,
                            ['controller' => 'Apps', 'action' => 'view', $notification
                                ->app->id]
                        ) : '' ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $notification->has('user') ?
                        $this->Html->link(
                            $notification->user->name,
                            ['controller' => 'Users', 'action' => 'view', $notification
                                ->user->id]
                        ) : '' ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('Type') ?></th>
                <td><?= h($notification->type) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($notification->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Body') ?></th>
                <td><?= h($notification->body) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($notification->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Seen') ?></th>
                <td><?= h($notification->seen) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($notification->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($notification->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Deleted') ?></th>
                <td><?= h($notification->deleted) ?></td>
            </tr>
        </table>
    </div>
</div>
