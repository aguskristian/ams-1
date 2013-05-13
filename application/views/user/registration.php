<div class="row-fluid">
	<?php echo $message; ?>
    <div class="dialog">
        <div class="block">
            <p class="block-heading">User Register</p>
            	<div class="block-body">
                <?php echo form_open('user/do_registration'); ?>
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
                    <input type="text" name="email" width="50%">@gapura.co.id
                    
                    <label>Cabang</label>
                    <select name="cabang" id="cabang_id">
                        <option value="dps">DPS</option>
                   	</select>
                    
                    <label>Unit</label>
                    <select name="unit" id="unit_id">
                       	<option value="gm">General Manager</option>
                        <option value="mc">Customer Service</option>
                        <option value="mi">Internal Service</option>
                        <option value="mf">Finance</option>
                        <option value="mo" selected="selected">Operation</option>
                        <option value="mt">Technic</option>
                        <option value="mw">Cargo</option>
                        <option value="mq">SSQ</option>
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
                    
                    <?php echo form_submit('submit', 'Sign Up!', 'class = "btn btn-primary pull-right"'); ?>
                    
                    <label class="remember-me"><input type="checkbox"> I agree with the <a href="terms-and-conditions.html">Terms and Conditions</a></label>
                    <div class="clearfix"></div>
                <?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="#">Privacy Policy</a></p>
    </div>
</div>