<?php
namespace OCA\OpenGames\Engine;

use OCA\OpenGames\Db\NoughtsAndCrossesEntity;
use OCA\OpenGames\Storage\NoughtsAndCrossesStorage;

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
class NoughtsAndCrossesEngine
{

    protected $data;

    public function getDataForTemplate() {
        return array(
            'board'=> $this->data['board'],
        );
    }

    public function saveData(NoughtsAndCrossesMapper $noughtsAndCrossesMapper, $name) {
        try {
            $data = $noughtsAndCrossesMapper->find($name);
            $data->setData(json_encode($this->data));
            $noughtsAndCrossesMapper->update($data);
        } catch(\OCP\AppFramework\Db\DoesNotExistException $e) {
            $data = new NoughtsAndCrossesEntity();
            $data->setGameid($name);
            $data->setData(json_encode($this->data));
            $noughtsAndCrossesMapper->insert($data);
        }
    }

    public function loadData(NoughtsAndCrossesMapper $noughtsAndCrossesMapper, $name) {
        try {
            $data = $noughtsAndCrossesMapper->find($name);
            $this->data = json_decode($data->getData(), true);
        } catch(\OCP\AppFramework\Db\DoesNotExistException $e) {
           $this->data = array(
               'inProgress'=>false,
               'board'=>array(
                   1 => array(1=>0, 2=>0, 3=>0),
                   2 => array(1=>0, 2=>0, 3=>0),
                   3 => array(1=>0, 2=>0, 3=>0),
               ),
           );
        }
    }

    public function getStateString() {
        $str = $this->data['nextMove'];
        for ($row = 1; $row <= 3; $row++) {
            for ($col = 1; $col <= 3; $col++) {
                $str .= $this->data['board'][$row][$col];
            }
        }
        return md5($str);
    }

    public function isGameInProgress() {
        return isset($this->data) && isset($this->data['inProgress']) && $this->data['inProgress'];
    }

    public function startNewGame() {
        $this->data = array(
            'inProgress'=>true,
            'board'=>array(
                1 => array(1=>0, 2=>0, 3=>0),
                2 => array(1=>0, 2=>0, 3=>0),
                3 => array(1=>0, 2=>0, 3=>0),
            ),
            'nextMove' => 1,
            'players' => array(),
        );
    }

    public function move($row, $col, $userId = null) {

        if ($this->data['board'][$row][$col] !== 0) {
            return;
        }
        $this->data['board'][$row][$col] = $this->data['nextMove'];
        $this->data['nextMove'] = $this->data['nextMove'] > 0 ? -1 : 1;
        if ($this->whichSideWon() !== 0 || $this->isGameOverWithNoWinner()) {
            $this->data['inProgress'] = false;
        }
        if ($userId && !in_array($userId, $this->data['players'])) {
            $this->data['players'][] = $userId;
        }


    }

    /**
     * @return bool
     * @TODO This is Badly named, as it doesn't check if there is no winner.
     */
    public function isGameOverWithNoWinner() {
        for ($row = 1; $row <= 3; $row++) {
            for ($col = 1; $col <= 3; $col++) {
                if ($this->data['board'][$row][$col] === 0) {
                    // There is still a square someone can play in - so not over!
                    return false;
                }
            }
        }
        // there are no squares someone can play in - the game is over.
        return true;
    }

    public function getNextMove() {
        return $this->data['nextMove'];
    }

    public function getPlayers() {
        return $this->data['players'];
    }

    public function whichSideWon() {


        foreach(array(1, -1) as $player) {

            # horizontal lines
            for ($row = 1; $row <= 3; $row++) {
                if ($this->data['board'][$row][1] === $player && $this->data['board'][$row][2] === $player  && $this->data['board'][$row][3] === $player ) {
                    return $player;
                }
            }
            # vertical lines
            for ($col = 1; $col <= 3; $col++) {
                if ($this->data['board'][1][$col] === $player && $this->data['board'][2][$col] === $player  && $this->data['board'][3][$col] === $player ) {
                    return $player;
                }
            }
            # back slash
            if ($this->data['board'][1][1] === $player && $this->data['board'][2][2] === $player  && $this->data['board'][3][3] === $player ) {
                return $player;
            }
            # Forward Slash
            if ($this->data['board'][3][1] === $player && $this->data['board'][2][2] === $player  && $this->data['board'][1][3] === $player ) {
                return $player;
            }

        }

        return 0;
    }

}
