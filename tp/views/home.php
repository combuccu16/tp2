<?php if (isset($_SESSION['user_id'])): ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/loginGranted.css">
        <title>Home</title>
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
        <h1>Welcome To PHP Lovers ! </h1>
    </body>
<?php else: ?>
    <h1>you are not logged in</h1>
    <a href="index.php?page=login">Login</a>
<?php endif; ?>

    </html>