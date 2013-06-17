<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PT Gapura Angkasa DPS - Administration Management System</title>
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/stylesheets/theme.css">
    <!--<link rel="stylesheet" href="<?php //echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/font-awesome/css/font-awesome.css">-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/ui-lightness/jquery-ui-1.10.3.custom.min.css">
	<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/bootstrap/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/js/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
	<script>
	/*$(document).ready(function(){
        $("#cabang_id").change(function(){
            var cabang_id = $("#cabang_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php //echo base_url();?>user/select_unit/",
               data : "cabang_id=" + cabang_id,
               success: function(data){$("#unit_id").html(data);
			   alert(data);
			   }
            });
        });
		

    });*/
	

	$(document).ready(function(){
        $("#cabang_id").change(function(){
            var cabang_id = $("#cabang_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url();?>user/select_unit/",
               data : "cabang_id=" + cabang_id,
               success: function(data){$("#unit_id").html(data);}
			   
			   
					
            });
			
			
        });
		
		/* ----- */
					$("#unit_id").change(function(){
            			var unit_id = $("#unit_id").val();
            			$.ajax({
               				type : "POST",
               				url  : "<?php echo base_url();?>user/select_sub_unit/",
               				data : "unit_id=" + unit_id,
               			success: function(data){$("#sub_unit_id").html(data);
					 		}
            			});
        			});
					/* ----- */
		

    });
    
	
	/*$('#f_city, #f_city_label').hide();
	$('#f_state').change(function(){
    var state_id = $('#f_state').val();
    if (state_id != ""){
        var post_url = "/index.php/control_form/get_cities/" + state_id;
        $.ajax({
            type: "POST",
             url: post_url,
             success: function(cities) //we're calling the response json array 'cities'
              {
                $('#f_city').empty();
                $('#f_city, #f_city_label').show();
                   $.each(cities,function(id,city) 
                   {
                    var opt = $('<option />'); // here we're creating a new select option for each group
                      opt.val(id);
                      opt.text(city);
                      $('#f_city').append(opt); 
                });
               } //end success
         }); //end AJAX
    } else {
        $('#f_city').empty();
        $('#f_city, #f_city_label').hide();
    }//end if
}); //end change */
	
/*	$(document).ready(function(){
		$("#unit_id").change(function(){
            var unit_id = function(data){$("#unit_id").html(data);};
            $.ajax({
               type : "POST",
               url  : "<?php //echo base_url();?>user/select_sub_unit/",
               data : "unit_id=" + unit_id, 
               success: function(data){$("#sub_unit_id").html(data);
			   alert(data);
			   }
            });
        });*/
		
		
	// });
  	/*$(function() {
    	$( "#datepicker" ).datepicker();
  	});*/
  	</script>
    <!-- Demo page code -->

   <!-- <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>-->

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/lib/lib/font-awesome/docs/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
</head>

<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class=""> 
  <!--<![endif]-->
    
    
    
    <div class="navbar">
    
    
        <div class="navbar-inner">
        
        
                <a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>wp-content/themes/gapura-angkasa/ams/images/gapura-angkasa.png" /></a>
    
    
                
                <ul class="nav pull-right">
                	<li><a href="">Administration Management System</a></li>
                	<?php
                    $session_data = $this->session->userdata('logged_in');
					if($this->session->userdata('logged_in'))
	    			{
					?>
                    	<li id="fat-menu" class="dropdown">
                        <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo ucfirst($session_data['ui_nama']); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                            <ul class="dropdown-menu">
                                <li><a tabindex="-1" href="#">My Account</a></li>
                                <li class="divider"></li>
                                <li><a tabindex="-1" class="visible-phone" href="#">Settings</a></li>
                                <li class="divider visible-phone"></li>
                                <li><a tabindex="-1" href="<?php echo base_url(); ?>index.php/user/logout/">Logout</a></li>
                            </ul>
                    	</li>
					
                    <?php
					}
					else
					{
					?>
						<li><a href="<?php echo base_url(); ?>user/login/" class="hidden-phone visible-tablet visible-desktop" role="button">Login</a></li>
                        <li><a href="<?php echo base_url(); ?>user/pin_verification/" class="hidden-phone visible-tablet visible-desktop" role="button">PIN Verification</a></li>
					<?php
                    }
					?>
                </ul>
                
        </div>
    </div>
    
    

