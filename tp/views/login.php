<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
    <form action="index.php?page=login" method="POST">
        <div class="input-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
        </div>
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
        </div>

        <button type="submit">Login</button>
</body>

</html>