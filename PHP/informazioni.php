<?php
header("Access-Control-Allow-Origin: *");
$obj = new stdClass();

$informazioni = '
    [
        {"ut":"Alessandro","info":"ciao sono un coglione"},
        {"ut":"Marco","info":"ciao sono un bastardo"},
        {"ut":"Daneiele","info":"ciao sono un testa di cazzo"}
    ]';

    $arrayInfo = json_decode($informazioni);

    $ut = "";
    $json = file_get_contents('php://input');
    $dati = json_decode($json);
    if(!is_null($dati)){
        //con -> accedo alle proprietà/attributi di un oggetto in PHP
        $ut = $dati->ut;
    }

    $obj->ut = $ut;

    $i = 0;
    while($i < count($arrayInfo) && ($arrayInfo[$i]->ut != $ut)){
        $i++;
    }
    if($i<count($arrayInfo)){
        $obj->info = $arrayInfo[$i]->info;
        $obj->trovato = 1;
    }else{
        $obj->info = "L'utente non contiene informazioni";
    }

    echo json_encode($obj);

?>