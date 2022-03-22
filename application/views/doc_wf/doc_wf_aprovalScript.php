<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
   $(function () {
    doc_aproval_dtl();
    });
  
    

function doc_aproval_dtl() {
        $.ajax({
            type:'post',
            url:'<?=base_url("Workflow/ind_wf_dtl")?>',
            dataType:'json',
            success:function (f) {
                
     
                $(".doc_pth").attr("href","<?php echo base_url(); ?>"+f.doc_dtl.documentpath);

                $(".doc_name").text(f.doc_dtl.documentname +""+ f.doc_dtl.fileext);
                $("#wf_descp").text(f.doc_wf_ind.workflow_assign.description);

                if (f.iscompleted==false) 
                {
                      $("#appr_div").html(`<form id="wf_appr_form" enctype="multipart/form-data" method="post">

                <input type="hidden" name="wf_type_id" id="wf_type_id" value="1" class="form-control">
                <input type="hidden" name="doc_id" id="doc_id" class="form-control">
                <input type="hidden" name="wf_id" id="wf_id" class="form-control">
                <input type="hidden" name="isaproved" id="isaproved" class="form-control">
                <div class="textarea_area mt-3">
                    <h5 class="card_head2">Comment</h5>
                    <textarea name="comment" id="comment" class="form-control" placeholder="Type your comment"></textarea>
                </div>
                <div class="textarea_area mt-3">
                    <h5 class="card_head2">Add Files (Optional)</h5>
                    <input type="file" name="appr_attch" class="form-control">
                </div>
                </form>
                <div class="button_div mt-3">
                    <button type="button" class="btn btn-danger mr-3 " id="idreject" value="0">Reject</button>
                    <button type="button" class="btn btn-primary" id="aproved" value="1">Approve</button>
                </div>`);

                $("#doc_id").val(f.doc_dtl.id);
                $("#wf_id").val(f.doc_wf_ind.workflow_assign.id);


                $("#idreject").click(function(){
                        alert("working");
                        $("#isaproved").val('0');
                        $("#wf_appr_form").submit();
                    })
    $("#aproved").click(function(){
        $("#isaproved").val('1');
        $("#wf_appr_form").submit();
    })


    $("#wf_appr_form").on("submit",function(e){
		e.preventDefault();
		
		$("#attr_btn").attr("disabled", true);
        e.preventDefault();
        var frm = $("#wf_appr_form").serialize();
        if(frm!=""){
            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('Workflow/approve_wf')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
					
                    if(f.status){

                        doc_aproval_dtl();
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







                }

                if (f.iscompleted==true) 
                {
                      $("#appr_div").html(`
                            
                      <div class="mt-3">
						<h4 class="card_head1">Your Result</h4>
						<span id="yr_result">

                        </span>
					</div>
                      
                      `);
                      var dn="";
                      if (f.ind_dtl.isapproved='1')
                      {
                          dn+=`<div><i class="mdi mdi-check-circle mr-3" style="color: green"></i> Approved</div>`;
                      }else{
                        dn+=`<div><i class="mdi mdi-close-circle mr-3" style="color: red"></i> Rejected</div>`;
                      } 
                      dn+=`<div>
                      Comment : ${f.ind_dtl.comment} <br>
                      Verified at : ${f.ind_dtl.updateat}
                      </div>`;
                      $("#yr_result").html(dn);

                
                }

                var sts="";
                if (f.wf_status=="Pending") 
                {
                    sts+=`<div><i class="mdi mdi-record mr-3" style="color: #fcd303"></i> Pending</div>`;
                   
                } 
                if(f.wf_status=="Approved")
                {
                    sts+=`<div><i class="mdi mdi-record mr-3" style="color: green"></i> Approved</div>`;
                }
                if(f.wf_status=="Rejected")
                {
                    sts+=`<div><i class="mdi mdi-record mr-3" style="color: red"></i> Rejected</div>`;
                }
                $("#wf_sts").html(sts);
                var html="";
                var com=f.doc_wf_ind.workflow_assign.iscomplete;
                var mc=0;
                if (com=='1') 
                {
 

                            f.workflow_data.map(function(e){
                            if (e.iscomplete=='1' && e.isapproved=='1') 
                            {
                                   html+=`<div><i class="mdi mdi-record mr-3" style="color: green"></i> ${f.staff_name[mc]}</div>`;
                            }

                            if (e.iscomplete=='1' && e.isapproved=='0') 
                            {
                                   html+=`<div><i class="mdi mdi-record mr-3" style="color: red"></i> ${f.staff_name[mc]}</div>`;
                            }
                            if (e.iscomplete=='0' && e.isapproved=='0') 
                            {
                                   html+=`<div><i class="mdi mdi-record mr-3" style="color: black"></i> ${f.staff_name[mc]}</div>`;
                            }
                            mc++;
                        })
                } if (com=="0") {
                    
                    
                          f.workflow_data.map(function(e){
                            if (e.iscomplete=='1' && e.isapproved=='1') 
                            {
                                   html+=`<div><i class="mdi mdi-record mr-3" style="color: green"></i> ${f.staff_name[mc]}</div>`;
                            }

                            if (e.iscomplete=='1' && e.isapproved=='0') 
                            {
                                   html+=`<div><i class="mdi mdi-record mr-3" style="color: red"></i> ${f.staff_name[mc]}</div>`;
                            }
                            if (e.iscomplete=='0' && e.isapproved=='0') 
                            {
                                   if (f.this_id==e.assignedto) {
                                    html+=`<div><i class="mdi mdi-record-circle-outline mr-3" style="color: #fcd303"></i> ${f.staff_name[mc]}</div>`;
                                    $("#wf_type_id").val(e.id);
                                   } else {
                                     html+=`<div><i class="mdi mdi-record mr-3" style="color: #fcd303"></i> ${f.staff_name[mc]}</div>`;
                                   }
                            }
                            mc++;
                        })
                }

                  $("#wf_status").html(html);
                

                console.log(f);
                var j=0;
          
            }
        });
    }

  

$("#frmDp").submit(function (e){
        e.preventDefault();
        
            $.ajax({
                type:'post',
				crossDomain:true,
				processData: false,
				contentType: false,
				cache: false,
                url:"<?=base_url('get_doc_wfdtl/approve_wf')?>",
                data:new FormData(this),
                dataType:'json',
                success:function (f){
                    if(f.status){
                        // $('#frmDp').trigger('reset');
                        // $("#btnSubmit").html('Create');
                        report_pc();
                        mytoast(f);
                        // $("#txtid").val(0);
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
        
    });

</script>