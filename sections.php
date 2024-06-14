<?php 

if (isset($_POST["stepHistory"]) && is_numeric($_POST["stepHistory"])) {

    echo file_get_contents('sections/section'.$_POST["stepHistory"].'.html');

}

$tab[]=[
    "selectOccupation" => "7"
];


// {name: 'selectOccupation', value: '7'}
// 1
// : 
// {name: 'preciseStatus', value: 'fqsd'}
// 2
// : 
// {name: 'businessName', value: ''}
// 3
// : 
// {name: 'bussinesActivity', value: ''}
// 4
// : 
// {name: 'studentLevel', value: '----'}
// 5
// : 
// {name: 'jobTitle', value: ''}
// 6
// : 
// {name: 'jobSearch', value: ''}
// 7
// : 
// {name: 'selfPcUsageRate', value: 'Régulier'}
// 8
// : 
// {name: 'checkBoxTools', value: 'Logiciels'}
// 9
// : 
// {name: 'softwares', value: 'Word'}
// 10
// : 
// {name: 'softwares', value: 'Excel'}
// 11
// : 
// {name: 'softwares', value: 'PowerPoint'}
// 12
// : 
// {name: 'softwares', value: 'Outlook'}
// 13
// : 
// {name: 'numberCollaborators', value: ''}
// 14
// : 
// {name: 'checkBoxWantToSelf', value: 'Plus efficace'}
// 15
// : 
// {name: 'checkBoxWantToSelf', value: 'Monter en competences'}
// 16
// : 
// {name: 'domainWanted', value: 'Programmation Informatique'}
// 17
// : 
// {name: 'domainWanted', value: 'Bases de données'}
// 18
// : 
// {name: 'domainWanted', value: 'Réseaux Sociaux'}
// 19
// : 
// {name: 'domainWanted', value: 'Autre'}
// 20
// : 
// {name: 'checkBoxProgramming', value: 'CSS'}
// 21
// : 
// {name: 'checkBoxDatabase', value: 'PostgreSQL'}
// 22
// : 
// {name: 'checkBoxSocial', value: 'Instagram'}
// 23
// : 
// {name: 'otherWish', value: 'fsfqsdfq'}
// 24
// : 
// {name: 'typeWish', value: '1'}
// 25
// : 
// {name: 'lastName', value: 'fsqdfqsd'}
// 26
// : 
// {name: 'firstName', value: 'fqsdfqsf'}
// 27
// : 
// {name: 'cityResidence', value: 'sqdfqsdfqf'}
// 28
// : 
// {name: 'countryResidence', value: 'sqdfqsdf'}
// 29
// : 
// {name: 'cityBusiness', value: ''}
// 30
// : 
// {name: 'countryBusiness', value: ''}
// 31
// : 
// {name: 'email', value: 'sqdfsq@fdsfs.com'}
// 32
// : 
// {name: 'phoneNumber', value: '09188321'}
// 33
// : 
// {name: 'rgpdCheck', value: '1'}

?>