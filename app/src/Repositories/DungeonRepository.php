<?php 

namespace App\Repositories;
use App\Repositories\Interface\IDungeonRepository;
use App\Core\Repository;
use App\Models\CharacterModel;
use App\Models\itemsModel;
use App\Models\MonsterModel;
use App\Models\RoomsModel;

class DungeonRepository extends Repository implements IDungeonRepository {
    
    public function createCharacter(CharacterModel $characterModel) {
        // Implementation here
        $sql = "INSERT INTO characters (name, img, class, level, hp, strength, agility, luck, experience) VALUES (:name, :img, :class, :level, :hp, :strength, :agility, :luck, :experience)";
        $createCharacter = $this->getConnection()->prepare($sql);
        $class = (int)$_POST['class'] ?? '';
        $level = (int)$_POST['level'] ?? '';
        $hp = (int)$_POST['hp'] ?? '';
        $strength = (int)$_POST['strength'] ?? '';
        $agility = (int)$_POST['agility'] ?? '';
        $luck = (int)$_POST['luck'] ?? '';
        $experience = (int)$_POST['experience'] ?? '';

        $createCharacter->execute([
            ':name' => $characterModel->name,
            ':img' => $characterModel->img,
            ':class' => $characterModel->class,
            ':level' => $characterModel->level,
            ':hp' => $characterModel->hp,
            ':strength' => $characterModel->strength,
            ':agility' => $characterModel->agility,
            ':luck' => $characterModel->luck,
            ':experience' => $characterModel->experience
        ]);
    }

    public function updateCharacter(CharacterModel $characterModel) {
        // Implementation here
        $sql = "UPDATE characters SET name = :name, img = :img, class = :class, level = :level, hp = :hp, strength = :strength, agility = :agility, luck = :luck, experience = :experience WHERE id = :id";
        $updateCharacter = $this->getConnection()->prepare($sql);
        
        $updateCharacter->execute([
            ':id' => $characterModel->id,
            ':name' => $characterModel->name,
            ':img' => $characterModel->img,
            ':class' => $characterModel->class,
            ':level' => $characterModel->level,
            ':hp' => $characterModel->hp,
            ':strength' => $characterModel->strength,
            ':agility' => $characterModel->agility,
            ':luck' => $characterModel->luck,
            ':experience' => $characterModel->experience
        ]);
    }

    public function getAllCharacters()
    {
        $sql = "SELECT * FROM characters";
        $getAllCharacters = $this->getConnection()->prepare($sql);
        $getAllCharacters->execute();
        return $getAllCharacters->fetchAll();
    }

    public function getCharacterById(int $characterId)
    {
        $sql = "SELECT * FROM characters WHERE id = :id";
        $getCharacterById = $this->getConnection()->prepare($sql);   
        $getCharacterById->execute([':id' => $characterId]);
        return $getCharacterById->fetch();
    }

    public function deleteCharacter(int $characterId)
    {
        $sql = "DELETE FROM characters WHERE id = :id";
        $deleteCharacter = $this->getConnection()->prepare($sql);
        $deleteCharacter->execute([':id' => $characterId]);
    }

    public function createMonster(MonsterModel $monsterModel)
    {
        $sql = "INSERT INTO monsters (name, img, strength, agility, hp, xp_reward) VALUES (:name, :img, :strength, :agility, :hp, :xp_reward)";
        $createMonster = $this->getConnection()->prepare($sql);
        $createMonster->execute([
            ':name' => $monsterModel->name,
            ':img' => $monsterModel->img,
            ':strength' => $monsterModel->strength,
            ':agility' => $monsterModel->agility,
            ':hp' => $monsterModel->hp,
            ':xp_reward' => $monsterModel->xp_reward
        ]);
    }

    public function getAllMonsters()
    {
        $sql = "SELECT * FROM monsters";
        $getAllMonsters = $this->getConnection()->prepare($sql);
        $getAllMonsters->execute();
        return $getAllMonsters->fetchAll();
    }

    public function getMonsterById(int $monsterId)
    {
        $sql = "SELECT * FROM monsters WHERE id = :id";
        $getMonsterById = $this->getConnection()->prepare($sql);   
        $getMonsterById->execute([':id' => $monsterId]);
        return $getMonsterById->fetch();
    }

    public function deleteMonster(int $monsterId)
    {
        $sql = "DELETE FROM monsters WHERE id = :id";
        $deleteMonster = $this->getConnection()->prepare($sql);
        $deleteMonster->execute([':id' => $monsterId]);
    }

    public function updateMonster(MonsterModel $monsterModel)
    {
        $sql = "UPDATE monsters SET name = :name, img = :img, strength = :strength, agility = :agility, hp = :hp, xp_reward = :xp_reward WHERE id = :id";
        $updateMonster = $this->getConnection()->prepare($sql);
        $updateMonster->execute([
            ':id' => $monsterModel->id,
            ':name' => $monsterModel->name,
            ':img' => $monsterModel->img,
            ':strength' => $monsterModel->strength,
            ':agility' => $monsterModel->agility,
            ':hp' => $monsterModel->hp, 
            ':xp_reward' => $monsterModel->xp_reward
        ]);
    }

    public function createItem(itemsModel $itemModel)
    {
        throw new \Exception('Not implemented');
    }
    

    public function updateItem(itemsModel $itemModel)
    {
        throw new \Exception('Not implemented');
    }

    public function deleteItem(int $itemId)
    {
        throw new \Exception('Not implemented');
    }


    public function createRoom(RoomsModel $roomsModel) {
        // Implementation here
        $sql = "INSERT INTO rooms ( description, type, north_room_id, south_room_id, east_room_id, west_room_id, discovered) VALUES (:description, :type, :north_room_id, :south_room_id, :east_room_id, :west_room_id, :discovered)";
        $createRoom = $this->getConnection()->prepare($sql);
        $northroom = (int)$_POST['northroom'] ?? '';
        $southroom = (int)$_POST['southroom'] ?? '';
        $eastroom = (int)$_POST['eastroom'] ?? '';
        $westroom = (int)$_POST['westroom'] ?? '';
        $dicovered = (int)$_POST['dicovered'] ?? '';

        $createRoom->execute([
            ':description' => $roomsModel->description,
            ':type' => $roomsModel->type,
            ':north_room_id' => $roomsModel->northroom,
            ':south_room_id' => $roomsModel->southroom,
            ':east_room_id' => $roomsModel->eastroom,
            ':west_room_id' => $roomsModel->westroom,
            ':discovered' => $roomsModel->discovered
        ]); 
    }

    public function updateRoom( RoomsModel $roomsModel) {
        // Implementation here
        $sql = "UPDATE rooms SET description = :description, type = :type, north_room_id = :north_room_id, south_room_id = :south_room_id, east_room_id = :east_room_id, west_room_id = :west_room_id, discovered = :discovered WHERE id = :id";
        $updateRoom = $this->getConnection()->prepare($sql);
        // $northroom = (int)$_POST['northroom'] ?? '';
        // $southroom = (int)$_POST['southroom'] ?? '';
        // $eastroom = (int)$_POST['eastroom'] ?? '';
        // $westroom = (int)$_POST['westroom'] ?? '';
        // $dicovered = (int)$_POST['dicovered'] ?? '';
        $updateRoom->execute([
            ':id' => $roomsModel->id,
            ':description' => $roomsModel->description,
            ':type' => $roomsModel->type,
            ':north_room_id' => $roomsModel->northroom,
            ':south_room_id' => $roomsModel->southroom,
            ':east_room_id' => $roomsModel->eastroom,
            ':west_room_id' => $roomsModel->westroom,
            ':discovered' => $roomsModel->discovered
        ]);
    }

     public function deleteRoom(int $roomId)
    {
        $sql = "DELETE FROM rooms WHERE id = :id";
        $deleteRoom = $this->getConnection()->prepare($sql);
        $deleteRoom->execute([':id' => $roomId]);
    }

    public function getRoomById(int $roomId)
    {
        $sql = "SELECT * FROM rooms WHERE id = :id";
        $getRoomById = $this->getConnection()->prepare($sql);
        $getRoomById->execute([':id' => $roomId]);
        return $getRoomById->fetch();
    }

    public function getAllRooms()
    {
        $sql = "SELECT * FROM rooms";
        $getAllRooms = $this->getConnection()->prepare($sql);
        $getAllRooms->execute();
        return $getAllRooms->fetchAll();
    }

    public function deleteUser(int $userId)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $deleteUser = $this->getConnection()->prepare($sql);
        $deleteUser->execute([':id' => $userId]);
    }

    public function getUserById(int $userId)
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $getUserById = $this->getConnection()->prepare($sql);
        $getUserById->execute([':id' => $userId]);
        return $getUserById->fetch();
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $getAllUsers = $this->getConnection()->prepare($sql);
        $getAllUsers->execute();
        return $getAllUsers->fetchAll();
    }

}