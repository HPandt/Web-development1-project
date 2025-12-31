<?php

namespace App\Repositories\Interface;

interface IRoomRepesitory {
    public function getRoomById(int $roomId);
    public function getNextRoom(array $currentRoom, string $dir);
    public function markDiscovered(int $roomId);
        
}