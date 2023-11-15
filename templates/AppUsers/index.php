<?php
/**
* @var AppView $this
 * @var AppUser[]|CollectionInterface $appUsers
 */

use App\Model\Entity\AppUser;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'App Users')
?>
<?php if($appUsers->count() === 0):?>
<p class="lead">There are currently no App Users.</p>
<?php else :?>
<table class="table table-striped">
    <thead>
    <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('identifier') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('meta') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($appUsers as $appUser) : ?>
    <tr>
                                                                                                                                                                <td><?= $this->Number->format($appUser->id) ?></td>
                                                                                                                                                <td><?= $appUser->has('app') ? $this->Html->link($appUser
                            ->app->name, ['controller' =>
                            'Apps', 'action' => 'view', $appUser->app
                            ->id]) : '' ?>
                        </td>
                                                                                                                                                                                                                            <td><?= h($appUser->identifier) ?></td>
                                                                                                                                                                                            <td><?= h($appUser->name) ?></td>
                                                                                                                                                                                            <td><?= h($appUser->meta) ?></td>
                                                                                                                                                                                            <td><?= h($appUser->created) ?></td>
                                                                                                                                                                                            <td><?= h($appUser->modified) ?></td>
                                                                                                                                                                                            <td><?= h($appUser->deleted) ?></td>
                                            <td class="actions">
            <?=$this->element('/layout/table_row_actions', ['entity' => $appUser])?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>