<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
	$(function () {
	
		load_data('cboGender',"<?=base_url('Load/load_gender')?>");
		
		
		report_candidate();
	});
	jQuery('#cboTp').change(function (e) {
		report_candidate();
	})



	$("#dob").on("change",function(){
		var date = $(this).val();
		// alert(date);
		var getdate= getAge(date);
        // alert(getdate);
		$("#staff_age").val(getdate);
	})

function getAge(dateString) {
   var ageInMilliseconds = new Date() - new Date(dateString);
   return Math.floor(ageInMilliseconds/1000/60/60/24/365); // convert to years
}




	$("#frmCandidate").submit(function (e){
		e.preventDefault();
		// var frm = $("#frmCandidate").serializeToJSON();
		// if(frm!=""){
			// const frm_data=do_data_list(JSON.stringify(frm));
			$.ajax({
				type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
				url:"<?=base_url('Staff/c_candidate')?>",
				data:new FormData(this),
				dataType:'json',
				success:function (f){
					if(f.status){
						$('#frmCandidate').trigger('reset');
						$("#btnSubmit").html('Create');
						report_candidate();
						mytoast(f);
						$("#txtid").val(0);
					}else{
						mytoast(f);
					}
				},
				error : function(error){
					JSON.stringify(error);
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
						res['message']="Error in database, please contact your administrator";
					}
					mytoast(res);
				}
			})
		// }
	});

	function report_candidate() {
		$.ajax({
			type:'post',
			url:'<?=base_url("Staff/r_candidate")?>',
			dataType:'json',
			success:function (f) {
				var htmldata="";
				var j=0;
				var gender="";
				var caste="";
                var deptfrm="";
                    deptfrm+=`<option value='' hidden="hidden">select</option>`;
                    f.dept_data.map(function(e){
                        deptfrm+=`<option value='${e.id}'>${e.dept_dtl.deptname}</option>`;
                    });
                    console.log(deptfrm);
                   
                   $("#companydeptid").html(deptfrm);

				//    var desfrm="";
				//        desfrm+=`<option value='' hidden="hidden">select</option>`;
                //     f.des.map(function(e){
                //         desfrm+=`<option value='${e.id}'>${e.desgname}</option>`;
                //     });
                //     console.log(desfrm);
                //    $("#designationid").html(desfrm);


				   var userdt="";
				   userdt+=`<option value='' hidden="hidden">select</option>`;
                    f.user.map(function(e){
                        userdt+=`<option value='${e.id}'>${e.typename}</option>`;
                    });
                    console.log(deptfrm);
                   
                   $("#usertype").html(userdt);

				for(var i in f.data){

                    var km=0;
                  
					gender="";
					if(f.data[i].gender ==1){
						gender="Male";
					}else if(f.data[i].gender ==2){
						gender="Female";
					}else if(f.data[i].gender ==3){
						gender="Other";
					}
					caste="";
					if(f.data[i].caste ==1){
						caste="General";
					}else if(f.data[i].caste ==2){
						caste="OBC";
					}else if(f.data[i].caste ==3){
						caste="SC";
					}else if(f.data[i].caste ==4){
						caste="ST";
					}
					j++;
					htmldata+=`<tr><td>${j}</td><td>${f.data[i].name}</td><td>${f.data[i].deptname}</td><td>${f.data[i].mobile}</td><td>${f.data[i].email}</td><td>${gender}</td><td>${f.data[i].dob}</td> <td>${f.data[i].age}</td><td><img src='<?=base_url("assets/staff_image/")?>${f.data[i].image}' alt='no image uploaded' height='100' width='100'></td>`;
					if (f.data[i].isactive==1){
						htmldata +=`<td style="width: 10px; display: inline" id='action${f.data[i].id}'><i id='activeInactive${f.data[i].id}' class='mdi mdi-toggle-switch-off'  style='font-size: 25px;'  onclick='active_inactive(${f.data[i].id},1)'></i>
                                <i id='edit${f.data[i].id}' class='mdi mdi-square-edit-outline'  style='font-size: 25px;'  onclick='edit(${f.data[i].id})'></i></td></tr>`;
					}else if (f.data[i].isactive==0){
						htmldata +=`<td id='action${f.data[i].id}'><i class='mdi mdi-toggle-switch' style='font-size: 25px;' onclick='active_inactive(${f.data[i].id},0)'></i></td></tr>`;
					}
				}
				if ($.fn.DataTable.isDataTable("#CReport")) {
					$('#CReport').DataTable().clear().destroy();
				}
				$("#cndrpt").html(htmldata);
				$("#CReport").DataTable({
					retrieve:true,
					dom: 'flrtipB',
					buttons: [
						{
							extend: 'copyHtml5',
							title: 'Candidate Report',
						},
						{
							extend: 'excelHtml5',
							title: 'Candidate Report',
						},
						{
							extend: 'csvHtml5',
							title: 'Candidate Report',
						},
						{
							extend: 'pdfHtml5',
							title: 'Candidate Report',
						},
						{
							extend: 'print',
							title: 'Candidate Report',
						},
					],
				});
			}
		});
	}

	function active_inactive(rowid,isactive) {
		activeInactiveRecords(rowid,isactive,"<?=base_url('Staff/active_inactive_candidate')?>");
	}
	function edit(id){
		$.ajax({
			type:'post',
			url:'<?=base_url("Staff/edit_candidate")?>',
			data:{id:id},
			dataType:'json',
			success:function (f) {
				$('#txtid').val(f.data[0].id);
				$('#cboTp').val(f.data[0].ctype);
				$('#txtCnm').val(f.data[0].name);
				$('#txtMob').val(f.data[0].mobile);
				$('#txtAds').val(f.data[0].address);
				$('#txtMail').val(f.data[0].email);

				// $('#cboGender').val(f.data[0].gender);
				// $('#password').val(f.data[0].password);

				$('#dob').val(f.data[0].staffdob);
				$('#staff_age').val(f.data[0].staffage);
				
				// $('#txtPic').val(f.data[0].image);
				$("#btnSubmit").html('Update');


				var deptfrm="";
                    deptfrm+=`<option value='' hidden="hidden">select</option>`;
                    f.dept_data.map(function(e){
                         
						if (e.id==f.data[0].companydeptid) {
							deptfrm+=`<option value='${e.id}' selected>${e.dept_dtl.deptname}</option>`;
						}else{
							deptfrm+=`<option value='${e.id}'>${e.dept_dtl.deptname}</option>`;
						}


                        
                    });
               
                    
                   $("#companydeptid").html(deptfrm);


				   var userdt="";
				   userdt+=`<option value='' hidden="hidden">select</option>`;
                    f.user.map(function(e){
						if (e.id==f.data[0].usertypeid) {
							userdt+=`<option value='${e.id}' selected>${e.typename}</option>`;
						}else{
							userdt+=`<option value='${e.id}'>${e.typename}</option>`;
						}
                        
                    });
                    
					
                   $("#usertype").html(userdt);


				   var gend="";
				   gend+=`<option value='' hidden="hidden">select</option>`;
				   var k=1;
                    f.gender.map(function(e){
						if (k==f.data[0].gender) {
							gend+=`<option value='${k}' selected>${e}</option>`;
						}else{
							gend+=`<option value='${k}'>${e}</option>`;
						}
                       k++;
                        
                    });
					console.log(gend);
                   $("#cboGender").html(gend);




			}
		});
	}
</script>
