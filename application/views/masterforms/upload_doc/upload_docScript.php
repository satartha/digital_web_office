<script src="<?=base_url('assets/js/functions.js')?>"></script>
<script>
    $(function () {
        init_page();
    });

    function init_page() {
        $.ajax({
            type:'post',
            url:'<?=base_url("Upload_doc/r_pc")?>',
            dataType:'json',
            success:function (f) {
                var htmldata="";
                // console.log(f);
                var j=0;
                htmldata+=`<option value='' hidden='hidden'>select</option>`;
                f.data.map(function(e){
                    htmldata+=`<option value='${e.id}'>${e.typename}</option>`;
                })

                $("#doctype").html(htmldata);

                var htmldt="";
                // console.log(f);
                var j=0;
                htmldt+=`<option value='' hidden='hidden'>select</option>`;
                f.staff.map(function(e){
                    htmldt+=`<option value='${e.id}'>${e.staffname}</option>`;
                })

                $("#user_as").html(htmldt);

            }
        });
    }

    $("#exp_opt").on("change",function(){
        var ext= $(this).val();
        
        var dt="";
        switch(ext) {
                    case '1d':
                        dt= "+ 1 day";
                        break;
                    case '1wk':
                        dt= "+ 7 days";
                        break;
                    case '1mn':
                        dt= "+1 month";
                        break;
                    case '6mn':
                        dt= "+6 months";
                        break;
                        case '1yr':
                            dt= "+ 365 days";
                        break;
                    default:
                    dt=null;
        }

        $.ajax({
            type:'post',
            url:'<?=base_url("Upload_doc/exp_dt")?>',
            data:{data:dt},
            dataType:'json',
            success:function (f) {
                // var htmldata="";
                console.log(f);
                $("#expdt").val(f.future_date);
                // var j=0;
                // htmldata+=`<option value='' hidden='hidden'>select</option>`;
                // f.data.map(function(e){
                //     htmldata+=`<option value='${e.id}'>${e.typename}</option>`;
                // })

                // $("#doctype").html(htmldata);


             
            }
        });

    })


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
				url:"<?=base_url('Upload_doc/c_candidate')?>",
				data:new FormData(this),
				dataType:'json',
				success:function (f){
					if(f.status){
						$('#frmCandidate').trigger('reset');
						$("#btnSubmit").html('add');
						// report_candidate();
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













</script>