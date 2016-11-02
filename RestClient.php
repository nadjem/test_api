<?php


class RestClient
{

        public function apiRequest($method,$url,$id=false,$data_string=false)
    {

        if($method == "POST"){

            $nom =($data_string["Nom"]);
            $prenom =($data_string["Prenom"]);

            $url .= $nom."/".$prenom;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response  = curl_exec($ch);
            curl_close($ch);

            echo $response;

        }

        if($method == "GET"){

            if(isset($id) ? $id : null){

                $url .= $id;

            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if (!$response) {
                die("Connection Failure.n");
            }
            echo $response;

        }
        if($method == "PUT"){

            //var_dump($data_string);

            $nom =($data_string["Nom"]);
            $prenom =($data_string["Prenom"]);





            $url .= $id."/".$nom."/".$prenom;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($data_string)))
            );


            $response = curl_exec($ch);
            if (!$response) {
                die("Connection Failure.n");
            }
            echo $response;

        }
        if($method == "DELETE"){

            $url .= $id;


            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($data_string))
            );


            $response = curl_exec($ch);
            if (!$response) {
                die("Connection Failure.n");
            }
            echo $response;

        }


    }


}