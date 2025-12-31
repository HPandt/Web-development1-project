<?php

namespace App\Models\ViewModels;

use App\Models\MonsterModel;

class MonstersViewModel{
    /**
     * @var MonsterModel[]
     */

    public array $monsters;

    public function __construct(array $monsters = []){
        $this->monsters = $monsters;
    }
}