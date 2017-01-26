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

namespace OCA\OpenGames\AppInfo;

use OCP\AppFramework\App;

use OCA\OcUtility\AppInfo\Application as OcUtility;
use OCA\OcUtility\Service\SmarterLogger as SmarterLogger;

/**
 * Class Application
 *
 * @package OCA\OpenGames\AppInfo
 */
class Application extends App {

	/**
	 * Constructor
	 *
	 * @param array $urlParams
	 */
	public function __construct(array $urlParams = []) {
		parent::__construct('opengames', $urlParams);
	}

}
