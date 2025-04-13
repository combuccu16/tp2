<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'listEtudiants';
switch ($page) {
    case 'listEtudiants':
        require_once "../../views/listEtudiants.php";
        break;
    case 'infoEtudiant':
        require_once "../../views/infoEtudiant.php";
        break;
    default:
        echo "page not found";
        break;
}
