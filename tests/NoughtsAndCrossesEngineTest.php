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
class NoughtsAndCrossesEngineTest extends PHPUnit_Framework_TestCase  {

    function testStart() {
        $game = new \OCA\OpenGames\Engine\NoughtsAndCrossesEngine();
        $game->startNewGame();
        $this->assertEquals(0, $game->whichSideWon());
        $this->assertFalse($game->isGameOverWithNoWinner());

    }

    function testHorizontalLine1() {

        $game = new \OCA\OpenGames\Engine\NoughtsAndCrossesEngine();
        $game->startNewGame();
        $game->move(1,1);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(3,1);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(1,2);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(3,2);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(1,3);  # player 1
        $this->assertEquals(1, $game->whichSideWon());
        $this->assertFalse($game->isGameOverWithNoWinner());

    }

    function testVerticalLine1() {
        $game = new \OCA\OpenGames\Engine\NoughtsAndCrossesEngine();
        $game->startNewGame();
        $game->move(1,1);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(1,3);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(2,1);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(2,3);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(3,1);  # player 1
        $this->assertEquals(1, $game->whichSideWon());
        $this->assertFalse($game->isGameOverWithNoWinner());


    }

    function testDiagonalBackSlash() {
        $game = new \OCA\OpenGames\Engine\NoughtsAndCrossesEngine();
        $game->startNewGame();
        $game->move(1,1);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(1,3);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(2,2);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(2,3);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(3,3);  # player 1
        $this->assertEquals(1, $game->whichSideWon());
        $this->assertFalse($game->isGameOverWithNoWinner());

    }

    function testDiagonalForwardSlash() {
        $game = new \OCA\OpenGames\Engine\NoughtsAndCrossesEngine();
        $game->startNewGame();
        $game->move(1,3);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(1,2);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(2,2);  # player 1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(2,3);  # player -1
        $this->assertEquals(0, $game->whichSideWon());
        $game->move(3,1);  # player 1
        $this->assertEquals(1, $game->whichSideWon());
        $this->assertFalse($game->isGameOverWithNoWinner());

    }

    function testNoWinner() {

        $game = new \OCA\OpenGames\Engine\NoughtsAndCrossesEngine();
        $game->startNewGame();
        $game->move(1,1);  # player 1
        $game->move(1,2);  # player -1
        $game->move(1,3);  # player 1
        $game->move(2,1);  # player -1
        $game->move(2,3);  # player 1
        $game->move(2,2);  # player -1
        $game->move(3,1);  # player 1
        $game->move(3,3);  # player -1
        $this->assertFalse($game->isGameOverWithNoWinner());
        $game->move(3,2);  # player 1
        $this->assertTrue($game->isGameOverWithNoWinner());

    }

}


