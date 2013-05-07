<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">User Register</p>
            	<div class="block-body">
                <form>
                    
                    <label>Nama</label>
                    <input type="text" class="span12" name="nama" size="50" width="50">
                    <font color="#FF0000" size="-1"><?php echo form_error('nama'); ?></font>
                    
                    <label>NIPP</label>
                    <input type="text" class="span12" name="nipp">
                    <font color="#FF0000" size="-1"><?php echo form_error('nipp'); ?></font>
                    
                    <label>No Handphone</label>
                    <input type="text" class="span12" name="hp">
                    <font color="#FF0000" size="-1"><?php echo form_error('hp'); ?></font>
                    
                    <label>Email</label>
                    <input type="text" class="span12">
                    
                    <label>Cabang</label>
                    <select name="cabang" id="cabang_id">
                        <option value="">-- select cabang --</option>
                        <?php
                        foreach ( $query_cabang_combo as $row_cabang_combo )
                        {
                            echo "<option value='$row_cabang_combo[uc_code]'>$row_cabang_combo[uc_name]</option>";
                        }
                        ?>
                   	</select>
                    
                    <label>Unit</label>
                    <select name="unit" id="unit_id">
                       	<option value="">-- select cabang dulu --</option>
                   	</select>
                                    
                    <label>Jabatan</label>
                    <select name="jabatan" id="jabatan">
                        <option value="staff">Staff</option>
                        <option value="supv">Supervisor</option>
                        <option value="assman">Assistant Manager</option>
                        <option value="mgr">Manager</option>
                        <option value="gm">General Manager</option>
                    </select>
                    
                    <label>Password</label>
                    <input type="password" class="span12">
                    
                    <a href="index.html" class="btn btn-primary pull-right">Sign Up!</a>
                    <label class="remember-me"><input type="checkbox"> I agree with the <a href="terms-and-conditions.html">Terms and Conditions</a></label>
                    <div class="clearfix"></div>
                </form>
                
                <?php echo form_open('user/register'); ?>
						
                        <table align="center">
                       
                        	<tr>
                            	<td>Nama</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td><input type="text" name="nama" value="" /></td>
                                <font color="#FF0000" size="-1"><?php echo form_error('nama'); ?></font>
                                <td>&nbsp;<font color="#FF0000"><b>*</b></font> </td>
                            </tr>
                            <tr>
                            	<td>NIPP</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td><input type="text" name="nipp" value="" /></td>
                                <font color="#FF0000" size="-1"><?php echo form_error('nipp'); ?></font>
                                <td>&nbsp;<font color="#FF0000"><b>*</b></font></td>
                                
                            </tr>
                            <tr>
                            	<td>No Handphone</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td><input type="text" name="hp" value="" /></td>
                                <font color="#FF0000" size="-1"><?php echo form_error('hp'); ?></font>
                                <td>&nbsp;<font color="#FF0000"><b>*</b></font></td>
                            </tr>
                            <tr>
                            	<td>Email</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td><input type="text" name="email" 
                                value="" /></td>
                                <font color="#FF0000" size="-1"><?php echo form_error('email'); ?></font>
                                <td><b>@gapura.co.id</b>&nbsp;<font color="#FF0000"><b>*</b></font></td>
                            </tr>
                            <tr>
                            	<td>Cabang</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>
                                    <select name="cabang" id="cabang_id">
                                        <option value="">-- select cabang --</option>
                                        <?php
                                        foreach ( $query_cabang_combo as $row_cabang_combo )
                                        {
                                            echo "<option value='$row_cabang_combo[uc_code]'>$row_cabang_combo[uc_name]</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>&nbsp;<font color="#FF0000"><b>*</b></font></td>
                            </tr>
                            <tr>
                            	<td>Unit</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>
                                	<select name="unit" id="unit_id">
                                	<option value="">-- select cabang dulu --</option>
                                    </select>
                                </td>
                                <td>&nbsp;<font color="#FF0000"><b>*</b></font></td>
                            </tr>
                            <tr>
                            	<td>Jabatan</td>
                                <td>&nbsp;:&nbsp;</td>
                                <td>
                                	<select name="jabatan" id="jabatan">
                                    	<option value="staff">Staff</option>
                                    	<option value="gm">General Manager</option>
                                        <option value="mgr">Manager</option>
                                        <option value="assman">Assistant Manager</option>
                                        <option value="supv">Supervisor</option>
                                    </select>
                                 </td>
                                <td>&nbsp;<font color="#FF0000"><b>*</b></font></td>
                            </tr>
                        	<tr>
                            	<td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo form_reset('reset','Reset','class = "btn btn-danger"'); ?>&nbsp;&nbsp;<?php echo form_submit('submit', 'Register', 'class = "btn btn-primary pull-right"');?></td>
                                <td>&nbsp;</td>
                                
                            </tr>
                        </table>
                        
                        <?php //echo validation_errors(); ?>
                        
						<?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="privacy-policy.html">Privacy Policy</a></p>
    </div>
</div>