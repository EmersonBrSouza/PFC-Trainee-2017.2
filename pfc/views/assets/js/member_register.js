$(document).ready(function () {

    $.validator.setDefaults({
        errorClass:"text-danger"
    });

    $.validator.addMethod( "lettersonly", function( value, element ) {
        return this.optional( element ) || /^[a-zA-zà-ú/\s]+$/i.test(value);
    }, "Números não são permitidos" );

    $.validator.addMethod("strongPassword", function(value,element){
        return this.optional(element) || value.length >= 6 && value.length <= 32;                                
    }, "A senha deve conter no mínimo 6 caracteres");

    $.validator.addMethod("scoreLessThan", function( value) {
        var target = 250;
        return value <= target;
    }, "O valor deve ser menor ou igual a 250." );

    $.validator.addMethod("scoreGreaterThan", function( value) {
        var target = 0;
        return value >= target;
    }, "O valor deve ser maior ou igual a 0." );

    $('#form').validate({
        rules:{
            name:{
                required:true,
                lettersonly:true
            },
            personal_email:{
                email:true,
                required:true
            },
            professional_email:{
                email:true,
                required:true
            },
            password:{
                required:true,
                strongPassword:true
            },
            password_update:{
                strongPassword:true
            },
            rg:{
                required:true
            },
            cpf:{
                required:true
            },
            birthdate:{
                required:true
            },
            telephone:{
                required:true
            },
            score:{
                required:true,
                scoreLessThan:true,
                scoreGreaterThan:true,
            },
            member_type:{
                required:true
            }

        },
        messages:{
            name:{
                required:"Por favor, preencha este campo.",
                lettersonly:"Apenas letras são permitidas"
            },
            personal_email:{
                required:"Por favor, preencha este campo.",
                email:"Informe um endereço de e-mail válido"
            },
            professional_email:{
                required:"Por favor, preencha este campo.",
                email:"Informe um endereço de e-mail válido"
            },
            password:{
                required:"Por favor, preencha este campo.",
                strongPassword:"A senha deve conter de 6 a 32 caracteres"
            },
            password_update:{
                strongPassword:"A senha deve conter de 6 a 32 caracteres"
            },
            rg:{
                required:"Por favor, preencha este campo."
            },
            cpf:{
                required:"Por favor, preencha este campo."
            },
            birthdate:{
                required:"Por favor, preencha este campo."
            },
            telephone:{
                required:"Por favor, preencha este campo."
            },
            score:{
                required:"Por favor, preencha este campo.",
                scoreLessThan:"Pontuação Máxima: 250 pontos",
                scoreGreaterThan:"Pontuação Mínima: 0 pontos",
            },
            member_type:{
                required:"Por favor, preencha este campo."
            }
        }
    });

    $('#rg').mask('00.000.000-00')
    $('#cpf').mask('000.000.000-00')
    $('#telephone').mask('(00)000000000')
    $('#birthdate').mask('00/00/0000')

    $('#img-membro').on('click',function(event) {
        $('#arquivo').click();
        $('#arquivo').one('change',function(e){
            var method = window.location.href.split('/');
            method.pop();
            method.push('savePicture');
            method = method.join('/');
            
            
            var files = e.target.files;
            var formData = new FormData();
            var file = [];
            
            formData.append('profile', $('input[type=file]')[0].files[0]);

            $.ajax({
                url:method,
                contentType:false,
                processData:false,
                data:formData,
                type:'POST',
                success:function(data){
                    $('#img-membro').css('background-image',"url('"+JSON.parse(data).path+"')");
                    $('#path_profile_picture').val(JSON.parse(data).path);
                }
            });
        });
    });

});