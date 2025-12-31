<?php

namespace App\Core;

use App\Models\CharacterModel;
use App\Models\MonsterModel;
use App\Repositories\GameRepository;

class Dice{

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
            $this->character->addXp($this->character->id, $xpGain);
            if ($this->monster->hp > 0) {
                # code...
                $this->character->reduceMonsterHp($this->monster->id, $damage);
            } else {
                # code...
                $result = "You striked and defeated the {$this->monster->name}!";
            }
        
        } else {
           $damage = rand(5, 15);
           $this->character->reduceHp($this->character->id, $damage);
           $result = "The {$this->monster->name} hits you! You lose {$damage} HP.";
        }
    }
}