<div class="row-fluid">
    <div class="dialog">
    <?php echo $message; ?>
        <div class="block">
            <p class="block-heading">User Login</p>
            	<div class="block-body">
                <?php echo form_open('user/do_login'); ?>
                    <label>Email</label>
                    <input type="text" class="span12" name="email">
                    <font color="#FF0000" size="-1"><?php echo form_error('hp'); ?></font>
                    
                    <?php echo form_submit('submit', 'login', 'class = "btn btn-primary pull-right"'); ?>
                   
                    <div class="clearfix"></div>
                <?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="#">Privacy Policy</a></p>
    </div>
</div>