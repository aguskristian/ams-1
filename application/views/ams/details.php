<div class="container-fluid">
            <div class="row-fluid">


<div class="row-fluid">


<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Details</a></li>
    <li><a href="#tabs-2">Tracking</a></li>
    <li><a href="#tabs-3">Action</a></li>
    <li><a href="#tabs-4">Man Hours</a></li>
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
                
                <tr>
                  <td width="35%">Tanggal Penerimaan</td>
                  <td> : </td>
                  <td><?php echo mdate("%d %M %Y %H:%i", strtotime($row->docs_date_in)) ;?></td>
             	</tr>
                <tr>
                  <td width="35%">Jenis Dokumen</td>
                  <td> : </td>
                  <td><?php echo $row->docs_type ;?></td>
             	</tr>
                <tr>
                  <td>No Dokumen</td>
                   <td> : </td>
                  <td><?php echo $row->docs_no ;?></td>
                </tr>
                <tr>
                  <td>Tanggal Dokumen</td>
                   <td> : </td>
                  <td><?php echo mdate("%d %M %Y", strtotime($row->docs_date)) ;?></td>
                </tr>
                <tr>
                  <td>Dari</td>
                   <td> : </td>
                  <td><?php echo $row->docs_from ;?></td>
                </tr>
                <tr>
                  <td>Kepada</td>
                   <td> : </td>
                  <td><?php echo $row->docs_to ;?></td>
                </tr>
                <tr>
                  <td>Tembusan</td>
                   <td> : </td>
                  <td><?php echo $row->docs_copy ;?></td>
                </tr>
                <tr>
                  <td>Perihal</td>
                   <td> : </td>
                  <td><?php echo $row->docs_subject ;?></td>
                </tr>
                <tr>
                  <td>Keterangan</td>
                   <td> : </td>
                  <td><?php echo $row->docs_description ;?></td>
                </tr>
                
                <?php } endforeach; ?>
                
                <?php foreach ($query_files as $row_files):{ ?>
                
                <tr>
                  <td>File Attachment</td>
                   <td> : </td>
                  <td>
				  	<?php 
						$docs_real_name = $this->encrypt->decode($row_files->df_real_name, 'eman_elif');
						$docs_system_name = $this->encrypt->decode($row_files->df_system_name, 'siHdmY');
						$docs_ext = $this->encrypt->decode($row_files->df_ext, 'txe_elif');
						$docs_file_path = $row_files->df_file_path;
						$filename = $docs_system_name . $docs_ext;
						echo $row_files->df_user_name ;
					?>
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
              
                <?php echo form_open('docs/document_action'); ?>
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