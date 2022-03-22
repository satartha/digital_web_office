<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
	<!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu" style="position: relative;">
      <nav class="navbar top-navbar col-lg-12 col-12 p-0" style="position: fixed;z-index: 1;">
        <div class="container-fluid">
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
            <ul class="navbar-nav navbar-nav-left">
<!--              <li class="nav-item ml-0 mr-5 d-lg-flex d-none">-->
<!--                <a href="#" class="nav-link horizontal-nav-left-menu"><i class="mdi mdi-format-list-bulleted"></i></a>-->
<!--              </li>-->
              <li class="nav-item dropdown">
<!--                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">-->
<!--                  <i class="mdi mdi-bell mx-0"></i>-->
<!--                  <span class="count bg-success">2</span>-->
<!--                </a>-->
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                          <i class="mdi mdi-information mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">Application Error</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          Just now
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                          <i class="mdi mdi-settings mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">Settings</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          Private message
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-info">
                          <i class="mdi mdi-account-box mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-normal">New user registration</h6>
                        <p class="font-weight-light small-text mb-0 text-muted">
                          2 days ago
                        </p>
                    </div>
                  </a>
                </div>
              </li>
              <li class="nav-item dropdown">
<!--                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">-->
<!--                  <i class="mdi mdi-email mx-0"></i>-->
<!--                  <span class="count bg-primary">4</span>-->
<!--                </a>-->
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                  <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="assets/img/faces/face4.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          The meeting is cancelled
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="assets/img/faces/face2.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          New product launch
                        </p>
                    </div>
                  </a>
                  <a class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <img src="assets/img/faces/face3.jpg" alt="image" class="profile-pic">
                    </div>
                    <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                        </h6>
                        <p class="font-weight-light small-text text-muted mb-0">
                          Upcoming board meeting
                        </p>
                    </div>
                  </a>
                </div>
              </li>
					<?php
				?>
            </ul>
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo mr-3" href="<?php echo base_url() ?>"><h1 ><img src="" id="header_logo" alt=""> <b style="font-size: 27px;color: #ff4f00;"><span id="com_name"></span></b></h1></a>
				
                <input class="head_search mr-3" type="search" placeholder="Search">
				<a class="mr-3 text-white" href="#">Calender</a>
				<a class="mr-3 text-white" href="#">Help</a>

        <?php
           
           if (isset($this->session->dflogin) || (isset($this->session->dflogin_staff) && $this->session->dflogin_staff['usertypeid']=='1'))
            {
             ?>

<a class="mr-3 text-white" href="<?php echo base_url('Workflow/wf_str'); ?>">Workflow History</a>

             <?php

            }
        
        ?>
        
            </div>
            <ul class="navbar-nav navbar-nav-right">
				<li id="CurrentTime" class="mdi mdi-timer"></li>
                <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
           
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                      <a class="dropdown-item" href="<?=base_url('Login/logout')?>">
                        <i class="mdi mdi-logout text-primary"></i>
                        Logout
                      </a>
                  </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
              <span class="mdi mdi-menu"></span>
            </button>
          </div>
        </div>
      </nav>

      <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLongTitle" style="color:#072247;">Name: <span id="showname"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="card card-secondary">
                      <div class="card-body">
                          <table id="gReport" class="table table-bordered table-striped">
                              <thead>
                              <tr style="color:#072247;">
                                  <th class="text-center">Name</th>
                                  <th class="text-center">Mobile</th>
                                  <th class="text-center">Email</th>
                                  <th class="text-center">Address</th>
                                  <th class="text-center">Label</th>
								  <th class="text-center">Subunit</th>
                                  <th class="text-center">Designation</th>
                              </tr>
                              </thead>
                              <tbody id="report" class="text-center">
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
      </div>
		<div class="container-fluid" style="position: absolute;top: 65px;">
			<ul class="nav page-navigation" style="background-color: #E9ECEF;font-size: 15px;">
				<li class="breadcrumb_list">
					<a href="">DWO</a> /
					<span>Folder</span>
				</li>

			</ul>
		</div>
    <!-- partial -->
