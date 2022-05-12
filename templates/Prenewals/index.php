<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prenewal[]|\Cake\Collection\CollectionInterface $prenewals
 */
?>
<div class="prenewals index content">
    <?= $this->Html->link(__('New Prenewal'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Prenewals') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('renewal_date') ?></th>
                    <th><?= $this->Paginator->sort('policy_id') ?></th>
                    <th><?= $this->Paginator->sort('premium') ?></th>
                    <th><?= $this->Paginator->sort('fee') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th><?= $this->Paginator->sort('policy_status') ?></th>
                    <th><?= $this->Paginator->sort('tenant_id') ?></th>
                    <th><?= $this->Paginator->sort('payment_date') ?></th>
                    <th><?= $this->Paginator->sort('memo') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prenewals as $prenewal): ?>
                <tr>
                    <td><?= $this->Number->format($prenewal->id) ?></td>
                    <td><?= h($prenewal->renewal_date) ?></td>
                    <td><?= $prenewal->has('policy') ? $this->Html->link($prenewal->policy->policy_number, ['controller' => 'Policies', 'action' => 'view', $prenewal->policy->id]) : '' ?></td>
                    <td><?= $this->Number->format($prenewal->premium) ?></td>
                    <td><?= $this->Number->format($prenewal->fee) ?></td>
                    <td><?= $this->Number->format($prenewal->status) ?></td>
                    <td><?= h($prenewal->created) ?></td>
                    <td><?= h($prenewal->modified) ?></td>
                    <td><?= $this->Number->format($prenewal->policy_status) ?></td>
                    <td><?= $prenewal->has('tenant') ? $this->Html->link($prenewal->tenant->full_name, ['controller' => 'Tenants', 'action' => 'view', $prenewal->tenant->id]) : '' ?></td>
                    <td><?= h($prenewal->payment_date) ?></td>
                    <td><?= h($prenewal->memo) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $prenewal->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $prenewal->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $prenewal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prenewal->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
