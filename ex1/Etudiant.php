<?php

class Etudiant {
    private $nom, $notes;

    public function __construct(string $nom, array $notes_arr) {
        $this->nom = $nom;

        foreach ($notes_arr as $note) {
            if ((!is_float($note) && !is_int($note) ) || $note < 0 || $note > 20) {
                throw new InvalidArgumentException("Etudiant::__construct(): \$notes must be an array of floats between 0 and 20.");
            }
        }
        $this->notes = $notes_arr;
    }

    public function getNom() : string {
        return $this->nom;
    }
    public function getNotes() : array {
        return $this->notes;
    }
    public function getMoyenne() : float {
        $moy = 0;
        foreach ($this->notes as $note) {
            $moy += $note;
        }
        $moy /= count($this->notes);
        return $moy;
    }
    public function isAdmis() : string {
        return ($this->getMoyenne() >= 10 ? "Admis" : "Non admis");
    }
}