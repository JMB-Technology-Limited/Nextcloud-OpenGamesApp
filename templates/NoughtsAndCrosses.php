<?php

/**
 * @author James Baster <james@jmbtechnology.co.uk>
 * @copyright Copyright (c) 2017, JMB Technology Limited.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */
style('opengames', 'noughtsandcrosses');
?>
<div class="NoughtsAndCrossesPage">

    <div class="NoughtsAndCrossesHeader">
        Let's play!
        <?php if ($_['whoToMove'] === -1) { ?>
            <img src="<?php print_unescaped(image_path('opengames', 'cross-small.png')); ?>" />
        <?php } else { ?>
            <img src="<?php print_unescaped(image_path('opengames', 'nought-small.png')); ?>" />
        <?php } ?>
        to move!
    </div>

    <?php if ($_['showOtherPlayerMovedError']) { ?>
        <div class="NoughtsAndCrossesHeader">
            Sorry, while you were thinking someone else moved! Try again.
        </div>
    <?php } ?>

    <table class="NoughtsAndCrossesBoard">
        <?php for ($row = 1; $row <= 3; $row++) { ?>
            <tr class="NoughtsAndCrossesBoardRow">
                <?php for ($col = 1; $col <= 3; $col++) { ?>
                    <td class="NoughtsAndCrossesBoardCell">
                        <a href="?cell=<?php p($row) ?><?php p($col) ?>&state=<?php p($_['stateString']) ?>">
                            <?php if ($_['data']['board'][$row][$col] === 1) { ?>
                                <img src="<?php print_unescaped(image_path('opengames', 'nought.png')); ?>" />
                            <?php } elseif ($_['data']['board'][$row][$col] === -1) { ?>
                                <img src="<?php print_unescaped(image_path('opengames', 'cross.png')); ?>" />
                            <?php } ?>
                        </a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>

    <?php if ($_['inProgress'] && $_['players']) {  ?>
        <div class="NoughtsAndCrossesPlayersHeader">Players:</div>
        <ul>
            <?php foreach($_['players'] as $player) { ?>
                <li><?php p($player) ?></li>
            <?php } ?>
        </ul>


    <?php } ?>

    <?php if ($_['lastWhichSideWon'] !== 0 || $_['lastIsGameOverWithNoWinner']) { ?>

        <?php if ($_['lastIsGameOverWithNoWinner']) { ?>
            <div class="NoughtsAndCrossesHeader">No-one won the last game!</div>
        <?php } else { ?>
            <div class="NoughtsAndCrossesHeader">
                <?php if ($_['lastWhichSideWon'] === -1) { ?>
                    <img src="<?php print_unescaped(image_path('opengames', 'cross-small.png')); ?>" />
                <?php } else { ?>
                    <img src="<?php print_unescaped(image_path('opengames', 'nought-small.png')); ?>" />
                <?php } ?>
                won the last game!
            </div>
        <?php } ?>


        <table class="NoughtsAndCrossesBoard">
            <?php for ($row = 1; $row <= 3; $row++) { ?>
                <tr class="NoughtsAndCrossesBoardRow">
                    <?php for ($col = 1; $col <= 3; $col++) { ?>
                        <td class="NoughtsAndCrossesBoardCell">
                            <div class="NoughtsAndCrossesBoardContents">
                                <?php if ($_['lastData']['board'][$row][$col] === 1) { ?>
                                    <img src="<?php print_unescaped(image_path('opengames', 'nought.png')); ?>" />
                                <?php } elseif ($_['lastData']['board'][$row][$col] === -1) { ?>
                                    <img src="<?php print_unescaped(image_path('opengames', 'cross.png')); ?>" />
                                <?php } ?>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </table>

        <div class="NoughtsAndCrossesPlayersHeader">Players in the last game:</div>
        <ul>
            <?php foreach($_['lastPlayers'] as $player) { ?>
                <li><?php p($player) ?></li>
            <?php } ?>
        </ul>

    <?php } ?>

</div>