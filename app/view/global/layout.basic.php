<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php if ( isset($layout['metaTitle']) ) echo $layout['metaTitle']; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- style -->
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" rel="stylesheet" />
	<link href="<?php echo $fusebox->config['baseUrl']; ?>lib/bootstrap-extend/4.0-alpha/bootstrap.extend.css" rel="stylesheet" />
	<link href="<?php echo $fusebox->config['baseUrl']; ?>css/main.css" rel="stylesheet" />
	<!-- script -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
	<script src="<?php echo $fusebox->config['baseUrl']; ?>lib/bootstrap-extend/4.0-alpha/bootstrap.extend.js"></script>
	<script src="<?php echo $fusebox->config['baseUrl']; ?>js/main.js"></script>
</head>
<body data-controller="<?php echo $fusebox->controller; ?>" data-action="<?php echo $fusebox->action; ?>" data-ajax-error="modal">
<?php if ( isset($layout['content']) ) echo $layout['content']; ?>
</body>
</html>