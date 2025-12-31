-- Characters:
INSERT INTO `characters` (`id`, `user_id`, `name`, `img`, `class`, `level`, `hp`, `strength`, `agility`, `luck`, `experience`) 
VALUES (NULL, NULL, 'Cassandra Firebird', NULL, 'warrior', '1', '120', '8', '6', '5', '0'), 
(NULL, NULL, 'Derek Silverfinger', NULL, 'rogue', '1', '100', '6', '7', '7', '0'), 
(NULL, NULL, 'Lucy Blizzard', NULL, 'mage', '1', '80', '5', '8', '8', '0');

-- Monsters:
INSERT INTO `monsters` (`id`, `name`, `img`, `strength`, `agility`, `hp`, `loot_item_id`, `xp_reward`) 
VALUES (NULL, 'Goblin', NULL, '5', '5', '50', NULL, '10'), 
(NULL, 'Kobold', NULL, '7', '6', '65', NULL, '15'), 
(NULL, 'Orc', NULL, '10', '5', '80', NULL, '20');

--Rooms


-- Items
INSERT INTO items (name, description, type, bonus_stat, bonus_value)
VALUES
('Rusty Sword', 'An old blade, but still sharp enough.', 'weapon', 'strength', 2),
('Worn Leather Boots', 'Light boots that improve movement.', 'armor', 'agility', 1),
('Healing Herb', 'Restores a small amount of health.', 'consumable', NULL, 10);