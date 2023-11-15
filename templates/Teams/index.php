<?php
/**
* @var AppView $this
 * @var Team[]|CollectionInterface $teams
 */

use App\Model\Entity\Team;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'Teams')
?>
<?php if($teams->count() === 0):?>
<p class="lead">There are currently no Teams.</p>
<?php else :?>
<table class="table table-striped">
    <thead>
    <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('notification_count') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($teams as $team) : ?>
    <tr>
                                                                                                                                                                                                    <td><?= $this->Number->format($team->id) ?></td>
                                                                                                                                                <td><?= $team->has('user') ? $this->Html->link($team
                            ->user->name, ['controller' =>
                            'Users', 'action' => 'view', $team->user
                            ->id]) : '' ?>
                        </td>
                                                                                                                                                                                                                                                        <td><?= $team->has('app') ? $this->Html->link($team
                            ->app->name, ['controller' =>
                            'Apps', 'action' => 'view', $team->app
                            ->id]) : '' ?>
                        </td>
                                                                                                                                                                                                                                                                <td><?= $this->Number->format($team->notification_count) ?></td>
                                                                                                                                                                                                                                <td><?= h($team->created) ?></td>
                                                                                                                                                                                                                                <td><?= h($team->modified) ?></td>
                                                                                                                                                                                                                                <td><?= h($team->deleted) ?></td>
                                            <td class="actions">
            <?=$this->element('/layout/table_row_actions', ['entity' => $team])?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>