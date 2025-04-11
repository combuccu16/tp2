 <?php if (isset($_SESSION['user_id'])): ?>
     <?php
        require_once '../../controllers/studentController.php'; //here
        $studentController = new studentController(); //here
        $limit = 2;
        $offset = isset($_GET['p']) ? ((int)($_GET['p']) - 1) * $limit : 0;
        $students = $studentController->getStudentsBySection($_GET['section'], $offset, $limit);
        ?>
     <!DOCTYPE html>
     <html lang="en">

     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
         <?php echo "<title>" . $_GET['section'] . " Students</title>" ?>
     </head>

     <body>
         <table class="table">
             <thead>
                 <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Birthday</th>
                     <th>Section</th>
                 </tr>
             </thead>
             <tbody>
                 <?php foreach ($students as $student): ?>
                     <tr>
                         <td><?php echo $student['id']; ?></td>
                         <td><?php echo $student['name']; ?></td>
                         <td><?php echo $student['birthday']; ?></td>
                         <td><?php echo $student['section']; ?></td>
                     </tr>
                 <?php endforeach; ?>
         </table>
         <?php if ($offset >= 2): ?>
             <?php echo '<a href="index.php?page=viewListedStudents&section' . $_GET['section'] . '&p=' . ($offset) / 2 . '>previous page</a>' ?>
         <?php endif; ?>
         <?php echo '<a href="index.php?page=viewListedStudents&section=' . $_GET['section'] . '&p=' . ($offset + 4) / 2 . '">next page</a>' ?>
     </body>
 <?php else : ?>
     <h1>you have to log in to see this page</h1>
     <a href="index.php?page=login">Login</a>
 <?php endif  ?>

     </html>