<?php
    isset($edit_modal_size) OR $edit_modal_size = 'max-max';
    isset($detail_modal_size) OR $detail_modal_size = $edit_modal_size;
    isset($edit_url_query_string) OR $edit_url_query_string = '';
    isset($delete_url_query_string) OR $delete_url_query_string = '';
?>

<script type="text/x-kendo-template" id="<?php echo $grid_name; ?>-actions-template">
    <div class="btn-group grid-row-action-menu">
        <a href="<?php echo admin_url("$controller/details/id/#= id #") ?>" 
            class="action-quickview btn btn-mini basic-tooltip"
            data-grid-selector="\#<?php echo $grid_name; ?>Grid" 
            data-modal-size="<?php echo $detail_modal_size; ?>" 
            data-modal-name="<?php echo $grid_name; ?>Modal"
            data-quickview-template-selector="\#<?php echo $grid_name; ?>-quickview-template"
             title="<?php _e('Quick View'); ?>">
                        <i class="icon-list-alt"></i> <span><?php _e('Quick View'); ?></span>
        </a>
    
        <a href="<?php echo admin_url("$controller/edit/window/modal/id/#= id #") . $edit_url_query_string ?>" 
            class="modal-for-grid action-edit btn btn-mini basic-tooltip" 
            data-grid-selector="\#<?php echo $grid_name; ?>Grid" 
            data-modal-size="<?php echo $edit_modal_size; ?>" 
            data-modal-name="<?php echo $grid_name; ?>Modal"
             title="<?php _e('Edit'); ?>">
             <i class="icon-edit"></i> <span><?php _e('Edit'); ?></span>
        </a>

        <a href="<?php echo admin_url("$controller/delete/id/#= id #") . $edit_url_query_string?>" 
            class="action-ajax action-delete show-confirm btn btn-mini basic-tooltip" 
            data-grid-selector="\#<?php echo $grid_name; ?>Grid"
             title="<?php _e('Delete'); ?>">
             <i class="icon-remove"></i> <span><?php _e('Delete'); ?></span>
        </a>
    </div>         
</script>
