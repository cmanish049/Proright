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
                            <div id="statusGrid"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php 
$this->template->view('templates/kendo_grid_toolbar_template',array(
    'edit_modal_size' => 'max-max',
    'grid_name' => 'status'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'status',
    'edit_url_query_string' => query_string(array('status_type' => $status_type), NULL, FALSE),
    'delete_url_query_string' => query_string(array('status_type' => $status_type), NULL, FALSE)
)); 
?>

<script type="text/x-kendo-template" id="status-quickview-template">
    <div id="quickview-container">
        <table class="quickview-grid">
            <thead>
                <tr>
                    <th class="label"><?php _e('Label'); ?></th>
                    <th class="value"><?php _e('Value'); ?></th>
                </tr>
            </thead>
            <tbody>  
                
            	<tr>
                    <td><strong><?php _e('Status Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('status_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Is Active'); ?></strong></td>
                    <td><?php echo kendouiDataItemBooleanImageTemplateString('is_active',''); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>

<script type="text/javascript">
    var statusGrid;    
    $(function() {
        grid(
            $('#statusGrid'),
            {
                url : '<?php echo $grid_url; ?>',
                model : {
                    id:'status_id',
                    fields: {
                        actions:{},
                        status_name: { type: 'string' },
                        is_active: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#status-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#status-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'status_name',
                				title:'<?php _e('Status Name'); ?>',
                				filterable: true,
                				//width: 200,
                				template : '#= isnull(status_name, "") #'
            			},
            
            			{
                				field:'is_active',
                				title:'<?php _e('Is Active'); ?>',
                				filterable: true,
                				width: 150,
                				template : '<?php echo kendouiDataItemBooleanImageTemplateString('is_active'); ?>',
                                values : <?php echo kendoui_yes_no_grid_filter_items(); ?>
                                
            			}
           
                    ]
                }

            }
        );      
        statusGrid = $('#statusGrid').data('kendoGrid');

    });
</script>