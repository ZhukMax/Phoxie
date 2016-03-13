<?php
/*
 * Phoxie CMS for Phalcon PHP
 *
 * Copyright 2016 by Zhuk Max.
 * All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more
 * details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 */
use Phalcon\Mvc\Application;

try {
	
	define('BASE_PATH', realpath(NULL) . '/');

	// Hard include config files
	require BASE_PATH . 'core/config/config.inc.php';
	require CORE_PATH . 'config/loader.inc.php';

    // Execute the request handler
    $application = new Application($di);
    echo $application->handle()->getContent();

// If Errors with Phalcon use
} catch(\Phalcon\Exception $e) {
	echo "PhalconException: ", $e->getMessage();
}
