<?php
// title & nav
if ( file_exists(__DIR__.'/layout.settings.php') ) include 'layout.settings.php';


// display altogether
ob_start();
include 'layout.body.php';
include 'layout.modal.php';
$layout['content'] = ob_get_clean();


// wrap by <html> and <body>
include 'layout.basic.php';