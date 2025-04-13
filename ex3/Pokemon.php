<?php

class Pokemon {
    protected $nom, $image, $hp, $attackPokemon;

    /**
     * @throws InvalidArgumentException
     */
    public function  __construct(string $nom, string $image, float $hp, AttackPokemon $attackPokemon) {
        if (!filter_var($image, FILTER_VALIDATE_URL)) {
          throw new InvalidArgumentException("Pokemon::__construct: `image` must be a URL.");
        }
        if ($hp < 0) {
            throw new InvalidArgumentException("Pokemon::__construct: `hp` must be positive.");
        }

        $this->nom = $nom;
        $this->image = $image;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function getNom() : string {
        return $this->nom;
    }
    public function getImage() : string {
        return $this->image;
    }
    public function getHp() : float {
        return $this->hp;
    }
    public function getAttackPokemon() : AttackPokemon {
        return $this->attackPokemon;
    }

    public function setNom (string $nom) {
        $this->nom = $nom;
    }
    public function setImage (string $image) {
        if (!filter_var($image, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("Pokemon::setImage: `image` must be a URL.");
        }
        $this->image = $image;
    }
    public function setHp (float $hp) {
        if ($hp < 0) {
            throw new InvalidArgumentException("Pokemon::setHp: `hp` must be positive.");
        }
        $this->hp = $hp;
    }
    public function setAttackPokemon (AttackPokemon $attackPokemon) {
        $this->attackPokemon = $attackPokemon;
    }

    public function isDead() : bool {
        return ($this->hp <= 0);
    }

    public function attack (Pokemon $p) {
        // attack points is a random number between the min and max attack points
        $atk = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        if (rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack()) {
            $atk = $this->attackPokemon->getSpecialAttack() * $atk;
        } 
        $p->hp -= $atk;
        return $atk;
    }

    public function whoAmI () : string {
        return sprintf("Nom: %s<br>" .
        "HP: %s<br>" .
        "AttackPokemon:" .
        "<ul>" .
        "    <li>attackMinimal: %.2f</li>" .
        "    <li>attackMaximal: %.2f</li>" .
        "    <li>specialAttack: %.2f</li>" .
        "    <li>probabilitySpecialAttack: %d %%</li>" .
        "</ul>",
        $this->nom, $this->hp,
        $this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal(),
        $this->attackPokemon->getSpecialAttack(), $this->attackPokemon->getProbabilitySpecialAttack());
    }

}