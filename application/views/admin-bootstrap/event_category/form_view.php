<div class="form-container">
    <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal ajax-form"'); ?>                       
    <?php echo form_hidden('redirect', $redirect); ?>  
    
    <div class="row-fluid">
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="category_name"><?php _e('Category Name') ?></label>
                    <div class="controls">
                        <?php echo form_input('category_name',  
                        set_value('category_name', object_element('category_name', $row)), 
                        'class="validate[required,maxSize[100]] input-xlarge " id="event_category_category_name" tabindex="2" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="category_color"><?php _e('Category Color') ?></label>
                    <div class="controls">
                        <?php echo form_input('category_color',  
                        set_value('category_color', object_element('category_color', $row)), 
                        'class="validate[maxSize[10]] input-xlarge " id="event_category_category_color" tabindex="3" '); ?>
                    </div>
                </div>                
                    
                <div class="control-group">
                    <label class="control-label form-lbl" for="icon_path"><?php _e('Icon') ?></label>
                    <div class="controls">
                        <?php if(object_element('icon_path', $row) && file_exists(object_element('icon_path', $row))): ?>
                            <div class="clearfix" style="max-width: 100px">
                                <img src="<?php echo $row->icon_path ?>" />
                            </div>
                            <hr />
                        <?php endif; ?>
                        
                        <div class="clearfix">
                            <input id="file" name="file" type="file" />
                        
                            <?php echo form_input(array('name' => 'icon_path','type' => 'hidden'),  
                            set_value('icon_path', object_element('icon_path', $row)), 
                            'class="validate[maxSize[255]] input-xlarge " id="event_category_icon_path" tabindex="4" '); ?>

                            <input id="temp_file_path" name="temp_file_path" type="hidden" value="" />
                        </div>
                    </div>
                </div>                
        
    </div>
    
    <div class="form-actions">
        <?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'class' => 'btn btn-primary btn-large btn-form-submit',
            'data-modal-name' => 'event_categoryModal',
            'data-window' => $window)); ?>
        <a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
           data-window="<?php echo $window ?>"
           data-modal-name="event_categoryModal">
               <?php _e('Cancel'); ?>
        </a>
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