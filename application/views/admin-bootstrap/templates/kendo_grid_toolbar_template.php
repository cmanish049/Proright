<?php 
isset($edit_modal_size) OR $edit_modal_size = 'max-max';
?>

<script type="text/x-kendo-template" id="<?php echo $grid_name ?>-toolbar-template">
    <div class="btn-toolbar pull-left">
        <a href="<?php echo $edit_url ?>" class="modal-for-grid btn modal-iframe btn-grid-toolbar" 
           title="<?php _e('New'); ?>"
            data-modal-size="<?php echo $edit_modal_size; ?>" 
            data-modal-name="<?php echo $grid_name; ?>Modal" 
            data-grid-selector="\#<?php echo $grid_name; ?>Grid">
             <i class="icon-plus-sign"></i> <span><?php _e('New'); ?></span>
         </a>
    </div>
            
    <div class="btn-toolbar pull-right">
        <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="\#">
                <?php _e('Actions'); ?>
                <span class="caret"></span>
            </a>
            <ul class="dropdown-menu pull-right">
                <li>
                    <a href="\#" 
                       class="btn-export-grid-excel-2007 btn-grid-export" 
                       data-grid-selector="\#<?php echo $grid_name ?>Grid">
                        <?php _e('Download EXCEL 2007') ?>
                    </a>
                </li>
                <li>
                    <a href="\#" 
                       class="btn-export-grid-excel-2003" 
                       data-grid-selector="\#<?php echo $grid_name ?>Grid">
                        <?php _e('Download EXCEL 2003') ?>
                    </a>
                </li>
                <li>
                    <a href="\#" 
                       class="btn-export-grid-pdf" data-grid-selector="\#<?php echo $grid_name ?>Grid">
                        <?php _e('Download PDF') ?>
                    </a>
                </li>
            </ul>
        </div>
        
        <a href="<?php echo admin_url("$controller/grid"); ?>" 
           class="btn pull-right action-reset-grid btn-grid-toolbar basic-tooltip" 
            data-modal-name="<?php echo $grid_name ?>Modal" 
            data-grid-selector="\#<?php echo $grid_name ?>Grid"
            title="<?php _e('Clear Filters'); ?>">
             <i class="icon-refresh"></i> <span><?php _e('Clear Filters'); ?></span>
         </a> 
    </div>           
</script>