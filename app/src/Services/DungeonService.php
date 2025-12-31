<?php 

namespace App\Services;

use App\Repositories\Interface\IDungeonRepository;
use App\Services\Interface\IDungeonService;

class DungeonService implements IDungeonService {
    private IDungeonRepository $dungeonRepository;
    public function __construct(IDungeonRepository $dungeonRepository) {
        $this->dungeonRepository = $dungeonRepository;
    }

    public function createCharacter($userId, $characterName, $classType){
    return $this->dungeonRepository->createCharacter($userId, $characterName, $classType);
    }
    public function updateCharacter($userId, $characterName, $classType){
        return $this->dungeonRepository->updateCharacter($userId, $characterName, $classType);
    }
    public function createItem(){
        return $this->dungeonRepository->createItem();
    }
    public function updateItem(){
        return $this->dungeonRepository->updateItem();
    }
    public function createRoom($dungeonId, $name, $description, $monsters, $items, $exits){
        return $this->dungeonRepository->createRoom($dungeonId, $name, $description, $monsters, $items, $exits);
    }
    public function updateRoom($dungeonId, $roomId, $name, $description, $monsters, $items, $exits){
        return $this->dungeonRepository->updateRoom($dungeonId, $roomId, $name, $description, $monsters, $items, $exits);
    }

}