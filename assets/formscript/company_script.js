jQuery(document).ready(function () {
    jQuery("#btnSubmit").click(function (e) {
        e.preventDefault();
        var frm=jQuery("#frmCompany");
        console.log(frm[0])
    })
});

// $('#frmCompany').submit(function(e){
//     e.preventDefault();
//     var frm = $("#frmCompany").serialize();
//     $.ajax({
//         type:"post",
//         url:'<?=base_url("Company/company_creation")?>',
//         data:frm,
//         success:function(res){
//             if(res!=false){
//                 $("#frmCompany").trigger('reset');
//             }
//         }
//     });
// });
// $('#btnReport').click (function(){
//     $.ajax({
//         type:"post",
//         url:"<?=base_url('Company/company_creation')?>",
//         success:function(res){
//             $('#showReportcd').html(res);
//         }
//     });
// });