<!-- <script>
function load_entry_from(fval,rval) {
    window.location.href="Entryform?mid=" + fval+"&rid="+rval;
}
function load_entry_report(fval,rval) {
    window.location.href="Report/report_page?mid=" + fval+"&rid="+rval;
}
</script> -->
<script src="<?=base_url('assets/js/functions.js')?>"></script>


<script>

$('#fast_upload').change(function(evt) {
        // alert($(this).val());
	
        evt.preventDefault();

            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('Upload_doc/fast_upload_file')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
					console.log(f);
                    if(f.status){
						pdf_rpt();
                        mytoast(f);         
                    }else{
                        mytoast(f);
                    }
                },
                error : function(error){
                    alert("error");
                    if(error.status == 500){
                        var str =  JSON.stringify(error.responseText);
                        var pos1 = str.indexOf("<p>",str.search("</p>"));
                        var pos = str.indexOf("</p>",pos1);
                        var res=[];
                        res['title']="Error";
                        res['message']=str.slice(pos1, pos);
                    }else if( error.status == 404){
                        var str =  JSON.stringify(error.responseText);
                        var pos1 = str.search("<p>");
                        var pos = str.search("</p>");
                        var res=[];
                        res['title']="Error";
                        res['message']=str.slice(pos1, pos);
                    }else{
                        var res=[];
                        res['title']="Error";
                        res['message']="Error in database, Contact your Administrator.";
                    }
                    mytoast(res);
                }
            })
    
    });
 
</script>


<script>
	$("#file_upload_btn").hide();
	$(function () {
		pdf_rpt();
	});
    // $("#file_upload_btn").on("click",function(e){
       
    // })
     $("#frmDataUpload").submit(function (e) {
		 e.preventDefault();
		 $.ajax({
			 type:'post',
			 url:"<?=base_url('Dashboard/upload_pdf')?>", 
			 crossDomain:true,
			 processData: false,
			 contentType: false,
			 cache: false,
			 data:new FormData(this),
			 dataType:'json',
			 success:function (f) {
				 if(f.status){
					 $("#frmDataUpload").trigger('reset');
					 alert("File Upload Successfully");
					 var p=$(".pth").val();
					//  pdf_rpt();
					 getsubfolder(p,k);
				 }else{
					 alert("File Upload Failed");
				 }
			 }
		 })
	 });

	 var k=0;

	 function pdf_rpt() {
		$("#show").hide();
		$("#up_frm").hide();
		$.ajax({
			type:'post',
			url:"<?=base_url('Dashboard/show_dir')?>",
			dataType:'json',
			success:function (f) {
				if(f.status){

					k=0;
					m=0;
					var htmlfile_nw="";
					var htmldata="";
				
                     $("#com_name").text(f.com_nm);
					var htmldt="";
					for(var i in f.data){
						m++;
                        htmldt+=`<li>
									<div class="col_div" href="#demo${m}" id="${m}" data-toggle="collapse" onclick="getsubfolder('${f.data[i].directory}',${m})"><i class="mdi mdi-folder" ></i> ${f.data[i].directory_name}</div>
									<div id="demo${m}" class="collapse">
									<ul id='loadsub1${m}'>
										
									</ul>
									</div>
								</li>
								`;

								var nw=`	<li class="col_div" ><div href="#" id="${m}" onclick="getsubfolder('${f.data[i].directory}',${m})"><i class="mdi mdi-folder"></i> ${f.data[i].directory_name}</div>
						<ul id='loadsub1${m}'></ul></li>`;

								var folder_dt=`<span>
								               Folder Size : ${f.data[i].folder_size}<br>
											   Files : ${f.data[i].filecount} <br>
											   Folders : ${f.data[i].dircount} <br>
								               </span>`;

						htmlfile_nw+=`<tr>
						<td><i class='mdi mdi-folder-open' style="font-size:40px"></i></td>
						<td><span class="col_div" href="#demo2" id="${m}" data-toggle="collapse" onclick="getsubfolder('${f.data[i].directory}',${m})"><i class="mdi mdi-folder" ></i> ${f.data[i].directory_name}</span><br>created on: ${f.data[i].create_time}</td>
						<td>${folder_dt}</td>
						<td></td>
						</tr>`;
					}
					$("#fld_dt").html(htmlfile_nw);
					$("#owner_nm").text(f.com_nm);
					$("#cr_dt").text(f.cr_on);
				
					$("#loadsub01").html(htmldt);

				}
			}
		})
	}
    
	


	function getsubfolder(dname,id){
		$("#up_frm").show();
		$('.pth').val(dname);
		$("#show").hide();
		$.ajax({
			type:'post',
			url:"<?=base_url('Dashboard/subname')?>",
			data:{dname:dname},
			dataType:'json',
			success:function (f){
                
                $("#file_upload_btn").show();
                   
				if(f.status){
                    
					var htmldata="";
					var htmldt="";
					var htmlfile="";
					var ftype="";
					var download="";
					var htmlfile_nw=""

					var ftype_nw="";
					var download_nw="";

					$("#showpth").html(`${dname}`);
					if(f.data.subdircount>0){
						for(var i in f.data.subdir){
							k++;
                        // htmldata+=`<li style='list-style-type:none;color:#ff4f00;cursor:pointer;'><i class='mdi mdi-folder-plus'></i> <span onclick="getsubfolder('${dname}/${f.data.subdir[i].subdirectory}',${k})">${f.data.subdir[i].subdirectory}</span>
						// <ul id='loadsub${k}'></ul>
						// </li>`;
						htmldt+=`<li class="col_div"><div href="#" onclick="getsubfolder('${dname}/${f.data.subdir[i].subdirectory}',${k})"><i class="mdi mdi-folder"></i> ${f.data.subdir[i].subdirectory}</div>
						<ul id='loadsub1${k}'></ul></li>`;
					}
					// $("#loadsub"+id).html(htmldata);
					$("#loadsub1"+id).html(htmldt);
					} 


					if(f.data.subdircount>0){
						for(var i in f.data.subdir){
							k++;
						// 	let delete_fld=`<span " style="cursor:pointer;margin-right:10px;margin-bottom:10px; float:right; margin-left:auto;" onclick="DeleteFolder('${dname}/${f.data.subdir[i].subdirectory}','${id}')"><i class="mdi mdi-delete" style="font-size: 25px;color: #ec1313"></i> </span>`;
						// 	htmlfile+=`<div class='col-4 mt-2'><div class='card' style="height:100px"><div class='card-body'><li style='list-style-type:none;color:#ff4f00;cursor:pointer; font-size:18px'><i class='mdi mdi-folder-open' style="font-size:40px"></i> <span onclick="getsubfolder('${dname}/${f.data.subdir[i].subdirectory}',${k})">${f.data.subdir[i].subdirectory}</span>
						// <ul id='loadsub${k}'></ul></li>
						
						// </div></div></div>`;

						var heading_nw1=`<a  onclick="getsubfolder('${dname}/${f.data.subdir[i].subdirectory}',${k})" style="cursor:pointer">${f.data.subdir[i].subdirectory}</a>`;
						htmlfile_nw+=`<tr>
							<td><i class='mdi mdi-folder-open' style="font-size:40px"></i></td>
							<td>${heading_nw1} <br>Created on : ${f.data.subdir[i].create_time}</td>
							<td>Folder Size : ${f.data.subdir[i].folder_size} <br> files : ${f.data.subdir[i].filecount} <br>Folders : ${f.data.subdir[i].dircount}</td>
							<td>${download}</td>
							</tr>`;
					}
					}
					
					if(f.data.filescount>0){
						for (var j in f.data.new_file){
							if(f.data.new_file[j].files.filetype == ".pdf"){
							 ftype=`<i class="mdi mdi-file-pdf" style="font-size: 40px;"></i>`;
							 download=`<a style="text-decoration:none;" href="<?=base_url('assets/Documents_company/')?>${dname}/${f.data.new_file[j].files.filename}" download><i class="mdi mdi-download" style="font-size: 25px;color:#109bbb"></i></a>&nbsp;&nbsp;
										 <a style="text-decoration:none;" href="<?=base_url('assets/Documents_company/')?>${dname}/${f.data.new_file[j].files.filename}" target="_blank"><i class="mdi mdi-view-list" style="font-size: 25px;color: #0fbb0f"></i></a>&nbsp;&nbsp;
									 `;
							 view=`<a href="<?=base_url('assets/Documents_company/')?>${dname}/${f.data.new_file[j].files.filename}" target="_blank" onclick=""><i class="mdi mdi-file" style="font-size: 25px;color:#109bbb"></i></a>`
							 		 
						}else{
							 ftype=`<i class="mdi mdi-file" style="font-size: 40px;"></i>`;
							download=`<a style="text-decoration:none;" href="<?=base_url('assets/Documents_company/')?>${dname}/${f.data.new_file[j].files.filename}" download ><i class="mdi mdi-download" style="font-size: 25px;color:#109bbb"></a></i>&nbsp;&nbsp;
								`;
							view=`<a href="<?=base_url('assets/Documents_company/')?>${dname}/${f.data.new_file[j].files.filename}" target="_blank" onclick=""><i class="mdi mdi-file" style="font-size: 25px;color:#109bbb"></i></a>`
						}


						var doc_r_id=f.data.new_file[j].db_data.id;
						var bt=btoa(doc_r_id);
						var dt_nw="<?php echo  base_url('Dashboard/File_dtl?I=')?>"+bt;

						var heading_nw=`<a onclick="getfile_dtl(${doc_r_id})" style="cursor:pointer;">${f.data.new_file[j].files.heading}</a>`;
					      
						    htmlfile_nw+=`<tr>
							<td>${ftype}</td>
							<td><b>${heading_nw}</b><br>Created on : ${f.data.new_file[j].files.create_time}</td>
							<td>File Size : ${f.data.new_file[j].files.file_size} <br> Expiry On : ${f.data.new_file[j].db_data.expirydate}  <br> <br> Last Modified : ${f.data.new_file[j].db_data.updateat}</td>
							<td>${download} &nbsp; ${view}</td>
							</tr>`;
						
							// htmlfile+=`<div class="col-4 mt-2">
					
							// <div class="card" style="height:140px" onclick="getfile_dtl(${doc_r_id})">
							               
							// 				<div class="card-body" style="cursor:pointer;">
							// 					<h4 style="color:#ff4f00">${ftype}&nbsp;&nbsp;${f.data.new_file[j].files.heading}</h4>
							// 					<h3 class="float-right">${download}</h3>
							// 				</div>
											
							// 			</div>
							// </div>`;
							
						}
					}else {
						// if(htmlfile ==""){
						// 	htmlfile="<h3 style='color:#ff4f00'>No files in this directory</h3>";
							
						// }
						if (htmlfile_nw=="") 
						{
							htmlfile_nw+=`<tr>
							<td colspan="4">No files in this directory</td>
							</tr>`;
						}
					}
					// $("#loadfile").html(htmlfile);
					$("#fld_dt").html(htmlfile_nw);
						// $("#loadfile").html("<h3 style='color:#ff4f00'>No files in this directory</h3>");			
				}else{
					// $("#loadfile").html("<h3 style='color:#ff4f00'>No files in this directory</h3>");
					$("#showpth").html(`${dname}`);
				}
			}
		})
	}


	 function make_dir(dname){
		 $("#dname").val(dname);		 
		$("#show").show();
	}
	function getfile_dtl(id)
	{
		$.ajax({
			type:'post',
			url:"<?=base_url('Dashboard/fdoc_dt')?>",
			data:{doc_id:id},
			dataType:'json',
			success:function (f){
				if(f.status){
					// var data="<?=base_url('assets/Documents_company/')?>";
					// console.log(data);
					// // alert("Folder Deleted Successfully");
					window.location.href="<?php  echo base_url('Dashboard/File_dtl');?>";
				
				}else{
					alert("No Details File Details Found");
					mytoast(f);
				}
			}
		})
	}



	function DeleteFolder(Dname,rDir_id)
	{

		if (confirm("Are you sure ,you want to delete this folder ?")) 
		{
			$.ajax({
			type:'post',
			url:"<?=base_url('Pdf/delete_directory')?>",
			data:{dname:Dname},
			dataType:'json',
			success:function (f){
				if(f.status){
					
					alert("Folder Deleted Successfully");
					// mytoast(f);
					// window.location.href=window.location.href;
					// window.location.reload(true);
					// window.setTimeout(function(){location.reload()},1000);
					
					$(`#${rDir_id}`).click();
					
					
				}else{
					alert("Folder Cannt be Deleted");
					mytoast(f);
				}
			},
			error : function(error){
                    JSON.stringify(error);
                    if( error.status == 404){
                        var str =  JSON.stringify(error.responseText);
                        var pos1 = str.search("<p>");
                        var pos = str.search("</p>");
                        var res=[];
                        res['title']="Error";
                        res['message']=str.slice(pos1, pos);
                    }else{
                        var res=[];
                        res['title']="Error";
                        res['message']="Error in database, please contact your administrator";
                    }
                    mytoast(res);
                }
		   })
		}
	
	}

	$("#frmDirct").submit(function (e){
		e.preventDefault();
		var dname=$("#dname").val();
		var input=$("#cd").val();
		// var frm=$("#frmDirct").serialize();
		$.ajax({
			type:'post',
			url:"<?=base_url('Pdf/make_directory')?>",
			data:{dname:dname,input:input},
			dataType:'json',
			success:function (f){
				if(f.status){
					$('#frmDirct').trigger('reset');
					alert("File Created Successfully");
					$("#show").hide();
					mytoast(f);
					var p=$("#dname").val();
					getsubfolder(p,k);
				}else{
					alert("File Not Created");
					mytoast(f);
				}
			},
			error : function(error){
                    JSON.stringify(error);
                    if( error.status == 404){
                        var str =  JSON.stringify(error.responseText);
                        var pos1 = str.search("<p>");
                        var pos = str.search("</p>");
                        var res=[];
                        res['title']="Error";
                        res['message']=str.slice(pos1, pos);
                    }else{
                        var res=[];
                        res['title']="Error";
                        res['message']="Error in database, please contact your administrator";
                    }
                    mytoast(res);
                }
		})
	});

	$("#btnClose").click(function(){
		$("#show").hide();
	})

	function fdlt(fname) {
		$.ajax({
			type:'post',
			url:"<?=base_url('Pdf/dlt')?>",
			data:{fname:fname},
			dataType:'json',
			success:function (f) {
				if(f.status){
					alert("File Deleted Successfully");
					var p=$(".pth").val();
					getsubfolder(p,k);
				}else{
					alert("File Not Deleted");
				}
			}
		})
	}


</script>
