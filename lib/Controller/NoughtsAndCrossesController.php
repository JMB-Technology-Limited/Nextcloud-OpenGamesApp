<?php
namespace OCA\OpenGames\Controller;

use OCA\OpenGames\Engine\NoughtsAndCrossesEngine;
use OCA\OpenGames\Db\NoughtsAndCrossesMapper;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\IRequest;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Controller;
use OCP\Files\IAppData;

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
class NoughtsAndCrossesController extends Controller {



    protected  $userId;


    /** @var NoughtsAndCrossesMapper  */
    protected $NoughtsAndCrossesMapper;

    public function __construct($AppName, IRequest $request ,NoughtsAndCrossesMapper $noughtsAndCrossesMapper, $UserId){
        parent::__construct($AppName, $request);
        $this->userId = $UserId;
        $this->NoughtsAndCrossesMapper = $noughtsAndCrossesMapper;
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function index($cell=null, $state=null) {

        $engineCurrent = new NoughtsAndCrossesEngine();
        $engineCurrent->loadData($this->NoughtsAndCrossesMapper, 'current');
        if (!$engineCurrent->isGameInProgress()) {
            $engineCurrent->startNewGame();
            $engineCurrent->saveData( $this->NoughtsAndCrossesMapper, 'current' );
        }

        $engineLast = new NoughtsAndCrossesEngine();
        $engineLast->loadData($this->NoughtsAndCrossesMapper, 'last');

        $showOtherPlayerMovedError = false;


        if ($cell) {
            $row = intval($cell / 10);
            $col = intval($cell % 10);
            if ($state !== $engineCurrent->getStateString()) {
                $showOtherPlayerMovedError = true;
            } else {
                $engineCurrent->move( $row, $col, $this->userId );
                if ( $engineCurrent->isGameInProgress() ) {
                    $engineCurrent->saveData( $this->NoughtsAndCrossesMapper, 'current' );
                } else {
                    $engineLast = $engineCurrent;
                    $engineLast->saveData( $this->NoughtsAndCrossesMapper, 'last' );

                    $engineCurrent = new NoughtsAndCrossesEngine();
                    $engineCurrent->startNewGame();
                    $engineCurrent->saveData( $this->NoughtsAndCrossesMapper, 'current' );
                }

                return new RedirectResponse( \OC::$server->getURLGenerator()->linkToRoute( 'opengames.NoughtsAndCrosses.index' ) );
            }
        }


        return new TemplateResponse('opengames', 'NoughtsAndCrosses', array(
            'data' => $engineCurrent->getDataForTemplate(),
            'inProgress' => $engineCurrent->isGameInProgress(),
            'whoToMove' => $engineCurrent->getNextMove(),
            'players'=>$engineCurrent->getPlayers(),

            'lastData' => $engineLast->getDataForTemplate(),
            'lastPlayers' => $engineLast->getPlayers(),
            'lastWhichSideWon' => $engineLast->whichSideWon(),
            'lastIsGameOverWithNoWinner' => $engineLast->isGameOverWithNoWinner(),


            'stateString' => $engineCurrent->getStateString(),
            'showOtherPlayerMovedError' => $showOtherPlayerMovedError,
        ));
    }

}