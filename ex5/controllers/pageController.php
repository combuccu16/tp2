<?php
class pageController
{
    public function showLoginPage()
    {
        require_once "../../views/login.php";
    }
    public function showHomePage()
    {
        require_once '../../views/home.php';
    }
    public function showListEtudiantsPage()
    {
        require_once '../../views/listEtudiants.php';
    }
    public function showListSectionsPage()
    {
        require_once '../../views/listSections.php';
    }
    public function showListedStudentsPage()
    {
        require_once '../../views/viewListedStudents.php';
    }
    public function showExportController(){
        require_once __DIR__ . "/exportController.php";
    }
}
