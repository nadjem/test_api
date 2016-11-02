<?php
require_once "RestClient.php";

$requestApi = new RestClient();

/*valeur de test */
$id = 28;
$data_stringPut= array('Nom'=> 'Jackson' , 'Prenom' => 'Jack');
$data_stringGet = $id;
$data_stringDelete = $id;
$data_stringPost =  array('Nom'=> 'Mighty' , 'Prenom' => 'Duck'  );
/***************/
?>
<!DOCTYPE html>
<html lang=fr>

<head>
    <meta charset=UTF-8>
    <link rel=stylesheet href="assets/css/bootstrap.min.css">
    <link rel=stylesheet href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
    <title>testApi</title>
</head>

<body>
    <div class="container">
        <?php
        $requestApi->apiRequest("GET","http://testapi.com/testapi/");
        $requestApi->apiRequest("GET","http://testapi.com/testapi/",$id);
        $requestApi->apiRequest("POST","http://testapi.com/testapi/",$id,$data_stringPost);
        $requestApi->apiRequest("PUT","http://testapi.com/testapi/",$id,$data_stringPut);
        $requestApi->apiRequest("DELETE","http://testapi.com/testapi/",$id);
        ?>
    </div>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>