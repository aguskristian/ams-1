<div class="container-fluid">
            <div class="row-fluid">

<div class="row-fluid">


    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">NOTA DINAS</a>
        <div id="page-stats" class="block-body collapse in">
        
        <br /><br  />
        			 
        			<?php echo $error; ?>
                  	<?php echo form_open_multipart('docs/save', array('class' => 'form-horizontal', 'id' => 'edit-profile')); ?>
                    
						<fieldset>
							
                           
                           
                          
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Nomer</label>
								<div class="controls">
									<input name="docs_no" type="text" value="" />
								</div>
							</div>
                           
                           <div class="control-group">
								<label class="control-label" for="input01">Tanggal</label>
								<div class="controls">
									<input name="docs_date" type="text" id="docs_date" />
                           		</div>
						   </div>
                           
                           <div class="control-group">
								<label class="control-label" for="input01">Dari</label>
								<div class="controls">
									<input name="docs_from" type="text" value="" />
								</div>
							</div>
                                    
							<div class="control-group">
								<label class="control-label" for="input01">Kepada</label>
								<div class="controls">
									<select>
                                      <option value="gm">General Manager</option>
                                      <option value="mc">Manager Customer Service</option>
                                      <option value="mf">Manager Keuangan</option>
                                      <option value="mi">Manager Internal Service</option>
                                      <option value="mo">Manager Operasi</option>
                                      <option value="mq">Manager Safety Security & Quality Control</option>
                                      <option value="mt">Manager Teknik</option>
                                      <option value="mw">Manager Cargo</option>
                                    </select>
								</div>
							</div>	
							
                            
                            
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Tembusan</label>
								<div class="controls">
									<input name="docs_copy" type="text" value="" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Perihal</label>
								<div class="controls">
									<input name="docs_subject" type="text" value="" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Keterangan</label>
								<div class="controls">
									<textarea cols="40" rows="5" name="docs_description"></textarea>
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Pilih File</label>
								<div class="controls">
									<input type="file" value="file" name="file" />
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



