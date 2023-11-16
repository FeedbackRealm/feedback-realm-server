<?php
/**
 * @var AppView $this
 * @var EntityInterface $entity
 * @var ?string $controller
 * @var ?string $displayName
 */

use App\View\AppView;
use Cake\Datasource\EntityInterface;

$controller = $controller ?? $this->getRequest()->getParam('controller');
$displayName = $displayName ?? $entity->id;
$entityName = (new ReflectionClass($entity))->getShortName();

?>
<div class="btn-group btn-group-sm" role="group">
    <?= $this->Html->link(
        __('View'),
        ['controller' => $controller, 'action' => 'view', $entity->id],
        ['title' => __('View'), 'class' => 'btn btn-outline-info']
    ) ?>
    <?= $this->Html->link(
        __('Edit'),
        ['controller' => $controller, 'action' => 'edit', $entity->id],
        ['title' => __('Edit'), 'class' => 'btn btn-outline-info']
    ) ?>
    <?= $this->Form->postLink(
        __('Delete'),
        ['controller' => $controller, 'action' => 'delete', $entity->id],
        [
            'confirm' => __(
                'Are you sure you want to delete {0} "{1}"?',
                h($entityName),
                h($displayName)
            ),
            'title' => __('Delete'), 'class' => 'btn btn-outline-danger',
        ]
    ) ?>
</div>

