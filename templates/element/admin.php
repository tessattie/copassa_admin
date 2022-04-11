<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#" style="color:white"><span style="color:white">AR System</span></a>
                
                <ul class="nav navbar-top-links navbar-right">

                    <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <span class="fa fa-user" style="font-size: 28px;margin-top: -5px;margin-left: 1px;"></span>
                    </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="<?= ROOT_DIREC ?>/users/view/<?= $user_connected['id'] ?>"><span class="fa fa-user">&nbsp;</span> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= ROOT_DIREC ?>/users/logout"><span class="fa fa-power-off">&nbsp;</span> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.container-fluid -->
    </nav>
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-usertitle" style="margin:auto;width:100%">
                <div class="profile-usertitle-name text-center" style="margin-top:12px"><?= $user_connected['name'] ?></div>
                <div class="profile-usertitle-status text-center"><span class="indicator label-success"></span>Online</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>

        <ul class="nav menu" style="margin-top:0px">

            <li class="<?= ($this->request->getParam('controller') == 'Tenants') ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/tenants"><em class="fa fa-users">&nbsp;</em> Agents</a></li>
            <li class="<?= ($this->request->getParam('controller') == 'Users') ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/users"><em class="fa fa-user">&nbsp;</em> Users</a></li>

            <li class="<?= ($this->request->getParam('controller') == 'Folders') ? 'active' : '' ?>"><a href="<?= ROOT_DIREC ?>/folders/show"><em class="fa fa-folder">&nbsp;</em> Ressources</a></li>

            <li><a  href="<?= ROOT_DIREC ?>/users/logout" style="color:red"><em class="fa fa-power-off">&nbsp;</em> Log Out</a></li>
        </ul>

    </div><!--/.sidebar-->

<script type="text/javascript">
    $(document).ready(function(){
        $("li.parent").click(function(){
            var children = $(this).find(".children");
            if(children.hasClass("collapse")){
                children.removeClass("collapse");
            }else{
                children.addClass("collapse");
            }
        })
    })
</script>