<?php
require_once "../../controller/studentController.php";
$sc = new StudentController();
$etudiants = $sc->getAllStudents();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <h1>Students List</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($etudiants as $etudiant) : ?>
                <tr>
                    <td>
                        <?= $etudiant['id'] ?>
                    </td>
                    <td>
                        <?= $etudiant['name'] ?>
                    </td>
                    <td>
                        <?= $etudiant['birthday'] ?>
                    </td>

                    <?php echo '<td><a href="index.php?page=infoEtudiant&id=' . $etudiant['id'] . '">Check</a></td>' ?>
                </tr>
            <?php endforeach; ?>
    </table>
</body>

</html>