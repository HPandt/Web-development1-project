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

    public function fight( int $characterId, int $monsterId, int $roomId ): array{
        $log = [];
        $character = $this->dungeonRepo->getCharacterById($characterId);
        $room = $this->roomRepo->getRoomById($roomId);
        $monster = $this->dungeonRepo->getMonsterById($monsterId);

        if(!$character || !$room || $room->Type !== 'monster'){
            $log[] = "Invalid character or monster.";
            return $log;
        }
        
        //to make monsters reusable have to set a second hp variable. mishap with db monsters
        $monsterHp = $room['monster_current_hp'] ?? $monster->hp;

        // Character attacks, need to add game over if player hits zero
        
        $playerRoll = Dice::rollWithStats($character->strength);
        $monsterRoll = Dice::rollWithStats( $monster->agility);

        if($playerRoll > $monsterRoll){
            $damage = Dice::damage(1, 8) + $character->strength;
            $monsterHp -= $damage;
            $this->roomRepo->updateMonsterHp($roomId, $monsterHp);
            $log[] = "{$character->name} hits {$monster->name} for {$damage} damage.";
        }else{
            $log[] = "{$character->name} misses {$monster->name}.";
        }

        if($monsterHp <= 0){
            $this->roomRepo->MonsterDefeated($roomId);
            $this->gameRepo->addXP($character->id, $monster->xp_reward);
            $log[] = "{$monster->name} is defeated! You manage to survive another room, it is now safe!";

            return [
            'log' => $log, 
            'playerDead' => false,
            'combatOver'=> true,
            'roomSafe' => true
            ];
        }

        //Monster turn
        $playerRoll = Dice::rollWithStats($character->agility);
        $monsterRoll = Dice::rollWithStats( $monster->strength);

        // Monster attacks, need to add abiltiy to go to next room when dead
        
        if($monsterRoll > $character->agility){
            $damage = Dice::damage(1, 6) + $monster->strength;
            $character->hp -= $damage;
            $this->gameRepo->reduceHp($character->id, $damage);

            $log[] = "{$monster->name} hits {$character->name} for {$damage} damage.";
        }else{
            $log[] = "{$monster->name} misses {$character->name}.";
        }

        
        if($character->hp <= 0){
        $log[] = "{$character->name} has been defeated! You tried but it wasnt enough... Game Over.";
        return [
            'log' => $log, 
            'playerDead' => true,
            'combatOver'=> true
        ];
        }
        return [
            'log' => $log, 
            'playerDead' => false,
            'combatOver'=> false,
            'monsterHp' => $monsterHp
        ];
    }
}