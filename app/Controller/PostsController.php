<?php

class PostsController extends AppController {
	var $uses = array('User', 'Post');
	public function postsList() {
		$posts = $this->Post->find('all');
		$this->set('posts', $posts);
	}

	public function view( $id = null ) {
		$this->Post->id = $id;
		$this->set('post', $this->Post->read());

	}

	function postCreate() {
		$users = $this->User->find('list', array(
			'fields' => array('User.id', 'User.user_name'),
		));
		if (!empty($this->data)) {
			
			if ($this->Post->save($this->data))	{
				$this->redirect( array('controller' => 'site', 'action' => 'index') );
			}
		}
		$this->set(array('users' => $users));
	}

	function postUpdate($id = null) {
		$users = $this->User->find('list', array(
			'fields' => array('User.id', 'User.user_name')
		));
		if (empty($this->data)) {

				$this->Post->id = $id;
				$this->data = $this->Post->read();
		}
		else {
			if ($this->Post->save($this->data['Post']))
			{
				$this->flash('Your post has been updated.','/posts/view/'.$id);
			}
		}
		$this->set(array('users' => $users));
	}

	function postDelete($id = null) {
		$this->Post->delete($id);
		$this->flash('The post with id: '.$id.' has been deleted.', '/posts/postsList');
	}
}
