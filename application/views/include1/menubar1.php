<!-- <nav class="bottom-navbar" style="z-index:1;">
	<div class="container-fluid">
		<ul class="nav page-navigation">
		
			<li class="nav-item">
				<a href="#" class="nav-link">
					<i class="mdi mdi-file-document-box menu-icon"></i>
					<span class="menu-title">Form</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="submenu">
					<ul>
                    <?php
						
						if ($this->session->dflogin) 
						{
							?>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Entryform')?>">Create Company</a></li>	
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Staff')?>">Staff Creation</a></li>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Dept_mapping')?>">Add Department</a></li>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Document_type')?>">Document Type</a></li>

							<?php
						}elseif($this->session->dflogin_admin){
							
                                         if ($this->session->dflogin_admin['usertypeid']=='1') 
										 {
										   ?>
							                       <li class="nav-item"><a class="nav-link" href="<?=base_url('Admin/create_admin_alt')?>">Create Admin</a></li>
										   <?php
											 
										 }
								?>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Admin/create_company_alt')?>">Create Company</a></li>
								
							
								
						<?php
						}
						?>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a href="<?=base_url('Dashboard')?>" class="nav-link">
					<i class="mdi mdi-chart-areaspline menu-icon"></i>
				<span class="menu-title">Dashboard</span>
					<i class="menu-arrow"></i>
				</a>
			</li>

		</ul>
	</div>
</nav>
<nav class="bottom-navbar mt-3" style="z-index:0;">
	<div class="container-fluid">
		<ul class="nav page-navigation" style="background-color: #E9ECEF;font-size: 15px;">

			<li class="breadcrumb_list">
				<a href="">DWO</a> /
				<span>Folder</span>
			</li>

		</ul>
	</div>
</nav> -->