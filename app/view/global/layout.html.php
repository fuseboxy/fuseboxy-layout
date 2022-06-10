<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title><?php if ( isset($layout['metaTitle']) ) echo $layout['metaTitle']; ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /><?php
	// jquery & bootstrap
	?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
	<link rel="stylesheet" href="https://cdn.statically.io/bb/henrygotmojo/bootstrap-extend/4.4/bootstrap.extend.css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
	<script src="https://cdn.statically.io/bb/henrygotmojo/bootstrap-extend/4.4/bootstrap.extend.js"></script><?php
	// captcha
	if ( !empty(F::config('captcha')) ) echo Captcha::api();
	// scaffold
	if ( class_exists('Scaffold') ) :
		?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css" />
		<link rel="stylesheet" href="https://cdn.statically.io/bb/henrygotmojo/fuseboxy-scaffold-asset/2.1.7/fuseboxy.scaffold.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
		<script src="https://cdn.statically.io/bb/henrygotmojo/fuseboxy-scaffold-asset/2.1.7/fuseboxy.scaffold.js"></script><?php
	endif;
	// webform
	if ( class_exists('Webform') ) :
		?><link rel="stylesheet" href="https://cdn.statically.io/bb/henrygotmojo/fuseboxy-webform-asset/0.5.6/fuseboxy.webform.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jSignature/2.1.3/jSignature.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>
		<script src="https://cdn.statically.io/bb/henrygotmojo/fuseboxy-webform-asset/0.5.6/fuseboxy.webform.js"></script><?php
	endif;
	// scaffold & webform
	if ( class_exists('Scaffold') or class_exists('Webform') ) :
		?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
		<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/simple-ajax-uploader@2.6.7/SimpleAjaxUploader.js"></script><?php
	endif;
	// custom
	if ( is_file( F::config('baseDir').'css/main.css' ) ) :
		?><link rel="stylesheet" href="<?php echo F::config('baseUrl'); ?>css/main.css?t=<?php echo date('YmdHis'); ?>" /><?php
	elseif ( is_file( dirname(F::config('baseDir')).'/css/'.basename(F::config('baseDir')).'.css' ) ) :
		?><link rel="stylesheet" href="<?php echo dirname(F::config('baseUrl')); ?>/css/<?php echo basename(F::config('baseDir')); ?>.css?t=<?php echo date('YmdHis'); ?>" /><?php
	endif;
	if ( is_file( F::config('baseDir').'js/main.js' ) ) :
		?><script src="<?php echo F::config('baseUrl'); ?>js/main.js?t=<?php echo date('YmdHis'); ?>"></script><?php
	elseif ( is_file( dirname(F::config('baseDir')).'/js/'.basename(F::config('baseDir')).'.js' ) ) :
		?><script src="<?php echo dirname(F::config('baseUrl')); ?>/js/<?php echo basename(F::config('baseDir')); ?>.js?t=<?php echo date('YmdHis'); ?>"></script><?php
	endif;
?></head>
<body data-controller="<?php echo F::command('controller'); ?>" data-action="<?php echo F::command('action'); ?>"><?php
if ( isset($layout['content']) ) echo $layout['content'];
?></body>
</html>