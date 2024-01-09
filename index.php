<?php echo head(array('bodyid'=>'home')); ?>

<!-- Featured Items -->

<div id="featured-item">
    <h2><?php echo __('Featured Items'); ?></h2>
    <?php echo $this->shortcodes('[carousel is_featured=1 showtitles=true autoscroll=true interval=4000 speed=1000]');?> 
    <h3><?php echo link_to_items_browse('Browse the Costumes and Textiles Collection', array("collection" => 1) ); ?></h3>
</div>
            
<!--end featured-item-->

<div>
<?php if (get_theme_option('Homepage Text')): ?>
<p><?php echo get_theme_option('Homepage Text'); ?></p>
<?php endif; ?>
</div>

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>

<?php if ((get_theme_option('Display Featured Exhibit') !== '0')
        && plugin_is_active('ExhibitBuilder')
        && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
<!-- Featured Exhibit -->
<div>
    <div>
        <h2><?php echo __('Featured Exhibits'); ?></h2>
        <?php echo $this->shortcodes('[exhibits num=2 is_featured=1 sort=added order=d]');?> 
    </div>
</div>

<?php endif; ?>

<?php if (get_theme_option('Display Featured Collection') !== '0'): ?>
<!-- Featured Collection -->
<div id="featured-collection">
    <h2><?php echo __('Featured Collection'); ?></h2>
    <?php echo random_featured_collection(); ?>
</div><!-- end featured collection -->
<?php endif; ?>


<!--recent-items -->
<?php
$recentItems = get_theme_option('Homepage Recent Items');
if ($recentItems === null || $recentItems === ''):
    $recentItems = 3;
else:
    $recentItems = (int) $recentItems;
endif;

if ($recentItems):
?>

<div id="recent-items"> 
    <h2><?php echo __('Recently Added Items'); ?></h2> 
    <?php echo recent_items($recentItems); ?> 
    <p class="view-items-link"><a href="<?php echo html_escape(url('items' )); ?>"><?php echo __('View All Items'); ?></a></p> 
 </div> 
 
<?php endif; ?>
<!--end recent-items -->

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>
