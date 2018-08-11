<div class="main side">
	<aside>
		<div class="sidebar left ">
			<div class="user-panel">
				<div class="pull-left image">
					<?php 
						if(isset($user->profile_picture) && $user->profile_picture != "") 
						$img = SITE_URL.'/assets/uploads/user/'.$user->profile_picture;
						else
						$img = SITE_URL.'/assets/uploads/user/avatar.png';
					?>
					<img src="<?=$img ?>" class="img-responsive" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?=$user->name ?></p><!-- 
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
				</div>
			</div>
			<ul class="list-sidebar bg-defoult">
				<li>
					<a href="<?=SITE_URL ?>/admin">
						<i class="fa fa-th-large"></i>
						<span class="nav-label">Dashboards</span>
					</a>
				</li>
				<li>
					<a href="<?=SITE_URL ?>/admin/user" data-active="user">
						<i class="fa fa-users"></i>
						<span class="nav-label">Users</span>
					</a>
				</li>


				<li>
					<a href="#" data-toggle="collapse" data-target="#customer" class="collapsed active" >
						<i class="fa fa-hospital-o"></i>
						<span class="nav-label"> Customer </span>
						<span class="fa fa-chevron-left pull-right"></span>
					</a>
					<ul class="sub-menu collapse" id="customer">
						<li  class="active">
							<a href="<?=SITE_URL ?>/admin/customer"  data-active="customer">
								<span class="nav-label">Customer</span>
							</a>
						</li>
						<li class="active">
							<a href="<?=SITE_URL ?>/admin/dicom_details_assigned"  data-active="billing_code_add">Assigned Worksheet</a>
						</li>
					</ul>
				</li>



				
		</div>
	</aside>
</div>