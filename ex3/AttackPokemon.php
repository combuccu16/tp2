<?php

class AttackPokemon {
    private $attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack;

    public function __construct(int $min, int $max, float $special, int $probability) {
        $this->attackMinimal = $min;
        $this->attackMaximal = $max;
        $this->specialAttack = $special;
        $this->probabilitySpecialAttack = $probability;
    }

    public function getAttackMinimal(): int{
        return $this->attackMinimal;
    }

    public function setAttackMinimal(int $value) {
        $this->attackMinimal = $value;
    }

    public function getAttackMaximal(): int {
        return $this->attackMaximal;
    }

    public function setAttackMaximal(int $value) {
        $this->attackMaximal = $value;
    }
    
    public function getSpecialAttack(): float {
        return $this->specialAttack;
    }

    public function setSpecialAttack(float $value) {
        $this->specialAttack = $value;
    }

    public function getProbabilitySpecialAttack(): int {
        return $this->probabilitySpecialAttack;
    }

    public function setProbabilitySpecialAttack(int $value) {
        $this->probabilitySpecialAttack = $value;
    }
}