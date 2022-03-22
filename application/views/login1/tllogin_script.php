<script>

$("#login").submit(function (e){
        e.preventDefault();
        var userid=$("#tu").val();
        var password=$("#tp").val();
        
        if(userid!=""){
            const desk1=do_data_list(userid);
            const desk2=do_data_list(password);
            
            $.ajax({
                type:'post',
                url:"<?=base_url('Login/check_staff_login')?>",
                data:{data1:desk1,data2:desk2},
                dataType:'json',
                success:function (data){
                    if(data.status!=false){
                    	// if(data.calling == "1"){
							window.location.href="<?=base_url('Staff_dashboard/staff_section')?>";
						// }else if(data.campaign == "1"){
						// 	window.location.href="<?=base_url('Dashboard/campaign_dashboard')?>";
						// }else{
                    	// 	alert("You have no access to login");
						// }
                        $('#login').trigger('reset');
                    }else{
                        alert(data.message);
                    }
                }
            })
        }
    })

	const tpwd = document.querySelector('#tpwd');
	const password = document.querySelector('#tp');
	tpwd.addEventListener('click', function (e) {
		const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
		password.setAttribute('type', type);
		this.classList.toggle('mdi-eye-off');
	});
</script>
