<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
    report_data();
    function report_data()
	{
		$("#as_div").hide();
	
		$.ajax({
			type:'post',
			url:"<?=base_url('Upload_doc/doc_details')?>",
		
			dataType:'json',
			success:function (f){
				if(f.status){
				 $("#myModal").modal("hide");
				 $("#modal_att").modal("hide");	
                 $("#modal_ver").modal("hide");
				  console.log(f.data);
				  var path=f.data.file_data.documentpath;
				  $(".docid").text(f.data.file_data.id);
				  $(".txtid").val(f.data.file_data.id);
				  $("#current_path").val(path);
				  $("#current_path").hide();
				  $(".txtid").hide();
				  $("#docid").val(f.data.file_data.id);
				  
				  $(".doc_nm").text(f.data.file_data.documentname);
				  $(".docowner").text(f.owner_name);

				  $(".doc_com").text(f.data.file_data.versioncomment);
				  $(".curr_version").text(f.data.file_data.version);
				  $(".doc_sp").text(f.data.file_size);
				  $(".doc_cr").text(f.data.file_data.entryat);
				  $(".doc_exp").text(f.data.file_data.expirydate);

				  $(".doc_letterno").text(f.data.file_data.letterno);
				  $(".doc_letterdt").text(f.data.file_data.letterdate);
				  $(".doc_ver_com").text(f.data.file_data.versioncomment);
				  $(".doc_ver").text(f.data.file_data.version);
				  $("#curr_version").text(f.data.file_data.version);


				  $(".docname").text(f.data.file_data.filename+f.data.file_data.fileext);


				$("#doc_prev").attr("href", "<?php echo base_url(); ?>"+ path +"");
				$("#download_btn").attr("href", "<?php echo base_url(); ?>"+ path +"");

                   var htmldt="";
				htmldt+=`<option value='' hidden='hidden'>select</option>`;
                var wf_select="";
				wf_select+=`<option value="" hidden>Choose</option>`;
				if (f.wf!=false) 
				{
					f.wf.map(function(e){
						wf_select+=`<option value="${e.id}">${e.workflowname}</option>`;
					})
				}

				$("#wfid").html(wf_select);
				
                f.doc_type.map(function(e){
					
					if (f.data.file_data.doctypeid==e.id) {
						
						htmldt+=`<option value='${e.id}' selected>${e.typename}</option>`;
					}else{
						htmldt+=`<option value='${e.id}'>${e.typename}</option>`;
					}
                    
                })

                $("#doctype1").html(htmldt);
				
				$("#doc_name").val(f.data.file_data.documentname);
				$("#letterno").val(f.data.file_data.letterno);
				$("#letterdt").val(f.data.file_data.letterdate);
				$("#expdt").val(f.data.file_data.expirydate);
				$("#description").val(f.data.file_data.description);
			
                if (f.doc_version.length>0) 
				{
					var ver_dt="";
                    var i=0;
					f.doc_version.map(function(e){
						var ver_id=e.id;
						ver_dt+=`<tr><td>${e.version}</td><td>${f.ownername[i]}</td><td>${e.versioncomment}</td><td><a href="<?php echo base_url()?>${e.documentpath}" target="_blank"><i class="mdi mdi-square-edit-outline mdi-24px" style="cursor: pointer;"></i></a>&nbsp;<a href="#" data-eid="${ver_id}"   class="rstr btn btn_success"><i class="mdi mdi-restore mdi-24px" style="cursor: pointer;"></i></a></td></tr>`;
					    i++;
                    })
                    
				
				}else{
					ver_dt=`<tr><td colspan="4">No Data Found</td></tr>`;
				}
				$("#doc_ver_tbl").html(ver_dt);

			    $("#edit_btn").attr("href","<?php echo base_url();?>/Upload_pdf/update_doc_ds?I="+btoa(f.data.file_data.id)+"");

				}else{
					alert("No Details File Details Found");
					mytoast(f);
				}
			}
		})
	}

	$(document).on("click",".rstr",function(e){
	e.preventDefault();
       var eid= $(this).data('eid');
            $.ajax({
                type:'post',
                url:"<?=base_url('Upload_doc/restore_version')?>",
                data:{id:eid},
                dataType:'json',
                success:function (f){
                    if(f.status){
                        report_data();		
                        mytoast(f);
                    }else{
                        mytoast(f);
                    }
                },
                error : function(error){
                    
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
	})

	$("#ver_submit").on("submit",function(e){
		e.preventDefault();
		$("#update_btn").attr("disabled", true);
		// $("#crt").show();
        e.preventDefault();
        var frm = $("#ver_submit").serialize();
        
        if(frm!=""){
            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('Upload_doc/update_doc_version')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
					$("#update_btn").attr("disabled", false);
					$("#txtid").val(0);
           
                    if(f.status){
                  ;
                        $("#btnSubmit").trigger('reset');
                        report_data();
						
                        mytoast(f);
                    
                 
                    }else{
                        mytoast(f);
                    }
                },
                error : function(error){
                    
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
        }
	})



	$("#as_input").keyup(function(){
		// alert("working");
		var dt=$(this).val();
		dt=dt.trim();
		$("#as_ul").html("");
		if (dt!="") 
		{
			$.ajax({
                type:'post',
                url:"<?=base_url('Workflow/get_staff')?>",
                data:{name:dt},
                dataType:'json',
                success:function (f){
                    if(f.status){
					
                        $("#as_div").attr("display:block");
						$("#as_div").fadeIn();
						
					    
                        f.staff.map(function (v) 
						{
						
							$("#as_ul").append(`<li  onclick="get_dtl(${v.id})" class="list_staff" style="cursor:pointer;">${v.staffname}</li>`);
						})

						// $.each(f.staff, function(k, v) {
						// $("#as_ul").append(`<li data-eid="${v.id}" onclick="get_dtl(${v.id})" class="list_staff" style="cursor:pointer;">${v.staffname}</li>`);
					
						// })
					

				
                    }else{
						alert("false");
						console.log(f);
                    }
                },
                error : function(error){
                  
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
		}
	})


	

	function get_dtl(id)
	{
		$("#as_ul").fadeOut();
			$.ajax({
                type:'post',
                url:"<?=base_url('Workflow/get_ind_staff')?>",
                data:{sid:id},
                dataType:'json',
                success:function (f){
					console.log(f);
                    if(f.status){
                 
				    $("#drag_ndtl").append(`<tr id='staff_row${id}'>
												<td><i class="mdi mdi-drag-vertical"></i></td>
												
												<td>${f.ind_staff.staffname}<input class="form-control" name="resp_per[]" type="hidden"  value="${id}"></td>
												
												<td><span class="mdi mdi-trash-can-outline" onclick="delete_staff_row(${id})"></span></td>
											</tr>`);
					

				
                    }else{
					
                    }
                },
                error : function(error){
                    
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
	
	}
	$("#exampleModal").hide(function(){
			$("#as_input").trigger("reset");
		})
	

	    function delete_staff_row(id)
		{

			$(`#staff_row${id}`).remove();

		}



		
	$("#modal_flow").on("submit",function(e){
		e.preventDefault();
		
		$("#attr_btn").attr("disabled", true);
        e.preventDefault();
        var frm = $("#btnSubmit1").serialize();
        
        if(frm!=""){
            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('Workflow/generate_workflow')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
					// $("#attr_btn").attr("disabled", false);
					// $("#txtid").val(0);
               
                    if(f.status){
                      
                        $("#modal_flow").trigger('reset');
                        report_data();
						
                        mytoast(f);
                      
                    }else{
                        mytoast(f);
                    }
                },
                error : function(error){
                    
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
        }


	})








	
	$("#btnSubmit1").on("submit",function(e){
		e.preventDefault();
		
		$("#attr_btn").attr("disabled", true);
		// $("#crt").show();
        e.preventDefault();
        var frm = $("#btnSubmit1").serialize();
        
        if(frm!=""){
            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('Upload_doc/edit_attr')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
					$("#attr_btn").attr("disabled", false);
					$("#txtid").val(0);
                    // console.log(f);
					// $("#crt").hide();
                    if(f.status){
                        // designation_change_report(did);
                        $("#btnSubmit1").trigger('reset');
                        report_data();
						
                        mytoast(f);
                        // $(".vanish").remove();
                        // $("#addDType").html("");
                        // $("#attr_btn").html("Update");
                    }else{
                        mytoast(f);
                    }
                },
                error : function(error){
                    
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
        }


	})


    $("#workflow_btn").click(function(){
        get_dir();
    })
$("#choose_btn").click(function(){
    $("#myModal").modal("hide");
})

$("#tgl_btn").on("change",function(){
    var display=$("#tgl_load").attr("style");
    
   

    if (display=="display: none;") 
    {
       $(".pth").val("");       
    }
    

})




    function get_dir() {
		$("#show").hide();
		$("#up_frm").hide();
		$.ajax({
			type:'post',
			url:"<?=base_url('Dashboard/show_dir')?>",
			dataType:'json',
			success:function (f) {
				if(f.status){
                    $('.pth').val(f.base_path);
                    $("#base_pathname").text(f.base_path);
					k=0;
					m=0;
					var htmlfile_nw="";
					var htmldata="";
					// for(var i in f.data){
					// 	k++;
                    //     htmldata+=`<li style='list-style-type:none;color:#ff4f00;cursor:pointer;'><i class='mdi mdi-folder-plus'></i> <span id="${k}" onclick="getsubfolder('${f.data[i].directory}',${k})">${f.data[i].directory_name}</span>
					// 	<ul id='loadsub${k}'></ul></li>`;
					// }
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
					//  $("#loadsub0").html(htmldata);
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

						var heading_nw1=`<a onclick="getsubfolder('${dname}/${f.data.subdir[i].subdirectory}',${k})" style="cursor:pointer">${f.data.subdir[i].subdirectory}</a>`;
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

						var heading_nw=`<a onclick="getfile_dtl(${doc_r_id})">${f.data.new_file[j].files.heading}</a>`;
					      
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










</script>