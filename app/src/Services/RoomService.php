<?php 

namespace App\Services;

use App\Repositories\Interface\IRoomRepesitory;
use App\Services\Interface\IRoomService;
use App\Repositories\Interface\IRoomRepository;

class RoomService implements IRoomService {
    private IRoomRepesitory $roomRepository;
    public function __construct(IRoomRepesitory $roomRepository) {
        $this->roomRepository = $roomRepository;
    }
    // Implementation of room service methods
    public function getRoomById(int $roomId) {
        return $this->roomRepository->getRoomById($roomId);
    }
    public function getNextRoom(array $currentRoom, string $dir) {
        return $this->roomRepository->getNextRoom($currentRoom, $dir);
    }
    public function markDiscovered(int $roomId) {
        return $this->roomRepository->markDiscovered($roomId);
    }
    
}