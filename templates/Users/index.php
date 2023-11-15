<?php
/**
* @var AppView $this
 * @var User[]|CollectionInterface $users
 */

use App\Model\Entity\User;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/index');

$this->assign('title', 'Users')
?>
<?php if($users->count() === 0):?>
<p class="lead">There are currently no Users.</p>
<?php else :?>
<table class="table table-striped">
    <thead>
    <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('avatar') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email_verified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('app_count') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
    <tr>
                                                                                                <td><?= $this->Number->format($user->id) ?></td>
                                                                                                                            <td><?= h($user->name) ?></td>
                                                                                                                            <td><?= h($user->email) ?></td>
                                                                                                                            <td><?= h($user->avatar) ?></td>
                                                                                                                            <td><?= h($user->email_verified) ?></td>
                                                                                                                            <td><?= $this->Number->format($user->app_count) ?></td>
                                                                                                                            <td><?= h($user->created) ?></td>
                                                                                                                            <td><?= h($user->modified) ?></td>
                                                                                                                            <td><?= h($user->deleted) ?></td>
                                            <td class="actions">
            <?=$this->element('/layout/table_row_actions', ['entity' => $user])?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>