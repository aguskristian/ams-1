<div class="container-fluid">
            <div class="row-fluid">


<div class="row-fluid">
    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">Details </a>
        <div id="tablewidget" class="block-body collapse in">
            <table class="table">
<!--              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Agenda</th>
                  <th>No Document</th>
                  <th>Judul</th>
                </tr>
              </thead>
-->              <tbody>
                <?php foreach ($query as $row):{ ?>
                
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
                  <td><?php echo $row->docs_remarks ;?></td>
                </tr>
                <tr>
                  <td>File Attachment</td>
                   <td> : </td>
                  <td>
				  	<?php 
						$docs_real_name = $this->encrypt->decode($row->df_real_name, 'eman_elif');
						$docs_system_name = $this->encrypt->decode($row->df_system_name, 'siHdmY');
						$docs_ext = $this->encrypt->decode($row->df_ext, 'txe_elif');
						$docs_file_path = $row->df_file_path;
						$filename = $docs_system_name . $docs_ext;
						echo $docs_real_name ;
					?>
                	</td>
                </tr>
                
				<?php } endforeach; ?> 
              </tbody>
            </table>
           
        </div>
    </div>

    <div class="block span6">
        <a href="#widget1container" class="block-heading" data-toggle="collapse">HISTORY </a>
        <div id="widget1container" class="block-body collapse in">
        	<table class="table">
             <thead>
                <tr>
                  <th>PIC</th>
                  <th>IN</th>
                  <th>OUT</th>
                  <th>Duration</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($query_position as $pos):{ ?>
                
                <tr>
                	<td><?php echo $pos->ui_nama ;?></td>
                  	<td><?php echo mdate("%d-%m-%Y %h:%i", strtotime($pos->dp_date_in)) ;?></td>
                    <td>
						<?php
							if($pos->dp_date_out == '0000-00-00 00:00:00')
							{
								echo $pos->dp_date_out ;
							}
							else
							{
								echo mdate("%d-%m-%Y %h:%i", strtotime($pos->dp_date_out)) ;
							}
						?>
                   	</td>
                    <td>
						<?php
							if($pos->dp_date_out == '0000-00-00 00:00:00')
							{
								
								echo number_format((strtotime(date('Y-m-d H:i:s')) - strtotime($pos->dp_date_in))/(60*60*24),1) . ' hari';
							}
							else
							{
								echo number_format((strtotime($pos->dp_date_out) - strtotime($pos->dp_date_in))/(60*60*24), 1) . ' hari';
							}
						?>
					</td>
                </tr>
                <?php } endforeach; ?> 
              </tbody>
            </table>
            
        </div>
    </div>
</div>