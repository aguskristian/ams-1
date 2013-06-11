<div class="container-fluid">
            <div class="row-fluid">

<div class="row-fluid">


    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">ADD NEW INCOMING DOCUMENT</a>
        <div id="page-stats" class="block-body collapse in">
        
        <?php echo $error; ?>
                  <?php echo form_open_multipart('docs/do_upload', array('class' => 'form-horizontal', 'id' => 'edit-profile')); ?>
                    
						<fieldset>
							<legend>Document Details</legend>
                          
                           <div class="control-group">
								<label class="control-label" for="input01">Date</label>
								<div class="controls">
									<input name="date" type="text" id="datepicker" />
                           		</div>
						   </div>
                                    
								
							
                            
                            <div class="control-group">
								<label class="control-label" for="input01">To</label>
								<div class="controls">
									<input name="filename" type="text" class="input-xlarge" id="input01" value="filename" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Subject</label>
								<div class="controls">
									<input name="filename" type="text" class="input-xlarge" id="input01" value="filename" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Select File</label>
								<div class="controls">
									<input type="file" class="input-xlarge" id="input01" value="file" name="file" />
								</div>
							</div>
                            
                            
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Category</label>
								<div class="controls">
                                	<?php /*
										$dropdown = array();
										
										foreach($query_category_for_combo as $row_combo) 
										{
											if($row_combo->dc_uu_code == 'all')
											{
												$dropdown[$row_combo->dc_id] = $row_combo->dc_category . ' (ext)';
											}
											else
											{
												$dropdown[$row_combo->dc_id] = $row_combo->dc_category;
											}
									    }
										echo form_dropdown('category', $dropdown, '2'); */
									?>
								</div>
							</div>
							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save</button> <button class="btn">Cancel</button>
							</div>
					 </fieldset> 	
					</form>
        
        
        </div>
        </div>
   
    </div>
</div>



