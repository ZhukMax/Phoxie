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
 
/*
 * IndexController
 *
 * @indexAction
 */
use Phoxie\Classes\PagesClass;

class IndexController extends PagesClass
{
    /**
     *
     * get Page
     */
	public function indexAction()
	{
		$alias = $this->dispatcher->getParam('alias');
		if (!$alias) $alias = 'index';
		$page = Pages::findFirst(array("alias = '".$alias."'"));
		if (!$page) {
			$this->dispatcher->forward(array("controller" => "system", "action" => "notfound"));
			$this->view->disable();
		}/*else {
			$this->view->page = $page;
			$this->view->pick($page->templates->path);
		}*/
	}
}