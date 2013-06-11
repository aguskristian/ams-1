 <div class="sidebar-nav">
        
        <a href="#dashboard-menu" class="nav-header" data-toggle="collapse"><i class="icon-dashboard"></i>Administration Man System</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><?php echo anchor('dashboard', 'Home', 'Home'); ?></li>
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-briefcase"></i>Incoming<span class="label label-info">+3</span></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
        	<li ><a href="sign-in.html">New</a></li>
            <li ><a href="sign-in.html">Open</a></li>
            <li ><a href="sign-up.html">Progress</a></li>
            <li ><a href="reset-password.html">Archive</a></li>
        </ul>

        <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Error  <i class="icon-chevron-up"></i></a>
        <ul id="error-menu" class="nav nav-list collapse">
            <li ><?php echo anchor('user/pin_verification', 'PIN Verification'); ?></li>
            <li ><a href="404.html">404 page</a></li>
            <li ><a href="500.html">500 page</a></li>
            <li ><a href="503.html">503 page</a></li>
        </ul>

        <a href="#legal-menu" class="nav-header" data-toggle="collapse"><i class="icon-legal"></i>Legal</a>
        <ul id="legal-menu" class="nav nav-list collapse">
            <li ><a href="privacy-policy.html">Privacy Policy</a></li>
            <li ><a href="terms-and-conditions.html">Terms and Conditions</a></li>
        </ul>

      
    </div>