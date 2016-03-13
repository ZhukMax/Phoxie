<?php
/*
 * Ph2x CMS for Phalcon PHP
 *
 * Copyright 2015 by Zhuk Max.
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

class Core extends \Phalcon\Mvc\Controller
{

	/**
     *
     * _acl function
	 * check permissions for user
	 *
	 * @input $controller
	 * @input $action
	 * @input $url
	 *
	 * @return user's data
	*/
	protected function _acl($controller, $action, $url = false)
	{
		if (!$this->session->has('user')) $this->dispatcher->forward(array("controller" => "admin", "action" => "inter"));
		else {
			$user = Users::findFirst($this->session->get('user'));
			if (!$user) $this->dispatcher->forward(array("controller" => "admin", "action" => "inter"));
			else return $user;
		}
	}

	/**
     *
     * addField function
	 * @input $data
	 *
	 * @return error
	 * @return done
	*/
	protected function addField($data)
	{
		$this->_acl('admin', 'addfield');

		if ($data['fieldID'] == 0) {
			$xField = new XFields();
			$xField->title = $data['title'];
			$xField->type = $data['type'];
			if ($data['type'] == 'multi') {
				$nextField = true;
				$settings = array();
				$i = 1;
				while ($nextField) {
					$settings[$i]['title'] = $data['xf-title-'.$i];
					$settings[$i]['type'] = $data['xf-type-'.$i];
					$i++;
					if (!$data['xf-type-'.$i]) $nextField = false;
				}
				$xField->settings = json_encode($settings);
			} else $xField->settings = '{}';
			$xField->tab = $data['tab'];
			
			if ($xField->create() == false) {
				$error = '';
				foreach ($xField->getMessages() as $message) {
					$error .= '* '.$message->getMessage().'<br>';
				}
				return json_encode(array('done'=>'0','error'=>$error));
			}
		} else $xField = XFields::findFirst($data['fieldID']);
		
		// Add xField to Page
		$xData = new XData();
		$xData->xfield = $xField->id;
		$xData->page = $data['page'];
		if ($xData->create() == false) {
			$error = '';
			foreach ($xField->getMessages() as $message) {
				$error .= '* '.$message->getMessage().'<br>';
			}
			return json_encode(array('done'=>'0','error'=>$error));
		} else return json_encode(array('done'=>'1'));
		
	}

	/**
     *
     * savePage function
	 * @input $data
	 *
	 * @return error
	 * @return done
	*/
	protected function savePage($data)
	{
		$this->_acl('admin', 'savepage');

		$page = Pages::findFirst((int)$data['pageid']);
		if (!$page) $page = new Pages();
		
		if ($page->save($data) == false) {
			$error = '';
			foreach ($page->getMessages() as $message) {
				$error .= '* '.$message->getMessage().'<br>';
			}
			return json_encode(array('done'=>'0','error'=>$error));
		} else return json_encode(array('done'=>'1'));
	}

	/**
     *
     * removePage function
	 * @input $data
	 *
	 * @return error
	 * @return done
	*/
	protected function removePage($data)
	{
		$this->_acl('admin', 'removepage');

		$page = Pages::findFirst((int)$data['pageid']);
		
		if ($page == false) return json_encode(array('done'=>'0','error'=>'Страница была удалена ранее'));
		if ($page->delete() == false) {
			$error = '';
			foreach ($page->getMessages() as $message) {
				$error .= $message->getMessage().'<br>';
			}
			return json_encode(array('done'=>'0','error'=>$error));
		} else return json_encode(array('done'=>'1'));

	}

	protected function ajaxform()
	{
		$output = $errorName = $errorPhone = $okText = '';
		$errorArray = array();

		$errorName = '*** Имя обязательно к заполнению! ***';
		$errorPhone = '*** Телефон обязателен к заполнению! ***';
		$okText = '<h3>Ваше письмо отправлено!</h3> <h4>Наш менеджер свяжется с Вами в ближайшее время.</h4>';

		$name = !$_POST['name'] ? false : trim($_POST['name']);
		$phone = !$_POST['phone'] ? false : trim($_POST['phone']);
		$email = !$_POST['email'] ? '' : $_POST['email'];
		$site = !$_POST['site'] ? '' : $_POST['site'];
		$comment = !$_POST['comment'] ? '' : $_POST['comment'];

		if ($name == false) $errorArray[] = array('field'=>'contact-form-name','error'=>$errorName);
		if ($phone == false) $errorArray[] = array('field'=>'contact-form-phone','error'=>$errorPhone);

		if ($name != false && $phone != false) {

			$title = 'Сообщение с сайта AppUnit';
			$mess =  substr(htmlspecialchars(trim($comment)), 0, 1000000);
			$text = '<b>Имя:</b> '.$name.'<br><b>Телефон:</b> '.$phone.'<br>';
			$text .= '<b>E-mail:</b> '.$email.'<br><b>Сайт:</b> '.$site.'<br>';
			$text .= '<br><b>Сообщение:</b> '.$mess;
			$to = 'order@app-unit.ru';
			$from = 'admin@app-unit.ru';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: App Unit llc <'.$from.'>';
			if (mail($to, $title, $text, $headers)) $output = json_encode(array('ok'=>$okText));

		} else $output = json_encode($errorArray);

		return $output;
	}

	protected function session_destroy()
	{
		header('Content-type: application/json');
		$this->session->destroy();
		$logoutMessage = array('done'=>'1');
		return json_encode($logoutMessage);
	}

	/**
     *
     * login function
	 * create session data w/field `user`
	 *
	 * @return form's errors
	 * @return done
	*/
	protected function login($data)
	{
		header('Content-type: application/json');
		if ($this->security->checkToken($data['tokenkey'],$data['tokenvalue'])) {
			
			if (!$data['login']) return json_encode(array('done'=> 0,'error'=>'empty_login'));
			if (!$data['password']) return json_encode(array('done'=> 0,'error'=>'empty_password'));
			
			$user = Users::findFirst(array("login = '".$data['login']."'"));
			
			if (isset($user->login)) {
				
				if ($this->security->checkHash($data['password'], $user->password)) {
				
					$this->session->set('user', $user->id);
					return json_encode(array('done'=> 1));

				} else return json_encode(array('done'=> 0,'error'=>'password'));
				
			} else return json_encode(array('done'=> 0,'error'=>'login'));
		} else return json_encode(array('done'=> 0,'error'=>'token'));
	}

	/**
     *
     * signup function
	 * create new Users model's object
	 *
	 * @return form's errors
	 * @return done
	*/
	protected function signup($data)
	{
		header('Content-type: application/json');
		if ($this->security->checkToken($data['tokenkey'],$data['tokenvalue'])) {

				if (!$data['login']) return json_encode(array('done'=> 0,'error_field'=>'login'));
				if (!$data['password']) return json_encode(array('done'=> 0,'error_field'=>'password'));

				$user = new Users();
				$user->login = $data['login'];
				$user->email = $data['email'];
				$user->password = $this->security->hash($data['password']);
				$user->save();

				if (!$user->id) return json_encode(array('done'=> 0,'error_field'=>'db'));
				else return json_encode(array('done'=> 1));

		} else return json_encode(array('done'=> 0,'error_field'=>'token'));
	}

	/**
     *
     * createTree functions
	 * get model's object & converts to tree
	 *
	 * @input $data - model's object
	 * @input $start - id of top parent for tree
	 *
	 * @return structured array
	*/
	protected function createTree($array, $id = 'id', $parent_id = 'parent', $children = 'children') {
	
		$tree = [[$children => []]];
		$references = [&$tree[0]];

		foreach($array as $item) {
			if(isset($references[$item[$id]])) {
				$item[$children] = $references[$item[$id]][$children];
			}

			$references[$item[$parent_id]][$children][] = $item;
			$references[$item[$id]] =& $references[$item[$parent_id]][$children][count($references[$item[$parent_id]][$children]) - 1];
		}

		return $tree[0][$children];
	}
}