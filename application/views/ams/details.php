<div class="container-fluid">
            <div class="row-fluid">


<div class="row-fluid">


<div id="tabs">
  <ul>
    <li><a href="#tabs-1">details</a></li>
    <li><a href="#tabs-2">tracking</a></li>
    <li><a href="#tabs-3">action</a></li>
    <li><a href="#tabs-4">discussion</a></li>
    <li><a href="#tabs-5">flow control</a></li>
  </ul>
  <div id="tabs-1">
<p><strong>DOCUMENT DETAILS</strong></p>
  <p>Details informasi tentang document</p>
  <p>&nbsp;</p>
<p><table class="table">
<!--              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Agenda</th>
                  <th>No Document</th>
                  <th>Judul</th>
                </tr>
              </thead>
-->              <tbody>
                <?php foreach ($query_docs as $row):{ ?>
                
                 <?php $docs_id = $row->docs_id; ?>
                 
                 <CENTER><u><?php echo $row->docs_type ;?></u></CENTER>
                 
                 <CENTER>Nomor : <?php echo $row->docs_no ;?></CENTER>
                 
                  
                 <!--
                <tr>
                  <td>Tanggal Dokumen :</td> <td><?php echo mdate("%d %M %Y", strtotime($row->docs_date)) ;?></td>
                  <td> : </td>
                 <td></td>
                </tr>
            	-->
                
             		
                 <tr><CENTER>Dari : <?php echo $row->docs_from ;?></CENTER></tr>

                 <CENTER>Kepada : <?php echo $row->docs_to ;?></CENTER>

                 <CENTER>Tembusan : <?php echo $row->docs_copy ;?></CENTER>
                  
				 <CENTER>Perihal : <?php echo $row->docs_subject ;?></CENTER>
                </tr>
                <p><table class="table">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</table></p>

                <tr>
                  <td><?php echo $row->docs_description ;?></td>
                </tr>
                </table></p>
                <?php } endforeach; ?>
                
                <?php foreach ($query_files as $row_files):{ ?>
                
<p><table class="table">---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</table></p>
                <tr>
                  <td>File Attachment</td>
                   <td> : </td>
                  <td>
				  	<?php 
						#$docs_real_name = $this->encrypt->decode($row_files->df_real_name, 'eman_elif');
						#$docs_system_name = $this->encrypt->decode($row_files->df_system_name, 'siHdmY');
						#$docs_ext = $this->encrypt->decode($row_files->df_ext, 'txe_elif');
						#$docs_file_path = $row_files->df_file_path;
						#$filename = $docs_system_name . $docs_ext;
						#echo base_url() . 'assets/uploads/files/' . $row_files->df_real_name ;
					?>
 <a href="<?php echo base_url(); ?>wp-uploads/<?php echo $row_files->df_system_name . '-' . $row_files->df_real_name; ?> "><?php echo $row_files->df_real_name; ?></a>

                	</td> 
                </tr>
                
				<?php } endforeach; ?> 
                
              </tbody>
            </table></p>
  </div>
  
  <div id="tabs-2">
  <p><strong>DOCUMENT TRACKING</strong></p>
  <p>Track record penanganan document dari user ke user</p>
  <p>&nbsp;</p>
    <p><table class="table">
             <thead>
                <tr>
                  <th width="10%">FROM</th>
                  <th width="10%">TO</th>
                  <th width="10%">STATUS</th>
                  <th width="10%">DATE</th>
                  <th width="20%">SUBJECT</th>
                  <th width="40%">DESCRIPTION</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query_flow as $pos):{ ?>
                
                <tr>
                	<td><?php echo ucwords($pos->from_user) ;?></td>
                    <td><?php echo ucwords($pos->to_user) ;?></td>
                    <td><?php echo $pos->df_flow ;?></td>
                  	<td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($pos->df_update_on)) ;?></td>
                	<td><?php echo $pos->df_subject ;?></td>
                    <td colspan="3"><?php echo $pos->df_description ;?></td>
                </tr>
                <?php 
					if (! $pos->df_to == NULL )
					{
						$latest_nipp = $pos->df_to ; 
					}
					else
					{
						$latest_nipp = '0000000';
					}
					?>
                <?php } endforeach; ?> 
              </tbody>
            </table></p>
  </div>
  
  <div id="tabs-3">
  <p><strong>DOCUMENT ACTION</strong></p>
  <p>Penangangan terhadap document yg akan anda lakukan, apabila form ini tidak tersedia, berarti document saat ini tidak dalam kendali anda.</p>
  <p>&nbsp;</p>
    <p><?php if($nipp == $latest_nipp){ ?>
            
            <table class="table">
              <thead>
                <tr>
                  <th width="20%">ACTION</th>
                  <th width="30%">DETAILS</th>
                  <th width="50%">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
              
                <?php echo form_open_multipart('docs/document_action'); ?>
                <tr>
                  <td width="35%"><?php echo form_radio('docs_action', 'report', FALSE); ?> Report</td>
                  <td>
				  	<?php
                  		$dropdown = array();
                            foreach($query_upline as $row) 
                            {
                            $dropdown[$row->ui_nipp] = strtoupper($row->ui_nama);
                            }
                         echo form_dropdown('report', $dropdown, 'unknown');
					?>
                  </td>
                  <td><small>gunakan opsi ini untuk melapor pada atasan</small></td>
                 
             	</tr>
                 <tr>
                  <td width="35%"><?php echo form_radio('docs_action', 'coordination', FALSE); ?> Coordination</td>
                  <td><?php
				  		$dropdown_colleagues = array();
                            foreach($query_colleagues as $row_colleagues) 
                            {
                            $dropdown_colleagues[$row_colleagues->ui_nipp] = strtoupper($row_colleagues->ui_nama);
                            }
                         echo form_dropdown('coordination', $dropdown_colleagues, '');
					?></td>
                    <td><small>gunakan opsi ini untuk melakukan koordinasi dengan rekan sejawat</small></td>
                 
             	</tr>
                <tr>
                  <td><?php echo form_radio('docs_action', 'disposition', TRUE); ?> Disposition</td>
                  <td><?php
				  		$dropdown_downline = array();
                            foreach($query_downline as $row_downline) 
                            {
                            $dropdown_downline[$row_downline->ui_nipp] = strtoupper($row_downline->ui_nama);
                            }
                         echo form_dropdown('disposition', $dropdown_downline, '222');
					?></td>
                    <td><small>gunakan opsi ini untuk melakukan disposisi</small></td>
                </tr>
                
				<?php if (substr($ui_function, 8, 2) == '09') { ?>
                <tr>
                  <td><?php echo form_radio('docs_action', 'canceled', FALSE); ?> Canceled</td>
                  <td><?php echo form_input('canceled',''); ?></td>
                  <td><small>gunakan opsi ini untuk mengabaikan document dengan memasukan alasannya</small></td>
                </tr>
                <tr>
                  <td><?php echo form_radio('docs_action', 'completed', FALSE); ?> Completed</td>
                  <td><?php echo form_input('completed',''); ?></td>
                  <td><small>gunakan opsi ini untuk menyatakan proses thd document telah diselesaikan dengan baik</small></td>
                </tr>
                <?php } ?>
                
                <tr>
                  <td width="35%">Judul</td>
                  <td><?php echo form_input('docs_subject',''); ?></td>
             	</tr>
                <tr>
                  <td width="35%">Keterangan</td>
                  <td><?php echo form_textarea('docs_description',''); ?></td>
             	</tr>
                <tr>
                  <td width="35%">Upload file (optional)</td>
                  <td><?php echo form_upload('file',''); ?></td>
             	</tr>
                <tr>
                  <td width="35%">&nbsp;</td>
                  <td><?php echo form_submit('submit','submit'); ?></td>
             	</tr>
               <?php echo form_hidden('docs_id', $docs_id); ?>
               <?php echo form_close(); ?>
              </tbody>
            </table>
         <?php } ?>  </p>
  </div>
  
  <div id="tabs-4">
  	<p><strong>OPEN DISCUSSION</strong></p>
  	<p>Diskusi antar pertugas yang pernah di assignment document ini</p>
  	<p>&nbsp;</p>
    <p>
    	<table>
        	
        	<tr>
            	<td width="40%">
                	<strong>ADD NEW MESSAGE</strong>
					<?php echo form_open('docs/add_discussion'); ?>
                    <?php echo form_hidden('docs_id', $docs_id); ?>
                	<table>
                    	<tr>
                        	<td>subject</td>
                        </tr>
                    	<tr>
                        	<td><?php echo form_input('subject','');?></td>
                        </tr>
                        <tr>
                        	<td>message</td>
                        </tr>
                        <tr>
                        	<td><?php echo form_textarea('message',''); ?></td>
                        </tr>
                        <tr>
                        	<td><?php echo form_submit('submit', 'post'); ?></td>
                        </tr>
                    </table>
                    <?php echo form_close(); ?>
                    
                </td>
                <td valign="top" width="60%">
                   <table class="table">
                             <thead>
                                <tr>
                                  <th colspan="4">FORUM DISKUSI</th>
                                </tr>
                                <tr>
                                	<th>sender</th>
                                    <th>date</th>
                                    <th>subject</th>
                                    <th>message</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach ($query_discussion as $dis):{ ?>
                                
                                <tr>
                                    <td><small><?php echo $dis->ui_nama ;?></small></td>
                                    <td><small><?php echo mdate("%d-%m-%Y %h:%i", strtotime($dis->dd_update_on)) ;?></small></td>
                                    <td><?php echo $dis->dd_subject ;?></td>
                                    <td><?php echo $dis->dd_message ;?></td>
                                </tr>
                                <?php } endforeach; ?> 
                              </tbody>
                    </table>
              
              		</td>
            	</tr>        
        	</table>
       </p>
  </div>
  
  <div id="tabs-5">
  	<p><table class="table">
             <thead>
                <tr>
                  <th>PIC</th>
                  <th>DATE IN</th>
                  <th>DATE OUT</th>
                  <th>DURATION</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query_position as $pos):{ ?>
                
                <tr>
                	<td><?php echo $pos->ui_nama ;?></td>
                  	<td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($pos->dp_date_in)) ;?></td>
                    <td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($pos->dp_date_out)) ;?></td>
                    <td><?php 
							if($pos->dp_date_out == '0000-00-00 00:00:00')
							{
								echo floor((time() - strtotime($pos->dp_date_in))/(60*60*24)) . ' day';
							}
							else
							{
								echo floor((strtotime($pos->dp_date_out) - strtotime($pos->dp_date_in))/(60*60*24)) . ' day';
							}
							?>
                 	</td>
                </tr>
                <?php } endforeach; ?> 
              </tbody>
            </table></p>
  </div>
</div>

</div>