<?php
require_once("Session.php");

$session = new Session();

if (isset($_POST['reset_session'])) {
    $session->destroy();
}

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exercice 2</title>
    <link rel="stylesheet" href="../common.css">
</head>
<body>
    <h2>Exerice 2</h2>
    <br>
<?php
    if (!$session->isStarted()) {
        $session->start();
        $session->set("n_visits", 1);

        echo "<span>Bienvenue à notre platforme.</span>";
    } else {
        $n_visits = $session->get("n_visits");
        $session->set("n_visits", $n_visits + 1);

        echo "<span>Merci pour votre fidélité. C'est votre " . ($n_visits+1) . "<sup>ème</sup> visite.</span>";
    }
?>
    <br>
    <br>
    <form method="post">
        <input type="hidden" name="reset_session" value="1">
        <button class="btn" type="submit">Réinitialiser la session</button>
    </form>

    <script>
        // Prevent form re-submission on page refresh
        // Otherwise, the session just keeps getting reset after clicking the button once
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>