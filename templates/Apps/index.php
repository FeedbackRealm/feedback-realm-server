<?php
/**
 * @var AppView $this
 * @var App[]|CollectionInterface $apps
 */

use App\Model\Entity\App;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');
$this->assign('title', 'Apps');
?>
<?php $this->start('pageControls')?>
<div class="btn-group btn-group-sm mb-2" role="group">
    <?=$this->Html->link('New App', ['action' => 'add'], ['class'=>'btn btn-outline-success'])?>
</div>
<?php $this->end()?>
<?php if ($apps->count() === 0) : ?>
    <p class="lead">There are currently no Apps.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('logo') ?></th>
            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
            <th scope="col"><?= $this->Paginator->sort('auth_token') ?></th>
            <th scope="col"><?= $this->Paginator->sort('team_count') ?></th>
            <th scope="col"><?= $this->Paginator->sort('app_user_count') ?></th>
            <th scope="col"><?= $this->Paginator->sort('feedback_count') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($apps as $app) : ?>
            <tr>
                <td><?= $this->Number->format($app->id) ?></td>
                <td><?= $app->has('user') ? $this->Html->link($app
                        ->user->name, ['controller' =>
                        'Users', 'action' => 'view', $app->user
                        ->id]) : '' ?>
                </td>
                <td><?= h($app->name) ?></td>
                <td><?= h($app->logo) ?></td>
                <td><?= h($app->description) ?></td>
                <td><?= h($app->auth_token) ?></td>
                <td><?= $this->Number->format($app->team_count) ?></td>
                <td><?= $this->Number->format($app->app_user_count) ?></td>
                <td><?= $this->Number->format($app->feedback_count) ?></td>
                <td><?= h($app->created) ?></td>
                <td><?= h($app->modified) ?></td>
                <td><?= h($app->deleted) ?></td>
                <td class="actions">
                    <?= $this->element('/layout/table_row_actions', ['entity' => $app]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
