<?php
/**
 * @var AppView $this
 * @var Customer[]|CollectionInterface $customers
 * @var bool $showAppNames
 */

use App\Model\Entity\Customer;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'Customers')
?>
<?php if ($customers->count() === 0) : ?>
    <p class="lead">There are currently no Customers.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <?php if ($showAppNames) : ?>
                <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
            <?php endif ?>
            <th scope="col"><?= $this->Paginator->sort('identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('feedback_count', 'FeedBacks') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($customers as $customer) : ?>
            <tr>
                <?php if ($showAppNames) : ?>
                    <td>
                        <?= $customer->app
                            ? $this->Html->link($customer->app->name, [
                                'controller' => 'Apps',
                                'action' => 'view',
                                $customer->app_id,
                            ])
                            : $customer->app_id ?>
                    </td>
                <?php endif ?>
                <td><?= h($customer->identifier) ?></td>
                <td><?= h($customer->name) ?></td>
                <td><?= $this->Number->format((int)$customer->feedback_count) ?></td>
                <td><?= h($customer->created) ?></td>
                <td class="actions">
                    <?= $this->element('/layout/table_row_actions', [
                        'entity' => $customer,
                        'displayName' => 'Customer',
                        'actions' => ['view', 'edit'],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
