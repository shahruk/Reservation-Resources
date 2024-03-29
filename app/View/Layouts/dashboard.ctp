<?php
	$cakeDescription = __d('cake_dev', 'Reservation Resources');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> - <?php echo $cakeDescription ?>
	</title>
	
	<meta name="description" content="">
	<meta name="author" content="Reservation Resources LLC">
	
	<?php 
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('bootstrap', 'bootstrap-responsive.min', 'formee-style', 'formee-structure', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/blitzer/jquery-ui.css', 'uniform.default', '../lightbox/shadowbox', '../tooltip/css/tooltip', 'main', 'stylesheet'));
	?>
	<?php echo $this->Html->script(array('//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js','http://reservationresources.com:8124/socket.io/socket.io.js', 'global', 'dashboard')); ?>
	<?php echo $this->fetch('cssTop'); ?>
	<?php echo $this->fetch('scriptTop'); ?>
	
	<link rel="apple-touch-icon" href="http://reservationresources.com/img/apple-icon.png" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=yes" />
	<link rel="shortcut icon" href="http://reservationresources.com/img/favicon.ico" type="image/x-icon" />

	<!-- start Mixpanel --><script type="text/javascript">(function(c,a){var b,d,h,e;b=c.createElement("script");b.type="text/javascript";b.async=!0;b.src=("https:"===c.location.protocol?"https:":"http:")+'//api.mixpanel.com/site_media/js/api/mixpanel.2.js';d=c.getElementsByTagName("script")[0];d.parentNode.insertBefore(b,d);a._i=[];a.init=function(b,c,f){function d(a,b){var c=b.split(".");2==c.length&&(a=a[c[0]],b=c[1]);a[b]=function(){a.push([b].concat(Array.prototype.slice.call(arguments,0)))}}var g=a;"undefined"!==typeof f?g=
a[f]=[]:f="mixpanel";g.people=g.people||[];h="disable track track_pageview track_links track_forms register register_once unregister identify name_tag set_config people.set people.increment".split(" ");for(e=0;e<h.length;e++)d(g,h[e]);a._i.push([b,c,f])};a.__SV=1.1;window.mixpanel=a})(document,window.mixpanel||[]);
mixpanel.init("70faf422e52c65fa1676846b8ccfba19");</script><!-- end Mixpanel -->

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDaGX-geU4Vus1VavcQYujOOy2z8Y14QQQ&sensor=false"></script>
	<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if IE]><
		<?php echo $this->Html->script('excanvas.compiled'); ?>
	<![endif -->
</head>
<body>
	
		<?php if(isset($auth) && $auth == true){
			echo $this->element('Layout'.DS.'User'.DS.'header');
		} else {
			echo $this->element('Layout'.DS.'Guest'.DS.'header');
		} ?>
	<div id = "container">
	<div class="info ajaxmessage" style = "display:none">
		 <h3>Please wait while we send your message</h3>
		 <p>Sending.....</p>
	</div>

	<div class="error ajaxmessage" style = "display:none">
		 <h3>Oops, an error ocurred</h3>
		 <p>We could not deliver your message at this time</p>
	</div>

	<div class="warning ajaxmessage" style = "display:none">
		 <h3>Warning</h3>
		 <p>This is just a warning notification message.</p>
	</div>

	<div class="success ajaxmessage" style = "display:none">
		 <h3>Congrats, you did it!</h3>
		 <p>Your message has been sent</p>
	</div>
		<div class = "inner row-fluid" id = "body">
			<div class = "span3">
				<div id = "dashboard" class = "well">
					<h1>Navigation</h1>
					<ul class="nav nav-list">
					  <li><a href="<?php echo $this->webroot; ?>"><i class="icon-home"></i> Home</a></li>
					  <!-- <li><a href="#"><i class="icon-info-sign"></i> About</a></li> -->
					  <li><a href="http://blog.reservationresources.com"><i class="icon-comment"></i> Blog</a></li>
					</ul>
					<h1>Messages & Notifications</h1>
					<ul class="nav nav-list">
					  <li><a href="#inbox"><i class="icon-inbox"></i> Inbox</a></li>
					  <li><a href="#deleted"><i class="icon-circle-arrow-right"></i> Deleted Messages</a></li>
					  <li class = "active"><a href="#notifications"><i class="icon-exclamation-sign icon-white"></i> Notifications</a></li>
					</ul>
					<h1>My Properties</h1>
					<ul class="nav nav-list">
					  <li><a href="../properties/"><i class="icon-plus"></i> List My Property</a></li>
					  <li><a href="#manageproperties"><i class="icon-edit"></i> Manage Properties</a></li>
					</ul>
					<h1>My Property Bookings</h1>
					<ul class="nav nav-list">
					   <li><a href="#allbookings"><i class="icon-calendar"></i> View All Bookings</a></li>
					</ul>
					<h1>My Trips / Reservations</h1>
					<ul class="nav nav-list">
					  <li><a href="#managereservations"><i class="icon-flag"></i> Manage Upcoming Reservations</a></li>
					</ul>
					<h1>My Account</h1>
					<ul class="nav nav-list">
					  <li><a href="#editaccount"><i class="icon-user"></i>Edit Account</a></li>
					 <!-- <li><a href="#trustsandverifications"><i class="icon-ok-circle"></i>Trusts & Verifications</a></li> -->
					</ul>
				 <h1>Marketing / Promotion</h1>
					<ul class="nav nav-list">
					  <li><a href="#postcraigslist"><i class="icon-share-alt"></i>Post to Craigslist</a></li>
					</ul> 
				</div>
			</div>
			<div id = "content" class = "span9">

				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<?php echo $this->element('Layout'.DS.'footer'); ?>
	</div>
	
<?php echo $this->element('sql_dump'); ?>


<?php echo $this->Html->script(array('jquery.ui.min', 'bootstrap.min', 'jquery.livequery', 'formee', 'jquery.uniform.min', '../tooltip/js/spinners/spinners.min', '../tooltip/js/tooltip/tooltip', '../lightbox/shadowbox', 'main','http://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.0/jquery-ui.min.js')); ?>
<?php echo $this->fetch('scriptBottom'); ?>
<!-- end scripts-->
<script>
	var _gaq=[['_setAccount','UA-28088665-1'],['_trackPageview']];
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?46abADM1IQ3SPaeYTIZwoulFyMk5EZSu';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
<!-- Start of Async HubSpot Analytics Code -->
<script type="text/javascript">
(function(d,s,i,r) {
if (d.getElementById(i)){return;}
var n=d.createElement(s),e=d.getElementsByTagName(s)[0];
n.id=i;n.src='//js.hubspot.com/analytics/'+(Math.ceil(new Date()/r)*r)+'/193341.js';
e.parentNode.insertBefore(n, e);
})(document,"script","hs-analytics",300000);
</script>
<!-- End of Async HubSpot Analytics Code -->

</body>
</html>