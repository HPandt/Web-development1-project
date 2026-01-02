<?php 

namespace App\Services;

use App\Models\CharacterModel;
use App\Models\itemsModel;
use App\Models\MonsterModel;
use App\Models\RoomsModel;
use App\Repositories\Interface\IDungeonRepository;
use App\Services\Interface\IDungeonService;

class DungeonService implements IDungeonService {
    private IDungeonRepository $dungeonRepository;
    public function __construct(IDungeonRepository $dungeonRepository) {
        $this->dungeonRepository = $dungeonRepository;
    }

    public function createCharacter(CharacterModel $characterModel){
        if(empty($characterModel->name) || empty($characterModel->img) || $characterModel->class < 0){
            throw new \InvalidArgumentException("Invalid character data");
        }
        return $this->dungeonRepository->createCharacter($characterModel);
    }
    public function updateCharacter(CharacterModel $characterModel){
        return $this->dungeonRepository->updateCharacter($characterModel);
    }
    public function getAllCharacters()
    {
        return $this->dungeonRepository->getAllCharacters();
    }
    public function getCharacterById(int $characterId)
    {
        throw new \Exception('Not implemented');
    }
    public function deleteCharacter(int $characterId){
        return $this->dungeonRepository->deleteCharacter($characterId);
    }
    public function createMonster(MonsterModel $monsterModel){
        return $this->dungeonRepository->createMonster($monsterModel);
    }
    public function updateMonster(MonsterModel $monsterModel){
        return $this->dungeonRepository->updateMonster($monsterModel);
    } 
    public function getAllMonsters()
    {
        return $this->dungeonRepository->getAllMonsters();
    } 
    public function getMonsterById(int $monsterId)
    {
        throw new \Exception('Not implemented');
    }
    public function deleteMonster(int $monsterId){
        return $this->dungeonRepository->deleteMonster($monsterId);
    }
    public function createItem(itemsModel $itemModel){
        return $this->dungeonRepository->createItem($itemModel);
    }
    public function updateItem(itemsModel $itemModel){
         return $this->dungeonRepository->updateItem($itemModel);
    }
    public function deleteItem(int $itemId){
        return $this->dungeonRepository->deleteItem($itemId);
    }
    public function createRoom(RoomsModel $roomsModel){
        if(empty($roomsModel->description) || $roomsModel->type < 0){
            throw new \InvalidArgumentException("Invalid room data");
        }
        return $this->dungeonRepository->createRoom($roomsModel);
    }
    public function updateRoom(RoomsModel $roomsModel){
        if($roomsModel->id <= 0 || empty($roomsModel->description) || $roomsModel->type < 0){
            throw new \InvalidArgumentException("Invalid room data");
        }
        return $this->dungeonRepository->updateRoom($roomsModel);
    }
    
    public function deleteRoom(int $roomId){
        if($roomId <= 0){
            throw new \InvalidArgumentException("Invalid room ID");
        }
        return $this->dungeonRepository->deleteRoom($roomId);
    }
    public function getAllUsers()
    {
        return $this->dungeonRepository->getAllUsers();
    }
    public function getUserById(int $userId)
    {
        throw new \Exception('Not implemented');
    }
    public function deleteUser(int $userId)
    {
        throw new \Exception('Not implemented');
    }  

}