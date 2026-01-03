<?php

namespace App\Services;

use App\Core\Dice;
use App\Services\Interface\ICombatService;
use App\Repositories\RoomRepository;
use App\Repositories\DungeonRepository;
use App\Repositories\GameRepository;

class CombatService implements ICombatService{

    private DungeonRepository $dungeonRepo;
    private RoomRepository $roomRepo;
    private GameRepository $gameRepo;

    public function __construct(DungeonRepository $dungeonRepo, RoomRepository $roomRepo, GameRepository $gameRepo){
        $this->dungeonRepo = $dungeonRepo;
        $this->roomRepo = $roomRepo;
        $this->gameRepo = $gameRepo;
    }

    public function fight( int $characterId, int $monsterId ): array{
        $log = [];
        $character = $this->dungeonRepo->getCharacterById($characterId);
        $monster = $this->dungeonRepo->getMonsterById($monsterId);

        if(!$character || !$monster){
            $log[] = "Invalid character or monster.";
            return $log;
        }

        
        while($character->hp > 0 && $monster->hp > 0){
            // Character attacks, need to add game over if player hits zero
            
            $playerRoll = Dice::rollWithStats($character->strength);
            $monsterRoll = Dice::rollWithStats( $monster->agility);

            if($playerRoll > $monsterRoll){
                $damage = Dice::damage(1, 8) + $character->strength;
                $monster->hp -= $damage;
                $log[] = "{$character->name} hits {$monster->name} for {$damage} damage.";
            }else{
                $log[] = "{$character->name} misses {$monster->name}.";
            }

            if($monster->hp <= 0){
                $log[] = "{$monster->name} is defeated!";
                break;
            }

            $playerRoll = Dice::rollWithStats($character->agility);
            $monsterRoll = Dice::rollWithStats( $monster->strength);

            // Monster attacks, need to add abiltiy to go to next room when dead
            
            if($monsterRoll > $character->agility){
                $damage = Dice::damage(1, 6) + $monster->strength;
                $character->hp -= $damage;
                $log[] = "{$monster->name} hits {$character->name} for {$damage} damage.";
            }else{
                $log[] = "{$monster->name} misses {$character->name}.";
            }
        }

        if($character->hp <= 0){
            $log[] = "{$character->name} has been defeated!";
        }

        return $log;
    }
}