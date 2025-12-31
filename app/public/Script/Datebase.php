-- users
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE,
  email VARCHAR(255) UNIQUE,
  password_hash VARCHAR(255),
  role ENUM('player','admin') DEFAULT 'player',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- characters
CREATE TABLE characters (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  name VARCHAR(100),
  class ENUM('warrior','rogue','mage'),
  level INT DEFAULT 1,
  hp INT DEFAULT 100,
  strength INT DEFAULT 5,
  agility INT DEFAULT 5,
  luck INT DEFAULT 5,
  experience INT DEFAULT 0,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- dungeons (each playthrough)
CREATE TABLE dungeons (
  id INT AUTO_INCREMENT PRIMARY KEY,
  character_id INT NOT NULL,
  current_room_id INT NULL,
  is_active BOOLEAN DEFAULT TRUE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (character_id) REFERENCES characters(id)
);

-- rooms (can be pre-generated or dynamic)
CREATE TABLE rooms (
  id INT AUTO_INCREMENT PRIMARY KEY,
  dungeon_id INT,
  description TEXT,
  type ENUM('empty','monster','trap','treasure','exit'),
  north_room_id INT NULL,
  south_room_id INT NULL,
  east_room_id INT NULL,
  west_room_id INT NULL,
  discovered BOOLEAN DEFAULT FALSE,
  FOREIGN KEY (dungeon_id) REFERENCES dungeons(id)
);

-- monsters
CREATE TABLE monsters (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  strength INT,
  agility INT,
  hp INT,
  loot_item_id INT NULL,
  xp_reward INT DEFAULT 10
);

-- items
CREATE TABLE items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description TEXT,
  type ENUM('weapon','armor','consumable'),
  bonus_stat VARCHAR(20) NULL,
  bonus_value INT DEFAULT 0
);

-- rolls (for logging dice results)
CREATE TABLE rolls (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  roll_type VARCHAR(50),
  result INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

-- activity logs
CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  character_id INT,
  action TEXT,
  result TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

characters Seed Data
INSERT INTO characters (user_id, name, img, class, level, hp, strength, agility, luck, experience)
VALUES
(1, 'Cassandra Firebird', 'warrior.png', 'warrior', 1, 120, 7, 5, 3, 0),
(2, 'Derek Silverfinger', 'rogue.png', 'rogue', 1, 80, 5, 7, 7, 0),
(3, 'Lucy Blizzard', 'mage.png', 'mage', 1, 70, 5, 6, 5, 0),
(4, 'Ulrich Bloodaxe', 'barbarian.png', 'barbarian', 1, 150, 8, 6, 4, 0);

Basic Item Seeds
INSERT INTO items (name, description, type, bonus_stat, bonus_value)
VALUES
('Rusty Sword', 'An old blade, but still sharp enough.', 'weapon', 'strength', 2),
('Worn Leather Boots', 'Light boots that improve movement.', 'armor', 'agility', 1),
('Healing Herb', 'Restores a small amount of health.', 'consumable', NULL, 10);

Monster Seed Data for Monster Rooms
INSERT INTO monsters (name, strength, agility, hp, loot_item_id, xp_reward)
VALUES
('Cave Goblin', 'Cave_goblin.png', 5, 5, 20, NULL, 15),
('Kobold', 'Kobold.png', 6, 5, 40, NULL, 15),
('Orc', 'Orc.png', 10, 5, 80, NULL, 25),
('Skeleton Knight', 'Skeleton_Knight.png', 8, 5, 75, NULL, 25);

INSERT INTO rooms (dungeon_id, description, type, north_room_id, south_room_id, east_room_id, west_room_id, discovered)
VALUES
-- Entrance Room
(Null, 'You stand in a dimly lit stone chamber. Moist air drips from the ceiling, and you have no recollection of how you got here. All you know is you must escape, proceed young traveler. This is where your story begins', 'empty', NULL, 2, NULL, NULL, 1),
(Null, 'You continue forward into the darkness.', 'empty', 6, 1, 2, 3, 0),
(Null, 'You press on into the unknown.', 'empty', 7, NULL, 3, 1, 0),
(Null, 'You stumble into an empty room', 'empty', NULL, NULL, 6, 4, 0),

-- Monster Room
(Null, 'A guttural growl echoes through the darkness. A creature watches you from the shadows.', 'monster', 1, 3, NULL, NULL, 0),
(Null, 'While walking through the dungeon, you hear a strange noise. in the darkness a monster leaps out at you!', 'monster', 9, 5, 3, 3, 0),
(Null, 'Openning the door, as the light shines in from the candle you notice a monster standing in your way.', 'monster', 8, NULL, 5, 6, 0),


-- Trap Room
(Null, 'Rusty metal plates cover the floor. Something beneath them clicks as you step forward.', 'trap', 2, 4, 9, NULL, 0),
(Null, 'You walked apon a tile floor, but as you take a step you have a click and a arrow shot at you.', 'trap', 2, 4, 7, 7, 0),
(Null, 'While travering the dungeon you notice something shiny on the floor, plague with greed you reach and it was a trap.', 'trap', 4, 6, NULL, NULL, 0),


-- Treasure Room
(Null, 'A dazzling glow fills this chamber. A golden chest rests atop a stone pedestal.', 'treasure', 7, 5, NULL, NULL, 0),
(Null, 'A room of blinding light, covered in engraving of a time long gone what lays before you, a chest.', 'treasure', 3, 7, 8, NULL, 0),
(Null, 'A clear openning stands before you, in the corner a dusty old chest wrap in vines.', 'treasure', 3, 8, NULL, 9, 0),


-- Exit Room
(Null, 'A massive stone archway looms ahead. Freedom lies beyond this final door.', 'exit', 5, 9, 8, 9, 0);
(Null, 'As you walk you notice a bright light in the distance, a door stands before you. You open it and stepped out into the sunlight. You are now free!', 'exit', NULL, 7, 4, 2, 0);


