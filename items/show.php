<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>

    <h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1> 

<div id="main">
    
	<?php 
	// sort out item types for different displays
	$itemType = metadata('item', 'item_type_name'); ?>
	
	<?php
	// If an item is a Rotating view with a VR link, display it in an iframe
	if ($itemType == 'Rotating View') : ?>
	    <?php $vrurl= metadata('Item',array('Item Type Metadata','URL')); ?>
	    <?php if($vrurl) : ?>
	    <div class="iframe_wrapper">
	    <div class="responsive_iframe">
	        <div style="padding-bottom: 140%; margin:auto;"></div>
		    <iframe src="<?php echo $vrurl;?>" ></iframe>
	    </div>
	     <p>Trouble viewing this objectVR? <a href="<?php echo $vrurl;?>">360 view at full size</a></p>
	    </div>
	   
	    <?php else:
	        echo files_for_item(array('imageSize' => 'fullsize')); ?>
        <?php endif; ?>
	
	<?php
	// If an item is an audio or video file, default will call html5 player
	elseif ($itemType == 'Oral History' OR $itemType == 'Sound' OR $itemType == 'Moving Image'): ?>
	    <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
	
	<?php /* alternative method to use Connected Carousel plugin for item files ?>
	// If an item is a costume, show image carousel
	elseif ($itemType == 'Costume' OR $itemType == 'Still Image'): ?>
		<?php 
		if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?> 
            <div class="carouselWrapper">
            	<?php echo $this->shortcodes('[concarousel ids='.metadata('item','id').' 
            	center=true 
            	slides=5 
            	showdescription=false 
            	captionposition=none 
            	width=100% 
            	float=left
            	slideshow=false 
            	speed=2000 
            	focus=true 
            	navigation=true 
            	navbar=true]');?> 
            </div>
        
        <?php
        // or thumbnail gallery if option is selected with theme -->
        elseif ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
            <div id="itemfiles" class="element">
                <h2><?php echo __('Files'); ?></h2>
                <?php echo item_image_gallery(); ?>
            </div>
        <?php endif; ?>
        <?php */ ?>
		
	<?php else : ?>
			<?php /* echo files_for_item(array('imageSize' => 'fullsize')); */?>
		<?php echo get_specific_plugin_hook_output('UniversalViewer', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
	<?php endif; ?>
	
</div>

<div>
    <div class="tabs">
        <input type="radio" id="tab-1" name="tabs" checked =""/>
        <label id="brief-record" for="tab-1">Brief Record</label>
        
        <input type="radio" id="tab-2" name="tabs"/>
        <label id="full-record" for="tab-2">Full Record</label> 
       
       <div class="tab-content">
           <div id="tab-content-1">
               <h2 style="text-decoration: underline;">Brief Item Record</h2>
                <?php if (metadata('item', array('Dublin Core', 'Title')) !='') : ?>
                <p><strong>Title:</strong> <?php echo metadata('item', array('Dublin Core', 'Title'), array('delimiter' => ', ')); ?> </p>
                <?php endif; ?>
                
                <?php if (metadata('item', array('Dublin Core', 'Creator')) !='') : ?>
                <p><strong>Creator:</strong> <?php echo metadata('item', array('Dublin Core', 'Creator'), array('delimiter' => ', ')); ?> </p>
                <?php endif; ?>
                
                <?php if (metadata('item', array('Dublin Core', 'Date')) !='') : ?>
                <p><strong>Date:</strong> <?php echo metadata('item', array('Dublin Core', 'Date'), array('delimiter' => ', ')); ?> </p>
                <?php endif; ?>
                
                <?php if (metadata('item', array('Dublin Core', 'Description')) !='') : ?>
                <p><strong>Description:</strong> <?php echo metadata('item', array('Dublin Core', 'Description'), array('delimiter' => ', ')); ?> </p>
                <?php endif; ?>
           </div>
           <div id="tab-content-2">
               <h2 style="text-decoration: underline;">Full Item Record</h2>
               <?php echo all_element_texts('item'); ?>
           </div>
        </div>
   </div>
</div>
<div>
    <?php /* commenting out collection info block
        if (metadata('item', 'Collection Name')): ?>
        <div id="collection" class="element">
        <h2><?php echo __('Collection'); ?></h2>
        <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
    <?php endif; */ ?>
    
    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata('item', 'has tags')): ?>
    <div id="item-tags" class="element">
        <h2><?php echo __('Tags'); ?></h2>
        <div class="element-text"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif;?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>
</div>

<div class="clear"></div>

    <?php /* alternative method for displaying individual metadata entries ?>
    <input class="toggle" type="checkbox" value="" />
    <h3><button class="accordion"><strong>How it's made . . . </strong></button></h3>
    <div class="panel">

    <?php if (metadata('item', array('Item Type Metadata', 'Technique')) !='') : ?>
    <p><strong>Technique:</strong> <?php echo metadata('item', array('Item Type Metadata', 'Technique'), array('delimiter' => ', ')); ?> </p>
    <?php endif; ?>
    
    <?php if (metadata('item', array('Item Type Metadata', 'Structure Silhouette')) !='') : ?>
    <p><strong>Silhouette:</strong> <?php echo metadata('item', array('Item Type Metadata', 'Structure Silhouette'), array('delimiter' => ', ')); ?> </p>
    <?php endif; ?>
    
    <?php if (metadata('item', array('Item Type Metadata', 'Structure Neckline')) !='') : ?>
    <p><strong>Neckline:</strong> <?php echo metadata('item', array('Item Type Metadata', 'Structure Neckline'), array('delimiter' => ', ')); ?> </p>
    <?php endif; ?>
    
    </div>

 <?php echo all_element_texts('item', array('show_element_sets' => array ('Item Type Metadata'))); ?>
 
 <?php */ ?>
 
<?php //begin related items ?>

<?php //set current record ID 
$currentid = metadata('Item','id'); ?>

<?php //make sure it has a Relation
if (metadata('Item',array('Dublin Core', 'Relation')) !=''): ?>

    <?php $relations = metadata('item',array('Dublin Core', 'Relation'),array('all' => true));  ?>
<?php endif ; ?>

<?php //make sure it has an Identifier
if (metadata('Item',array('Dublin Core', 'Identifier')) !=''): ?>

    <?php //set variable for identifier
    $identifier = metadata('Item',array('Dublin Core', 'Identifier'));?>

	<?php //check each matching item
	$indirectRelations = get_records('Item',
	array('advanced' => array(
		array(
			'element_id' => 46,
			'type' => 'contains',
			'terms' => $identifier
		)
	  )
	),10000); ?>
<?php endif; ?>

<?php //reset to the original record
$reset = get_record_by_id('item',$currentid); 
set_current_record('item',$reset);
?>

<?php if (!empty($indirectRelations) OR !empty($relations)) : ?>
	<div id="item-relateditems" class="element" >
    <h2>Related Items:</h2>
    <div class="related-thumbs">
        <?php if (!empty($relations)) : ?>
            <?php foreach ($relations as $relation):  ?>
        		<?php $directRelations = get_records('Item',
        		array('advanced' => array(
        			array(
        				'element_id' => 43,
        				'type' => 'contains',
        				'terms' => $relation
        			)
        		  )
        		),5000); ?>
        		
        		<?php set_loop_records('relItems', $directRelations); ?>
        			<?php $relItems = get_loop_records('relItems') ; ?> 	
        			<?php foreach($relItems as $relItem): ?>  
        				<?php set_current_record('Item',$relItem); ?>
        				<?php $type=$relItem->getItemType(); ?>
        			
        						<div class="related-thumb">
        						<?php if (metadata('Item','has_files')){
        						 echo link_to_item(item_image('square_thumbnail',array('width'=>'100px','height'=>'auto'))); 
        						}
        						?>
        						</div> 
        
        			<?php endforeach; ?>    
            <?php endforeach ; ?>
        <?php endif; ?>
		
		<?php if (!empty($indirectRelations)) : ?>
            <?php set_loop_records('relItems', $indirectRelations); ?>
    			<?php $relItems = get_loop_records('relItems') ; ?> 	
    			<?php foreach($relItems as $relItem): ?>  
    				<?php set_current_record('Item',$relItem); ?>
    				<?php $type=$relItem->getItemType(); ?>
    			
    						<div class="related-thumb">
    						<?php if (metadata('Item','has_files')){
    						 echo link_to_item(item_image('square_thumbnail',array('width'=>'100px','height'=>'auto'))); 
    						}
    						?>
    						</div> 
    			<?php endforeach; ?>
			<?php endif; ?>

    </div>
    </div>

<?php endif; ?>

<?php  //reset to the original record
$reset = get_record_by_id('item',$currentid); 
set_current_record('item',$reset);
?>


<p style="clear:both">
</p>

    <?php /* include each plugin hook individually instead of adding all at the bottom
    fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); */ ?>
     
    <?php echo get_specific_plugin_hook_output('Geolocation', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
    
    <?php echo get_specific_plugin_hook_output('Commenting', 'public_items_show', array('view' => $this, 'item' => $item)); ?>
    


<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>

<?php echo foot(); ?>
