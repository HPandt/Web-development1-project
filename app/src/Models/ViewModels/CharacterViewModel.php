<?php

namespace App\Models\ViewModels;

use App\Models\CharacterModel;

class CharacterViewModel{
    /**
     * @var CharacterModel $character
     */

    public CharacterModel $character;

    public function __construct(CharacterModel $character){
        
    }
    public function getId(): ?int { return $this->character->id; }
    public function getName(): string { return $this->character->name; }
    public function getImg(): string { return $this->character->img; }
    public function getClass(): int { return $this->character->class; }
    public function getLevel(): int { return $this->character->level; }
    public function getHp(): int { return $this->character->hp; }
    public function getStrength(): int { return $this->character->strength; }
    public function getAgility(): int { return $this->character->agility; }
    public function getLuck(): int { return $this->character->luck; }
    public function getExperience(): int { return $this->character->experience; }

}