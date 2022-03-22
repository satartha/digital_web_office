<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
   $(function () {
    doc_aproval_dtl();
    });
  
    

function doc_aproval_dtl() {
        $.ajax({
            type:'post',
            url:'<?=base_url("Workflow/get_wf_dtl_ind")?>',
            dataType:'json',
            success:function (f) {
                
     
            if (f.status==true) 
            {
                $(".doc_pth").attr("href","<?php echo base_url(); ?>"+f.doc_dtl.documentpath);

                $(".doc_name").text(f.doc_dtl.documentname +""+ f.doc_dtl.fileext);
                $("#wf_descp").text(f.doc_wf_ind.workflow_assign.description);
                
                $("#wf_nm").text(f.doc_wf_ind.workflow.workflowname)

                var sts="";
                if (f.wf_status=="Pending") 
                {
                    sts+=`<div><i class="mdi mdi-record mr-3" style="color: #fcd303"></i> Pending</div>`;
                   
                } 
                if(f.wf_status=="Approved")
                {
                    sts+=`<div><i class="mdi mdi-check-circle mr-3" style="color: green"></i> Approved</div>`;
                }
                if(f.wf_status=="Rejected")
                {
                    sts+=`<div><i class="mdi mdi-record mr-3" style="color: red"></i> Rejected</div>`;
                }
                $("#wf_sts").html(sts);
                var html="";
                var com=f.doc_wf_ind.workflow_assign.iscomplete;
                var mc=0;
              
 

                            f.workflow_data.map(function(e){
                             
                            if (e.iscomplete=='1' && e.isapproved=='1') 
                            {
                                   var k=`<i class="mdi mdi-record mr-3" style="color: green"></i> `;
                            }

                            if (e.iscomplete=='1' && e.isapproved=='0') 
                              {
                                var k=`< class="mdi mdi-record mr-3" style="color: red">`;
                            }
                            if (e.iscomplete=='0' ) 
                            {
                                var k=`<i class="mdi mdi-record mr-3" style="color: #fcd303"></i> `;
                            }
                            html+=`<tr><td>${k}</td><td>${f.staff_name[mc]}</td><td>${e.assigndate}</td><td>${e.completedate}</td><td>${e.comment}</td></tr>`;
                            mc++;
                        })
                        console.log(html);
                  $("#histry_lst").html(html);
                
                var j=0;   
            }
          
            }
        });
    }

  



</script>