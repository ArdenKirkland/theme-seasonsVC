<?php
$pageTitle = __('404 Page Not Found');
echo head(array('title' => $pageTitle));
?>
<h1><?php echo $pageTitle; ?></h1>
<h2>Oops!</h2>
	
	<p>Sorry, this page doesn't exist, or you don't have permission to view it. Please check your URL, or send us a note.</p>
<?php echo foot(); ?>

