<?php

namespace App\Controllers\Api;

use App\Services\CombatService;
use App\Repositories\RoomRepository;
use App\Repositories\GameRepository;

 class GameApiController{
    private CombatService $combatService;
    private RoomRepository $roomRepo;
    private GameRepository $gameRepo;

    public function __construct( CombatService $combatService, RoomRepository $roomRepo, GameRepository $gameRepo ){
        $this->combatService = $combatService;
        $this->roomRepo = $roomRepo;
        $this->gameRepo = $gameRepo;
    }

    public function fight( int $characterId, int $monsterId ){
        header('Content-Type: application/json');

        $characterId = $_SESSION['character_id'] ?? null;
        $roomId = $_SESSION['current_room_id'] ?? null;
        if(!$characterId || $roomId){
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            return;
        }   
        $room = $this->roomRepo->getRoomById($roomId);

        if($room['Type'] !== 'monster' || $room['monster_id'] !== $monsterId){
            echo json_encode(['success' => false, 'message' => 'No monster to fight here.']);
            return;
        }
        //combat narative moved to service, and logic to repo
        $result = $this->combatService->fight($characterId, $monsterId, $roomId);

        echo json_encode([
            'Description' => $room['desceription'],
            'log' => $result['log'],
            'combatOver' => $result['combatOver'],
            'playerDead' => $result['playerDead'],
            'actions' => $result['combatOver'] ? ["MOVE"] : ["FIGHT"]
        ]);
        exit;
    }

    public function getAvailableDirections(array $room): array {
        $directions = [];
        foreach(['north', 'south', 'east', 'west'] as $dir){
            if(!empty($room[$dir . '_room_id'])){
                $directions[] = $dir;
            }
        }
        return $directions;
    }

    public function move(){
        header('Content-Type: application/json');
        $dungeonId = $_SESSION['dungeon_id'] ?? null;
        $direction = $_POST['direction'] ?? null;

        
        if(!$dungeonId || !$direction){
            echo json_encode(['success' => false, 'message' => 'Invalid request.']);
            exit;
        }

        $currentRoomId = $this->gameRepo->getCurrentRoomId($dungeonId);
        $currentRoom = $this->roomRepo->getRoomById($currentRoomId);

        if($currentRoom['TYPE'] === 'monster' && $currentRoom['monster_current_hp'] > 0){
           echo json_encode([
            'log' => ['The monster blocks your path! You must fight!'],
            'actions' => ['FIGHT']
           ]);
           exit;
        }

        $result = $this->gameRepo->chooseDirection($dungeonId, $direction);
        if(!$result['success']){
            
            echo json_encode([
                'log' => ['You cannot go ' . $direction . '. A wall blocks your path!'],
                'actions' => ['MOVE']
            ]);
            exit;
        }

        $this->gameRepo->updateCurrentRoom($dungeonId, $result['next_room_id']);
        $this->roomRepo->markDiscovered($result['next_room_id']);
        $room = $this->roomRepo->getRoomById($result['next_room_id']);

        $log = "You move " . $direction . " To a new room hoping to escape but what lays before is!";
        echo json_encode([
            'description' => $room['description'],
            'actions' =>[
                'movement' => $this->getAvailableDirections((array)$room),
                'combat' => $room['TYPE'] === 'monster'
            ],
            'log' => [$log]
        ]);
        exit;
    }

    public function roomDisplay(){
        header('Content-Type: application/json');
        $characterId = $_SESSION['character_id'] ?? null;
        $roomId = $_POST['room_id'] ?? null;

        $room = $this->roomRepo->getRoomById($roomId);

        $response = [
            'description' => $room['description'],
            'actions' => [],
            'log' => []
        ];

        if($room['TYPE'] === 'monster' && $room['monster_current_hp'] !== null){
            $combat =$this->combatService->fight($characterId, $room['monster_id'], $roomId);
            $response['log'] = $combat['log'];

            if($combat['playerDead']){
                $response['actions'][] = ['type' => 'Game_Over'];
            }elseif($combat['combatOver']){
                //also shows which directions are available after combat
                $response['actions'][] = ['type' => 'MOVE', 'directions' => $this->getAvailableDirections((array)$room)];
            }else{
                $response['actions'][] = ['type' => 'FIGHT'];
            }
        }elseif($room['TYPE'] === 'exit'){
            $response['log'][] = "Congratulations! You have found the exit and completed the dungeon!";
            $response['actions'][] = ['type' => 'Dungeon_Complete'];
        }else{
            $response['actions'][] = ['type' => 'MOVE', 'directions' => $this->getAvailableDirections((array)$room)];
        }
        
        echo json_encode($response);
        exit;
    }
 }