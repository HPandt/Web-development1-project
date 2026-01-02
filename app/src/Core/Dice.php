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
    public $character = new CharacterModel();
    public $monster = new MonsterModel();
    public static function roll($sides = 20){
        return random_int(1, $sides);
    }

    public static function rollWithStats($statBonus){
        return self::roll() + $statBonus;
    }

    public function combat(){
        $playerRoll = self::rollWithStats($this->character->strength);
        $monsterRoll = self::rollWithStats($this->monster->agility);

        if ($playerRoll > $monsterRoll) {
            $damage = rand(5, 15);
            $xpGain = $this->monster->xp_reward;
            $this->gameService->addXP($this->character->id, $xpGain);
            if ($this->monster->hp > 0) {
                # code...
                $this->gameService->reduceMonsterHp($this->monster->id, $damage);
            } else {
                # code...
                $result = "You striked and defeated the {$this->monster->name}!";
            }
        
        } else {
           $damage = rand(5, 15);
           $this->gameService->reduceHp($this->character->id, $damage);
           $result = "The {$this->monster->name} hits you! You lose {$damage} HP.";
        }
    }
}