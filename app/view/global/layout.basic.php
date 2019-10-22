<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php if ( isset($layout['metaTitle']) ) echo $layout['metaTitle']; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- style -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.1/css/all.css" />
	<link rel="stylesheet" href="https://bbcdn.githack.com/henrygotmojo/bootstrap-extend/raw/4.0/bootstrap.extend.min.css" />
	<?php if ( class_exists('Scaffold') ) : ?>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo $fusebox->config['baseUrl']; ?>css/main.css" />
	<!-- script -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
	<script src="https://bbcdn.githack.com/henrygotmojo/bootstrap-extend/raw/4.0/bootstrap.extend.min.js"></script>
	<?php if ( class_exists('Scaffold') ) : ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		<script src="<?php echo F::config('baseUrl'); ?>lib/simple-ajax-uploader/2.6.7/SimpleAjaxUploader.min.js"></script>
		<script src="<?php echo F::config('baseUrl'); ?>js/fuseboxy.scaffold.js"></script>
	<?php endif; ?>
	<script src="<?php echo $fusebox->config['baseUrl']; ?>js/main.js"></script>
</head>
<body data-controller="<?php echo $fusebox->controller; ?>" data-action="<?php echo $fusebox->action; ?>">
<?php if ( isset($layout['content']) ) echo $layout['content']; ?>
</body>
</html>