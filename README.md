# test_api

instancier un nouvel objet *RestClient()*

exemple:

    $api = new RestClient();

    
faire appel à la methode *apiRequest()* de la classe *RestClient()* en precisant:

* le verbe HTTP utilisé (GET, POST, PUT, DELETE),
* l'url,
* id du contact(pour les methodes GET avec parametres, DELETE, POST et PUT) et les datas(pour les methodes POST et PUT).

exemple:

    $api->apiRequest("GET","http://votre_url/testapi/");
    
    $api->apiRequest("DELETE","http://votre_url/testapi/",$id);    

    