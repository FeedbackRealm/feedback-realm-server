<?php
/**
 * @var AppView $this
 * @var EntityInterface $entity
 * @var ?string $controller
 * @var ?string $displayName
 * @var ?string[] $actions
 */

use App\View\AppView;
use Cake\Datasource\EntityInterface;

$controller = $controller ?? $this->getRequest()->getParam('controller');
$displayName = $displayName ?? $entity->id;
$actions = $actions ?? ['view', 'edit', 'delete'];
$entityName = (new ReflectionClass($entity))->getShortName();

?>
<div class="btn-group btn-group-sm" role="group">
    <?= in_array('view', $actions) ? $this->Html->link(
        __('View'),
        ['controller' => $controller, 'action' => 'view', $entity->id],
        ['title' => __('View'), 'class' => 'btn btn-outline-info']
    ) : '' ?>
    <?= in_array('edit', $actions) ? $this->Html->link(
        __('Edit'),
        ['controller' => $controller, 'action' => 'edit', $entity->id],
        ['title' => __('Edit'), 'class' => 'btn btn-outline-info']
    ) : '' ?>
    <?= in_array('delete', $actions) ? $this->Form->postLink(
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
    ) : '' ?>
</div>

