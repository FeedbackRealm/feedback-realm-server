<?php
/**
 * @var AppView $this
 * @var AppUser[]|CollectionInterface $appUsers
 * @var bool $showAppNames
 */

use App\Model\Entity\AppUser;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'App Users')
?>
<?php if ($appUsers->count() === 0) : ?>
    <p class="lead">There are currently no App Users.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <?php if ($showAppNames) : ?>
                <th scope="col"><?= $this->Paginator->sort('app_id') ?></th>
            <?php endif ?>
            <th scope="col"><?= $this->Paginator->sort('identifier') ?></th>
            <th scope="col"><?= $this->Paginator->sort('name') ?></th>
            <th scope="col"><?= $this->Paginator->sort('meta') ?></th>
            <th scope="col"><?= $this->Paginator->sort('feedback_count', 'FeedBacks') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($appUsers as $appUser) : ?>
            <tr>
                <?php if ($showAppNames) : ?>
                    <td><?= $appUser->app ? h($appUser->app->name) : $appUser->app_id ?></td>
                <?php endif ?>
                <td><?= h($appUser->identifier) ?></td>
                <td><?= h($appUser->name) ?></td>
                <td><?= h($appUser->meta) ?></td>
                <td><?= $this->Number->format($appUser->feedback_count) ?></td>
                <td><?= h($appUser->created) ?></td>
                <td class="actions">
                    <?= $this->element('/layout/table_row_actions', [
                        'entity' => $appUser,
                        'displayName' => 'App User',
                        'actions' => ['view', 'edit'],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
