<script>
    $("#frmworkflowgen").submit(function (e) {
		 e.preventDefault();
		 $.ajax({
			 type:'post',
			 url:"<?=base_url('Workflow/generate_workflow')?>", 
			 crossDomain:true,
			 processData: false,
			 contentType: false,
			 cache: false,
			 data:new FormData(this),
			 dataType:'json',
			 success:function (f) {
				 if(f.status){
					 $("#frmworkflowgen").trigger('reset');
					 alert("Document Workflow Successfully");
                     mytoast(f);

				 }else{
					 alert("Workflow is not generated");
                     mytoast(f);
				 }
			 },error:function (f) {
				
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