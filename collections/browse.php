<?php
$pageTitle = __('Browse Collections');
echo head(array('title' => $pageTitle, 'bodyclass' => 'collections browse'));
?>

<h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php echo pagination_links(); ?>

<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>

<?php 
/* changes here so that titles and thumbnails link to browse page for all items in collection, NOT to an intermediate collection info page */
foreach (loop('collections') as $collection): ?>

<div class="collection hentry">

    <h2><?php echo link_to_items_browse(__(metadata('collection', array('Dublin Core', 'Title'))), array('collection' => metadata('collection', 'id'))); ?></h2>
    <div class="item-meta">
     <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
        <div class="item-img">
        <?php echo link_to_items_browse($collectionImage, array('collection' => metadata('collection', 'id'))); ?>
        </div>
    <?php endif; ?>

    <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
    <div class="item-description">
        <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet' => 500))); ?>
    </div>
    <?php endif; ?>

    <?php /*commenting out contributors since this will be the same admin
        if ($collection->hasContributor()): ?>
    <div class="collection-contributors">
        <p>
        <strong><?php echo __('Contributors'); ?>:</strong>
        <?php echo metadata('collection', array('Dublin Core', 'Contributor'), array('all' => true, 'delimiter' => ', ')); ?>
        </p>
    </div>
    <?php endif; */ ?>

    <?php /* also commenting out this link - changes above make the title and image link directly to the items without viewing the collection overview page in between
        echo link_to_items_browse(__('View the items in %s', metadata('collection', 'rich_title', array('no_escape' => true))), array('collection' => metadata('collection', 'id')), array('class' => 'view-items-link'));  */?>

    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
    </div>
</div>

<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections' => $collections, 'view' => $this)); ?>

<?php echo foot(); ?>
