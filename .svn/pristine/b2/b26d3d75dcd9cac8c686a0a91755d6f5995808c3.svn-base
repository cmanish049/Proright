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
                    <div class="section-top-padding">
						<?php
							echo flash_data_alert_admin();
							echo form_alert_admin();
							echo alert_admin($error, 'error');
							echo alert_admin($success, 'success');
							echo alert_admin($warning, 'warning');
						?>
					
                            <?php echo form_open_multipart($form_action, 'class="form-validation-engine form-horizontal"'); ?>

								<?php echo form_hidden('country_id', object_element('country_id', $row)); ?>
								<?php echo form_hidden('redirect', $redirect); ?>

										<style type="text/css">.k-input{display: block}</style>
										<script type="text/javascript">
											$(function(){
												
												
												/*$("#select").kendoComboBox({                        
													filter: "contains",
													suggest: true,
													index: 0,
													ignoreCase : false,
													highlightFirst : true,
													placeholder: 'Please select',
													dataBound : function(e){
														this.wrapper.removeClass(this.element.attr('class'));
													}
													//value : 'd'
												});*/
											});
										</script>             
										
										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<select id="select"
														class="validate[funcCall[validateDropdownRequired]] nice-select input-large" 
														name="aaaaaa">
													<option value=""></option>
													<option value="a">X-Small</option>
													<option value="b">Small</option>
													<option value="c">Medium</option> 
													<optgroup label="Others">
														<option value="d">Large</option>
														<option value="e">X-Large</option>
														<option value="f">2X-Large</option>
													</optgroup><option value=""></option>
													<option value="a">X-Small</option>
													<option value="b">Small</option>
													<option value="c">Medium</option> 
													<optgroup label="Others">
														<option value="d">Large</option>
														<option value="e">X-Large</option>
														<option value="f">2X-Large</option>
													</optgroup>
													
												</select>
											</div>
										</div> 
										
										
										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<?php
												echo form_input(array('name' => 'numeric', 'type' => 'text'), set_value('numeric', object_element('date', $row)), 'class="validate[maxSize[100],required,custom[integer]] input-integer" date id="integer" tabindex="2" ');
												?>
											</div>
										</div>  
										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<?php
												echo form_input(array('name' => 'datetime', 'type' => 'text'), set_value('datetime', object_element('date', $row)), 'class="validate[maxSize[100],required,funcCall[validateDateTime]] input-datetime" date id="datetime" tabindex="2" ');
												?>
											</div>
										</div>

										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<?php
												echo form_input(array('name' => 'date', 'type' => 'date'), set_value('date', object_element('date', $row)), 'class="validate[maxSize[100],required,funcCall[validateDate]] input-date datepicker" date id="date" tabindex="2" ');
												?>
											</div>
										</div>   
										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<?php
												echo form_input(array('time' => 'time', 'type' => 'text'), set_value('time', object_element('time', $row)), 'class="validate[maxSize[100],required,funcCall[validateTime]] input-time" date id="time" tabindex="2" ');
												?>
											</div>
										</div>

										
										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<?php
												echo form_input(array('time' => 'time', 'type' => 'text'), set_value('time', object_element('time', $row)), 'class="validate[maxSize[100],required,funcCall[validateTime]] input-time" date id="time" tabindex="2" ');
												?>
											</div>
										</div>


										<div class="control-group">
											<label class="control-label form-lbl" for="country_name">Country Name</label>
											<div class="controls">
												<?php
												echo form_input(array('name' => 'country_name', 'type' => 'text'), set_value('country_name', object_element('country_name', $row)), 'class="validate[maxSize[100],required] input-xlarge" id="country_name" tabindex="2" ');
												?>
											</div>
										</div>                

										<div class="control-group">
											<label class="control-label form-lbl" for="country_seo">Country Seo</label>
											<div class="controls">
												<?php echo form_input('country_seo', set_value('country_seo', object_element('country_seo', $row)), 'class="validate[maxSize[100]] input-xlarge" id="country_seo" tabindex="3" '); ?>
											</div>
										</div>                

										<div class="form-actions">
											<?php echo form_submit(array('name' => 'button', 'value' => __('Save'), 'id' => 'save', 'class' => 'btn btn-primary btn-large')); ?>
											<a href="<?php echo $index_url; ?>" class="btn btn-large btn-cancel-form"
											   data-window="<?php echo $window ?>"
											   data-modal-name="countryModal">
												   <?php _e('Cancel'); ?>
											</a>
										</div>
									

								<?php echo form_close(); ?>
								<!--############################ Form  Bitişi ############################ -->
                        
                    </div>
                </div>

                <div class="box-footer">

                </div>
            </div>
        </div>
    </div>        
</div>
