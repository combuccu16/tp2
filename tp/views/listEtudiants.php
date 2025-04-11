<?php if (isset($_SESSION['user_id'])): ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/loginGranted.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <title>Liste Etudiants</title>
        <style>
            .container {
                display: flex;
            }
        </style>
    </head>

    <body>
        <header>
            <nav>
                <h1>Student Management System</h1>
                <ul>
                    <li><a href="index.php?page=home">Home</a></li>
                    <li><a href="index.php?page=listEtudiants&p=1">Liste des etudiants</a></li>
                    <li><a href="index.php?page=listSections&p=1">Liste des Sections</a></li>
                    <li><a href="index.php?page=logout">Logout</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
            $limit = 2;
            $offset = isset($_GET['p']) ? ((int)($_GET['p']) - 1) * $limit : 0;
            ?>
            <h2>Liste des Etudiants</h2>
            <form action="index.php?page=listEtudiants" method="POST">
                <div class="input-container">
                    <input type="text" name="filtrer" placeholder="filtrer">
                    <button type="submit">Filtrer</button>
                </div>
            </form>
            <button class="btn btn-primary" id="EDIT">EDIT</button>
            <button class="btn btn-primary" id="ADD">Add Etudiant</button>
            <div class="container">
                <a href="index.php?page=export&type=csv" class="btn btn-success">Exporter en CSV</a>
                <a href="index.php?page=export&type=pdf" class="btn btn-danger">Exporter en PDF</a>
            </div>
            <form id="hidden" action="index.php?page=listEtudiants" method="POST" style="display:none;">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>name</th>
                            <th>birthday</th>
                            <th>section</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" name="name" placeholder="name"></td>
                            <td><input type="date" name="birthday" placeholder="birthday"></td>
                            <td><input type="text" name="section" placeholder="section"></td>
                        </tr>
                </table>
                <button class="btn btn-danger" type="submit" name="add" value="add">Add</button>
            </form>
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!--  we're creating a pagination so we should get students by page using the limit and offset-->
                <!-- we need to make the pagination here the url should look like this: index.php?page=listEtudiants&page=2 -->
                <tbody>
                    <?php
                    require_once '../../controllers/studentController.php'; //here
                    $studentController = new studentController(); //here
                    if (isset($_SESSION["filtered_name"])) {
                        $name = $_SESSION["filtered_name"];
                        $students = $studentController->getStudentsByName($limit, $offset, $name);
                    } else {
                        $students = $studentController->getStudents($limit, $offset);
                    }
                    unset($_SESSION["filtered_name"]);
                    foreach ($students as $student) { ?>
                        <?php
                        echo "<tr>"; ?>
                        <form action="index.php?page=listEtudiants" method="POST">
                            <?php
                            echo "<td><input disabled type='text' name='id' value='" . htmlspecialchars($student['id']) . "'></td>";
                            echo "<td><input disabled type='text' name='name'  value='" . htmlspecialchars($student['name']) . "'</td>";
                            echo "<td><input disabled type='text' name='birthday' value='" . htmlspecialchars($student['birthday']) . "'</td>";
                            echo "<td><input disabled type='text' name='section'  value='" . htmlspecialchars($student['section']) . "'</td>";
                            echo "<td><button type='submit' name='delete' value='" . htmlspecialchars($student['id']) . "'>Delete</button>  <button type='submit' id='edit' name='edit' value='" . htmlspecialchars($student['id']) . "'>Edit</button></td>";
                            echo "</tr>"; ?>
                        </form>

                    <?php } ?>
                </tbody>
            </table>
            <?php if ($offset >= 2): ?>
                <a href="index.php?page=listEtudiants&p=<?php echo ($offset) / 2 ?>">previous page</a>
            <?php endif; ?>
            <?php echo '<a href="index.php?page=listEtudiants&p=' . ($offset + 4) / 2 . '">next page</a>' ?>
        </main>
        <script>
            let toggleButton = document.getElementById("ADD");
            let s = 0;
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
    </body>
<?php else: ?>
    <h1>you are not logged in</h1>
    <a href="index.php?page=login">Login</a>
<?php endif; ?>

    </html>