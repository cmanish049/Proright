<?php 
$url = $url . query_string(array('window' => 'ajax-modal'), NULL, FALSE);
isset($modal_name) OR $modal_name = 'modal';
?>

<a href="<?php echo $url; ?>" 
   class="btn-autocomplete-new basic-tooltip" 
   title="" data-modal-size="600-max" data-modal-name="<?php echo $modal_name; ?>" data-original-title="<?php _e('Add new') ?>"
   data-target-selector="<?php echo $target_selector; ?>">
    <i class="icon-plus-sign"></i> <span>New</span>
</a>