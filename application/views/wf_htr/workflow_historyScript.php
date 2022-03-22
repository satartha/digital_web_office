<script src="<?=base_url('assets/js/functions.js')?>"></script>

<script>
        report_data();
    function report_data()
	{
	    var html_dt=""; 
	
		$.ajax({
			type:'post',
			url:"<?=base_url('Workflow/Workflow_hst_detail')?>",
			dataType:'json',
			success:function (f){
				if (f.status==true) 
                {
                    var c=0;
                    f.workflow_history.map(function(e){

                        if (f.wf_status[c]=="Approved") {
                            var dt=`<i class="mdi mdi-check-circle mr-3" style="color: green">`;
                        }
                        if (f.wf_status[c]=="Pending") {
                            var dt=`<i class="mdi mdi-record mr-3" style="color: #fcd303"></i>`;
                        }

                        if (f.wf_status[c]=="Rejected") {
                            var dt=`<i class="mdi mdi-record mr-3" style="color: red"></i>`;
                        }
                        
                        var wfid=btoa(e.id);
                        html_dt+=`<tr><td>${dt}</td><td>${f.doc_dtl[c].documentname}</td><td>${e.entryat}</td><td>${e.description}</td><td><a href="<?php echo base_url()?>/Workflow/get_wf_dtl?I=${wfid}">view details</a></td></tr>`;
                      
                        c++;
                    })
                }else{
                    html_dt+=`<tr><td colspan='6'>No Workflow Found</td></tr>`;
                }

                $("#wf_lst").html(html_dt);

			},error : function(error){
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
</script>