<div class="container-fluid">
            <div class="row-fluid">

<div class="row-fluid">


    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">ADD NEW INCOMING DOCUMENT</a>
        <div id="page-stats" class="block-body collapse in">
        
        <br /><br  />
        			 
        			<?php echo $error; ?>
                  	<?php echo form_open_multipart('docs/save', array('class' => 'form-horizontal', 'id' => 'edit-profile')); ?>
                    
						<fieldset>
							
                           <div class="control-group">
								<label class="control-label" for="input01">Tanggal Penerimaan</label>
								<div class="controls">
									<input name="docs_date_in" type="text" id="docs_date_in" />
                           		</div>
						   </div>
                           
                           <div class="control-group">
								<label class="control-label" for="input01">Nomer Agenda</label>
								<div class="controls">
									<input name="docs_reg_no" type="text" value="" />
								</div>
							</div>
                           
                           <div class="control-group">
								<label class="control-label" for="input01">Jenis</label>
								<div class="controls">
                                	<select name="docs_type">
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
								<label class="control-label" for="input01">Nomer</label>
								<div class="controls">
									<input name="docs_no" type="text" value="" />
								</div>
							</div>
                           
                           <div class="control-group">
								<label class="control-label" for="input01">Tanggal Dokumen</label>
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
									<input name="docs_to" type="text" value="" />
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



