<div class="container-fluid">
            <div class="row-fluid">

<div class="row-fluid">


    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">ADD NEW INCOMING DOCUMENT</a>
        <div id="page-stats" class="block-body collapse in">
        
        <br /><br  />
        			<?php echo $error; ?>
                  	<?php echo form_open_multipart('docs/do_upload', array('class' => 'form-horizontal', 'id' => 'edit-profile')); ?>
                    
						<fieldset>
							
                          
                          
                           <div class="control-group">
								<label class="control-label" for="input01">Jenis</label>
								<div class="controls">
                                	<select>
                                      <option value="memo">Memo</option>
                                      <option value="notadinas" selected="selected">Nota Dinas</option>
                                      <option value="surat">Surat</option>
                                      <option value="sk">Surat Keputusan</option>
                                      <option value="ba">Berita Acara</option>
                                      <option value="sk">Surat Keputusan</option>
                                    </select>
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">No</label>
								<div class="controls">
									<input name="filename" type="text" value="" />
								</div>
							</div>
                           
                           <div class="control-group">
								<label class="control-label" for="input01">Tanggal</label>
								<div class="controls">
									<input name="date" type="text" id="datepicker" />
                           		</div>
						   </div>
                                    
							<div class="control-group">
								<label class="control-label" for="input01">Kepada</label>
								<div class="controls">
									<input name="filename" type="text" value="" />
								</div>
							</div>	
							
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Dari</label>
								<div class="controls">
									<input name="filename" type="text" value="" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Tembusan</label>
								<div class="controls">
									<input name="filename" type="text" value="" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Perihal</label>
								<div class="controls">
									<input name="filename" type="text" value="" />
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



