<?php

use App\Models\MonsterModel;

/** @var MonsterModel $monster */

class MonsterViewModel {
    /**
     * @var MonsterModel $monster
     */

    public MonsterModel $monster;

    public function __construct(MonsterModel $monster){
        $this->monster = $monster;
    }

    public function getId(): ?int { return $this->monster->id; }
    public function getName(): string { return $this->monster->name; }
    public function getImg(): string { return $this->monster->img; }
    public function getHp(): int { return $this->monster->hp; }
    public function getStrength(): int { return $this->monster->strength; }
    public function getAgility(): int { return $this->monster->agility; }
}