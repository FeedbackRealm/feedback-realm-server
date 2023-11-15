<?php
/**
* @var AppView $this
 * @var Feedback $feedback
            * @var App[]|CollectionInterface $apps
            * @var AppUser[]|CollectionInterface $appUsers
     */

use App\Model\Entity\Feedback;
use App\View\AppView;
use Cake\Collection\CollectionInterface;

    use App\Model\Entity\App;
    use App\Model\Entity\AppUser;
    
$this->extend('/layout/common/edit');
$this->assign('title', 'Feedback');
$this->assign('subTitle', 'edit');
$this->assign('entity', $feedback)
?>

<div class="feedbacks form content">
    <?= $this->Form->create($feedback) ?>
    <fieldset>
        <?php
            echo $this->Form->control('app_id', ['options' => $apps]);
            echo $this->Form->control('app_user_id', ['options' => $appUsers]);
                echo $this->Form->control('type');
                echo $this->Form->control('title');
                echo $this->Form->control('body');
                echo $this->Form->control('meta');
                echo $this->Form->control('deleted', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Edit'), [
    'class' => 'btn btn-outline-success btn-lg'
    ]) ?>
    <?= $this->Form->end() ?>
</div>
