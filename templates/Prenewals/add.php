<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prenewal $prenewal
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Prenewals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="prenewals form content">
            <?= $this->Form->create($prenewal) ?>
            <fieldset>
                <legend><?= __('Add Prenewal') ?></legend>
                <?php
                    echo $this->Form->control('renewal_date');
                    echo $this->Form->control('policy_id', ['options' => $policies]);
                    echo $this->Form->control('premium');
                    echo $this->Form->control('fee');
                    echo $this->Form->control('status');
                    echo $this->Form->control('policy_status');
                    echo $this->Form->control('tenant_id', ['options' => $tenants]);
                    echo $this->Form->control('payment_date', ['empty' => true]);
                    echo $this->Form->control('memo');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
