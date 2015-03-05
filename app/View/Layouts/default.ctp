<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
		
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('/kengoGrid/styles/kendo.common-bootstrap.min');
		echo $this->Html->css('/kengoGrid/styles/kendo.bootstrap.min');
		echo $this->Html->css('/kengoGrid/styles/kendo.common.min');
		echo $this->Html->css('/kengoGrid/styles/kendo.blueopal.min');
		echo $this->Html->css('/kengoGrid/styles/kendo.dataviz.min');
		echo $this->Html->css('/kengoGrid/styles/kendo.dataviz.default.min');
		echo $this->Html->script('/kengoGrid/js/jquery.min');
		echo $this->Html->script('/kengoGrid/js/kendo.all.min');
		// <script src="\js\lang\kendo.pt-BR.js"></script>
		// echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
	<body>
		<div id="example">
			   <div id="megaStore">
				   <ul id="menu">
					   <!-- <li><?php echo $this->Html->link('Домашняя', array('controller'=>'site', 'action' => 'index'));?></li> -->
					   <li><?php echo $this->Html->link('Управление товарами', array('controller'=>'goods', 'action' => 'index'));?></li>
					   <li><?php echo $this->Html->link('Управление контрагентами', array('controller'=>'partners', 'action' => 'index'));?></li>
					   <? if( $this->Session->read('Auth.User') ) {?>
							<li id="users"><?php echo $this->Html->link('Выход', array('controller'=>'users', 'action' => 'logout'));?></li>
					   <?}?>
				   </ul>
			   </div>
			   <style>
				   #megaStore {
					   width: 100%;
					   margin: 30px auto;
					   padding-top: 20px;
				   }
				  #users {
				  		float: right;
				  }
				   #menu h2 {
					   font-size: 1em;
					   text-transform: uppercase;
					   padding: 5px 10px;
				   }
				   #template img {
					   margin: 5px 20px 0 0;
					   float: left;
				   }
				   #template {
					   width: 380px;
				   }
				   #template ol {
					   float: left;
					   margin: 0 0 0 30px;
					   padding: 10px 10px 0 10px;
				   }
				   #template:after {
					   content: ".";
					   display: block;
					   height: 0;
					   clear: both;
					   visibility: hidden;
				   }
				   #template .k-button {
					   float: left;
					   clear: left;
					   margin: 5px 0 5px 12px;
				   }
				   body {
					   background-color: #94c0d2;
				   }
			   </style>
			   <script>
				   $(document).ready(function() {
					   $("#menu").kendoMenu();
				   });
			   </script>
	   </div>
		<div id="container">
			<div id="content">
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
	</body>
</html>