<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="<?= ROOT_DIREC ?>/policies/dashboard">
            <em class="fa fa-home"></em>
        </a></li>
        <li><a href="<?= ROOT_DIREC ?>/companies">
            Insurance Companies
        </a></li>
        <li>Edit</li>
        <li><?= $company->name ?></li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Edit Insurance Company : <?= $company->name ?>
            <ul class="pull-right panel-settings panel-button-tab-right">
                <li class="dropdown"><a href="<?= ROOT_DIREC ?>/companies">
                    <em class="fa fa-arrow-left"></em>
                </a>
                    
                </li>
            </ul>
        </div>
        <div class="panel-body articles-container">       
            <?= $this->Form->create($company) ?>
                <div class="row">
                    <div class="col-md-6"><?= $this->Form->control('name', array('class' => 'form-control', "label" => "Name *", "placeholder" => "Name")); ?></div>
                    <div class="col-md-6"><?= $this->Form->control('type', array('class' => 'form-control', "empty" => '-- Choose --', 'options' => $company_types, "label" => "Type", "multiple" => false, 'required' => true, 'style' => "height:46px")); ?></div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-4"><?= $this->Form->control('address', array('class' => 'form-control', "label" => "Address", "placeholder" => "Address")); ?></div>
                    <div class="col-md-4"><?= $this->Form->control('phone', array('class' => 'form-control', "placeholder" => 'Phone', "label" => "Phone")); ?></div>
                    <div class="col-md-4"><?= $this->Form->control('email', array('class' => 'form-control', "placeholder" => 'Email', "label" => "Email")); ?></div>   
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $this->Form->button(__('Update'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right;height:44px")) ?>
                    </div>
                </div>  
            <?= $this->Form->end() ?>
        </div>
    </div>
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Options
            <ul class="pull-right panel-settings panel-button-tab-right">
                <li class="dropdown"><a href="<?= ROOT_DIREC ?>/companies">
                    <em class="fa fa-arrow-left"></em>
                </a>
                    
                </li>
            </ul>
        </div>
        <div class="panel-body articles-container">       
            <?= $this->Form->create($option, array("url" => "/options/add")) ?>
                <div class="row">
                    <div class="col-md-2">
                        <?= $this->Form->control('company_id', array('type' => 'hidden', "value" => $company->id)); ?>
                        <?= $this->Form->control('name', array('class' => 'form-control', "label" => "Add Option", "placeholder" => "Product Name")); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->control('option_name', array('class' => 'form-control', "label" => false, "placeholder" => "Option", 'style' => 'margin-top:25px')); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $this->Form->control('plan', array('class' => 'form-control', "label" => false, 'style' => 'margin-top:25px', "empty" => "-- Plan --", 'options' => $plans)); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->control('deductible', array('class' => 'form-control', "label" => false, "placeholder" => "Outside USA Deductible", 'style' => 'margin-top:25px', 'value' => '')); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->control('usa_deductible', array('class' => 'form-control', "label" => false, "placeholder" => "Inside USA Deductible", 'style' => 'margin-top:25px')); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $this->Form->control('max_coverage', array('class' => 'form-control', "label" => false, "placeholder" => "Max Coverage", 'style' => 'margin-top:25px')); ?>
                    </div>
                    <div class="col-md-1">
                        <?= $this->Form->button(__('Add'), array('class'=>'btn btn-success', "style"=>"margin-top:25px;float:right;height:44px;width:100%")) ?>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered" style="margin-top:15px">
                            <thead>
                                <tr>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Option</th>
                                    <th class="text-center">Outside USA Deductible</th>
                                    <th class="text-center">Inside USA Deductible</th>
                                    <th class="text-center">Maximum Coverage</th>
                                    <th class="text-center">Plan</th>
                                    <th style="width:70px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($company->options as $option) : ?>
                                    <tr>
                                        <td class="text-center"><?= $option->name ?></td>
                                        <td class="text-center"><?= $option->option_name ?></td>
                                        <?php if(!empty($option->deductible)) : ?>
                                            <td class="text-center"><?= number_format($option->deductible) ?> USD</td>
                                        <?php else : ?>
                                            <td class="text-center"></td>
                                        <?php endif; ?>
                                        <?php if(!empty($option->usa_deductible)) : ?>
                                            <td class="text-center"><?= number_format($option->usa_deductible) ?> USD</td>
                                        <?php else : ?>
                                            <td class="text-center"></td>
                                        <?php endif; ?>
                                        <?php if(!empty($option->max_coverage)) : ?>
                                            <td class="text-center"><?= number_format($option->max_coverage) ?> USD</td>
                                        <?php else : ?>
                                            <td class="text-center"></td>
                                        <?php endif; ?>
                                        <?php if(!empty($option->plan)) : ?>
                                            <td><?= $plans[$option->plan] ?></td>
                                            <?php else : ?>
                                                <td></td>
                                            <?php endif; ?>
                                            
                                        <td class="text-right">
                                            <a href="<?= ROOT_DIREC ?>/options/edit/<?= $option->id ?>" style="font-size:1.3em!important;"><span class="fa fa-xl fa-pencil color-blue"></span></a>
                                            <a href="<?= ROOT_DIREC ?>/options/delete/<?= $option->id ?>" onclick="return confirm('Are you sure you would like to delete the option <?= $option->name ?>')" style="font-size:1.3em!important;margin-left:10px"><span class="fa fa-xl fa-trash color-red"></span></a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div><!--End .articles-->