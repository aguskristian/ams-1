<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">User Verification</p>
            	<div class="block-body">
                <?php echo form_open('user/register'); ?>
                    <label>Pin</label>
                    <input type="text" class="span12" name="email">
                    <font color="#FF0000" size="-1"><?php echo form_error('hp'); ?></font>
                    
                    <a href="index.html" class="btn btn-primary pull-right">Verify</a>
                   
                    <div class="clearfix"></div>
                <?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="#">Privacy Policy</a></p>
    </div>
</div>