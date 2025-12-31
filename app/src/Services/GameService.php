<?php 

namespace App\Services;

use App\Repositories\Interface\IGameRepository;
use App\Services\Interface\IGameService;

class GameService implements IGameService {
    private IGameRepository $gameRepository;
    public function __construct(IGameRepository $gameRepository) {
        $this->gameRepository = $gameRepository;
    }
    // Implementation of game service methods
    public function generateDungeon(int $characterId, int $startingRoomId = 30) {
        return $this->gameRepository->generateDungeon($characterId, $startingRoomId);
    }
    public function randomizeRooms($rooms) {
        return $this->gameRepository->randomizeRooms($rooms);
    }
    public function chooseDirection(int $dungeonId, string $direction) {
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
    public function getCurrentRoom(int $dungeonId, int $roomId) {
        return $this->gameRepository->getCurrentRoom($dungeonId, $roomId);
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