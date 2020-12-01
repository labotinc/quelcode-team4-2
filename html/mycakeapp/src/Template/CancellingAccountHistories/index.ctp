<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CancellingAccountHistory[]|\Cake\Collection\CollectionInterface $cancellingAccountHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cancelling Account History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cancellingAccountHistories index large-9 medium-8 columns content">
    <h3><?= __('Cancelling Account Histories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cancelling_category_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cancelled') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cancellingAccountHistories as $cancellingAccountHistory): ?>
            <tr>
                <td><?= $this->Number->format($cancellingAccountHistory->id) ?></td>
                <td><?= $cancellingAccountHistory->has('user') ? $this->Html->link($cancellingAccountHistory->user->id, ['controller' => 'Users', 'action' => 'view', $cancellingAccountHistory->user->id]) : '' ?></td>
                <td><?= $this->Number->format($cancellingAccountHistory->cancelling_category_id) ?></td>
                <td><?= h($cancellingAccountHistory->cancelled) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cancellingAccountHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cancellingAccountHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cancellingAccountHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cancellingAccountHistory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
