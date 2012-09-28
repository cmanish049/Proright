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
                            <div id="user_typeGrid"></div>
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
    'grid_name' => 'user_type'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'user_type'
)); 
?>

<script type="text/x-kendo-template" id="user_type-quickview-template">
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
                    <td><strong><?php _e('User Type Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('user_type_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Active'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('active'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var user_typeGrid;
    
    $(function() {
        grid(
            $('#user_typeGrid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'user_type_id',
                    fields: {
                        actions:{},
                        user_type_name: { type: 'string' },
                        active: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#user_type-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#user_type-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'user_type_name',
                				title:'<?php _e('User Type Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(user_type_name, "") #'
            			},
            			{
                				field:'active',
                				title:'<?php _e('Active'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(active, "") #'
            			}
                    ]
                }

            }
        );      
        user_typeGrid = $('#user_typeGrid').data('kendoGrid');

    });
</script>