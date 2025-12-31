<?php 

namespace App\Repositories;
use App\Repositories\Interface\IDungeonRepository;

class DungeonRepository implements IDungeonRepository {
    
    public function createCharacter($userId, $characterName, $classType) {
        // Implementation here
    }

    public function updateCharacter($userId, $characterName, $classType) {
        // Implementation here
    }

    public function createItem()
    {
        throw new \Exception('Not implemented');
    }

    public function updateItem()
    {
        throw new \Exception('Not implemented');
    }

    public function createRoom($dungeonId, $name, $description, $monsters, $items, $exits) {
        // Implementation here
    }

    public function updateRoom($dungeonId, $roomId, $name, $description, $monsters, $items, $exits) {
        // Implementation here
    }
}