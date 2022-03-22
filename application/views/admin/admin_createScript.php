<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
    // alert("working company Script");
      	$(function () {
            $("#frmEform2").trigger('reset');
    report_candidate();

});



    $("#frmEform2").submit(function (e){
		$("#btnSubmit").attr("disabled", true);
		// $("#crt").show();
        e.preventDefault();
        var frm = $("#frmEform2").serialize();
        
        if(frm!=""){
            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('Admin/create_Admin')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
					$("#btnSubmit").attr("disabled", false);
					$("#txtid").val(0);
                    // console.log(f);
					// $("#crt").hide();
                    if(f.status){
                        // designation_change_report(did);
                        $("#frmEform2").trigger('reset');
                        report_candidate();
						// $(".a").empty();
						// $(".a").trigger('change');
                        // view_report(f.pid);
                        mytoast(f);
                        // $(".vanish").remove();
                        // $("#addDType").html("");
                        $("#btnSubmit").html("Create");
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
    });



    function report_candidate() {
		$.ajax({

			type:'post',
			url:'<?=base_url("Admin/r_admin")?>',
			dataType:'json',
			success:function (f) {
				var htmldata="";
				var j=0;
			

				for(var i in f.data){
                    var km=0;
					j++;
					htmldata+=`<tr><td>${j}</td><td>${f.data[i].name}</td><td>${f.data[i].mobile}</td><td>${f.data[i].email}</td><td>${f.data[i].address}</td><td><img src='<?=base_url("assets/admin_logo/")?>${f.data[i].pic}' alt='no image uploaded' height='100' width='100'></td>`;
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
		activeInactiveRecords(rowid,isactive,"<?=base_url('Admin/active_inactive_admin')?>");
	}
	function edit(id){
		$.ajax({
			type:'post',
			url:'<?=base_url("Admin/edit_admin")?>',
			data:{id:id},
			dataType:'json',
			success:function (f) {
                console.log(f);
				$('#txtid').val(f.data[0].id);
				$('#comName').val(f.data[0].name);
				
               
				$('#txtMobile').val(f.data[0].mobile);
				$('#txtAddress').val(f.data[0].address);
			

				$('#txtEmail').val(f.data[0].email);
				// $('#password').val(f.data[0].password);
			
				
				$('#txtPic').val(f.data[0].pic);
                
				$("#btnSubmit").html('Update');


			}
		});
	}

</script>