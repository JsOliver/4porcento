var Registration = function () {

    return {

        //Registration Form
        initRegistration: function () {
	        // Validation
	        $("#sky-form4").validate({
	            // Rules for form validation
	            rules:
	            {
	                username:
	                {
	                    required: true
	                },
					cpf:
	                {
	                    required: true
	                },

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
	                },
	                passwordConfirm:
	                {
	                    required: true,
	                    minlength: 3,
	                    maxlength: 20,
	                    equalTo: '#password'
	                },
	                firstname:
	                {
	                    required: true
	                },
	                lastname:
	                {
	                    required: true
	                },
	                terms:
	                {
	                    required: true
	                }
	            },

	            // Messages for form validation
	            messages:
	            {

					cpf:{
						required: 'Informe o CPF.'

					},username:{
						required: 'Informe o nome de usuario.'

					},

	                login:
	                {
	                    required: 'Please enter your login'
	                },
	                email:
	                {
	                    required: 'Infome o email.',
	                    email: 'Email inválido.'
	                },
	                password:
	                {
	                    required: 'Informe a senha.'
	                },
	                passwordConfirm:
	                {
	                    required: 'Informe a senha novamente',
	                    equalTo: 'As senhas não coincidem'
	                },
	                firstname:
	                {
	                    required: 'Informe o nome'
	                },
	                lastname:
	                {
	                    required: 'Informe o sobrenome'
	                },
	                terms:
	                {
	                    required: 'Você deve aceitar os termos e confições de uso.'
	                }
	            },

	            // Do not change code below
	            errorPlacement: function(error, element)
	            {
	                error.insertAfter(element.parent());


	            }, submitHandler: function(error, element) {


						var e = document.getElementById("syn_list");
						var mes = e.options[e.selectedIndex].value;
						var f = document.getElementById("sexo");
						var genero = f.options[f.selectedIndex].value;
						var nome = document.getElementById('firstname').value;
						var sobrenome = document.getElementById('lastname').value;
						var username = document.getElementById('username').value;
						var email = document.getElementById('email').value;
						var password = document.getElementById('password').value;
						var passwordConfirm = document.getElementById('passwordConfirm').value;
						var cpf = document.getElementById('cpf').value;

					$.post("cadastrar",{cad:true,genero:genero,nome:nome,sobrenome:sobrenome,username:username,email:email,password:password,passwordConfirm:passwordConfirm,cpf:cpf},function (res) {

						if(res == 11){
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