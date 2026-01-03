<?php

namespace App\Core;

use App\Models\CharacterModel;
use App\Models\MonsterModel;
use App\Services\GameService;
use App\Services\Interface\IGameService;
use App\Services\RoomService;
use App\Services\Interface\IRoomService;

class Dice{

    private IGameService $gameService;
    private IRoomService $roomService;
    public function __construct(IGameService $gameService, IRoomService $roomService)
    {
        $this->gameService = $gameService;
        $this->roomService = $roomService;
    }
    public static function roll($sides = 20){
        return random_int(1, $sides);
    }

    public static function rollWithStats($statBonus){
        return self::roll() + $statBonus;
    }

    public static function damage(int $numDice, int $sides){
        return random_int(1, $sides);
    }

    
}