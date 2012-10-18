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
                            <div id="matter_fact_typeGrid"></div>
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
    'grid_name' => 'matter_fact_type'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'matter_fact_type'
)); 
?>

<script type="text/x-kendo-template" id="matter_fact_type-quickview-template">
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
                    <td><strong><?php _e('Fact Type Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('fact_type_name'); ?></td>
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
    var matter_fact_typeGrid;
    
    $(function() {
        grid(
            $('#matter_fact_typeGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'fact_type_id',
                    fields: {
                        actions:{},
                        fact_type_name: { type: 'string' },
                        is_active: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#matter_fact_type-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#matter_fact_type-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'fact_type_name',
                				title:'<?php _e('Fact Type Name'); ?>',
                				filterable: true,
                				//width: 200,
                				template : '#= isnull(fact_type_name, "") #'
            			},
            			{
                				field:'is_active',
                				title:'<?php _e('Is Active'); ?>',
                				filterable: true,
                				width: 150,
                				template : '<?php echo kendouiDataItemBooleanImageTemplateString('is_active') ?>',
                                values : <?php echo kendoui_yes_no_grid_filter_items(); ?>
            			}
                    ]
                }

            }
        );      
        matter_fact_typeGrid = $('#matter_fact_typeGrid').data('kendoGrid');

    });
</script>