<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<nav class="bottom-navbar" style="z-index: 0;">
       
			
			<div class="container">
		<ul class="nav page-navigation">
							<!-- <li class="nav-item">
			<a class="nav-link" href="<?=base_url('Dashboard')?>">
						<i class="mdi mdi-file-document-box menu-icon"></i>
						<span class="menu-title">Dashboard</span>
					</a>
				</li> -->
					<li class="nav-item">
						<a href="#" class="nav-link">
						<i class="mdi mdi-file-document-box menu-icon"></i>
							<span class="menu-title">Form</span>
							<i class="menu-arrow"></i>
				</a>
						<div class="submenu">
						<ul>
								
							<?php
                                         if ($this->session->dflogin_admin && $this->session->dflogin_admin['usertypeid']=='1') 
										 {
										   ?>
							                       <li class="nav-item"><a class="nav-link" href="<?=base_url('Admin/create_admin_alt')?>">Create Admin</a></li>
										   <?php
											 
										 }
								?>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Admin/create_company_alt')?>">Create Company</a></li>
								
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Workflow')?>">Create Workflow</a></li>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Department')?>">Create Department</a></li>
								<li class="nav-item"><a class="nav-link" href="<?=base_url('Designation')?>">Create Designation</a></li>
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
				
					
						</div>
			
				
	
				
            </ul> 
         </div>
      </nav>
    </div>
