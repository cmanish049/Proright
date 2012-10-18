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
                            <div id="event_priorityGrid"></div>
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
    'grid_name' => 'event_priority'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'event_priority'
)); 
?>

<script type="text/x-kendo-template" id="event_priority-quickview-template">
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
                        <td><strong><?php _e('Priority Name'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('priority_name'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Priority Color'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('priority_color'); ?></td>
                 	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var event_priorityGrid;
    
    $(function() {
        grid(
            $('#event_priorityGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'priority_id',
                    fields: {
                        actions:{},
                        priority_name: { type: 'string' },
                        priority_rating: { type: 'number' },
                        priority_color: { type: 'string' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#event_priority-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#event_priority-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
                			{
                    				field:'priority_name',
                    				title:'<?php _e('Priority Name'); ?>',
                    				filterable: true,
                    				//width: 200,
                    				template : '#= isnull(priority_name, "") #'
                			},
                			{
                    				field:'priority_rating',
                    				title:'<?php _e('Priority Rating'); ?>',
                    				filterable: true,
                    				width: 150,
                    				template : '#= isnull(priority_rating, "") #'
                			},
                			{
                    				field:'priority_color',
                    				title:'<?php _e('Priority Color'); ?>',
                    				filterable: true,
                    				width: 120,
                    				template : '<div class="center-inner"><div class="center" style="background-color:#= isnull(priority_color, "") #;width:16px;height:16px;"></div></div>'
                			}
                    ]
                }

            }
        );      
        event_priorityGrid = $('#event_priorityGrid').data('kendoGrid');

    });
</script>