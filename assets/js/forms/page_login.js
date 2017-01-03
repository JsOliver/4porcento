var Login = function () {

    return {
        
        //Masking
        initLogin: function () {
	        // Validation for login form
	        $("#sky-form1").validate({
	            // Rules for form validation
	            rules:
	            {
	                email:
	                {
	                    required: true,
	                    email: true
	                },
	                password:
	                {
	                    required: true,
	                    minlength: 3,
	                    maxlength: 20
	                }
	            },
	                                
	            // Messages for form validation
	            messages:
	            {
	                email:
	                {
	                    required: 'Informe o email',
	                    email: 'Email inválido'
	                },
	                password:
	                {
	                    required: 'informe sua senha'
	                }
	            },                  
	            
	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());
	            }, submitHandler: function(error, element) {

					var email = document.getElementById('email').value;

					var pass = document.getElementById('pass').value;

					$.post("logar",{log:true,email:email,pass:pass},function (res) {

						if (res == 11)
						{
window.location.reload();
						}else{

							$("#resposta").html(res);
						}


					});
				}
	        });
        }

    };

}();