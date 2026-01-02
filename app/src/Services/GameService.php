<?php 

namespace App\Services;

use App\Repositories\Interface\IGameRepository;
use App\Services\Interface\IGameService;
use App\Repositories\RoomRepository;

class GameService implements IGameService {
    private IGameRepository $gameRepository;
    private RoomRepository $roomRepository;
    public function __construct(IGameRepository $gameRepository, RoomRepository $roomRepository) {
        $this->gameRepository = $gameRepository;
        $this->roomRepository = $roomRepository;
    }
    // Implementation of game service methods
    public function generateDungeon(int $characterId, int $startingRoomId = 30) {
        return $this->gameRepository->generateDungeon($characterId, $startingRoomId);
    }
    public function randomizeRooms($rooms) {
        return $this->gameRepository->randomizeRooms($rooms);
    }
    public function chooseDirection(int $dungeonId, string $direction) {
        if (!in_array($direction, ['north', 'south', 'east', 'west'])) {
            throw new \InvalidArgumentException("Invalid direction: $direction");
        }

        $currentRoom = $this->gameRepository->getCurrentRoom($dungeonId);

        if (!$currentRoom){
            return [
                'success' => false,
                'message' => 'Current room not found.'
            ];
        }

        $nextRoomId = $this->gameRepository->chooseDirection($dungeonId, $direction);
        if ($nextRoomId === null) {
            return [
                'success' => false,
                'message' => 'You walk into a wall. You must choose another direction.'
            ];
        }

        $nextRoom = $this->gameRepository->getCurrentRoomId($nextRoomId);
        if (!$nextRoom) {
            return [
                'success' => false,
                'message' => 'Next room not found.'
            ];
        }

        $this->gameRepository->updateCurrentRoom($dungeonId, $nextRoomId);
        $this->roomRepository->markDiscovered($nextRoomId);

        return $this->gameRepository->chooseDirection($dungeonId, $direction);
    }
    public function showRoom(int $dungeonId, int $roomId) {
        return $this->gameRepository->showRoom($dungeonId, $roomId);
    }
    public function addXP(int $characterId, int $xpAmount) {
        return $this->gameRepository->addXP($characterId, $xpAmount);
    }
    public function reduceHp(int $characterId, int $hpAmount) {
        return $this->gameRepository->reduceHp($characterId, $hpAmount);
    }
    public function reduceMonsterHp(int $monsterId, int $hpAmount) {
        return $this->gameRepository->reduceMonsterHp($monsterId, $hpAmount);
    }
    public function getCurrentRoom(int $dungeonId) {
        return $this->gameRepository->getCurrentRoom($dungeonId);
    }
    public function getDungeonById(int $dungeonId) {
        return $this->gameRepository->getDungeonById($dungeonId);
    }
    public function updateCurrentRoom(int $dungeonId, int $roomId) {
        return $this->gameRepository->updateCurrentRoom($dungeonId, $roomId);
    }
    public function getCurrentRoomId(int $dungeonId) {
        return $this->gameRepository->getCurrentRoomId($dungeonId);
    }
    
    
}