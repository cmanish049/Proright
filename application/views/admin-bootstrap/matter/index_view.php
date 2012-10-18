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
                            <div id="matterGrid"></div>
                        </div>
                    </div>
                </div>

                <div class="box-footer"></div>
            </div>
        </div>
    </div>
</div>

<?php
$this->template->view('templates/kendo_grid_toolbar_template', array(
    'edit_modal_size' => 'max-max',
    'grid_name' => 'matter'
));
?>

<?php
$this->template->view('templates/kendo_grid_row_actions_template', array(
    'edit_modal_size' => 'max-max',
    'detail_modal_size' => '600-max',
    'grid_name' => 'matter'
));
?>

<script type="text/x-kendo-template" id="matter-action-show-template">
    <div class="center center-inner">
        <a href="<?php echo admin_url("$controller/show/window/modal/id/#= id #") ?>" 
            class="basic-tooltip open-modal" 
            data-grid-selector="\#matterGrid" 
            data-modal-size="max-max" 
            data-modal-name="matterModal"
             title="<?php _e('Show Details'); ?>">
             <i class="icon-details"></i>
        </a>
    </div>
</script>

<script type="text/x-kendo-template" id="matter-details-template">
    <div class="row">
        <div class="span12">
            <div id="matter-#= matter_id #" class="tabstrip">
                <ul>
                    <li class="k-state-active"><?php _e('Linked Clients'); ?></li>
                    <li><?php _e('Notes'); ?></li>
                    <li><?php _e('Emails'); ?></li>
                    <li><?php _e('Documents'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</script>

<script type="text/javascript">
    var matterGrid;
    function detailInit(e) {             
        var detailRow = e.detailRow;
        var containerId = detailRow.find('.tabstrip').attr('id');
        var queryString = 'container_tag_id='+containerId+'&show_only_grid=1&matter_id=' + e.data.id;
        
        tab(detailRow.find(".tabstrip"),{
            contentUrls: [
                '<?php echo admin_url('matter_linked_client/index?') ?>' + queryString,
                '<?php echo admin_url('matter_note/index?') ?>' + queryString,              
                '<?php echo admin_url('email/index?') ?>' + queryString,              
                '<?php echo admin_url('matter_document/index?') ?>' + queryString           
            ]
        });

        
    }
    $(function() {
        grid(
        $('#matterGrid'),
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
                detailTemplate: kendo.template($("#matter-details-template").html()),
                detailInit: detailInit, 
                selectable : 'cell',//'multiple cell',
                toolbar: [{template:$('#matter-toolbar-template').html()}],
                columns: [
                    {
                        title:'<?php _e('Actions') ?>',
                        template: $('#matter-actions-template').html(),
                        filterable:false,
                        groupable:false,
                        sortable:false,
                        width:150,
                        encoded: false,
                        showQuickView: false
                    },
                    {
                        title:'<?php _e('Details') ?>',
                        template: $('#matter-action-show-template').html(),
                        filterable:false,
                        groupable:false,
                        sortable:false,
                        width:100,
                        encoded: false,
                        showQuickView: false
                    },
                        
                    {
                        field:'matter_type_id',
                        title:'<?php _e('Matter Type'); ?>',
                        filterable: true,
                        width: 200,
                        template : '#= isnull(matter_type_name, "") #',
                        values : jQuery.parseJSON('<?php echo parse_json(parse_kendoui_dropdown_array($dropdown_matter_types)); ?>')
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
                        template : "<?php echo kendouiDataItemDateTemplateString('open_date') ?>"
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
                        template : "<?php echo kendouiDataItemDateTimeTemplateString('insert_date') ?>"
                        //format : "{0:yyyy-MM-dd hh:mm:ss}"
                    }
                ]
            }

        }
    );      
        matterGrid = $('#matterGrid').data('kendoGrid');

    });
</script>


<script type="text/x-kendo-template" id="matter-quickview-template">
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
                    <td><?php echo kendouiDataItemDateTimeTemplateString('insert_date'); ?></td>
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
