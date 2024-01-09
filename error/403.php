<?php
$pageTitle = __('403 Page Forbidden');
echo head(array('title' => $pageTitle));
?>

<h1><?php echo $pageTitle; ?></h1>
<?php echo flash(); ?>
<h2>Oops!</h2>	

	<p>Sorry, you don't have permission to view this page.</p>

<?php echo foot(); ?>

