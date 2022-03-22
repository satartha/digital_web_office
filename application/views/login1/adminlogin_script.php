<script>
    $(function () {
    });
    $("#login").submit(function (e){

        e.preventDefault();
        var userid=$("#tu").val();
        var password=$("#tp").val();
        if(userid!=""){
            const desk1=do_data_list(userid);
            const desk2=do_data_list(password);
            // alert(desk1);
            // return false;
            $.ajax({
                type:'post',
                url:"<?=base_url('Login/check_login_admin')?>",
                data:{data1:desk1,data2:desk2},
                dataType:'json',
                success:function (data){
                    // alert("working");
                    // console.log(data);
                	// console.log(data);
                    if(data.status!=false){
                    
                        window.location.href="<?=base_url('Admin')?>";
                        $('#login').trigger('reset');
                    }else{
                        alert("error working");
                    console.log(data);
                        alert(data.message);
                    }
                }
            })
        }
    })

	const spwd = document.querySelector('#spwd');
	const password = document.querySelector('#tp');
	spwd.addEventListener('click', function (e) {
		const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
		password.setAttribute('type', type);
		this.classList.toggle('mdi-eye-off');
	});
</script>
