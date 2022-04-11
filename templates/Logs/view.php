<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Log $log
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Log'), ['action' => 'edit', $log->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Log'), ['action' => 'delete', $log->id], ['confirm' => __('Are you sure you want to delete # {0}?', $log->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Logs'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Log'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="logs view content">
            <h3><?= h($log->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Comment') ?></th>
                    <td><?= h($log->comment) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $log->has('user') ? $this->Html->link($log->user->name, ['controller' => 'Users', 'action' => 'view', $log->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($log->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $this->Number->format($log->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= $this->Number->format($log->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= $this->Number->format($log->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= $this->Number->format($log->type) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
