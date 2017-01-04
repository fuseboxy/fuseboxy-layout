<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="ie ie6"> <![endif]-->
<!--[if IE 7]>         <html class="ie ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!--> <html> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php if ( isset($layout['metaTitle']) ) echo $layout['metaTitle']; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="powered by METASEIT (henry@metaseit.com)" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><![endif]-->
	<!--[if lt IE 9]><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
	<!-- style -->
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
	<link href="<?php echo $fusebox->config['baseUrl']; ?>css/main.css" rel="stylesheet" />
	<!-- script -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="<?php echo $fusebox->config['baseUrl']; ?>js/main.js"></script>
</head>
<body data-controller="<?php echo $fusebox->controller; ?>" data-action="<?php echo $fusebox->action; ?>" data-ajax-error="modal">
<?php if ( isset($layout['content']) ) echo $layout['content']; ?>
</body>
</html>