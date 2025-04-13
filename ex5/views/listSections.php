<?php if (isset($_SESSION['user_id'])): ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/loginGranted.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Liste Sections</title>
    </head>

    <body>
        <header>
            <nav>
                <h1>Student Management System</h1>
                <ul>
                    <li><a class="aclass" href="index.php?page=home">Home</a></li>
                    <li><a class="aclass" href="index.php?page=listEtudiants&p=1">Liste des etudiants</a></li>
                    <li><a class="aclass" href="index.php?page=listSections&p=1">Liste des Sections</a></li>
                    <li><a class="aclass" href="index.php?page=logout">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php 
            $limit = 2;
            $offset = (isset($_GET['p']) ? ((int)($_GET['p']) - 1) * $limit : 0);
            ?>
            <?php if (!(isset($_SESSION["viewStudents"]))): ?>
                <h2>Liste des Sections</h2>
                <form action="index.php?page=listSections&p=<?php echo (isset($_GET['p']) ? (int)$_GET['p'] : 1); ?>" method="POST" id="filtredForm">    
                <div class="input-container">
                        <input type="text" name="filtrer" placeholder="filtrer">
                        <button type="submit" id="filtrer">Filtrer</button>
                    </div>
                <!-- exporting the list of students-->
                </form>
                <div class="myContainer">
                    <div class="internal-container">
                        <a class="btn btn-info" href="index.php?page=export&type=csv&content=sec" class="btn btn-success">Exporter en CSV</a>
                        <a class="btn btn-info" href="index.php?page=export&type=pdf&content=sec" class="btn btn-success">Exporter en PDF</a>
                        <a class="btn btn-info" href="index.php?page=export&type=excel&content=sec" class="btn btn-success">Exporter en EXCEL</a>
                    </div>
                    <?php if ($_SESSION['user_role'] == 1): ?>
                    <div class="internal-container">
                        <button class="btn btn-primary" id="EDIT">EDIT</button>
                        <button class="btn btn-primary" id="ADD">Add Section</button>
                    </div>
                    <?php endif; ?>
                <!-- <form action="index.php?page=listSections&p=<?php echo (isset($_GET['p']) ? (int)$_GET['p'] : 1); ?>" method="POST" id="filtredForm">     -->
            </div>
                <form id="hidden" action="index.php?page=listSections" method="POST" style="display:none;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Designation</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="designation" placeholder="designation" required></td>
                                <td><input type="text" name="description" placeholder="description" required></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-danger" type="submit" name="add" value="add">Add</button>
                </form>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Designation</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <!--  we're creating a pagination so we should get students by page using the limit and offset-->
                    <!-- we need to make the pagination here the url should look like this: index.php?page=listEtudiants&page=2 -->
                    <tbody>
                        <?php
                        require_once '../../controllers/sectionController.php';
                        $sectionController = new SectionController();
                        if (isset($_SESSION["filtered_designation"])) {
                            $designation = $_SESSION["filtered_designation"];
                            $sections = $sectionController->getSectionsByDesignation( $designation , $offset , $limit);
                        } else {
                            $sections = $sectionController->getSections($limit, $offset);
                        }
                        unset($_SESSION["filtered_designation"]);
                        ?>

                        <?php
                        foreach ($sections as $section) {
                            echo "<tr>"; ?>
                            <form action="index.php?page=listSections" method="POST"><?php
                                echo "<td><input disabled type='text' name='id' value='" . htmlspecialchars($section['id']) . "'></td>";
                                echo "<td><input disabled type='text' name='designation' value='" . htmlspecialchars($section['designation']) . "'></td>";
                                echo "<td><input disabled type='text' name='description' value='" . htmlspecialchars($section['description']) . "'></td>";
                                if($_SESSION['user_role'] == 1) {
                                    echo "<td><button class='btn btn-danger' type='submit' name='delete' value='" . htmlspecialchars($section['id']) . "'>Delete</button>  <button class='btn btn-success' type='submit' id='edit' name='edit' value='" . htmlspecialchars($section['id']) . "'>Edit</button><a style='margin-left:5px'class='btn btn-warning' href='index.php?page=viewListedStudents&section=" . $section['designation'] . "&p=1' name='viewStudents' value='" . htmlspecialchars($section['designation'])  . "'>View Listed Students</a></td>";
                                }else{
                                    echo "<td><a style='margin-left:5px'class='btn btn-warning' href='index.php?page=viewListedStudents&section=" . $section['designation'] . "&p=1' name='viewStudents' value='" . htmlspecialchars($section['designation'])  . "'>View Listed Students</a></td>";
                                }
                                echo "</tr>"; ?>
                            </form>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php if ($offset >= 2): ?>
                    <a class="btn btn-secondary" href="index.php?page=listSections&p=<?php echo ($offset) / 2 ?>">previous page</a>
                    <?php echo "<span>". (isset($_GET['p']) ? (int)($_GET['p']) : 1) ."</span>"; ?>
                <?php endif; ?>
                <?php echo $sectionController->countSections()/2 > (isset($_GET['p']) ? (int)($_GET['p']) : 1) ?  '<a class="btn btn-secondary" href="index.php?page=listSections&p=' . ($offset + 4) / 2 . '">next page</a>' : ''; ?>
                    <?php endif; ?>
            </main>
        <?php if($_SESSION['user_role'] == 1): ?>
        <script>
            let toggleButton = document.getElementById("ADD");
            let s = 0;
            console.log(toggleButton);
            console.log(document.getElementById("hidden"))
            toggleButton.addEventListener("click", () => {
                if (s == 0) {
                    s = 1
                    document.getElementById("hidden").style.display = "block";
                } else {
                    s = 0
                    document.getElementById("hidden").style.display = "none";
                }
            });
            let v = 0;
            let btn = document.getElementById("EDIT");
            let inputs = [...document.querySelectorAll("input[type='text']")];

            btn.addEventListener("click", () => {
                if (v == 0) {
                    v = 1
                    inputs.forEach(input => {


                        if (input.name != "id") {
                            input.disabled = false;
                        }

                    });
                } else {
                    v = 0
                    inputs.forEach(input => {
                        if (input.name != "filtrer") {
                            input.disabled = true;
                        }
                    });
                }
            });
    
        </script>
        <?php endif; ?>
    </body>
<?php else: ?>
    <h1>you are not logged in</h1>
    <a href="index.php?page=login">Login</a>
<?php endif; ?>

    </html>