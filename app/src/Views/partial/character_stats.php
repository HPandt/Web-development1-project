<?php

use App\Models\ViewModels\CharactersViewModel;

/** @var CharactersViewModel $charactersVm  */
    
foreach ($charactersVm->characters as $character) { ?>
    <li>Level: <?php echo htmlspecialchars($character->level); ?></li>
    <li>Health: <?php echo htmlspecialchars($character->hp); ?></li>
    <li>Strength: <?php echo htmlspecialchars($character->strength); ?></li>
    <li>Defense: <?php echo htmlspecialchars($character->agility); ?></li>
    <li>Experience: <?php echo htmlspecialchars($character->experience); ?></li>
<?php } ?>