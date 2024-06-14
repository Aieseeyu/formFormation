<?php 

//$_POST["action"] = "getstep"; //permet de solliciter le stepper


if(!empty($_POST["action"])){
    if($_POST["action"] == "getstep") return getStep();
    elseif($_POST["action"] == "validform") return valideForm();
}

function getStep(){
    if(isset($_POST["stepHistory"]) && is_numeric($_POST["stepHistory"])){
        $file = 'sections/section'.$_POST["stepHistory"].'.html';
        if(file_exists($file)) die(@file_get_contents($file));
    }
    die(0);
}



function valideForm(){

    // on reçoit $_POST depuis ajax
    //$_POST["selectOccupation"] = 2;
    //$_POST["preciseStatus"] = '';

    //unset($_POST["selectOccupation"]); //permet de supprimer un élément d'un tableau

    $tab_required = ["selectOccupation","domainWanted","lastName","email"];

    $tab_ = [
        "selectOccupation" => [
            "1" => "jobSearch",
            "7" => ["preciseStatus","jobSearch"]
        ]

    ];

    $return = []; //tableau à retourner en JSON

    /*

    2 structures possibles pour return :

    return = {
        "status":0, //on est en erreur
        "errors" : [
            "Adresse mail invalide",
            "Numéro de téléphone invalide"
        ]
    }

    return = {
        "status":1 //on n'est pas en erreur
    }


    */


    if(!empty($_POST) && is_array($_POST) && count($_POST) > 0){
        foreach($tab_required as $k => $v){
            if(!in_array($v,$_POST)) $return["errors"][] = "Champs '".$v."' manquant";
        }
    } else die("erreur champs post");


    $return = json_encode($return); //(transforme notre tableau au format json)
    die($return); //on renvoie 

}

?>