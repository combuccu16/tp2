<?php
include_once "auto_loader.php";

$name1= "bidoof";
$image1= "https://assets.pokemon.com/assets/cms2/img/pokedex/full//399.png";
$hp1= 500;
$attack1 = new AttackPokemon(10,100,4,20);

$name2= "giratina";
$image2= "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtlkYUbGQ52dfxVGIRgdlfV6_l5xW2cptVKw&s";
$hp2= 400;
$attack2 = new AttackPokemon(10,90,3,25);

$pokemon1 = new PokemonEau($name1, $image1, $hp1, $attack1);
$pokemon2 = new PokemonFeu($name2, $image2, $hp2, $attack2);
?>
<!doctype html>
<html>
<head>
    <title>Exercice 3</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../common.css">
</head>
<body>
    <h2>Exercice 3</h2>
    <?php
    $winner= null;
    $round= 1;
    $degat1=0;
    $degat2=0;
    while ($winner === null) {
        if ($round % 2 == 0) {
            $degat1 = $pokemon1->attack($pokemon2);
            $degat2 = 0;
        } else {
            $degat1 = 0;
            $degat2 = $pokemon2->attack($pokemon1);
        }

        if($pokemon1->isDead() || $pokemon2->isDead()) {
            if($pokemon1->getHp() > $pokemon2->getHp()) {
                $winner= $pokemon1->getNom();
            }
            elseif($pokemon1->getHp() < $pokemon2->getHp()) {
                $winner = $pokemon2->getNom();
            }
            else {
                $winner= "tie";
            }
        }
    ?>
        
    <div class="row space-even">
        <div class="col">
            <div class="card">
                <img class="card-img" src="<?= $pokemon1->getImage() ?>" alt="<?= $pokemon1->getNom() ?>">
                <div class="card-text">
                     <?= $pokemon1->whoAmI() ?>
                </div>
            </div>
                <div class="notif bg-red text-center <?= ($round%2 === 0 ? "" : "hidden") ?>" style="width: 300px">
                    <?= ucfirst($pokemon1->getNom()) . " attaque et inflige des dégats de " . $degat1 . "!" ?>
                </div>
        </div>

        <div class="col">
            <div class="card">
                <img class="card-img" src="<?= $pokemon2->getImage() ?>" alt="<?= $pokemon2->getNom() ?>">
                <div class="card-text">
                    <?= $pokemon2->whoAmI() ?>
                </div>
            </div>
            <div class="notif bg-red text-center <?= ($round%2 === 1 ? "" : "hidden") ?>" style="width: 300px">
                <?= ucfirst($pokemon2->getNom()) . " attaque et inflige des dégats de " . $degat2 . "!" ?>
            </div>
        </div>

    </div>
    <br><br>
    <?php
        $round += 1;
    } 
    ?>
    <div style="display: flex; justify-content: center">
    <div class="notif bg-green text-center" style="width: 300px; display: flex; justify-content: center">
        <?= $winner === "tie" ? "Partie nulle!" : "Le vainqueur est " . ucfirst($winner) . "!" ?>
    </div>
    </div>
</body>
</html>