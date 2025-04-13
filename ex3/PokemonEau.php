<?php

class PokemonEau extends Pokemon {
    public function attack(Pokemon $p) : float {
        $atk = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        if ($p instanceof PokemonFeu) {
            $atk *= 2;
        } else {
            $atk *= 0.5;
        }

        if (rand(1, 100) <= $this->attackPokemon->getProbabilitySpecialAttack()) {
            $p->hp -= $this->attackPokemon->getSpecialAttack() * $atk;
            return $this->attackPokemon->getSpecialAttack() * $atk;
        } else {
            $p->hp -= $atk;
            return $atk;
        }
    }

    public function whoAmI(): string {
        return parent::whoAmI() . "Type: Eau";
    }
}