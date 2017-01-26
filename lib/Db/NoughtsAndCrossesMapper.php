<?php
namespace OCA\OpenGames\Db;

use OCP\IDb;
use OCP\AppFramework\Db\Mapper;

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
class NoughtsAndCrossesMapper extends Mapper {

    public function __construct(IDb $db) {
        parent::__construct($db, 'opengames_noughtsandcrosses', '\OCA\OpenGames\Db\NoughtsAndCrossesEntity');
    }

    public function find($id) {
        $sql = 'SELECT * FROM *PREFIX*opengames_noughtsandcrosses WHERE gameid = ?';
        return $this->findEntity($sql, [$id]);
    }

}