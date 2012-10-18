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
                            <div id="event_categoryGrid"></div>
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
    'grid_name' => 'event_category'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'event_category'
)); 
?>

<script type="text/x-kendo-template" id="event_category-quickview-template">
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
                        <td><strong><?php _e('Category Name'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('category_name'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Category Color'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('category_color'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Icon Path'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('icon_path'); ?></td>
                 	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var event_categoryGrid;
    
    $(function() {
        grid(
            $('#event_categoryGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'category_id',
                    fields: {
                        actions:{},
                        category_name: { type: 'string' },
                        category_color: { type: 'string' },
                        icon_path: { type: 'string' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#event_category-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#event_category-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
                			{
                    				field:'category_name',
                    				title:'<?php _e('Category Name'); ?>',
                    				filterable: true,
                    				//width: 200,
                    				template : '#= isnull(category_name, "") #'
                			},
                			{
                    				field:'category_color',
                    				title:'<?php _e('Category Color'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '<div class="center-inner"><div class="center" style="background-color:#= isnull(category_color, "") #;width:16px;height:16px;"></div></div>'
                			},
                			{
                    				field:'icon_path',
                    				title:'<?php _e('Icon'); ?>',
                    				filterable: true,
                    				width: 100,
                    				template : '<div class="center-inner"><img src="#= isnull(icon_path, "") #" width="32"/></div>'
                			}
                    ]
                }

            }
        );      
        event_categoryGrid = $('#event_categoryGrid').data('kendoGrid');

    });
</script>