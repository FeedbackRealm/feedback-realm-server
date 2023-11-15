<?php
/**
* @var AppView $this
 * @var Feedback[]|CollectionInterface $feedbacks
 */

use App\Model\Entity\Feedback;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'Feedbacks')
?>
<?php if($feedbacks->count() === 0):?>
<p class="lead">There are currently no Feedbacks.</p>
<?php else :?>
<table class="table table-striped">
    <thead>
    <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('app_user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('body') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('meta') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($feedbacks as $feedback) : ?>
    <tr>
                                                                                                                                                                                                    <td><?= $this->Number->format($feedback->id) ?></td>
                                                                                                                                                <td><?= $feedback->has('app') ? $this->Html->link($feedback
                            ->app->name, ['controller' =>
                            'Apps', 'action' => 'view', $feedback->app
                            ->id]) : '' ?>
                        </td>
                                                                                                                                                                                                                                                        <td><?= $feedback->has('app_user') ? $this->Html->link($feedback
                            ->app_user->name, ['controller' =>
                            'AppUsers', 'action' => 'view', $feedback->app_user
                            ->id]) : '' ?>
                        </td>
                                                                                                                                                                                                                                                                <td><?= h($feedback->type) ?></td>
                                                                                                                                                                                                                                <td><?= h($feedback->title) ?></td>
                                                                                                                                                                                                                                <td><?= h($feedback->body) ?></td>
                                                                                                                                                                                                                                <td><?= h($feedback->meta) ?></td>
                                                                                                                                                                                                                                <td><?= h($feedback->created) ?></td>
                                                                                                                                                                                                                                <td><?= h($feedback->modified) ?></td>
                                                                                                                                                                                                                                <td><?= h($feedback->deleted) ?></td>
                                            <td class="actions">
            <?=$this->element('/layout/table_row_actions', ['entity' => $feedback])?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>