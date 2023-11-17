<?php
/**
 * @var AppView $this
 * @var Feedback[]|CollectionInterface $feedbacks
 * @var bool $showAppNames
 */

use App\Model\Entity\Feedback;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'Feedbacks')
?>
<?php if ($feedbacks->count() === 0) : ?>
    <p class="lead">There are currently no Feedbacks.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <?php if ($showAppNames) : ?>
                <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
            <?php endif; ?>
            <th scope="col"><?= $this->Paginator->sort('customer_id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('type') ?></th>
            <th scope="col"><?= $this->Paginator->sort('title') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($feedbacks as $feedback) : ?>
            <tr>
                <?php if ($showAppNames) : ?>
                    <td>
                        <?= $feedback->has('app')
                            ? $this->Html->link($feedback->app->name, [
                                'controller' => 'Apps',
                                'action' => 'view', $feedback->app->id,
                            ]) : '' ?>
                    </td>
                <?php endif; ?>
                <td><?= $feedback->has('customer') ? $this->Html->link($feedback
                        ->customer->name, ['controller' =>
                        'Customers', 'action' => 'view', $feedback->customer
                        ->id]) : '' ?>
                </td>
                <td><?= h($feedback->type) ?></td>
                <td><?= h($feedback->title) ?></td>
                <td><?= h($feedback->created) ?></td>
                <td class="actions">
                    <?= $this->element('/layout/table_row_actions', [
                        'entity' => $feedback,
                        'displayName' => 'Feedback',
                        'actions' => ['view'],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
