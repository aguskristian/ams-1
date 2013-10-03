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
								<label class="control-label" for="input01">Jenis Surat</label>
								<div class="controls">
									<input name="docs_type" type="text" value="NOTA DINAS" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Nomor</label>
								<div class="controls">
									<input name="docs_no" type="text" value="<?php echo substr($ui_function, 0,2)?>/<?php echo substr($ui_function, 2,2)?>/ND/VII/2013" />
								</div>
							</div>
                            
                            <div class="control-group">
								<label class="control-label" for="input01">Kepada Yth. </label>
								<div class="controls">
                                <input name="docs_from" type="text" value="<?php echo substr($ui_function, 0,2)?><?php echo substr($ui_function, 8,2)?>" />
                                </div>
                            </div>
                            
                             <div class="control-group">
								<label class="control-label" for="input01">Dari </label>
								<div class="controls">
                                <input name="docs_to" type="text" value="<?php echo substr($ui_function, 0,2)?><?php echo substr($ui_function, 8,2)?>" />
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
                            
                            
                            <ahref "" >
                            <div class="control-group">
								<label class="control-label" for="input01">Create Nota Dinas</label>
								<div class="controls">
									<?php echo anchor('docs/create_nota_dinas','Create Noda Dinas'); ?>
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



