<?php

namespace App\Repositories;

use App\Repositories\Interface\IGameRepository;
use App\Repositories\RoomRepository;
use App\Core\Repository;
use App\Models\ViewModels\RoomsViewModel;


class GameRepository extends Repository implements IGameRepository{
    public function generateDungeon($characterId, $startingRoomId = 30) {
        // Creates a new dungeon for selected character and starts at first room ID -30
        $sql = "INSERT INTO dungeons (character_id, current_room_id) VALUES (?, ?)";
        $createDungeon = $this->getConnection()->query($sql);
        $createDungeon->execute([$characterId, $startingRoomId]);
        // Return last inserted ID
        return $this->getConnection()->lastInsertId();
    }
    public function randomizeRooms($rooms) {
        // For the randomized rooms
         $randomIndex = rand(1, 9);

        return $rooms[$randomIndex];
    }
    public function chooseDirection(int $dungeonId, string $direction) {
        // Implementation here
        $sql = "SELECT r.* FROM dungeons d JOIN rooms r ON r.id = d.current_room_id WHERE d.id = ?";
        $getRooms = $this->getConnection()->prepare($sql);
        $getRooms->execute([$dungeonId]);
        $currentRoom = $getRooms->fetchAll(\PDO::FETCH_ASSOC);

        if (!$currentRoom) {
            return [
                'success' => false,
                'message' => 'Current room not found.'
            ];
        }


        //Direction logic 
        $dir = $direction . "_room_id";
       if(empty($currentRoom[$dir])){
        return ['success' => false, 'reason'=> 'wall'];
       }


        return [
            'success' => true,
            'next_room_id' => $currentRoom[$dir]
        ];
    }

    public function showRoom(int $dungeonId, int $roomId) {
        // Implementation here
        $sql = "SELECT * FROM rooms WHERE id = ? AND dungeon_id = ?";
        $getRoom = $this->getConnection()->query($sql);
        $getRoom->execute([$roomId, $dungeonId]);
    }

    public function addXP( int $characterId, int $xpAmount) {
        // When player defeats monster use experice points from right monster here xpamount
        $sql = "UPDATE characters SET experience = experience + ? WHERE id = ?";
        $addXp = $this->getConnection()->query($sql);
        $addXp->execute([$xpAmount, $characterId]);
        
    }

    public function reduceHp(int $characterId,int $damage) {
        // Implementation here
        $sql = "UPDATE characters SET hp = hp - ? WHERE id = ?";
        $reduceHp = $this->getConnection()->query($sql);
        $reduceHp->execute([$damage, $characterId]);
    }

    public function getCurrentRoom(int $dungeonId) {
        // Implementation here
        $sql = "SELECT r.* FROM rooms r JOIN dungeons d ON r.id = d.current_room_id WHERE d.id = ?";
        $getRoom = $this->getConnection()->query($sql);
        $getRoom->execute([$dungeonId]);
        return $getRoom->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function getDungeonById($dungeonId) {
        // Implementation here
        $sql = "SELECT * FROM dungeons WHERE id = ?";
        $getDungeon = $this->getConnection()->query($sql);
        $getDungeon->execute([$dungeonId]);
        return $getDungeon->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function updateCurrentRoom(int $dungeonId, int $roomId) {
        // Implementation here
        $sql = "UPDATE dungeons SET current_room_id = ? WHERE id = ?";
        $updateRoom = $this->getConnection()->query($sql);
        $updateRoom->execute([$roomId, $dungeonId]);
    }
    public function getCurrentRoomId(int $dungeonId) {
        // Implementation here
        $sql = "SELECT current_room_id FROM dungeons WHERE id = ?";
        $getRoomId = $this->getConnection()->query($sql);
        $getRoomId->execute([$dungeonId]);
        $result = $getRoomId->fetch(\PDO::FETCH_ASSOC);
        return $result ? (int)$result['current_room_id'] : null;
    }
}