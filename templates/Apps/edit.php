<?php
/**
 * @var AppView $this
 * @var App $app
 */

use App\Model\Entity\App;
use App\View\AppView;

$this->extend('/layout/common/edit');
$this->assign('title', 'App');
$this->assign('subTitle', 'edit');
$this->assign('entity', $app)
?>

<div class="apps form content">
    <?= $this->Form->create($app) ?>
    <fieldset>
        <?php
        echo $this->Form->control('name');
        echo $this->Form->control('logo');
        echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Edit'), [
        'class' => 'btn btn-outline-success btn-lg',
    ]) ?>
    <?= $this->Form->end() ?>
</div>
