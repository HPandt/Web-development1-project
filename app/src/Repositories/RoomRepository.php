<?php 

namespace App\Repositories;
use App\Repositories\Interface\IRoomRepesitory;
use App\Core\Repository;

class RoomRepository extends Repository implements IRoomRepesitory {

    public function getRoomById(int $roomId) {
        $sql = "SELECT * FROM rooms WHERE id = ?";
        $getRoom = $this->getConnection()->query($sql);
        $getRoom->execute([$roomId]);
        return $getRoom->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public function getNextRoom(array $currentRoom, string $dir) {
        $nextRoomId = $currentRoom[$dir . '_room_id'];
        return $this->getRoomById($nextRoomId);
    }

    public function markDiscovered(int $roomId) {
        $sql = "UPDATE rooms SET is_discovered = 1 WHERE id = ?";
        $setMarked = $this->getConnection()->query($sql);
        return $setMarked->execute([$roomId]);
    }
}