<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tenant $tenant
 */
?>
<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="#">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/tenants">
            Agents
        </a></li>
        <li class="active">Edit <?= $tenant->full_name ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Edit Agent : <?= $tenant->full_name ?>
            <ul class="pull-right panel-settings panel-button-tab-right">
                <li class="dropdown"><a href="<?= ROOT_DIREC ?>/users">
                    <em class="fa fa-arrow-left"></em>
                </a>
                    
                </li>
            </ul>
        </div>
    <div class="panel-body articles-container">       
            <?= $this->Form->create($tenant) ?>
                <div class="row">
                <div class="col-md-12"><?= $this->Form->control('full_name', array('class' => 'form-control', "label" => "Name *", "placeholder" => "Nom")); ?></div>
                    
                </div>  
                <hr>
                <div class="row" style="margin-top:15px">
                <div class="col-md-4"><?= $this->Form->control('email', array('class' => 'form-control', "label" => "E-mail *", "placeholder" => "E-mail")); ?></div>
                <div class="col-md-4"><?= $this->Form->control('phone', array('class' => 'form-control', "type" => "text", "label" => "Phone *", "placeholder" => "Phone")); ?></div>
                <div class="col-md-4"><?= $this->Form->control('company', array('class' => 'form-control', "type" => "text", "label" => "Company Name *", "placeholder" => "Company Name")); ?></div>
    
                </div>  
                <hr>
                <div class="row" style="margin-top:15px">
                <div class="col-md-6"><?= $this->Form->control('identification', array('class' => 'form-control', "label" => "Identification *", "placeholder" => "Ex: PASS_12345")); ?></div>
                    <div class="col-md-4"><?= $this->Form->control('status', array('class' => 'form-control', "options" => $status, 'style' => "height:46px", "label" => "Status *", "value" => 1)); ?></div>
    
                </div>  
                <div class="row">
                    <div class="col-md-12"><?= $this->Form->button(__('Update'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right")) ?></div>
                </div>  


            <?= $this->Form->end() ?>
        </div>
        
    </div>
</div><!--End .articles-->
