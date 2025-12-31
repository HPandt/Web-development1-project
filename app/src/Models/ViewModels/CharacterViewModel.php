<?php

namespace App\Models\ViewModels;

use App\Models\CharacterModel;

class CharacterViewModel{
    /**
     * @var CharacterModel[]
     */

    public array $monsters;

    public function __construct(array $monsters = []){
        $this->monsters = $monsters;
    }
}