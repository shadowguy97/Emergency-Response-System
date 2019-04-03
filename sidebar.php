<?php
/**
 * User: Pelumi
 * Date: 23/10/18
 * Time: 10:25 PM
 */
$eType = $_SESSION['eType'];

if(isset($eType)){
    switch ($eType) {
        case "General":
            $img = 'assets/img/opt3.jpeg';
            $color = 'grey';
        break;
        case "Fire":
            $img = 'assets/img/pic5.jpg';
            $color = 'red';
        break;
        case "Security":
            $img = 'assets/img/opt.jpeg';
            $color = 'grey';
        break;
        case "Health":
            $img = 'assets/img/pic1.jpg';
            $color = 'red';
        break;
    }
}
else{
    $img = 'assets/img/opt3.jpeg';
    $color = 'grey';
}

if ($eType != "General"){
    echo("<div class=\"sidebar\" data-color=\"$color\" data-image=\" $img\">
        <div class=\"sidebar-wrapper\">
            <ul class=\"nav\">
                <li class=\"</li>");
                if($var == 'dash'){ echo "active";} 
                echo("\">
                <a href=\"dashboard.php\">
                    <i class=\"fa fa-dashboard\"></i>
                    <p>Dashboard</p>
                </a>
                </li>
                <li class=\"");
               if($var == 'logs'){ echo "active";}
               echo("\">
                    <a href=\"logs.php\">
                        <i class=\"fa fa-sticky-note\"></i>
                        <p>Emergency Logs</p>
                    </a>
                </li>   
            </ul>
        </div>
    </div>
    ");
}
else{
    echo("<div class=\"sidebar\" data-color=\"$color\" data-image=\" $img\">
        <div class=\"sidebar-wrapper\">
            <ul class=\"nav\">
                <li class=\"</li>");
                if($var == 'dash'){ echo "active";} 
                echo("\">
                <a href=\"dashboard.php\">
                    <i class=\"fa fa-dashboard\"></i>
                    <p>Dashboard</p>
                </a>
                </li>
                <li class=\"
                ");
                if($var == 'agents'){ echo "active";} 
               echo("\">
                    <a href=\"services.php\">
                        <i class=\"fa fa-users\"></i>
                        <p>Emergency Provider</p>
                    </a>
                </li>
                <li class=\"");
               if($var == 'logs'){ echo "active";}
               echo("\">
                    <a href=\"logs.php\">
                        <i class=\"fa fa-sticky-note\"></i>
                        <p>Emergency Logs</p>
                    </a>
                </li>   
                <li class=\"");
                if($var == 'admin'){ echo "active";}
                echo("\">
                    <a href=\"admin.php\">
                        <i class=\"fa fa-user\"></i>
                        <p>Admins</p>
                    </a>
                </li>   
            </ul>
        </div>
    </div>
    ");
}

?>