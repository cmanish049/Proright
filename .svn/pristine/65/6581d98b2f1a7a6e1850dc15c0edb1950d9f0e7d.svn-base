<div class="section corners">
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
                            <div id="cittyGrid"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/x-kendo-template" id="citty-toolbar-template">
    <a href="<?php echo $edit_url ?>" class="modal-for-grid btn btn-primary modal-iframe" title="<?php _e('New'); ?>"
       data-modal-size="max-max" data-modal-name="cittyModal" data-grid-selector="\#cittyGrid">
        <span class="icon icon-plus-sign icon-white"></span> <?php _e('New'); ?>
    </a>
    
    <a href="<?php echo admin_url("$controller/grid"); ?>" class="btn btn-primary pull-right action-reset-grid" 
       data-modal-name="cittyModal" 
       data-grid-selector="\#cittyGrid">
        <i class="icon-refresh icon-white"></i> <?php _e('Clear Filters'); ?>
    </a>        
</script>

<script type="text/x-kendo-template" id="citty-actions-template">
    
    <div class="btn-group grid-row-action-menu">
        <a href="<?php echo admin_url("$controller/details/id/#= id #") ?>" 
                       class="action-quickview btn btn-mini basic-tooltip"
                       data-grid-selector="\#cittyGrid" data-modal-size="800-max" data-modal-name="cittyModal"
                       data-quickview-template-selector="\#citty-quickview-template"
                        title="<?php _e('Quick View'); ?>">
                        <i class="icon-list-alt"></i> <span><?php _e('Quick View'); ?></span></a>
    
        <a href="<?php echo admin_url("$controller/edit/window/modal/id/#= id #") ?>" 
                           class="modal-for-grid action-edit btn btn-mini basic-tooltip" 
                           data-grid-selector="\#cittyGrid" data-modal-size="max-max" data-modal-name="cittyModal"
                            title="<?php _e('Edit'); ?>">
                            <i class="icon-edit"></i> <span><?php _e('Edit'); ?></span></a>

        <a href="<?php echo admin_url("$controller/delete/id/#= id #") ?>" 
                           class="action-ajax action-delete show-confirm btn btn-mini basic-tooltip" 
                           data-grid-selector="\#cittyGrid"
                            title="<?php _e('Delete'); ?>">
                            <i class="icon-remove"></i> <span><?php _e('Delete'); ?></span></a>
    </div>         
</script>


<script type="text/x-kendo-template" id="citty-quickview-template">
    <div id="quickview-container">
        <table class="quickview-grid">
            <thead>
                <tr>
                    <th><?php _e('Label'); ?></th>
                    <th><?php _e('Value'); ?></th>
                </tr>
            </thead>
            <tbody>  
                
            	<tr>
                    <td><strong><?php _e('City Name'); ?> : </strong></td>
                    <td><?php echo kendouiDataItemTemplateString('city_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Country Id'); ?> : </strong></td>
                    <td><?php echo kendouiDataItemTemplateString('country_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('State Id'); ?> : </strong></td>
                    <td><?php echo kendouiDataItemTemplateString('state_id'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var cittyGrid;
    
    $(function() {
        grid(
            $('#cittyGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'city_id',
                    fields: {
                        actions:{},
                        city_name: { type: 'string' },
                        country_id: { type: 'number' },
                        state_id: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#citty-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#citty-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'city_name',
                				title:'<?php _e('City Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(city_name, "") #'
            			},
            
            			{
                				field:'country_id',
                				title:'<?php _e('Country Id'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(country_id, "") #'
            			},
            
            			{
                				field:'state_id',
                				title:'<?php _e('State Id'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(state_id, "") #'
            			},
           
                    ]
                }

            }
        );      
        cittyGrid = $('#cittyGrid').data('kendoGrid');

    });
</script>