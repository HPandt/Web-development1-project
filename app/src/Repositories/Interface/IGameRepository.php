<?php

namespace App\Repositories\Interface;

use Apps\Models\ViewModels\RoomsViewModel; 
use Apps\Models\ViewModels\DungeonViewModel;


interface IGameRepository {
    public function generateDungeon(int $characterId, int $startingRoomId = 30);
    public function randomizeRooms($rooms);
    public function chooseDirection(int $dungeonId, string $direction);
    public function showRoom(int $dungeonId, int $roomId);
    public function addXP(int $characterId, int $xpAmount);
    public function reduceHp(int $characterId, int $hpAmount);
    public function reduceMonsterHp(int $monsterId, int $hpAmount);
    public function getCurrentRoom(int $dungeonId, int $roomId);
    public function getDungeonById(int $dungeonId);
    public function updateCurrentRoom(int $dungeonId, int $roomId);
    public function getCurrentRoomId(int $dungeonId);
    
}