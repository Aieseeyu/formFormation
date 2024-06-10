<?php 

// header("Content-Type: application/json");

$sections = [
    2 => file_get_contents('sections/section2.html'),
    3 => file_get_contents('sections/section3.html'),
    4 => file_get_contents('sections/section4.html'),
];

if (isset($_POST["stepHistory"])) {
    switch (($_POST["stepHistory"])) {
        case "2":
            echo $sections[2];
            break;
        
        case "3":
            echo $sections[3];
            break;
        
        case "4":
            echo $sections[4];
            break;
    }
}

?>