<div class="section">
    <div class="row">
        <div class="span12">
            <div class="box">
                <div class="box-header-container">
                    <h1 class="box-header">
                        <?php echo $page_title; ?>
                    </h1>
                </div>

                <div class="box-content">
                    <div class="section-padding">
                        <div class="grid-container">
                            <div id="auth_moduleGrid"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/x-kendo-template" id="auth_module-toolbar-template">
    <a href="<?php echo $edit_url ?>" class="modal-for-grid btn btn-primary modal-iframe" title="<?php _e('New'); ?>"
       data-modal-size="max-max" data-modal-name="auth_moduleModal" data-grid-selector="\#auth_moduleGrid">
        <span class="icon icon-plus-sign icon-white"></span> <?php _e('New'); ?>
    </a>
    
    <a href="<?php echo admin_url("$controller/grid"); ?>" class="btn btn-primary pull-right action-reset-grid" 
       data-modal-name="auth_moduleModal" 
       data-grid-selector="\#auth_moduleGrid">
        <i class="icon-refresh icon-white"></i> <?php _e('Clear Filters'); ?>
    </a>        
</script>

<script type="text/x-kendo-template" id="auth_module-actions-template">
    
    <div class="btn-group grid-row-action-menu">
        <a href="<?php echo admin_url("$controller/details/id/#= id #") ?>" 
                       class="action-quickview btn btn-mini basic-tooltip"
                       data-grid-selector="\#auth_moduleGrid" data-modal-size="800-max" data-modal-name="auth_moduleModal"
                       data-quickview-template-selector="\#auth_module-quickview-template"
                        title="<?php _e('Quick View'); ?>">
                        <i class="icon-list-alt"></i> <span><?php _e('Quick View'); ?></span></a>
    
        <a href="<?php echo admin_url("$controller/edit/window/modal/id/#= id #") ?>" 
                           class="modal-for-grid action-edit btn btn-mini basic-tooltip" 
                           data-grid-selector="\#auth_moduleGrid" data-modal-size="max-max" data-modal-name="auth_moduleModal"
                            title="<?php _e('Edit'); ?>">
                            <i class="icon-edit"></i> <span><?php _e('Edit'); ?></span></a>

        <a href="<?php echo admin_url("$controller/delete/id/#= id #") ?>" 
                           class="action-ajax action-delete show-confirm btn btn-mini basic-tooltip" 
                           data-grid-selector="\#auth_moduleGrid" 
                            title="<?php _e('Delete'); ?>">
                            <i class="icon-remove"></i> <span><?php _e('Delete'); ?></span></a>
    </div>         
</script>


<script type="text/x-kendo-template" id="auth_module-quickview-template">
    <div id="quickview-container">
        <table class="quickview-grid">
            <thead>
                <tr>
                    <th style="width: 200px"><?php _e('Label'); ?></th>
                    <th><?php _e('Value'); ?></th>
                </tr>
            </thead>
            <tbody>  
                
            	<tr>
                        <td><strong><?php _e('Module Code'); ?> : </strong></td>
                        <td><?php echo kendouiDataItemTemplateString('module_code'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Module Name'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('module_name'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Module Single Label'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('module_single_label'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Module Plural Label'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('module_plural_label'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Parent Id'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('parent_id'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Module Url'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('module_url'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Active'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('active'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Show In Menu'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('show_in_menu'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Show In Form'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('show_in_form'); ?></td>
             	</tr>

            	<tr>
                    		<td><strong><?php _e('Sequence Number'); ?> : </strong></td>
                    		<td><?php echo kendouiDataItemTemplateString('sequence_number'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var auth_moduleGrid;
    
    $(function() {
        grid(
            $('#auth_moduleGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'module_id',
                    fields: {
                        actions:{},
                        module_code: { type: 'string' },
                        module_name: { type: 'string' },
                        module_single_label: { type: 'string' },
                        module_plural_label: { type: 'string' },
                        parent_id: { type: 'number' },
                        module_url: { type: 'string' },
                        active: { type: 'string' },
                        show_in_menu: { type: 'string' },
                        show_in_form: { type: 'string' },
                        sequence_number: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#auth_module-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#auth_module-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'module_code',
                				title:'<?php _e('Module Code'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(module_code, "") #'
            			},
            
            			{
                				field:'module_name',
                				title:'<?php _e('Module Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(module_name, "") #'
            			},
            
            			{
                				field:'module_single_label',
                				title:'<?php _e('Module Single Label'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(module_single_label, "") #'
            			},
            
            			{
                				field:'module_plural_label',
                				title:'<?php _e('Module Plural Label'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(module_plural_label, "") #'
            			},
            
            			{
                				field:'parent_id',
                				title:'<?php _e('Parent Id'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(parent_id, "") #'
            			},
            
            			{
                				field:'module_url',
                				title:'<?php _e('Module Url'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(module_url, "") #'
            			},
            
            			{
                				field:'active',
                				title:'<?php _e('Active'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(active, "") #'
            			},
            
            			{
                				field:'show_in_menu',
                				title:'<?php _e('Show In Menu'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(show_in_menu, "") #'
            			},
            
            			{
                				field:'show_in_form',
                				title:'<?php _e('Show In Form'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(show_in_form, "") #'
            			},
            
            			{
                				field:'sequence_number',
                				title:'<?php _e('Sequence Number'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(sequence_number, "") #'
            			},
           
                    ]
                }

            }
        );      
        auth_moduleGrid = $('#auth_moduleGrid').data('kendoGrid');

    });
</script>