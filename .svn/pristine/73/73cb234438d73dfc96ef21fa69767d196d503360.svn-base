<?php 
$container_tag_selector = $this->input->get('container_tag_id'); 
$container_tag_selector = $container_tag_selector?"#$container_tag_selector":'body';
?>

<?php if($this->input->get('show_only_grid')=='1'): ?>
<div class="grid-container">
    <div id="matter_documentGrid"></div>
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
                            <div id="matter_documentGrid"></div>
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
    'edit_modal_size' => 'max-max',
    'grid_name' => 'matter_document'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'matter_document'
)); 
?>

<script type="text/javascript">   
    var containerTagObj = $('<?php echo $container_tag_selector; ?>');
    
    $(function() {
        
        grid(
            containerTagObj.find('#matter_documentGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'doc_id',
                    fields: {
                        actions:{},
                        doc_type_id: { type: 'number' },
                        doc_status_id: { type: 'number' },
                        doc_file_path: { type: 'string' },
                        doc_name: { type: 'string' },
                        matter_id: { type: 'number' },
                        client_id: { type: 'number' },
                        author: { type: 'string' },
                        description: { type: 'string' },
                        inserter_id: { type: 'number' },
                        insert_date: { type: 'date' },
                        updater_id: { type: 'number' },
                        update_date: { type: 'date' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#matter_document-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#matter_document-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        {
                            title:'<?php _e('Download') ?>',
                            template: '<div class="center-inner"><a href="<?php echo admin_url('matter_document/download/id/#=id#') ?>"><i class="icon-download-alt"></i></a></div>',
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:100,
                            encoded: false
                        },
                        
                			{
                    				field:'doc_type_id',
                    				title:'<?php _e('Doc Type'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(doc_type_name, "") #'
                			},
                			{
                    				field:'doc_status_id',
                    				title:'<?php _e('Doc Status'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(status_name, "") #'
                			},
                			/*{
                    				field:'doc_file_path',
                    				title:'<?php _e('Doc Path'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(doc_file_path, "") #'
                			},*/
                			{
                    				field:'doc_name',
                    				title:'<?php _e('Doc Name'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(doc_name, "") #'
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
                    				field:'author',
                    				title:'<?php _e('Author'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template : '#= isnull(author, "") #'
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
                    				template: "<?php echo kendouiDataItemDateTemplateString('insert_date'); ?>"
                			}
                    ]
                }

            }
        );              

    });
</script>


<script type="text/x-kendo-template" id="matter_document-quickview-template">
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
                        <td><strong><?php _e('Doc Type'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('doc_type_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Doc Status'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('doc_status_id'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Doc Path'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('doc_file_path'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Doc Name'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('doc_name'); ?></td>
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
                        <td><strong><?php _e('Author'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('author'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Description'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('description'); ?></td>
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

