<?php

namespace App\Services\Interface;

use App\Models\CharacterModel;
use App\Models\MonsterModel;
use App\Models\UserModel;
use App\Models\itemsModel;
use App\Models\RoomsModel;

interface IDungeonService {
    
    public function createCharacter(CharacterModel $characterModel);
    public function updateCharacter(CharacterModel $characterModel);
    public function deleteCharacter(int $characterId);
    public function createMonster(MonsterModel $monsterModel);
    public function updateMonster(MonsterModel $monsterModel);
    public function deleteMonster(int $monsterId);
    public function createItem(itemsModel $itemModel);
    public function updateItem(itemsModel $itemModel);
    public function deleteItem(int $itemId);
    public function createRoom( RoomsModel $roomModel);
    public function updateRoom( RoomsModel $roomModel);
    public function deleteRoom(int $roomId);
    public function getAllUsers();
    public function getUserById(int $userId);
    public function deleteUser(int $userId);
    public function getAllCharacters();
    public function getCharacterById(int $characterId);
    public function getAllMonsters();
    public function getMonsterById(int $monsterId);

}