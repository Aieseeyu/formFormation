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


// tableau des champs requis dans tous les cas et des champs requis dynamiquement
    $tab_required = [
        "selectOccupation" => [
            "1" => "jobSearch",
            "2" => ["businessName","businessActivity"],
            "3" => "jobTitle",
            "5" => "studentLevel",
            "7" => ["preciseStatus","jobSearch"],
        ],
        "selfOrNot" => [
            "0"=> ["selfPcUsageRate","checkBoxTools","softwares","checkBoxWantToSelf"],
            "1"=> ["selfPcUsageRate","checkBoxTools","softwares","checkBoxWantToSelf"],
            "2"=> ["numberCollaborators","notSelfUsagePc","checkboxWantToCollaborators"],
        ],
        "domainWanted" => [ 
            "Programmation Informatique" => "checkBoxProgramming",
            "Bases de données" => "checkBoxDatabase",
            "Réseaux Sociaux" => "checkBoxSocials",
            "Autre" => "otherWish",
        ],
        "typeWish"=> [
            "Dans vos locaux" => ["cityBusiness","countryBusiness"],
            "Dans nos locaux à Cannes (FR)" => ["cityResidence","countryResidence"],
            "Distanciel (Visio)" => ["cityResidence","countryResidence"],
            "Hybride (présentiel et distanciel)" => ["cityResidence","countryResidence"],
        ],
        "lastName", 
        "firstName", 
        "email", 
        "phoneNumber", 
        "rgpdCheck"
    ];

    //tableau d'erreurs etc à retourner en JSON
    $return = ["status" => "1"]; 

    // on verifie que le POST qu'on recoit est valide
    if(!empty($_POST) && is_array($_POST) && count($_POST) > 0){
        // on reitere dans le tableau des champs requis
        foreach($tab_required as $key => $value){
            // si la valeur est un tableau on rentre, sinon on ajoute juste une erreur au  tableau d'erreurs
            if (is_array($value)) {
                // on reitere dans le tableau des champs requis en fonction de la valeur
                foreach($value as $keySecond => $valueSecond){
                    // si la valeur correspond a une des valeurs du tableau des champs requis on rentre
                    if(!in_array($keySecond,$_POST)){
                        // si la valeur de la clé a plusieurs champs on rentre, sinon on ajoute juste une erreur au tableau d'erreurs
                        if (is_array($valueSecond)) {
                            // on reitere dans le tableau des champs à verifier
                            foreach($valueSecond as $keyThird => $valueThird){
                                // si le champs n'est pas dans le POST on ajoute une erreur au tableau d'erreur
                                if(!in_array($valueThird,$_POST)){
                                    $return["errors"][] = "Champ '".$valueThird."' manquant";
                                }
                            }
                        } 
                        if(!in_array($valueSecond,$_POST)) $return["errors"][] = "Champ '".$value."' manquant";
                    }
                }
            }
            if(!in_array($value,$_POST)) $return["errors"][] = "Champ '".$value."' manquant";
        }

    } else die("erreur champs post");

    $return = json_encode($return); //(transforme notre tableau au format json)
    die($return); //on renvoie 

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
    // $tab_ = [
    //     "selectOccupation" => [
    //         "1" => "jobSearch",
    //         "2" => ["businessName","businessActivity"],
    //         "3" => "jobTitle",
    //         "5" => "studentLevel",
    //         "7" => ["preciseStatus","jobSearch"],
    //     ],
    //     "selfOrNot" => [
    //         "0"=> ["selfPcUsageRate","checkBoxTools","softwares","checkBoxWantToSelf"],
    //         "1"=> ["selfPcUsageRate","checkBoxTools","softwares","checkBoxWantToSelf"],
    //         "2"=> ["numberCollaborators","notSelfUsagePc","checkboxWantToCollaborators"],
    //     ],
    //     "domainWanted" => [ 
    //         "Programmation Informatique" => "checkBoxProgramming",
    //         "Bases de données" => "checkBoxDatabase",
    //         "Réseaux Sociaux" => "checkBoxSocials",
    //         "Autre" => "otherWish",
    //     ],
    //     "typeWish"=> [
    //         "Dans vos locaux" => ["cityBusiness","countryBusiness"],
    //         "Dans nos locaux à Cannes (FR)" => ["cityResidence","countryResidence"],
    //         "Distanciel (Visio)" => ["cityResidence","countryResidence"],
    //         "Hybride (présentiel et distanciel)" => ["cityResidence","countryResidence"],
    //     ],
    // ];


}

?>