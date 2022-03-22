<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
  
    $(function () {
        report_pc();
    });
    $("#frmDp").submit(function (e){
        e.preventDefault();
        var frm = $("#frmDp").serializeToJSON();
        if(frm!=""){
            const frm_data=do_data_list(JSON.stringify(frm));
            $.ajax({
                type:'post',
                url:"<?=base_url('Dept_mapping/c_dp')?>",
                data:{frm_data:frm_data},
                dataType:'json',
                success:function (f){
                    if(f.status){
                        $('#frmDp').trigger('reset');
                        $("#btnSubmit").html('Add');
                        report_pc();
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
        }
    });
    function report_pc() {
        $.ajax({
            type:'post',
            url:'<?=base_url("Dept_mapping/r_pc")?>',
            dataType:'json',
            success:function (f) {
                // alert("success Here");
               
                var htmldata="";
                var frmdt="";
               
                var j=0;
                var l=0;
                for(var i in f.data){
                    j++;
                    htmldata+=`<tr><td>${j}</td><td>${f.data[i].deptname}</td>`;
                    if (f.data[i].isactive==1){
                        htmldata +=`<td style="width: 10px; display: inline" id='action${f.data[i].id}'><i id='activeInactive${f.data[i].id}' class='mdi mdi-toggle-switch-off'  style='font-size: 25px;'  onclick='active_inactive(${f.data[i].id},1)'></i> `;
                    }else if (f.data[i].isactive==0){
                        htmldata +=`<td id='action${f.data[i].id}'><i class='mdi mdi-toggle-switch' style='font-size: 25px;' onclick='active_inactive(${f.data[i].id},0)'></i></td></tr>`;
                    }
                }
                if (f.data_form!=undefined || f.data_form!=null ) {
                        frmdt+=`<option hidden='hidden'>Choose</option>`;
                    f.data_form.map(function(e){
                    
                        frmdt+=`<option value="${f.data_form[l].deptid}">${f.data_form[l].deptname}</option>`;
                        l++;
                    })
                    $("#dept_map").html(frmdt);
                }

                

                console.log(htmldata);
				if ($.fn.DataTable.isDataTable("#pcReport")) {
					$('#pcReport').DataTable().clear().destroy();
				}
                console.log(frmdt);
                $("#pcrpt").html(htmldata);
                
                $("#pcReport").DataTable({
                    retrieve:true,
                    dom: 'flrtipB',
					buttons: [
						{
							extend: 'copyHtml5',
							title: 'Pc Report',
						},
						{
							extend: 'excelHtml5',
							title: 'Pc Report',
						},
						{
							extend: 'csvHtml5',
							title: 'Pc Report',
						},
						{
							extend: 'pdfHtml5',
							title: 'Pc Report',
						},
						{
							extend: 'print',
							title: 'Pc Report',
						},
					],
                });
            },
            error:function(e)
            {
                console.log(e);
                alert("error is here");
            }
        });
    }
    function active_inactive(rowid,isactive) {
        activeInactiveRecords_alt(rowid,isactive,"<?=base_url('Dept_mapping/active_inactive_pc')?>");
    }
    function edit(id){
        // alert(id);
        $.ajax({
            type:'post',
            url:'<?=base_url("Dept_mapping/edit_pc")?>',
            data:{id:id},
            dataType:'json',
            success:function (f) {
                console.log(f);
                $('#txtid').val(f.data[0].id);
                // $('#pcd').val(f.data[0].pccode);
                $('#pcnm').val(f.data[0].deptname);
                $("#btnSubmit").html('Update');
            }
        });
    }
</script>
