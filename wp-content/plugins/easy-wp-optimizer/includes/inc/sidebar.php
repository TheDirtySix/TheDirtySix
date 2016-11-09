<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	if(!ewo_check_user()){return;}
	$page = $_GET['page'];
	$show1 ='';$show2 ='';$show3 ='';
	$selected1 = '';$selected2 = '';$selected3 = '';$selected4 = '';$selected5 = '';
	$selected = 'class="selected"';
	switch ($page)
	{
		case 'ewo_easy_wp_optimizer':
		  $selected1 = $selected;
		  $show1 = 'show';
		  break;
		
		case 'ewo_scheduled_wp_data_optimize':
		  $selected2 = $selected;
		  $show1 = 'show';
		  break;
		case 'ewo_backup_database':
		  $selected3 = $selected;
		  $show2 = 'show';
		  break;
		case 'ewo_restore_database':
		  $selected4 = $selected;
		  $show2 = 'show';
		  break;
		case 'ewo_system_info':
		  $selected5 = $selected;
		  $show3 = 'systemhover';
		  break;  
		  
		
		default:
		$show1 ='';$show2 ='';$selected1 = '';$selected2 = '';$selected3 = '';$selected4 = '';
	}

?>
    <div class="sidebar">	  
		<style>body{font-family: "Lato", Helvetica, Arial; font-size: 16px;}</style>
    	<div class="container">
  			<h1 class="title">Easy WP Optimizer</h1>
            <ul class="menu">
                <li class="dropdown profile">
                    <a href="javascript:;" data-toggle="dropdown">Wordpress Data Optimize<i class="icon-arrow"></i></a>
                    <ul class="dropdown-menu show">
                    	<li <?php echo $selected1;?>><a href="admin.php?page=ewo_easy_wp_optimizer">&nbsp;&nbsp;&nbsp; Manual Optimize</a></li>
                    </ul>
                </li>            
            
                <li class="dropdown messages">
                    <a href="javascript:;" data-toggle="dropdown">WP Data Backup & Restore<i class="icon-arrow"></i></a>
                    <ul class="dropdown-menu show">
                        <li  <?php echo $selected3;?>><a href="admin.php?page=ewo_backup_database" class="profile">&nbsp;&nbsp;&nbsp; WP Data Backup</a></li>
                        <li  <?php echo $selected4;?>><a href="admin.php?page=ewo_restore_database">&nbsp;&nbsp;&nbsp; WP Data Restore</a></li>
                    </ul>
                </li>

                <li class="dropdown settings <?php echo $show3;?>">
                    <a href="admin.php?page=ewo_system_info" data-toggle="dropdown">System Information</a>
                </li>
            </ul>
            <p class="text-center">
                Find more: <a href="https://www.coothemes.com/plugins/" target="_blank">coothemes.com</a>
            </p>
		</div> 
	</div><!--div class="sidebar"-->