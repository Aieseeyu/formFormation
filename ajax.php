<?php 

define("template_dir", __DIR__);
define("email", "stefan.dragos3479@gmail.com");

//$_POST["action"] = "getstep"; //permet de solliciter le stepper


if(!empty($_POST["action"])){
    if($_POST["action"] == "getstep") return getStep();
    elseif($_POST["action"] == "validform") return valideForm();
}

function getStep(){
    if(isset($_POST["stepHistory"]) && is_numeric($_POST["stepHistory"])){
        $file = template_dir.'/sections/section'.$_POST["stepHistory"].'.html';
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
            "4" => ["businessName","businessActivity"],
            "5" => "studentLevel",
            "6" => ["businessName","businessActivity"],
            "7" => "preciseStatus"
        ],
        "selfOrNot" => [
            "0"=> ["selfPcUsageRate","checkBoxTools","softwares","checkBoxWantToSelf"],
            "1"=> ["selfPcUsageRate","checkBoxTools","softwares","checkBoxWantToSelf"],
            "2"=> ["numberCollaborators","notSelfUsagePc","checkboxWantToCollaborators"],
        ],
        "domainWanted" => [ 
            "Programmation Informatique" => "checkBoxProgramming",
            "Bases de données" => "checkBoxDatabase",
            "Réseaux Sociaux" => "checkBoxSocial",
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

    // ajouter "dans la section ..." ????
    $tabError = [
        "selectOccupation" => "Veuillez choisir un statut",
        "preciseStatus" => "Veuillez préciser votre statut",
        "businessName" => "Veuillez renseigner le nom de l'entreprise",
        "businessActivity" => "Veuillez renseigner l'activité de l'entreprise",
        "studentLevel" => "Veuillez choisir un niveau d'étude",
        "jobTitle" => "Veuillez renseigner le poste que vous occupez",
        "jobSearch" => "Veuillez renseigner le domaine dans lequel vous recherchez",
        "selfOrNot" => "Veuillez choisir pour qui est la demande",
        "selfPcUsageRate" => "Veuillez choisir un niveau d'usage personnel de l'ordinateur",
        "checkBoxTools" => "Veuillez sélectionner les outils que vous utilisez",
        "softwares" => "Veuillez cocher les outils que vous utilisez",
        "numberCollaborators" => "Veuillez renseigner le nombre de collaborateurs",
        "notSelfUsagePc" => "Veuillez choisir si ils utilisent l'ordinateur dans le cadre de leur travail",
        "checkBoxWantToSelf" => "Veuillez sélectionner sur quoi votre demande porte pour vous-même", // a voir
        "checkboxWantToCollaborators" => "Veuillez sélectionner sur quoi votre demande porte pour vos collaborateurs", // a voir
        "domainWanted" => "Veuillez cocher les domaines souhaités",
        "checkBoxProgramming" => "Veuillez sélectionner les languages souhaitées",
        "checkBoxDatabase" => "Veuillez sélectionner les bases de donées souhaitées",
        "checkBoxSocial" => "Veuillez sélectionner les réseaux souhaités",
        "otherWish" => "Veuillez renseigner quelle autre demande",
        "typeWish" => "Veuillez choisir le type de formation souhaitée",
        "lastName" => "Veuillez renseigner votre nom",
        "firstName" => "Veuillez renseigner votre prénom",
        "cityResidence" => "Veuillez renseigner votre ville de résidence",
        "countryResidence" => "Veuillez renseigner votre pays de résidence",
        "cityBusiness" => "Veuillez renseigner la ville de vos locaux",
        "countryBusiness" => "Veuillez renseigner le pays de vos locaux",
        "email" => "Veuillez renseigner votre email",
        "phoneNumber" => "Veuillez renseigner votre numéro de téléphone",
        "rgpdCheck" => "Veuillez accepter les conditions",
    ];

    $emailMessages = [
            "1"=> [
                "selectOccupation" => [
                    "1" => "En recherche d'emploi",
                    "2" => "Entrepreneur Individuel",
                    "3" => "Dirigeant",
                    "4" => "Salarié",
                    "5" => "Étudiant",
                    "6" => "Entreprise",
                    "7" => "Autre",
                    "message" => "Le statut: "
                ],
                "preciseStatus" => "Autre statut: ",
                "businessName" => "Nom de l'entreprise: ",
                "businessActivity" => "Activité de l'entreprise: ",
                "studentLevel" => "Niveau d'étude: ",
                "jobTitle" => "Intitulé du poste: ",
                "jobSearch" => "Domaine de recherche d'emploi: ",
                "selfOrNot" => [
                    "1" => "Moi-même",
                    "2" => "Mes collaborateurs",
                    "message" => "La demande concerne: "
                ],
            ],
            "2"=> [
                "selfPcUsageRate" => "Utilisation personnelle de l'ordinateur: ",
                "checkBoxTools" => "Outils utilisés: ",
                "softwares" => "Logiciels utilisés: ",
                "numberCollaborators" => "Nombre de collaborateurs: ",
                "notSelfUsagePc" => "Utilisation des collaborateurs de l'ordinateur: ",
            ],
            "3"=> [
                "checkBoxWantToSelf" => "Souhait personnel: ", // a voir
                "checkboxWantToCollaborators" => "Souhait pour les collaborateurs: ", // a voir
                "domainWanted" => "Domaines souhaités: ",
                "checkBoxProgramming" => "Dans la programmation: ",
                "checkBoxDatabase" => "Dans les bases de donées: ",
                "checkBoxSocial" => "Dans les réseaux sociaux: ",
                "otherWish" => "Autre demande: ",
            ],
            "4"=> [
                "typeWish" => "Type de formation souhaité: ",
                "lastName" => "Nom: ",
                "firstName" => "Prénom: ",
                "cityResidence" => "Ville de résidence: ",
                "countryResidence" => "Pays de résidence: ",
                "cityBusiness" => "Ville des locaux: ",
                "countryBusiness" => "Pays des locaux: ",
                "email" => "Email: ",
                "phoneNumber" => "Numéro de téléphone: ",
                "rgpdCheck" => [
                    "0" => "Non",
                    "1" => "Oui",
                    "message" => "RGPD coché: "
                ],
            ],
    ];

    function getMessageError ($inputName, $tabError ){

        // if (!empty($tabError[$inputName])) {
        //     return $tabError[$inputName];
        // } else {
        //     return "champ ".$inputName." manquant";
        // }

        // version simplifiée (ternaire)
        return !empty($tabError[$inputName]) ? $tabError[$inputName] : "champ ".$inputName." manquant";

    };


    function sanitizeCheckbox ($value) {

        if (is_array($value)) {
            $value = implode(",", $value);
        } 

        return $value;
    };


    //tableau d'erreurs etc à retourner en JSON
    $return = ["status" => "1" /*, "post" => $_POST*/];

    $lastTab = [];

    // on verifie que le POST qu'on recoit est valide
    if(!empty($_POST) && is_array($_POST) && count($_POST) > 0){
        // on reitere dans le tableau des champs requis
        foreach($tab_required as $key => $value){
            // si la valeur est un tableau on rentre, sinon on ajoute juste une erreur au tableau d'erreurs
            if (!is_array($value)) {
                if (!empty($_POST[$value])) {
                    $lastTab[$value] = sanitizeCheckbox($_POST[$value]);
                } else {
                    $return["errors"][$value] = getMessageError($value, $tabError);
                }
            } else {
                if(isset($_POST[$key])){
                    $postValue = $_POST[$key];
                    $lastTab[$key] = sanitizeCheckbox($postValue);

                    if (is_array($postValue)) {
                        foreach ($postValue as $keyForm => $valueForm) {
                            if(isset($value[$valueForm])){
                                if (is_array($value[$valueForm])) {
                                    foreach ($value[$valueForm] as $keySecond => $valueSecond) {
                                        if(!empty($_POST[$valueSecond])){
                                            $lastTab[$valueSecond] = sanitizeCheckbox($_POST[$valueSecond]);
                                        } else {
                                            $return["errors"][$valueSecond] = getMessageError($valueSecond, $tabError);
                                        }
                                    }
                                } elseif (!empty($_POST[$value[$valueForm]])) {
                                    $lastTab[$value[$valueForm]] = sanitizeCheckbox($_POST[$value[$valueForm]]);
                                } else {
                                    $return["errors"][$key] = getMessageError($key, $tabError);
                                }
                            }
                        }
                    } else {
                        if(isset($value[$postValue])){
                            if (is_array($value[$postValue])) {
                                foreach ($value[$postValue] as $keySecond => $valueSecond) {
                                    if(!empty($_POST[$valueSecond])){
                                        $lastTab[$valueSecond] = sanitizeCheckbox($_POST[$valueSecond]);
                                    } else {
                                        $return["errors"][$valueSecond] = getMessageError($valueSecond, $tabError);
                                    }
                                }
                            } elseif (!empty($_POST[$value[$postValue]])) {
                                $lastTab[$value[$postValue]] = sanitizeCheckbox($_POST[$value[$postValue]]);
                            } else {
                                $return["errors"][$key] = getMessageError($key, $tabError);
                            }
                        }
                    }
                } else {
                    $return["errors"][$key] = getMessageError($key, $tabError);
                }
            }
        }
    } else die("erreur champs post");

    
    if (!empty($return["errors"]) && count($return["errors"]) > 0) {
        $return["status"] = "0" ;
    } else {
        $return["html"] = @file_get_contents(template_dir."/sections/sectionFinal.html");
    }

    $message = "
        <html>
            <body>
                <div style='font-family: Arial, sans-serif; line-height: 1.6;'>
                    <h1 style='color: #333;'>Demande de ".$lastTab["firstName"]." ".$lastTab["lastName"]."</h1>
    ";

    foreach ($emailMessages as $numSection => $tabInputs) {

        $message .= "<br><strong>Section ".$numSection."</strong><br>";

        foreach ($tabInputs as $inputName => $inputValue) {
            
            if (is_array($inputValue)) {
                if (isset($lastTab[$inputName])){
                    if (isset($inputValue[$lastTab[$inputName]])) {
                        $message .= "<p>".$inputValue["message"].$inputValue[$lastTab[$inputName]]."</p>";
                    } else {
                        $message .= "Les champs ne correspondent pas. <br>";
                    }
                } else {
                    // $message .= "Le champ ".$inputName." n'a pas été trouvé. <br>";
                }
            } else {
                if (isset($lastTab[$inputName])) {
                    $message .= "<p>".$inputValue.$lastTab[$inputName]."</p>";
                }   else {
                    // $message .= "Le champ ".$inputName." n'a pas été trouvé. <br>";
                }
            }
        }
    }

    $message .= "            
                        <br><p>Cordialement,<br>L'équipe développement BrainyFormations</p>
                    </div>
                </body>
            </html>
        ";


    $headers  = 'MIME-Version: 1.0' . "\n"; // Version MIME
    $headers .= 'Content-type: text/html; charset=ISO-8859-1'."\n";

    mail(email,"Demande",$message,$headers);

    $return["final"] = $lastTab;
    $return["messageMail"] = $message;
    $return = json_encode($return); //(transforme notre tableau au format json)
    die($return); //on renvoie 

}

?>