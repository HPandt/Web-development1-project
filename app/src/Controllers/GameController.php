<?php

namespace App\Controllers;

use App\Services\Interface\IGameService;
use App\Services\GameService;
use App\Repositories\Interface\IGameRepository;
use App\Services\RoomService;
use App\Services\Interface\IRoomService;
use App\Repositories\RoomRepository;

class GameController {
    private IGameService $gameService;
    private IRoomService $roomService;

    public function __construct(IGameService $gameService, IRoomService $roomService) {
        session_start();
        $this->gameService = $gameService;
        $this->roomService = $roomService;
    }

    // Controller methods to handle game actions
    // Need to rework to fit api structure. for this and future controllers.
    public function gameDashboard() {
        require(__DIR__ . '/../Views/Game/index.php');
    }

    public function startMenu() {
        require(__DIR__ . '/../Views/Game/start_screen.php');
    }
    public function startGame() {
        $characterId = $_SESSION['character_id'] ?? null;
        if ($characterId) {
            $dungeon = $this->gameService->generateDungeon($characterId);
            $_SESSION['dungeon_id'] = $dungeon->id;
            header('Location: /game/dungeon');
            exit();
        } else {
            $error = "Couldnt start game. Error by character not found.";
            header('Location: /game/index');
            exit();
        }
    }

    public function showDungeon() {
        $dungeonId = $_SESSION['dungeon_id'] ?? null;
        if ($dungeonId) {
            $dungeon = $this->gameService->getDungeonById($dungeonId);
            require(__DIR__ . '/../Views/game/dungeon.php');
        } else {
            $error = "Couldnt load dungeon. Error by dungeon not found.";
            header('Location: /start-game');
            exit();
        }
    }

    // public function showCurrentRoom() {
    //     $dungeonId = $_SESSION['dungeon_id'] ?? null;
    //     if ($dungeonId) {
    //         $currentRoomId = $this->gameService->getCurrentRoomId($dungeonId);
    //         $room = $this->roomService->getRoomById($currentRoomId);
    //         require(__DIR__ . '/../Views/Game/room.php');
    //     } else {
    //         header('Location: /start-game');
    //         exit();
    //     }
    // }
}