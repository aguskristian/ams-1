 <div class="sidebar-nav">
        
        <a href="<?php echo base_url(); ?>dashboard/" class="nav-header" data-toggle="collapse"><i class="icon-home"></i>AMS DPS V1.0</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><?php echo anchor('dashboard', 'Home', 'Home'); ?></li>
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-file"></i>Incoming Document</a>
        <ul id="accounts-menu" class="nav nav-list collapse">
        	<li ><?php echo anchor('docs/add','New'); ?></li>
            <li ><?php echo anchor('docs/add','Open'); ?></li>
            <li ><?php echo anchor('docs/add','Progress'); ?></li>
            <li ><?php echo anchor('docs/add','Completed'); ?></li>
        </ul>

        <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Error  <i class="icon-chevron-up"></i></a>
        <ul id="error-menu" class="nav nav-list collapse">
            <li ><a href="404.html">404 page</a></li>
            <li ><a href="500.html">500 page</a></li>
            <li ><a href="503.html">503 page</a></li>
        </ul>

        <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-signal"></i>Legal</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="privacy-policy.html">Privacy Policy</a></li>
            <li ><a href="terms-and-conditions.html">Terms and Conditions</a></li>
            <li ><?php echo anchor('user/manage_station', 'manage station'); ?></li>
        </ul>

		<!--<p>user : <?php //echo $nama; ?></p>
        <p>cabang : <?php //echo $cabang; ?></p>        
        <p>unit : <?php //echo $unit; ?></p>
        <p>unit : <?php //echo $function; ?></p>-->
      
    </div>