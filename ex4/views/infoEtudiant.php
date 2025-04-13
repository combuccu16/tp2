<?php
require_once "../../controller/studentController.php";
$id = $_GET['id'];
$sc = new StudentController();
$etudiant = $sc->getStudent($id);
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
    <h1>Student Details</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $etudiant['id'] ?></td>
                <td><?= $etudiant['name'] ?></td>
                <td><?= $etudiant['birthday'] ?></td>
            </tr>
        </tbody>
    </table>
    <a href="index.php?page=listEtudiants" class="btn btn-primary" style="margin-left:10px">Back to List</a>
</body>

</html>