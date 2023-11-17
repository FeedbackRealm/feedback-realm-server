<?php
/**
 * @var AppView $this
 * @var Feedback $feedback
 */

use App\Model\Entity\Feedback;
use App\View\AppView;

$this->extend('/layout/common/view');
$this->assign('title', 'Feedback');
$this->assign('subTitle', 'view');
$this->assign('entity', $feedback)
?>


<div class="feedbacks">
    <h4><?= h($feedback->title) ?></h4>
    <div class="table-responsive">
        <table class="table table-striped">
            <tr>
                <th scope="row"><?= __('App') ?></th>
                <td><?= $feedback->has('app') ?
                        $this->Html->link(
                            $feedback->app->name,
                            ['controller' => 'Apps', 'action' => 'view', $feedback
                                ->app->id]
                        ) : '' ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('Customer') ?></th>
                <td><?= $feedback->has('customer') ?
                        $this->Html->link(
                            $feedback->customer->name,
                            ['controller' => 'Customers', 'action' => 'view', $feedback
                                ->customer->id]
                        ) : '' ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?= __('Type') ?></th>
                <td><?= h($feedback->type) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($feedback->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Body') ?></th>
                <td><?= h($feedback->body) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($feedback->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($feedback->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($feedback->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Deleted') ?></th>
                <td><?= h($feedback->deleted) ?></td>
            </tr>
        </table>
    </div>
    <div class="text">
        <h4><?= __('Meta') ?></h4>
        <?= $this->Text->autoParagraph(h($feedback->meta)); ?>
    </div>
</div>
