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

$application = new \OCA\OpenGames\AppInfo\Application();


$user = \OC::$server->getUserSession()->getUser();
if ($user) {
    \OC::$server->getNavigationManager()->add(function () {
        return [
            'id' => 'opengames',
            'order' => 22,
            'name' => 'OpenGames',
            'href' => \OC::$server->getURLGenerator()->linkToRoute('opengames.NoughtsAndCrosses.index'),
            'icon' => \OC::$server->getURLGenerator()->imagePath('opengames', 'app.svg'),//TODO
        ];
    });
}
