<?php
/**
 * @var AppView $this
 * @var ?string $name
 * @var ?string $model
 */

use App\View\AppView;

$name = $name ?? 'records';
$model = $model ?? null;
$this->Paginator->defaultModel($model);

?>
<?php if ($this->Paginator->param('count') > 0) : ?>
    <div class="paginator">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('«', ['label' => __('First')]) ?>
            <?= $this->Paginator->prev('‹', ['label' => __('Previous')]) ?>
            <?= $this->Paginator->numbers(['model' => $model]) ?>
            <?= $this->Paginator->next('›', ['label' => __('Next')]) ?>
            <?= $this->Paginator->last('»', ['label' => __('Last')]) ?>
        </ul>
        <p class="text-center"><?= $this->Paginator->counter(__("Page {{page}} of {{pages}}, showing {{current}} {$name} out of {{count}} total")) ?></p>
    </div>
<?php endif; ?>
