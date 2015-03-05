<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout; ?></title>
<?php echo $this->Html->css('default'); ?>
</head>

<body>
<!--Header Background Part Starts -->
<div id="header-bg">
	<!--Header Contant Part Starts -->
	<div id="header">
		<? echo $this->Html->link($this->Html->image("logo.gif"), array('controller'=>'site', 'action' => 'index'), array('escape' => false));?>

		<br class="spacer" />
	</div>
	<!--Header Contant Part Ends -->
</div>
<!--Header Background Part Ends -->
<?php echo $this->element('menu', array('cache' => true)); ?>
<!--Our Company Bacground Part Starts -->
<div id="ourCompany-bg">
	<!--Our Company Part Starts -->
	<div id="ourCompany-part">
		<h2 class="ourCompany-hdr"><?php echo $title_for_layout; ?></h2>
		<?php echo $content_for_layout; ?>
		<br class="spacer" />
	</div>
	<!--Our Company Part Ends -->
</div>
<!--Our Company Bacground Part Ends -->
<!--Future Plans Part Starts -->
<div id="futurePlan-bg">
	<!--Future Plans Contant Part Starts -->
	<div id="futurePlanContant">
		<!--Projects 2007 Part Starts -->
		<div id="projPart">
			<h2 class="proj-hdr">Projects <span>2007</span></h2>
			<ul class="pic">
				<li><a href="#"><img src="img/future-pic-1.jpg" alt="Pic 1" title="Pic 1" width="82" height="74" /></a></li>
				<li><a href="#"><img src="img/future-pic-2.jpg" alt="Pic 2" title="Pic 2" width="82" height="74" /></a></li>
				<li class="noRightMargin"><a href="#"><img src="img/future-pic-3.jpg" alt="Pic 3" title="Pic 3" width="82" height="74" /></a></li>
			</ul>
			<br class="spacer" />
			<h3 class="sub-hdr">We Have For This year:</h3>
			<p>Quisque laoreet, elit at tincidunt porta, massa torr Porttitor magna, at vehicula pede dui id enim. Pellentesque</p>
			<a href="#" class="more-btn" title="READ MORE"></a>
		</div>
		<!--Projects 2007 Part Ends -->
		<!--Future Part Starts -->
		<div id="futurePart">
			<h2 class="future-hdr">Future Plans</h2>
			<h3 class="future-subHdr">Sed semper, enim id fringilla posuere</h3>
			<p>mauris diam dignissim magna, id ornare libero quam innvallis erat eu lectus. Aenean bibendum facilisis ante.</p>
			<p>Pellentesque id nunc at leo vestibulum lobortis. Integer luctus leo non felis. Proin in justo. Donec sapien enim, porta quis, aliquam sit amet, condimentum nonummy, lorem. Nullam mi metus, cursus in, porta vel, fringilla et, orci. Integer sit amet quam id turpis ultrices</p>
			<img src="img/future-img.gif" alt="Image" title="Image" width="127" height="141" />
			<br class="spacer" />
		</div>
		<!--Future Part Ends -->
		<br class="spacer" />
	</div>
	<!--Future Plans Contant Part Ends -->
</div>
<!--Footer Part Starts -->
<div id="footer-bg">
	<!--Footer Menu Part Starts -->
	<div id="footer-menu">
		<ul class="footMenu">
			<li class="noDivider"><a href="#" title="Home">Home</a></li>
			<li><a href="#" title="About">About</a></li>
			<li><a href="#" title="Services">Services</a></li>
			<li><a href="#" title="Support">Support</a></li>
			<li><a href="#" title="Chat">Chat</a></li>
			<li><a href="#" title="History">History</a></li>
			<li><a href="#" title="Contact">Contact</a></li>
		</ul>
		<br class="spacer" />
		<p class="copyright">Copyright &copy; Package 2007 All Rights Reserved</p>
		<p class="copyright topPad">Powered by <a href="http://www.templatekingdom.com/Web-Templates/Web-Design/" target="_blank" title="TemplateKingdom.com">TemplateKingdom.com</a></p>
	</div>
	<!--Footer Menu Part Ends -->
</div>
<!--Footer Part Ends -->
</body>
</html>
