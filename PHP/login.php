<?php
header("Access-Control-Allow-Origin: *");
$obj = new stdClass();

$persone = '
    [
        {"ut":"Alessandro","pwd":"alessandro"},
        {"ut":"Marco","pwd":"marco"},
        {"ut":"Daneiele","pwd":"daniele"}
    ]';

    $arrayPersone = json_decode($persone);

    //Istruzioni per prelevare i dati dal client
    $ut = "";
    $pwd = "";
    $json = file_get_contents('php://input');
    $dati = json_decode($json);
    if(!is_null($dati)){
        //con -> accedo alle proprietà/attributi di un oggetto in PHP
        $ut = $dati->ut;
        $pwd = $dati->pwd;
    }


    $obj->get = $_GET;
    $obj->json = $dati;
    $obj->post = $_POST;
    $obj->ut = $ut;
    $obj->pwd = $pwd;

    //RICERCA PARZIALE (Appena trovo il nome esco dal ciclo) 
    $i = 0;
    while($i<count($arrayPersone) && ($arrayPersone[$i]->ut != $ut || $arrayPersone[$i]->pwd != $pwd)){
        $i++;
    }
    if($i<count($arrayPersone)){
        //Ho trovato
        $obj->login = true;
        $obj->cod = 1;
    }else{
        $obj->cod = -1;
    }

    echo json_encode($obj);

?>