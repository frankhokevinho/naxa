<div class="page-header navbar navbar-fixed-top">
<div class="page-header-inner ">
<div class="page-logo">
<a href="home.php">
<img src="<?php echo $fronturl; ?>/assets/images/logo.png" alt="logo" class="logo-default" style="width: 160px; height: 20px; filter: brightness(0) invert(1);"> </a>
<div class="menu-toggler sidebar-toggler"> </div>
</div>

<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>

<div class="top-menu">
<ul class="nav navbar-nav pull-right">
<li class="dropdown dropdown-user">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<span class="username"> <?php echo $user; ?> </span>
<i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu dropdown-menu-default">
<li><a href="<?php echo $adminurl; ?>/ChangePassword"><i class="fa fa-cog"></i> Change Password </a></li>
<li><a href="<?php echo $adminurl; ?>/Profile"><i class="fa fa-user"></i> Profile Management </a></li>
<li><a href="<?php echo $adminurl; ?>/signout"><i class="fa fa-sign-out"></i> Log Out </a></li>
</ul>
</li>

</ul>
</div>
</div>
</div>
<div class="clearfix"> </div>
<div class="page-container">
<div class="page-sidebar-wrapper">
<div class="page-sidebar navbar-collapse collapse">
<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
<li class="sidebar-toggler-wrapper hide">
<div class="sidebar-toggler"> </div>
</li>



<li class="nav-item start">
<a href="<?php echo $adminurl; ?>/Dashboard" class="nav-link "><i class="fa fa-home"></i><span class="title">Dashboard</span></a>
</li>



<li class="nav-item">
<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-bars"></i>
<span class="title">Website Control</span><span class="arrow "></span></a>



<ul class="sub-menu">

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/GeneralSetting" class="nav-link"><i class="fa fa-cogs"></i> General Setting </a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/EmailSetting" class="nav-link"><i class="fa fa-envelope"></i> Email Setting </a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/SMSSetting" class="nav-link"><i class="fa fa-mobile"></i> SMS Setting </a>
</li>


</ul>
</li>










<li class="nav-item">
<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-desktop"></i>
<span class="title">Interface Control</span><span class="arrow "></span></a>



<ul class="sub-menu">

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/MenuManager" class="nav-link"><i class="fa fa-desktop"></i> Menu Manager </a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/LogoSetting" class="nav-link"><i class="fa fa-cogs"></i> Logo+icon Setting</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/SliderSetting" class="nav-link"><i class="fa fa-cogs"></i> Slider Setting</a>
</li>


<li class="nav-item">
<a href="<?php echo $adminurl; ?>/HomeText/1" class="nav-link"><i class="fa fa-cogs"></i> Home Text 1</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/HomeText/2" class="nav-link"><i class="fa fa-cogs"></i> Home Text 2</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/HomeText/3" class="nav-link"><i class="fa fa-cogs"></i> Home Text 3</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/HomeService" class="nav-link"><i class="fa fa-cogs"></i> Service Section</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/HomeServiceImage" class="nav-link"><i class="fa fa-cogs"></i> Service Section image</a>
</li>


<li class="nav-item">
<a href="<?php echo $adminurl; ?>/HomeText/4" class="nav-link"><i class="fa fa-cogs"></i> Footer Text</a>
</li>


<li class="nav-item">
<a href="<?php echo $adminurl; ?>/SocialSetting" class="nav-link"><i class="fa fa-cogs"></i> Social Setting</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/ContactSetting" class="nav-link"><i class="fa fa-cogs"></i> Contact Setting</a>
</li>


<li class="nav-item">
<a href="<?php echo $adminurl; ?>/StatsSetting" class="nav-link"><i class="fa fa-bar-chart"></i> Statistics Setting</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/PaymentFromSetting" class="nav-link"><i class="fa fa-file-image-o"></i> Payment From </a>
</li>



</ul>
</li>





<li class="nav-item">
<a href="<?php echo $adminurl; ?>/Packege" class="nav-link "><i class="fa fa-th"></i><span class="title">Packege Management</span></a>
</li>





<li class="nav-item">
<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-download"></i>
<span class="title">Deposit Money</span><span class="arrow"></span></a>
<ul class="sub-menu">

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/DepositMethod" class="nav-link"><i class="fa fa-cog"></i> Deposit Method</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/UserDepositedFund" class="nav-link"><i class="fa fa-desktop"></i> Deposit Log</a>
</li>

</ul>
</li>          


<li class="nav-item">
<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-upload"></i>
<span class="title">Withdraw Money</span><span class="arrow"></span></a>
<ul class="sub-menu">

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/WithdrawMethod" class="nav-link"><i class="fa fa-cog"></i> Withdraw Method</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/WithdrawAll" class="nav-link"><i class="fa fa-desktop"></i> Withdraw Log</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/WithdrawPending" class="nav-link"><i class="fa fa-desktop"></i> Pending Request</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/WithdrawSuccess" class="nav-link"><i class="fa fa-desktop"></i> Success Log</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/WithdrawRefunded" class="nav-link"><i class="fa fa-desktop"></i> Refunded Log</a>
</li>

</ul>
</li> 




<li class="nav-item">
<a href="javascript:;" class="nav-link nav-toggle"><i class="fa fa-users"></i>
<span class="title">Users Management</span><span class="arrow "></span></a>
<ul class="sub-menu">

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/AllUsers" class="nav-link"><i class="fa fa-desktop"></i> All Users</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/BannedUsers" class="nav-link"><i class="fa fa-times"></i> Banned Users</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/VerifiedUsers" class="nav-link"><i class="fa fa-check"></i> Verified Users</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/MobileUnverifiedUsers" class="nav-link"><i class="fa fa-mobile"></i> Mobile Unverified</a>
</li>

<li class="nav-item">
<a href="<?php echo $adminurl; ?>/EmailUnverifiedUsers" class="nav-link"><i class="fa fa-envelope"></i> Email Unverified</a>
</li>


</ul>
</li>


<li class="nav-item">
<a href="<?php echo $adminurl; ?>/Staffs" class="nav-link "><i class="fa fa-user"></i><span class="title">Staff Management</span></a>
</li>





</ul>
</div>
</div>


