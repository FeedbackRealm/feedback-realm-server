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
<?php $this->start('pageControls') ?>
<div class="btn-group btn-group-sm mb-2" role="group">
    <?= $this->Html->link('New App', ['action' => 'add'], ['class' => 'btn btn-outline-success']) ?>
</div>
<?php $this->end() ?>
<?php if ($apps->count() === 0) : ?>
    <p class="lead">There are currently no Apps.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('description') ?></th>
            <th scope="col"><?= $this->Paginator->sort('user_id', 'Creator') ?></th>
            <th scope="col"><?= $this->Paginator->sort('team_count', 'Members') ?></th>
            <th scope="col"><?= $this->Paginator->sort('app_user_count', 'Users') ?></th>
            <th scope="col"><?= $this->Paginator->sort('feedback_count', 'Feedbacks') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($apps as $app) : ?>
            <tr>

                <td>
                    <?= h($app->logo) ?>
                    <?= h($app->name) ?>
                </td>
                <td><?= h($app->description) ?></td>
                <td><?= $app->has('user') ? $this->Html->link($app
                        ->user->name, ['controller' =>
                        'Users', 'action' => 'view', $app->user
                        ->id]) : '' ?>
                </td>
                <td><?= $this->Number->format($app->team_count) ?></td>
                <td><?= $this->Number->format($app->app_user_count) ?></td>
                <td><?= $this->Number->format($app->feedback_count) ?></td>
                <td><?= h($app->created) ?></td>
                <td class="actions">
                    <?= $this->element('/layout/table_row_actions', [
                        'entity' => $app,
                        'displayName' => $app->name
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
