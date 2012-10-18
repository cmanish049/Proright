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
                            <div id="event_subjectGrid"></div>
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
    'grid_name' => 'event_subject'
)); 
?>

<?php 
$this->template->view('templates/kendo_grid_row_actions_template',array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'event_subject'
)); 
?>

<script type="text/x-kendo-template" id="event_subject-quickview-template">
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
                        <td><strong><?php _e('Subject'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('subject'); ?></td>
                 	</tr>

                	<tr>
                        <td><strong><?php _e('Is Active'); ?></strong></td>
                        <td><?php echo kendouiDataItemTemplateString('is_active'); ?></td>
                 	</tr>

            </tbody>
        </table>        
    </div>
</script>


<script type="text/javascript">
    var event_subjectGrid;
    
    $(function() {
        grid(
            $('#event_subjectGrid'),
            {
                url : '<?php echo admin_url("$controller/grid") . query_string(); ?>',
                model : {
                    id:'subject_id',
                    fields: {
                        actions:{},
                        subject: { type: 'string' },
                        is_active: { type: 'number' }
                    }
                },
                gridOptions : {
                    toolbar: [{template:$('#event_subject-toolbar-template').html()}],
                    columns: [
                        {
                            title:'<?php _e('Actions') ?>',
                            template: $('#event_subject-actions-template').html(),
                            filterable:false,
                            groupable:false,
                            sortable:false,
                            width:150,
                            encoded: false
                        },
                        
                			{
                    				field:'subject',
                    				title:'<?php _e('Subject'); ?>',
                    				filterable: true,
                    				//width: 200,
                    				template : '#= isnull(subject, "") #'
                			},
                			{
                    				field:'is_active',
                    				title:'<?php _e('Is Active'); ?>',
                    				filterable: true,
                    				width: 200,
                    				template: '<?php echo kendouiDataItemBooleanImageTemplateString('is_active'); ?>'
                			}
                    ]
                }

            }
        );      
        event_subjectGrid = $('#event_subjectGrid').data('kendoGrid');

    });
</script>