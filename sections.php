<?php 

if (isset($_POST["stepHistory"]) && is_numeric($_POST["stepHistory"])) {

    echo file_get_contents('sections/section'.$_POST["stepHistory"].'.html');

}

?>