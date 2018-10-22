<?php
/**
 * Created by PhpStorm.
 * User: Pelumi
 * Date: 1/31/18
 * Time: 8:18 AM
 */

/*require_once 'local_config.php';
session_start();

$request = 'SELECT * FROM operators WHERE id="900300000"';
$reply = @mysqli_query($dbc, $request);


//$query = 'SELECT * FROM operators';
//$response = @mysqli_query($dbc, $query);

/*
print_r($reply);

while ($row = mysqli_fetch_array($reply)) {
    echo('<pre>');
    print_r($row);
    echo('</pre>');
}

*/

//echo(md5('james007'));
/*
$url = 'http://lottoking.com.ng/admin/api/lottoplus';

$params ="request=GetUsers&category=merchants";

$opts = array(
    'ssl' => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
    'http' => array(
        'method' => 'POST',
        'header' => "Content-type: application/x-www-form-urlencoded\r\nLK_APP_VERSION: 1.0.0\r\n",
        'content' => $params
    )
);

$context = stream_context_create($opts);
$result = file_get_contents($url, false, $context);
$data = json_decode($result, true);

echo('<pre>');
print_r($data);
echo('</pre>');

$len = count($data["message"]["GetUsersResponse"]);
//echo $len;

/*
$u2 = "Agent";

$ut = array();

$arr2;

for($i = 0; $i < $len; $i++) {
    $ut[$i] = $data["message"]["GetUsersResponse"]["" . $i . ""]['UserType'];
}

for($i = 0; $i < $len; $i++){
    if ($ut[$i] == $u2){
        $arr2[$i] = array($data["message"]["GetUsersResponse"]["" . $i . ""]);
    }
}

echo('<pre>');
print_r($arr2);
echo('</pre>');


$agenLen = count($arr2);
*/

echo(protect("Hello world"));
