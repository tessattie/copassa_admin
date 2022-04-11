<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Tenant[]|\Cake\Collection\CollectionInterface $tenants
 */
?>

<div class="row" style="margin-bottom:15px">
    <ol class="breadcrumb">
        <li><a href="#">
            <em class="fa fa-home"></em>
        </a></li>
        <li class="active">Agents</li>
    </ol>
</div>
<?= $this->Flash->render() ?>
<div class="container-fluid"> 
    <div class="panel panel-default articles">
        <div class="panel-heading">
            Agents
            <a class="btn btn-warning" style="float:right" href="<?= ROOT_DIREC ?>/tenants/add">New</a>
        </div>
    <div class="panel-body articles-container">
            <table class="table table-stripped datatable">
                <thead> 
                    <th>Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">ID</th>
                    <th class="text-center">Company</th>
                    <th class="text-center">Status</th>
                    <th class="text-center"></th>
                </thead>
            <tbody> 
            <?php foreach($tenants as $tenant) : ?>
                <tr>
                    <td><?= $tenant->full_name ?></td>
                    <td class="text-center"><?= $tenant->email ?></td>
                    <td class="text-center"><?= $tenant->phone ?></td>
                    <td class="text-center"><?= $tenant->identification ?></td>
                    <td class="text-center"><?= $tenant->company ?></td>
                    <td class="text-center"><?= $status[$tenant->status] ?></td>
                    <td class="text-right">
                        <a href="<?= ROOT_DIREC ?>/tenants/edit/<?= $tenant->id ?>" style="font-size:1.3em!important;"><span class="fa fa-xl fa-pencil color-blue"></span></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            <!--End .article-->
        </div>
        
    </div>
</div><!--End .articles-->

<script type="text/javascript">$(document).ready( function () {
    $('.datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );</script>

<style>
    .dt-button{
        padding:5px;
        background:black;
        border:2px solid black;
        border-radius:2px;;
        color:white;
        margin-bottom:-10px;
    }
    .dt-buttons{
        margin-bottom:-25px;
    }
</style>
