<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  

    <div class="row-fluid">
        <div class="span12">
            <div class="control-group">
                <label class="control-label form-lbl" for="matter_id"><?php _e('Matter') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('matter_id', set_value('matter_id', object_element('matter_id', $row)), 'class="validate[] input-xlarge  nice-remote-data-select" id="email_matter_id" tabindex="2"
                                    data-url="' . admin_url('ajax_search/matters') . '"
                                    data-text="' . object_element('matter_name', $row) . '"');
                    ?>
                </div>
            </div>



            <!--                <div class="control-group">
                                <label class="control-label form-lbl" for="email_to"><?php _e('Email To') ?></label>
                                <div class="controls">
            <?php
            echo form_input('email_to', set_value('email_to', object_element('email_to', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="email_email_to" tabindex="4" ');
            ?>
                                </div>
                            </div>                -->

                            

            <!--    <div class="control-group">
                    <label class="control-label form-lbl" for="is_successful"><?php _e('Is Successful') ?></label>
                    <div class="controls">
            <?php
            $dropdown_is_successful = yes_no_dropdown_items();
            echo form_dropdown('is_successful', $dropdown_is_successful, set_value('is_successful', object_element('is_successful', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-select" id="email_is_successful" tabindex="7"');
            ?>
                    </div>
                </div>-->

            <!--            <div class="control-group">
                            <label class="control-label form-lbl" for="email_template_id"><?php _e('Email Template') ?></label>
                            <div class="controls">
            <?php
            //echo form_dropdown('email_template_id', $dropdown_email_template_id, set_value('email_template_id', object_element('email_template_id', $row)), 'class="validate[] input-xlarge  nice-select" id="email_email_template_id" tabindex="8"');
            ?>
                            </div>
                        </div>-->

            <input type="hidden" name="email_template_id" id="email_email_template_id" />

        </div>               

    </div>

    <div class="row-fluid">
        <div class="span12">
            <div class="control-group">
                <label class="control-label form-lbl" for="receiver_id"><?php _e('Send to'); ?></label>
                <div class="controls">
                    <?php
                    echo form_input('receiver_id', set_value('receiver_id', object_element('receiver_id', $row)), 
                            'class="validate[] span11 nice-remote-data-select" id="email_receiver_id" tabindex="3" multiple="multiple"
                                    data-url="' . admin_url('ajax_search/users') . '"
                                    data-text="' . object_element('receiver_name', $row) . '"');
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row-fluid">
        <div class="span12">
            <div class="control-group">
                <label class="control-label form-lbl" for="email_subject"><?php _e('Email Subject') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('email_subject', 
                            set_value('email_subject', object_element('email_subject', $row)), 
                            'class="validate[maxSize[255]] span11 " id="email_email_subject" tabindex="5" ');
                    ?>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label form-lbl" for="email_body"><?php _e('Email Body') ?></label> 
                <div class="controls">
                    <?php
                    echo form_textarea(array('name' => 'email_body', 'rows' => 5, 'cols' => 40), 
                            decode_html(set_value('email_body', (object_element('email_body', $row)))), 
                            'class="validate[required] js-editor span11" id="email_email_body" tabindex="6"');
                    ?>
                </div>                
            </div>
        </div>
    </div>

    <div class="clear"></div>

    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'class' => 'btn btn-primary btn-large btn-form-submit',
            'data-modal-name' => 'emailModal',
            'data-window' => $window)); ?>
        
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="emailModal">
               <?php _e('Cancel'); ?>
        </a>
    </div>

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>


<ul class="hide" id="email-templates-body">
    <?php foreach($email_templates as $e): ?>
        <li id="email-template-body-<?php echo $e->email_template_id; ?>"><?php echo $e->email_template_body; ?></li>
    <?php endforeach; ?>
</ul>

<script type="text/x-kendo-template" id="editor-dropdown-email-templates-template">
    <select id="editor-dropdown-email-templates" style="width:150px">
        <option value=''><?php _e('Email Templates'); ?></option>
        <?php foreach($email_templates as $e): ?>
            <option value="<?php echo $e->email_template_id; ?>"><?php echo $e->email_template_name; ?></option>
        <?php endforeach; ?>        
    </select>
</script>

<?php
$matter_fields = array(
    '[matter_type_name]' => __('Matter Type Name'),
    '[matter_name]' => __('Matter Name'),
    '[case_number]' => __('Case Number'),
    '[court_case_number]' => __('Court case number'),
    '[attorney_name]' => __('Attorney name'),
    '[court_name]' => __('Court name'),
    '[description]' => __('Description'),
    '[open_date]' => __('Open date'),
    '[close_date]' => __('Close date')
);
?>
<script type="text/x-kendo-template" id="editor-dropdown-matter-fields-template">
    <select id="editor-dropdown-matter-fields" style="width:150px">
        <option value=''><?php _e('Matter Fields'); ?></option>
        <?php foreach($matter_fields as $key => $e): ?>
            <option value="<?php echo $key; ?>"><?php echo $e; ?></option>
        <?php endforeach; ?>        
    </select>
</script>

<script type="text/javascript">
    $(function(){
        
        htmlEditor($("#email_email_body"),{
            tools: [
                {
                    name :"emailTemplates",
                    tooltip : 'Email Templates',
                    template : $("#editor-dropdown-email-templates-template").html(),
                    exec : function(e){
                        //var editor = $(this).data("kendoEditor");
                    }
                },
                {
                    name :"matterFields",
                    tooltip : 'Matter Fields',
                    template : $("#editor-dropdown-matter-fields-template").html(),
                    exec : function(e){
                        //var editor = $(this).data("kendoEditor");
                    }
                }
            ]
        });
        
        $("#editor-dropdown-email-templates").kendoDropDownList({
            change: function(e) {            
                var emailTemplateId = e.sender.value();
                $('#email_email_template_id').val(emailTemplateId);
                var html = $('#email-template-body-'+emailTemplateId).html();
                
                $("#email_email_body").data("kendoEditor").value(html);
            }
        });
        
        $("#editor-dropdown-matter-fields").kendoDropDownList({
            change: function(e) {            
                var matterField = e.sender.value();                
                $("#email_email_body").data("kendoEditor").exec("inserthtml", { value: matterField });
            }
        });
        
    });
</script>