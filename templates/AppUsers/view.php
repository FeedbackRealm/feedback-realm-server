<?php
/**
 * @var AppView $this
 * @var AppUser $appUser
 * @var Feedback[]|CollectionInterface $feedbacks
 */

use App\Model\Entity\AppUser;
use App\Model\Entity\Feedback;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/view');
$this->assign('title', 'App User');
$this->assign('subTitle', 'view');
$this->assign('entity', $appUser)
?>


<div class="appUsers">
    <h4><?= h($appUser->name) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('App') ?></th>
                <td><?= $appUser->has('app') ?
                        $this->Html->link(
                            $appUser->app->name,
                            ['controller' => 'Apps', 'action' => 'view', $appUser
                                ->app->id]
                        ) : '' ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('Identifier') ?></th>
                <td><?= h($appUser->identifier) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Name') ?></th>
                <td><?= h($appUser->name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($appUser->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($appUser->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($appUser->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Deleted') ?></th>
                <td><?= h($appUser->deleted) ?></td>
            </tr>
        </table>
    </div>
    <div class="text">
        <h4><?= __('Meta') ?></h4>
        <?= $this->Text->autoParagraph(h($appUser->meta)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Feedbacks') ?></h4>
        <?php if (!empty($appUser->feedbacks)) : ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th scope="col"><?= __('Id') ?></th>
                        <th scope="col"><?= __('App Id') ?></th>
                        <th scope="col"><?= __('App User Id') ?></th>
                        <th scope="col"><?= __('Type') ?></th>
                        <th scope="col"><?= __('Title') ?></th>
                        <th scope="col"><?= __('Body') ?></th>
                        <th scope="col"><?= __('Meta') ?></th>
                        <th scope="col"><?= __('Created') ?></th>
                        <th scope="col"><?= __('Modified') ?></th>
                        <th scope="col"><?= __('Deleted') ?></th>
                        <th scope="col" class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($appUser->feedbacks as $feedbacks) : ?>
                        <tr>
                            <td><?= h($feedbacks->id) ?></td>
                            <td><?= h($feedbacks->app_id) ?></td>
                            <td><?= h($feedbacks->app_user_id) ?></td>
                            <td><?= h($feedbacks->type) ?></td>
                            <td><?= h($feedbacks->title) ?></td>
                            <td><?= h($feedbacks->body) ?></td>
                            <td><?= h($feedbacks->meta) ?></td>
                            <td><?= h($feedbacks->created) ?></td>
                            <td><?= h($feedbacks->modified) ?></td>
                            <td><?= h($feedbacks->deleted) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Feedbacks', 'action' =>
                                    'view', $feedbacks->id], ['class' => 'btn btn-secondary']) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Feedbacks', 'action' =>
                                    'edit', $feedbacks->id], ['class' => 'btn btn-secondary']) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Feedbacks',
                                    'action' => 'delete', $feedbacks->id], ['confirm' => __('Are you sure you want to delete
                            # {0}?', $feedbacks->id), 'class' => 'btn btn-danger']) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
