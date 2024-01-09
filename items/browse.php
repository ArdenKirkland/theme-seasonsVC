<?php
$pageTitle = __('Browse Items');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<div>
<?php echo item_search_filters(); ?>
</div>

<div id="primary">
   <div>
        <?php echo pagination_links(); ?>
        
        <?php if ($total_results > 0): ?>
        
        <?php
        $sortLinks[__('Title')] = 'Dublin Core,Title';
        $sortLinks[__('Creator')] = 'Dublin Core,Creator';
        $sortLinks[__('Date Added')] = 'added';
        ?>
        <div id="sort-links">
            <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
        </div>

        <?php endif; ?>

        <?php foreach (loop('items') as $item): ?>
        <div class="item hentry">
            <h2><?php echo link_to_item(null, array('class' => 'permalink')); ?></h2>
            <div class="item-meta">
            <?php if (metadata('item', 'has files')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image()); ?>
                </div>
            <?php endif; ?>
        
                <div class="item-description">
                <?php if ($creator = metadata('item', array('Dublin Core', 'Creator'))): ?>
                    <p><strong>Creator: </strong><?php echo $creator; ?></p>
                <?php endif; ?>
                <?php if ($date = metadata('item', array('Dublin Core', 'Date'))): ?>
                    <p><strong>Date: </strong><?php echo $date; ?></p>
                <?php endif; ?>
                <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet' => 250))): ?>
                    <p><?php echo $description; ?></p>
                <?php endif; ?>
                </div>

            <?php if (metadata('item', 'has tags')): ?>
                <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
                    <?php echo tag_string('items'); ?></p>
                </div>
            <?php endif; ?>
        
            <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' => $item)); ?>
        
            </div><!-- end class="item-meta" -->
        </div><!-- end class="item hentry" -->
        <?php endforeach; ?>

        <?php echo pagination_links(); ?>
    </div>
</div> 

<div id="sidebar">
    <?php fire_plugin_hook('public_facets', array('view' => $this)); ?>
</div>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php /* call plugins individually instead of all at once
    fire_plugin_hook('public_items_browse', array('items' => $items, 'view' => $this)); */ ?>

<?php echo foot(); ?>
