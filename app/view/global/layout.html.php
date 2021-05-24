<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php if ( isset($layout['metaTitle']) ) echo $layout['metaTitle']; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo F::config('baseUrl'); ?>../bootstrap-extend/bootstrap.extend.css" />
<script src="<?php echo F::config('baseUrl'); ?>../bootstrap-extend/bootstrap.extend.js"></script><?php
	if ( class_exists('Scaffold') ) :
		?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" />
		<link rel="stylesheet" href="https://cdn.statically.io/bb/henrygotmojo/fuseboxy-scaffold-asset/2.1.3/fuseboxy.scaffold.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-ajax-uploader@2.6.7/SimpleAjaxUploader.js"></script>
		<script src="https://cdn.statically.io/bb/henrygotmojo/fuseboxy-scaffold-asset/2.1.3/fuseboxy.scaffold.js"></script><?php
	endif;
	if ( class_exists('Captcha') and F::is('auth.*') ) echo Captcha::api();
	if ( is_file( F::config('baseDir').'css/main.css' ) ) :
		?><link rel="stylesheet" href="<?php echo F::config('baseUrl'); ?>css/main.css" /><?php
	endif;
	if ( is_file( F::config('baseDir').'js/main.js' ) ) :
		?><script src="<?php echo F::config('baseUrl'); ?>js/main.js"></script><?php
	endif;
?></head>
<body data-controller="<?php echo F::command('controller'); ?>" data-action="<?php echo F::command('action'); ?>"><?php
if ( isset($layout['content']) ) echo $layout['content'];
?></body>
</html>