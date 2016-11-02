<?php
namespace Manager;
use Entity\User;
use \Firebase\JWT\JWT;
class UserManager extends \PDO
{

    private $db;

    public function __construct() {
        $this->db = DbManager::getInstance()->getConnection();
    }


    public function findAll(){
        $res = [];
        $sql  = "SELECT * FROM contacts";
        $stmt=$this->db->prepare($sql);
        $stmt->execute();
        $datas=($stmt->fetchAll(\PDO::FETCH_ASSOC));
       // var_dump($datas);
        foreach ($datas as $data){
    array_push($res,json_encode($data));
}
        return $res;
    }


    public function getUserById($id_user){
        $sql  = "SELECT * FROM contacts WHERE id = $id_user";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':id',$id_user, \PDO::PARAM_INT);
        $stmt->execute();

        $data=$stmt->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }

    public function updateUserByIdUser($id_user, $name, $firstName){
        $sql  = "UPDATE contacts SET nom = '$name' , prenom= '$firstName' WHERE id = $id_user ";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':id',$id_user, \PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }

    public function addUser($name, $firstName){
        $sql  = "INSERT INTO contacts (nom, prenom, cree_le) VALUES ('$name', '$firstName', now())";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':id',$id_user, \PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }

    public function deleteUserByIdUser($id_user){
        $sql  = "DELETE FROM contacts WHERE id= :id";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(':id',$id_user, \PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }

    public function createToken(){
        define('SECRET_KEY','Your-Secret-Key');
        define('ALGORITHM','HS512');

        $tokenId    = base64_encode(mcrypt_create_iv(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;
        $expire     = $notBefore + 7200;
        $serverName = 'http://localhost/bady_bad/';

        $data = [
            'iat'  => $issuedAt,         // Issued at: time when the token was generated
            'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
            'iss'  => $serverName,       // Issuer
            'nbf'  => $notBefore,        // Not before
            'exp'  => $expire,           // Expire
            'data' => [                  // Data related to the logged user you can set your required data

            ]
        ];
        $secretKey = base64_decode(SECRET_KEY);
        $jwt = JWT::encode(
            $data,
            $secretKey,
            ALGORITHM
        );
        $unencodedArray = ['jwt' => $jwt];
        echo  "{'status' : 'success','resp':".json_encode($unencodedArray)."}";

    }

    public function checkToken(){
        $token = JWT::decode($_POST['token'], 'secret_server_key');
        echo $token->id;
    }
}
