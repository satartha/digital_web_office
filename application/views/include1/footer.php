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
<script>
	// var dtl=[];
	// function serch(){
	// 	var search=$('#srch').val();
	// 	if(search.length>3) {
	// 		$("#searchshow").show();
	// 		$.ajax({
	// 			type: 'post',
	// 			url: "<?=base_url('Dashboard/search')?>",
	// 			data: {srch: search},
	// 			dataType: 'json',
	// 			success: function (f) {
	// 				dtl=f;
	// 				if (f.status) {
	// 					// dtl=f;
	// 					var s = "";
	// 					for (var i in f.data) {
	// 						s += `<div id="eachname" data-toggle="modal" data-target="#exampleModalLong" onclick="details('${f.data[i].name}','${f.data[i].mobile}')"><span>${f.data[i].name}</span>&nbsp;<span>${f.data[i].mobile}</span>&nbsp;<span>${f.data[i].desname}(${f.data[i].subunit})</span></div>`;
	// 					}
	// 					$("#list").html(s);
	// 				}
	// 			}
	// 		})
	// 	}else{
	// 		$("#list").html("");
	// 		$("#searchshow").hide();
	// 	}
	// }

	// function details(name,mob){
	// 	if(dtl.status) {
	// 		var d="";
	// 		for (var i in dtl.data) {
	// 			if (dtl.data[i].mobile ==mob){
	// 				let mobile=dtl.data[i].mobile;
	// 				let email=dtl.data[i].email;
	// 				let address=dtl.data[i].address;
	// 				if(mobile=="0"){
	// 					mobile='-';
	// 				}
	// 				if(email=="" || email==null){
	// 					email='-';
	// 				}
	// 				if(address=="" || address==null){
	// 					address='-';
	// 				}
	// 				$("#showname").html(dtl.data[i].name);
	// 				d+=`<tr><td>${dtl.data[i].name}</td><td>${mobile}</td><td>${email}</td><td>${address}</td><td>${dtl.data[i].label}</td><td>${dtl.data[i].subunit}</td><td>${dtl.data[i].desname}</td></tr>`;
	// 			}
	// 			if ($.fn.DataTable.isDataTable("#gReport")) {
	// 				$('#gReport').DataTable().clear().destroy();
	// 			}
	// 			$("#report").html(d);
	// 			$("#gReport").DataTable({
	// 				retrieve:true,
	// 				dom: 'flrtipB',
	// 				buttons: [
	// 					{
	// 						extend: 'csvHtml5',
	// 						title: 'Search Details'
	// 					},
	// 					{
	// 						extend: 'copyHtml5',
	// 						title: 'Search Details'
	// 					},
	// 					{
	// 						extend: 'excelHtml5',
	// 						title: 'Search Details'
	// 					},
	// 					{
	// 						extend: 'pdfHtml5',
	// 						title: 'Search Details'
	// 					},
	// 					{
	// 						extend: 'print',
	// 						title: 'Search Details'
	// 					},
	// 				],
	// 			});
	// 		}
	// 	}
	// }
</script>

<script>
        

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
                  
                }else{
					
                  alert("error in fetching image data");
                }
			 }
            })
        }

        show_header();

      </script>

<script>
	$(document).ready(function() {
		$('#example').DataTable();
	} );
</script>
</body>
</html>
