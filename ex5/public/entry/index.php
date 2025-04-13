<?php
session_start();
require_once '../../controllers/pageController.php';
require_once '../../controllers/usersController.php';
require_once '../../controllers/studentController.php';
require_once '../../controllers/sectionController.php';
$pc = new pageController();
$uc = new UsersController();
$sc = new studentController();
$sec = new SectionController();
$page = $_GET['page'] ?? 'home';
switch ($page) {
    case 'login':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($uc->checkUser($_POST['email'], $_POST['username'])) {
                $pc->showHomePage();
                break;
            }
?>
            <script>
                alert("Login failed!");
            </script>
            <?php
        } else {
            $pc->showLoginPage();
            break;
        }
    case 'home':
        $pc->showHomePage();
        break;
    case 'register':
        require_once 'views/register.php';
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
        break;
    case 'listEtudiants':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $sc->deleteStudent($_POST['delete']);
            } else if (isset($_POST['edit']) && isset($_POST['name']) && isset($_POST['birthday']) && isset($_POST['section'])) {

                $student = $sc->editStudent($_POST['edit'], $_POST['name'], $_FILES['image'], $_POST['birthday'], $_POST['section']);
            ?>
                <script>
                    alert("Student edited successfully!");
                </script>
<?php
            } else if (isset($_POST['filtrer'])) {
                $_SESSION["filtered_name"] = $_POST['filtrer'];
            } else if (isset($_POST['add'])) {
                $sc->createStudent($_POST['name'], $_FILES['image'], $_POST['birthday'], $_POST['section']);
            } else {
                // $sc->editStudent($_POST['edit']);
            }
        }
        $pc->showListEtudiantsPage();
        break;
    case 'listSections':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['delete'])) {
                $sec->deleteSection($_POST['delete']);
            } else if (isset($_POST['viewStudents'])) {
                $_SESSION["viewStudents"] = $_POST['viewStudents'];
            } else if (isset($_POST['edit']) && isset($_POST['designation']) && isset($_POST['designation'])) {
                $sec->editSection($_POST['edit'], $_POST['designation'], $_POST['description']);
            } else if (isset($_POST['add'])) {
                $sec->createSection($_POST['designation'], $_POST['description']);
            }else if (isset($_POST['filtrer'])) {
                $_SESSION["filtered_designation"] = $_POST['filtrer'];
            }
        }
        $pc->showListSectionsPage();
        break;
    case 'viewListedStudents':
        $pc->showListedStudentsPage();
        break;
    case 'export':
        $type = $_GET['type'] ?? 'csv'; 
        $content = $_GET['content']; 
        $pc->showExportController();
        $ee = new Export($content);
        $ee->export($type);
        exit;
    default:
        require_once 'views/404.php';
        break;
}
