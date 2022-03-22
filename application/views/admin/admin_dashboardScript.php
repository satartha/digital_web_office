<script src="<?= base_url('assets/js/functions.js') ?>"></script>

<script>
	// alert("working company Script");
	$(function() {
		$("#frmEform2").trigger('reset');
		report_candidate();

	});
</script>

<script>
	function report_candidate() {
		$.ajax({

			type: 'post',
			url: '<?= base_url("Admin/r_admin") ?>',
			dataType: 'json',
			success: function(f) {
				console.log(f);

				if (f.status) {
					
					$(".admin_nm").text(f.admin_dtl.adminname);
					$(".admin_cr").text(f.admin_dtl.entryat);

					k = 0;
					m = 0;
					var htmlfile_nw = "";
					var htmldata="";
                    
					for(var i in f.company)
					{
						
						k++;
						var com_dtl=`Created On : ${f.company[i].com_details.entryat}<br>
						Company Code : ${f.company[i].com_details.companycode}<br>
						Address : ${f.company[i].com_details.address}<br>
					
						`;
					    htmldata+=`<tr><td>${f.company[i].com_details.companyname}</td><td><img height='50px' width='50px' style="border_radius:25px" src="<?php echo base_url('assets/com_logo/')?>${f.company[i].com_details.logo}"></td> <td>${com_dtl}</td></tr>`;
					}
                   
					console.log(htmldata);

					$("#com_lst").html(htmldata);



					if (f.usertypeid=='1') 
					{
									for(var i in f.admin)
								{
									
									m++;
									var com_dtl=`Created on : ${f.admin[i].entryat}<br>
									Email : ${f.admin[i].email}<br>
									
									Address : ${f.admin[i].address}<br>
								
									`;
									htmlfile_nw+=`<tr><td>${f.admin[i].name}</td><td><img height='50px' width='50px' style="border_radius:25px" src="<?php echo base_url('assets/admin_logo/')?>${f.admin[i].pic}"></td> <td>${com_dtl}</td></tr>`;
								}
							
								console.log(htmlfile_nw);

								$("#admin_list").html(htmlfile_nw);

					}

     


	// 				k = 0;
	// 				m = 0;
	// 				var htmlfile_nw = "";
	// 				var htmlcompany="";

	// 				// var htmldata="";
	// 				// for(var i in f.data){
	// 				// 	k++;
	// 				//     htmldata+=`<li style='list-style-type:none;color:#ff4f00;cursor:pointer;'><i class='mdi mdi-folder-plus'></i> <span id="${k}" onclick="getsubfolder('${f.data[i].directory}',${k})">${f.data[i].directory_name}</span>
	// 				// 	<ul id='loadsub${k}'></ul></li>`;
	// 				// }
					
	// 				var htmldt = "";
	// 				for (var i in f.data) {
	// 					m++;
	// 					htmldt += `<li>
	// 			<div class="col_div" href="#demo${m}" id="${m}" data-toggle="collapse" onclick="getsubfolder('${f.data[i].directory}',${m})"><i class="mdi mdi-folder" ></i> ${f.data[i].directory_name}</div>
	// 			<div id="demo${m}" class="collapse">
	// 			<ul id='loadsub1${m}'>
					
	// 			</ul>
	// 			</div>
	// 		</li>
	// 		`;

	// 					var nw = `	<li class="col_div" ><div href="#" id="${m}" onclick="getsubfolder('${f.data[i].directory}',${m})"><i class="mdi mdi-folder"></i> ${f.data[i].directory_name}</div>
	// <ul id='loadsub1${m}'></ul></li>`;

	// 					var folder_dt = `<span>
	// 					   Folder Size : ${f.data[i].folder_size}<br>
	// 					   Files : ${f.data[i].filecount} <br>
	// 					   Folders : ${f.data[i].dircount} <br>
	// 					   </span>`;

	// 					htmlfile_nw += `<tr>
	// <td><i class='mdi mdi-folder-open' style="font-size:40px"></i></td>
	// <td><span class="col_div" href="#demo2" id="${m}" data-toggle="collapse" onclick="getsubfolder('${f.data[i].directory}',${m})"><i class="mdi mdi-folder" ></i> ${f.data[i].directory_name}</span><br>created on: ${f.data[i].create_time}</td>
	// <td>${folder_dt}</td>
	// <td></td>
	// </tr>`;
	// 				}
	// 				$("#fld_dt").html(htmlfile_nw);
	// 				$("#owner_nm").text(f.com_nm);
	// 				$("#cr_dt").text(f.cr_on);
	// 				// $("#loadsub0").html(htmldata);
	// 				$("#loadsub01").html(htmldt);

				} else {
					alert("there is no information");
				}
			},error: function(k) {
				alert("Error");
				console.log(k);
			}
		});
	}
</script>