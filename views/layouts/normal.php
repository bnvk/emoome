<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?= site_title($sub_title, $page_title, $site_title) ?></title>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="<?= $this_module_assets ?>css/style.css">
	<link rel="icon" type="image/png" href="<?= $this_module_assets ?>favicon.ico">
	<script src="<?= $this_module_assets ?>js/libs/modernizr-2.0.6.min.js"></script>
</head>
<body>

<div id="container">
	<header>

	</header>
	<div id="main" role="main">

		<div id="index_holder">
			<img src="<?= $this_module_assets ?>images/title.png">
			<p>iPhone & Mobile Web apps coming soon. Wanna get in on the beta? <a href="mailto:info@emoo.me">Contact Us</a></p>
		</div>

	</div>
	<footer>

	</footer>
</div> <!--! end of #container -->

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?= $this_module_assets ?>js/libs/jquery-1.6.2.min.js"><\/script>')</script>

<!-- scripts concatenated and minified via ant build script-->
<script src="<?= $this_module_assets ?>js/plugins.js"></script>
<script src="<?= $this_module_assets ?>js/script.js"></script>
<!-- end scripts-->

<script>
	var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']]; // Change UA-XXXXX-X to be your site's ID
	(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
	g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
	<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->

</body>
</html>
