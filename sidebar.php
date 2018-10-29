<?php
/**
 * User: Pelumi
 * Date: 10/23/18
 * Time: 10:25 PM
 */
?>


<div class="sidebar" data-color="red" data-image="assets/img/pic1.jpg">

        <div class="sidebar-wrapper">


            <ul class="nav">
                <li class="<?php if($var == 'dash'){ echo "active";} ?>">
                    <a href="dashboard.php">
                        <i class="fa fa-dashboard" style="color: black;"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php if($var == 'agent'){ echo "active";} ?>">
                    <a href="provider.php">
                        <i class="fa fa-dashboard" style="color: black;"></i>
                        <p>Emergency Provider</p>
                    </a>
                </li>
                <li class="<?php if($var == 'ems'){ echo "active";} ?>">
                    <a href="ems.php">
                        <i class="fa fa-dashboard" style="color: black;"></i>
                        <p>Emergencies Logs</p>
                    </a>
                </li>   
            </ul>
        </div>
    </div>