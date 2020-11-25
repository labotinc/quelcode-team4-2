<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CreditCard[]|\Cake\Collection\CollectionInterface $creditCards
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Credit Card'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="creditCards index large-9 medium-8 columns content">
    <h3><?= __('Credit Cards') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('card_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('holder_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('expiration_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($creditCards as $creditCard): ?>
            <tr>
                <td><?= $this->Number->format($creditCard->id) ?></td>
                <td><?= $creditCard->has('user') ? $this->Html->link($creditCard->user->id, ['controller' => 'Users', 'action' => 'view', $creditCard->user->id]) : '' ?></td>
                <td><?= h($creditCard->card_number) ?></td>
                <td><?= h($creditCard->holder_name) ?></td>
                <td><?= h($creditCard->expiration_date) ?></td>
                <td><?= h($creditCard->is_deleted) ?></td>
                <td><?= h($creditCard->created) ?></td>
                <td><?= h($creditCard->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $creditCard->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $creditCard->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $creditCard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $creditCard->id)]) ?>
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
