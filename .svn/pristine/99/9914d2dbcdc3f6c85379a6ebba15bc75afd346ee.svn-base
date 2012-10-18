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
                            <div id="Grid"></div>
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
    'grid_name' => ''
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => ''
)); 
?>

<script type="text/x-kendo-template" id="-quickview-template">
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
                    <td><strong><?php _e('Matter Type'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('matter_type_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Matter Name'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('matter_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Case Number'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('case_number'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Court Case Number'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('court_case_number'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Attorney'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('attorney_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Court'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('court_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Description'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('description'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Open Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('open_date'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Close Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('close_date'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Is Closed'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('is_closed'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Inserter'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('inserter_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Insert Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('insert_date'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Updater'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('updater_id'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Update Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('update_date'); ?></td>
             	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var Grid;
    
    $(function() {
        grid(
            $('#Grid'),
            {
                url : '<?php echo admin_url("$controller/grid"); ?>',
                model : {
                    id:'matter_id',
                    fields: {
                        actions:{},
                        matter_type_id: { type: 'number' },
                        matter_name: { type: 'string' },
                        case_number: { type: 'string' },
                        court_case_number: { type: 'string' },
                        attorney_id: { type: 'number' },
                        court_id: { type: 'number' },
                        description: { type: 'string' },
                        open_date: { type: 'date' },
                        close_date: { type: 'date' },
                        is_closed: { type: 'number' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' },
                        updater_id: { type: 'number' },
                        update_date: { type: 'date' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'matter_type_id',
                				title:'<?php _e('Matter Type'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(matter_type_id, "") #'
            			},
            			{
                				field:'matter_name',
                				title:'<?php _e('Matter Name'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(matter_name, "") #'
            			},
            			{
                				field:'case_number',
                				title:'<?php _e('Case Number'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(case_number, "") #'
            			},
            			{
                				field:'court_case_number',
                				title:'<?php _e('Court Case Number'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(court_case_number, "") #'
            			},
            			{
                				field:'attorney_id',
                				title:'<?php _e('Attorney'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(attorney_id, "") #'
            			},
            			{
                				field:'court_id',
                				title:'<?php _e('Court'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(court_id, "") #'
            			},
            			{
                				field:'description',
                				title:'<?php _e('Description'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(description, "") #'
            			},
            			{
                				field:'open_date',
                				title:'<?php _e('Open Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(open_date, "") #'
            			},
            			{
                				field:'close_date',
                				title:'<?php _e('Close Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(close_date, "") #'
            			},
            			{
                				field:'is_closed',
                				title:'<?php _e('Is Closed'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(is_closed, "") #'
            			},
            			{
                				field:'inserter_id',
                				title:'<?php _e('Inserter'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(inserter_id, "") #'
            			},
            			{
                				field:'insert_date',
                				title:'<?php _e('Insert Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(insert_date, "") #'
            			},
            			{
                				field:'updater_id',
                				title:'<?php _e('Updater'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(updater_id, "") #'
            			},
            			{
                				field:'update_date',
                				title:'<?php _e('Update Date'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(update_date, "") #'
            			}
                    ]
                }

            }
        );      
        Grid = $('#Grid').data('kendoGrid');

    });
</script>