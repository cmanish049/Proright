<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  

    <div class="row-fluid">                
        <div class="span5">
            

            <!--                <div class="control-group">
                            <label class="control-label form-lbl" for="doc_file_path"><?php _e('Doc Path') ?></label>
                            <div class="controls">
            <?php
            echo form_input('doc_file_path', set_value('doc_file_path', object_element('doc_file_path', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="matter_document_doc_file_path" tabindex="4" ');
            ?>
                            </div>
                        </div>                -->
            

            <div class="control-group">
                <label class="control-label form-lbl" for="matter_id"><?php _e('Matter') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('matter_id', set_value('matter_id', object_element('matter_id', $row)), 'class="validate[funcCall[validateDropdownRequired]] input-xlarge  nice-remote-data-select" id="matter_document_matter_id" tabindex="6" 
                                                data-url="' . admin_url('ajax_search/matters') . '"
                                                data-text="' . object_element('matter_name', $row) . '"');
                    ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label form-lbl" for="client_id"><?php _e('Client') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('client_id', set_value('client_id', object_element('client_id', $row)), 'class="validate[] input-xlarge nice-remote-data-select" id="matter_document_client_id" tabindex="7"
                                            data-url="' . admin_url('ajax_search/users?is_admin=0') . '"
                                            data-text="' . object_element('client_name', $row) . '"');
                    ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label form-lbl" for="author"><?php _e('Author') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('author', set_value('author', object_element('author', $row)), 'class="validate[maxSize[255]] input-xlarge " id="matter_document_author" tabindex="8" ');
                    ?>
                </div>
            </div>                

            <div class="control-group">
                <label class="control-label form-lbl" for="description"><?php _e('Description') ?></label> 
                <div class="controls">
                    <?php
                    echo form_textarea(array('name' => 'description', 'rows' => 3, 'cols' => 40), set_value('description', (object_element('description', $row))), 'class="validate[] input-xlarge js-editor " id="matter_document_description" tabindex="9"');
                    ?>
                </div>                
            </div>
            
        </div>

        <div class="span7">
            
            <div class="control-group">
                <label class="control-label form-lbl" for="doc_type_id"><?php _e('Doc Type') ?></label>
                <div class="controls">
                    <?php
                    echo form_dropdown('doc_type_id', $dropdown_doc_type_id, set_value('doc_type_id', object_element('doc_type_id', $row)), 'class="validate[] input-xlarge  nice-select" id="matter_document_doc_type_id" tabindex="2"');
                    ?>
                </div>
            </div>
                        
            <div class="control-group">
                <label class="control-label form-lbl" for="doc_status_id"><?php _e('Doc Status') ?></label>
                <div class="controls">
                    <?php
                    echo form_dropdown('doc_status_id', $dropdown_doc_status_id, set_value('doc_status_id', object_element('doc_status_id', $row)), 
                            'class="validate[] input-xlarge  nice-select" id="matter_document_doc_status_id" tabindex="3"');
                    ?>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label form-lbl" for="doc_name"><?php _e('Doc Name') ?></label>
                <div class="controls">
                    <?php
                    echo form_input('doc_name', set_value('doc_name', object_element('doc_name', $row)), 'class="validate[required,maxSize[255]] input-xlarge " id="matter_document_doc_name" tabindex="5" ');
                    ?>
                </div>
            </div>    
            
            <div class="control-group">
                <label class="control-label form-lbl" for="file"><?php _e('File') ?></label>
                <div class="controls">                                        
                    
                    <input id="file" name="file" type="file" />
                    <input id="doc_file_name" name="doc_file_name" type="hidden" 
                           value="<?php echo set_value('doc_file_name', object_element('doc_file_name', $row)) ?>" />
                    <input id="doc_file_path" name="doc_file_path" type="hidden" 
                           value="<?php echo set_value('doc_file_path', object_element('doc_file_path', $row)) ?>" />
                    
                    <input id="temp_file_path" name="temp_file_path" type="hidden" 
                           value="<?php echo set_value('temp_file_path') ?>" />
                </div>
            </div>                
        </div>
        
        <div class="clear"></div>
        <div class="form-actions">
            <?php $this->template->view('templates/form_footer_buttons_view',array('modal_name'=>'matter_documentModal')); ?>            
        </div>
    </div>        

    <?php echo form_close(); ?>
    <!--############################ Form  Bitişi ############################ -->
</div>

<script type="text/javascript">		
		$(function() {
            
            $("#file").kendoUpload({
                multiple : false,
                showFileList : true,
                async: {
                    saveUrl: "<?php echo admin_url('ajax/upload_tempfile') ?>",
                    autoUpload: true
                    //removeUrl: "",
                    //batch : false,
                    //removeVerb : 'DELETE'
                    //removeField: "fileNames[]"
                },
                success : function(e){
                    var json = e.response;
                    if (json.error=='yes') {
                        return false;
                    }
                    
                    var fileData = json.file_data;
                    $('#doc_file_name').val(fileData.file_name);
                    $('#temp_file_path').val(fileData.file_path);
                    
                    var wrapper = $(this.wrapper);
                    var fieldListObj = wrapper.find('.k-file');
                    if (fieldListObj.length>1) {
                        fieldListObj.first().remove();
                    }
                },
                upload : function(e) {
                                        
                    /*e.data = {
                        fileDescription: $("#fileDescription").val()
                    };*/
                },
                select: function(){
                    //console.log(this);
                }
            });
            
		});
</script>