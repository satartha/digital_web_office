<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
	#eachname{
		padding: 5px;
		border-bottom: 1px solid #d4d4d4;
	}
	#eachname:hover{
		background-color: #e9e9e9;
	}
</style>
</div>
</div>
</div>
        <footer class="footer">
          <div class="footer-wrap">
              <div class="w-100 clearfix">
<!--                <span class="d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020 <a href="https://www.atreyaassociates.com/" target="_blank">Atreya Associates</a>. All rights reserved.</span>-->
                <span class="d-block text-center">Copyright © 2022, All rights reserved.</span>
<!--                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart-outline" style="color:#51E1C3;"></i></span>-->
              </div>
          </div>
        </footer>

    <!-- base:js -->
    <script src="<?=base_url('assets/vendors/base/vendor.bundle.base.js')?>"></script>
    <!-- inject:js -->
    <script src="<?=base_url('assets/js/template.js')?>"></script>

    <!-- endinject -->
    <script src="<?=base_url('assets/vendors/chart.js/Chart.min.js')?>"></script>
    <script src="<?=base_url('assets/vendors/progressbar.js/progressbar.min.js')?>"></script>
		<script src="<?=base_url('assets/vendors/justgage/raphael-2.1.4.min.js')?>"></script>
		<script src="<?=base_url('assets/vendors/justgage/justgage.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/vendors/select2/select2.min.js')?>"></script>
    <!-- Custom js for this page-->
    <script src="<?=base_url('assets/js/dashboard.js')?>"></script>
    <!-- End custom js for this page-->

	<script>

	$(document).ready(function() {
		$('#txtAc12').select2();
	});

	GetTime();

	function GetTime(){
		var CurrentTime = new Date();
		var hour = CurrentTime.getHours();
		var minute = CurrentTime.getMinutes();
		var second = CurrentTime.getSeconds();
		if(minute < 10){
			minute = "0" + minute
		}

		if(second < 10){
			second = "0" + second
		}

		var GetCurrentTime = hour + ":" + minute + ":" + second + " ";

		if(hour > 11){
			GetCurrentTime += "PM"
		}else{
			GetCurrentTime += "AM"
		}

		document.getElementById("CurrentTime").innerHTML = GetCurrentTime;
		setTimeout(GetTime,1000)
	}

	</script>

<script src="<?=base_url('assets/js/template.js')?>"></script>
<script src="<?=base_url('assets/js/crypto-js/crypto-js.js')?>"></script>
<script src="<?=base_url('assets/js/mamba.js')?>"></script>
<script src="<?=base_url('assets/js/jquery.serializeToJSON.min.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/DataTables/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/DataTables/js/dataTables.bootstrap4.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/Buttons/js/dataTables.buttons.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/Buttons/js/buttons.colVis.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/Buttons/js/buttons.flash.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/Buttons/js/buttons.html5.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/Buttons/js/buttons.print.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/Buttons/js/buttons.bootstrap4.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/pdfmake/pdfmake.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/dataTable/pdfmake/vfs_fonts.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/toastr/build/toastr.min.js')?>"></script>
<script type="text/javascript"  src="<?= base_url('assets/js/jquery-ui.min.js')?>"></script>

<!--<script src="--><?//=base_url('assets/js/toggle.js')?><!--"></script>-->
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
	$(document).ready(function() {
		$('#example').DataTable();

			$("#sortable tbody").sortable({
				cursor: "move",
				placeholder: "sortable-placeholder",
				helper: function(e, tr)
				{
					var $originals = tr.children();
					var $helper = tr.clone();
					$helper.children().each(function(index)
					{
						// Set helper cell sizes to match the original sizes
						$(this).width($originals.eq(index).width());
					});
					return $helper;
				}
			}).disableSelection();
		$(".toggle-off").click(function(){
			$("#tgl_load").show();
		});
		$(".toggle-on").click(function(){
			$("#tgl_load").hide();
		});

	} );
	function open_folder() {
		$('#myModal').modal('show');
	}




	function show_header()
        {
            $.ajax({
              type:'get',
              url:"<?=base_url('Login/header_info')?>",
              dataType:'json',
              success:function (f) {
                if(f.status){
					// console.log(f);
                  $("#header_logo").attr('src',f.header_img);
				  $("#com_name").text(f.companyname);
                  
                }else{
					
                  alert("error in fetching image data");
                }
			 }
            })
        }

        show_header();

</script>
</body>
</html>
