<?php 
$container_tag_selector = $this->input->get('container_tag_id'); 
$container_tag_selector = $container_tag_selector?"#$container_tag_selector":'body';
?>

<?php if($this->input->get('show_only_grid')=='1'): ?>
<div class="grid-container">
    <div id="matter_noteGrid"></div>
</div>
<?php else: ?>
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
                                <div id="matter_noteGrid"></div>
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
    'grid_name' => 'matter_note'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'matter_note'
)); 
?>


<script type="text/javascript">
    var matter_noteGrid;
    var containerTagObj = $('<?php echo $container_tag_selector; ?>');
    $(function() {
        grid(
            containerTagObj.find('#matter_noteGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'note_id',
                    fields: {
                        actions:{},
                        note_type_id: { type: 'number' },
                        note_date: { type: 'date' },
                        description: { type: 'string' },
                        phone: { type: 'string' },
                        minute: { type: 'number' },
                        matter_id: { type: 'number' },
                        client_id: { type: 'number' },
                        operator_id: { type: 'number' },
                        is_private: { type: 'number' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' },
                        updater_id: { type: 'number' },
                        udpate_date: { type: 'date' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#matter_note-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#matter_note-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
            			{
                				field:'note_type_id',
                				title:'<?php _e('Note Type'); ?>',
                				filterable: true,
                				width: 300,
                				template : '#= isnull(note_type_name, "") #'
            			},
            			{
                				field:'note_date',
                				title:'<?php _e('Note Date'); ?>',
                				filterable: true,
                				width: 200,
                                template : "<?php echo kendouiDataItemDateTimeTemplateString('note_date'); ?>"
            			},
            			{
                				field:'description',
                				title:'<?php _e('Description'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(description, "") #'
            			},
            			/*{
                				field:'phone',
                				title:'<?php _e('Phone'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(phone, "") #'
            			},
            			{
                				field:'minute',
                				title:'<?php _e('Minute'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(minute, "") #'
            			},*/
            			{
                				field:'matter_id',
                				title:'<?php _e('Matter'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(matter_name, "") #'
            			},
            			{
                				field:'client_id',
                				title:'<?php _e('Client'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(client_name, "") #'
            			},
            			/*{
                				field:'operator_id',
                				title:'<?php _e('Operator'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(operator_id, "") #'
            			},*/
            			{
                				field:'is_private',
                				title:'<?php _e('Is Private'); ?>',
                				filterable: true,
                				width: 200,
                				template : '#= isnull(is_private, "") #'
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
            			}
                    ]
                }

            }
        );      
        matter_noteGrid = $('#matter_noteGrid').data('kendoGrid');

    });
</script>


<script type="text/x-kendo-template" id="matter_note-quickview-template">
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
                    <td><strong><?php _e('Note Type'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('note_type_name'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Note Date'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('note_date'); ?></td>
             	</tr>

            	<tr>
                    <td><strong><?php _e('Description'); ?></strong></td>
                    <td><?php echo kendouiDataItemTemplateString('description'); ?></td>
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
                    <td><strong><?php _e('Is Private'); ?></strong></td>
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
