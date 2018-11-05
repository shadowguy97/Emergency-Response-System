<?php
/**
 * User: Pelumi
 * Date: 23/10/18
 * Time: 10:25 PM
 */
?>


<div class="sidebar" data-color="red" data-image="assets/img/pic1.jpg">

        <div class="sidebar-wrapper">


            <ul class="nav">
                <li class="<?php if($var == 'dash'){ echo "active";} ?>">
                    <a href="dashboard.php">
                        <i class="fa fa-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php if($var == 'agent'){ echo "active";} ?>">
                    <a href="services.php">
                        <i class="fa fa-users"></i>
                        <p>Emergency Provider</p>
                    </a>
                </li>
                <li class="<?php if($var == 'logs'){ echo "active";} ?>">
                    <a href="logs.php">
                        <i class="fa fa-sticky-note"></i>
                        <p>Emergency Logs</p>
                    </a>
                </li>   
                <li class="<?php if($var == 'admin'){ echo "active";} ?>">
                    <a href="admin.php">
                        <i class="fa fa-user"></i>
                        <p>Admins</p>
                    </a>
                </li>   
            </ul>
        </div>
    </div>