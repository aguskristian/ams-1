<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">User Verification</p>
            	<div class="block-body">
                <?php echo form_open('user/do_pin_verification'); ?>
                <?PHP echo form_hidden('ads_code', $ads_code); ?>
                    <label>Pin</label>
                    <input type="text" class="span12" name="kode">
                    <font color="#FF0000" size="-1"><?php echo form_error('hp'); ?></font>
                    
                    <?php echo form_submit('submit', 'verify', 'class = "btn btn-primary pull-right"'); ?>
                   
                    <div class="clearfix"></div>
                <?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="#">Privacy Policy</a></p>
    </div>
</div>