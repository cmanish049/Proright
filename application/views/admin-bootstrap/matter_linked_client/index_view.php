<?php 
$container_tag_selector = $this->input->get('container_tag_id'); 
$container_tag_selector = $container_tag_selector?"#$container_tag_selector":'body';
?>

<?php if($this->input->get('show_only_grid')=='1'): ?>
<div class="grid-container">
    <div id="matter_linked_clientGrid"></div>
</div>
<?php else: ?>
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
                                <div id="matter_linked_clientGrid"></div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer"></div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php 
$this->template->view('templates/kendo_grid_toolbar_template',array(
    'edit_modal_size' => '800-max',
    'grid_name' => 'matter_linked_client'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'matter_linked_client'
)); 
?>

<script type="text/javascript">
    var matter_linked_clientGrid;
    var containerTagObj = $('<?php echo $container_tag_selector; ?>');
    $(function() {
        grid(
            containerTagObj.find('#matter_linked_clientGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'linked_id',
                    fields: {
                        actions:{},
                        linked_type_id: { type: 'number' },
                        matter_id: { type: 'number' },
                        client_id: { type: 'number' },
                        description: { type: 'string' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' },
                        updater_id: { type: 'number' },
                        update_date: { type: 'date' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#matter_linked_client-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#matter_linked_client-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'linked_type_id',
                				title:'<?php _e('Link Type'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(linked_type_name, "") #'
            			},
            			{
                				field:'matter_name',
                				title:'<?php _e('Matter'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(matter_name, "") #'
            			},
            			{
                				field:'client_name',
                				title:'<?php _e('Client'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(client_name, "") #'
            			},
            			{
                				field:'description',
                				title:'<?php _e('Description'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(description, "") #'
            			},
            			{
                				field:'inserter_name',
                				title:'<?php _e('Inserter'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(inserter_name, "") #'
            			},
            			{
                				field:'insert_date',
                				title:'<?php _e('Insert Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(insert_date, "") #'
            			}
                    ]
                }

            }
        );      
        matter_linked_clientGrid = $('#matter_linked_clientGrid').data('kendoGrid');

    });
</script>

<script type="text/x-kendo-template" id="matter_linked_client-quickview-template">
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
                    <td><strong><?php _e('Link Type'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('linked_type_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Matter'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('matter_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Client'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('client_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Description'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('description'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Inserter'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('inserter_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Insert Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('insert_date'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>

