<?php
require_once "classes/Manager/UserManager.php";
require_once "classes/Manager/DbManager.php";
require_once "classes/Entity/User.php";

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$methode = $_SERVER['REQUEST_METHOD'];
$uri = "$_SERVER[REQUEST_URI]";
echo "<pre>";
echo $methode." ".$actual_link;
echo "<br>";
echo "</pre>";

$data =file_get_contents('php://input');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $arrayDataUrl = explode( "/",$uri);
    $users = new \Manager\UserManager();

    if($users->addUser($arrayDataUrl[2],$arrayDataUrl[3])){
        echo json_encode(array("create" => "success"));
    }
    else{
        echo json_encode(array("create" => "error"));
    }
}

elseif ($_SERVER['REQUEST_METHOD']== 'GET'){
    $arrayDataUrl = explode( "/",$uri);
    $testArray = json_decode(explode( "/",$uri)[2]);

    if(!json_decode(explode( "/",$uri)[2])){
        $users = new \Manager\UserManager();
        $datas = $users->findAll();
    }else{
        $users = new \Manager\UserManager();
        $testArray =  explode( "/",$uri);
        $datas = $users->getUserById($testArray[2]);
        echo $datas;

    }

}elseif ($_SERVER['REQUEST_METHOD']== 'PUT'){
    $arrayDataUrl = explode( "/",$uri);
    $users = new \Manager\UserManager();

    if($users->updateUserByIdUser($arrayDataUrl[2],$arrayDataUrl[3],$arrayDataUrl[4])){
        echo json_encode(array("update" => "success"));
    }
    else{
        echo json_encode(array("update" => "error"));
    }

}
elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $users = new \Manager\UserManager();
    $arrayDataUrl = explode( "/",$uri);
    $testArray = json_decode(explode( "/",$uri)[2]);

    if( $users->deleteUserByIdUser($testArray) ){
        echo json_encode(array("delete" => "success"));
    }
    else{
        echo json_encode(array("delete" => "error"));
    }
}

