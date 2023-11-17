<?php
/**
 * @var AppView $this
 * @var Customer $customer
 * @var App[]|CollectionInterface $apps
 * @var Feedback[]|CollectionInterface $feedbacks
 */

use App\Model\Entity\App;
use App\Model\Entity\Customer;
use App\Model\Entity\Feedback;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

$this->extend('/layout/common/edit');
$this->assign('title', 'Customer');
$this->assign('subTitle', 'edit');
$this->assign('entity', $customer)
?>

<div class="customers form content">
    <?= $this->Form->create($customer) ?>
    <fieldset>
        <?php
        echo $this->Form->control('app_name', [
            'value' => $customer->app->name,
            'label' => 'App',
            'disabled' => true,
            'readonly' => true,
        ]);
        echo $this->Form->control('identifier', [
            'disabled' => true,
            'readonly' => true,
        ]);
        echo $this->Form->control('name');
        echo $this->Form->control('meta');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Edit'), [
        'class' => 'btn btn-outline-success btn-lg',
    ]) ?>
    <?= $this->Form->end() ?>
</div>
