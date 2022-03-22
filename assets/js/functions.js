function submitform(formid,btnid,txtid,rptfname){
    // $('#'+btnid).attr('disabled',true);
    var frm = $("#"+formid).serializeToJSON();
    if(frm!=''){
        const frm_data=do_data_list(JSON.stringify(frm));
        $.ajax({
            type:'post',
            url:formid.action,
            data:{frm_data:frm_data},
            crossDomain:true,
            dataType:'json',
            processData: false,
            contentType: false,
            cache: false,
            success:function (data) {
                if(data){
                    var status='';
                    if(data.status){
                        mytoast(data);
                        $('#'+formid).trigger('reset');
                        rptfname();
                        $("#"+formid.id).trigger('reset');
                    }else{
                        mytoast(data);
                    }
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
                }
                mytoast(error);
            }
        });
        $("#"+btnid).attr('disabled',false);
    }
}
function activeInactiveRecords(rowid,isactive,url){
    if(rowid!=null && isactive!=null && url!=null){
        jQuery.ajax({
            type: 'post',
            url: url,
            data: {rowid:rowid,isactive:isactive},
            dataType:'json',
            success: function (data) {
                if(data){
                    var status='';
                    if(data.status){
                        status='success';
                        var htmldata='';
                        if (isactive==0){
                            htmldata +="<i id='activeInactive"+rowid+"' class='mdi mdi-toggle-switch-off' onclick='active_inactive("+rowid+",1)' style='font-size: 25px;'></i>"+
                                "<i id='edit"+rowid+"' class='mdi mdi-square-edit-outline' style='font-size: 25px;' onclick='edit("+rowid+")'></i>"+
                                "</td></tr>";
                        }else if (isactive==1){
                            htmldata +="<i class='mdi mdi-toggle-switch' style='font-size: 25px;' onclick='active_inactive("+rowid+",0)'></i></td></tr>";
                        }
                        $("#action"+rowid).html(htmldata);
                    }else{
                        status="error";
                    }
                }
            }
        });
    }
}


function activeInactiveRecords_alt(rowid,isactive,url){
    if(rowid!=null && isactive!=null && url!=null){
        jQuery.ajax({
            type: 'post',
            url: url,
            data: {rowid:rowid,isactive:isactive},
            dataType:'json',
            success: function (data) {
                if(data){
                    var status='';
                    if(data.status){
                        status='success';
                        var htmldata='';
                        if (isactive==0){
                            htmldata +="<i id='activeInactive"+rowid+"' class='mdi mdi-toggle-switch-off' onclick='active_inactive("+rowid+",1)' style='font-size: 25px;'></i>"+
                                ""+
                                "</td></tr>";
                        }else if (isactive==1){
                            htmldata +="<i class='mdi mdi-toggle-switch' style='font-size: 25px;' onclick='active_inactive("+rowid+",0)'></i></td></tr>";
                        }
                        $("#action"+rowid).html(htmldata);
                    }else{
                        status="error";
                    }
                }
            }
        });
    }
}

function activeInactiveRecordswithoutedit(rowid,isactive,url){
    if(rowid!=null && isactive!=null && url!=null){
        jQuery.ajax({
            type: 'post',
            url: url,
            data: {rowid:rowid,isactive:isactive},
            dataType:'json',
            success: function (data) {
                if(data){
                    var status='';
                    if(data.status){
                        status='success';
                        var htmldata='';
                        if (isactive==0){
                            htmldata +="<i id='activeInactive"+rowid+"' class='mdi mdi-toggle-switch-off' onclick='active_inactive("+rowid+",1)' style='font-size: 25px;'></i></td></tr>"                              
                        }else if (isactive==1){
                            htmldata +="<i class='mdi mdi-toggle-switch' style='font-size: 25px;' onclick='active_inactive("+rowid+",0)'></i></td></tr>";
                        }
                        $("#action"+rowid).html(htmldata);
                    }else{
                        status="error";
                    }
                }
            }
        });
    }
}
function removeRecords(rowid,isactive,url){
    if(rowid!=null && isactive!=null && url!=null){
        jQuery.ajax({
            type: 'post',
            url: url,
            data: {rowid:rowid,isactive:isactive},
            dataType:'json',
            success: function (data) {
                if(data){
                    var status='';
                    if(data.status){
                        status='success';
                        var htmldata='';
                        if (isactive==1){
                            htmldata +="<i id='activeInactive"+rowid+"' class='mdi mdi-toggle-switch-off' onclick='active_inactive("+rowid+",0)' style='font-size: 25px;'></i>"+
                            "<i id='edit"+rowid+"' class='mdi mdi-square-edit-outline' style='font-size: 25px;' onclick='edit("+rowid+")'></i>"+
                            "</td></tr>";                             
                        }else if (isactive==0){
                            htmldata +="<i class='mdi mdi-toggle-switch' style='font-size: 25px;' onclick='active_inactive("+rowid+",1)'></i></td></tr>";
                        }
                        $("#action"+rowid).html(htmldata);
                    }else{
                        status="error";
                    }
                }
            }
        });
    }
}
function mytoast(res) {
    var title = res.title;
    var msg = res.message;
    if(res.status== true){
        // toastr.options.rtl = true;
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.success(msg,title);
        toastr.options.showMethod = 'slideDown';

    }else {
        // toastr.options.rtl = true;
        toastr.options.positionClass = 'toast-bottom-right';
        toastr.error(msg,title);
        toastr.options.showMethod = 'slideDown';
    }
}
function loadFirstoneBySecondone(firstid,secondid,url){
    var stateid =$('#'+firstid).val();
    $.ajax({
        type:'post',
        url:url,
        data:{id:stateid},
        dataType:'json',
        success:function (f) {
            console.log(f);
            if(f.status){
                $('#'+secondid).html(f);
            }else{
                $('#'+secondid).html('<option>--select--</option>');
            }
        }
    });
}

function loadBlockondist_cat(firstid,secondid,thirdid,url){
    var aid =$('#'+firstid).val();
    var did =$('#'+secondid).val();
    $.ajax({
        type:'post',
        url:url,
        data:{aid:aid,did:did},
        dataType:'json',
        success:function (f) {
            console.log(f);
            if(f){
                $('#'+thirdid).html(f);
            }else{
                $('#'+thirdid).html('<option>select</option>');
            }
        }
    });
}
function load_data(id,url){
    $.ajax({
        type:'post',
        url:url,
        dataType:'json',
        success:function (f) {
            $('#'+id).html(f);
        }
    });
}
function number_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) || e.which.length >6) {
            return false;
        }
    })
}
function percentage_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 &&  e.which != 37 && e.which != 46 && (e.which < 48 || e.which > 57) || e.which.length >6 ) {
            return false;
        }
    })
}
function alfa_numeric(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 45 && e.which != 47 && e.which != 46 ) {
            return false;
        }
    });
}
function charachters_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && e.which != 32 && e.which != 13 &&(e.which < 65 || e.which > 90 ) && (e.which < 97 || e.which > 122)) {
            return false;
        }
    });
}
function name_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && e.which != 32 && e.which != 13 && e.which != 46 &&(e.which < 65 || e.which > 90 ) && (e.which < 97 || e.which > 122)) {
            return false;
        }
    });
}
function url_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0  && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 47 && e.which != 46 && e.which != 58) {
            $(".errormsg_"+id).html("Only : , / and . are allowed").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function email_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0  && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 46){
            $(".errormsg_"+id).html("Only @ and . are allowed").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function epf_number_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 47 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 && e.which != 45 && e.which != 47 && e.which != 46 ) {
            $(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function bloodgroup_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 47 || e.which > 57) && e.which != 45 && e.which != 43 ) {
            $(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function password_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 44 || e.which > 57) && e.which != 32 && e.which != 38 && e.which != 40 && e.which != 41 &&  e.which != 47 &&  e.which != 95 ) {
            $(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function address_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && e.which != 32 && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 44 || e.which > 57)) {
            $(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function qualification_validate(id) {
    $("#"+id).keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 64 || e.which > 90) && (e.which < 97 || e.which > 122)&& (e.which < 48 || e.which > 57) && e.which !=43 && e.which !=32 && e.which !=46 ) {
            $(".errormsg_"+id).html("Alphanumeric Only").css({'color':'red'}).show().fadeOut(2000);
            return false;
        }
    });
}
function load_firstone_by_secondone(firstid,secondid,url){
    var yourid =$("#"+firstid).val();
    // var myselect2=$("#txtAc12").val();
    console.log(yourid);
    
    $.ajax({
        type:'post',
        url:url,
        data:{id:yourid},
        dataType:"json",
        success:function (f) {
            if(f.status != false){
                $('#'+secondid).html(f);
            }else{
                $('#'+secondid).html("<option>Select</option>");
            }
        }
    });
}

google.charts.load('current', {'packages':['bar','corechart']});
function google_piechart(values,options,id) {
	var data = google.visualization.arrayToDataTable(values);
	var chart = new google.visualization.PieChart(document.getElementById(id));
	chart.draw(data, options);
}

function google_barchart(values,options,id) {
	var data = google.visualization.arrayToDataTable(values);
	var chart = new google.visualization.PieChart(document.getElementById(id));
	chart.draw(data, options);
}


function load_spinner(tblid,bodyid,col){
	if ($.fn.DataTable.isDataTable("#"+tblid)) {
		$('#'+tblid).DataTable().clear().destroy();
	}
	$("#"+bodyid).html(`<tr>
					<td colspan="${col}" class="spinner-border-report" role="status" style="height: 50px;width:50px;">
						<i class="mdi mdi-loading" style="color:#ff4f00;font-size: 40px;"></i>
					</td>
				</tr>`);
	}
