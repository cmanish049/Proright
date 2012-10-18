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
                            <div id="eventGrid"></div>
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
    'grid_name' => 'event'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'event'
)); 
?>

<script type="text/x-kendo-template" id="event-quickview-template">
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
                        <td><strong><?php _e('Category'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('category_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Is All Day'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('is_all_day'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Begin Date'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('begin_date'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('End Date'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('end_date'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Subject'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('subject_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Description'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('description'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Event Location'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('event_location_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Priority'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('priority_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Event Status'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('event_status_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Matter'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('matter_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Client'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('client_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Private'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('is_private'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Inserter'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('inserter_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Insert Date'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('insert_date'); ?></td>
                 	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var eventGrid;
    var eventCategories = jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_categories)); ?>');
    
    $(function() {
        grid(
            $('#eventGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'event_id',
                    fields: {
                        actions:{},
                        category_id: { type: 'number' },
                        is_all_day: { type: 'number' },
                        begin_date: { type: 'date' },
                        end_date: { type: 'date' },
                        subject_id: { type: 'number' },
                        description: { type: 'string' },
                        event_location_id: { type: 'number' },
                        priority_id: { type: 'number' },
                        event_status_id: { type: 'number' },
                        matter_id: { type: 'number' },
                        client_id: { type: 'number' },
                        is_private: { type: 'number' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' },
                        updater_id: { type: 'number' },
                        update_date: { type: 'date' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#event-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#event-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
                			{
                    				field:'category_id',
                    				title:'<?php _e('Category'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(category_name, "") #',
                                    values : eventCategories
                			},
                			{
                    				field:'is_all_day',
                    				title:'<?php _e('Is All Day'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template: '<?php echo kendouiDataItemBooleanImageTemplateString('is_all_day'); ?>',
                                    values : <?php echo kendoui_yes_no_grid_filter_items(); ?>
                			},
                			{
                    				field:'begin_date',
                    				title:'<?php _e('Begin Date'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template: "<?php echo kendouiDataItemDateTimeTemplateString('begin_date'); ?>"
                			},
                			{
                    				field:'end_date',
                    				title:'<?php _e('End Date'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template: "<?php echo kendouiDataItemDateTimeTemplateString('end_date'); ?>"
                			},
                			{
                    				field:'subject',
                    				title:'<?php _e('Subject'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(subject, "") #'
                			},
                			{
                    				field:'description',
                    				title:'<?php _e('Description'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(description, "") #'
                			},
                			{
                    				field:'location_name',
                    				title:'<?php _e('Event Location'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(location_name, "") #'
                			},
                			{
                    				field:'priority_id',
                    				title:'<?php _e('Priority'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(priority_name, "") #',
                                    values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_priorities)); ?>')
                			},
                			{
                    				field:'event_status_id',
                    				title:'<?php _e('Event Status'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(event_status_name, "") #',
                                    values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_event_status)); ?>')
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
                    				field:'is_private',
                    				title:'<?php _e('Private'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template: '<?php echo kendouiDataItemBooleanImageTemplateString('is_private'); ?>',
                                    values : <?php echo kendoui_yes_no_grid_filter_items(); ?>
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
                    				template: "<?php echo kendouiDataItemDateTemplateString('insert_date'); ?>"
                			}
                    ]
                }

            }
        );      
        eventGrid = $('#eventGrid').data('kendoGrid');

    });
</script>