$(document).ready(function(){
    var parcel = [];

    $.validator.setDefaults({
        errorClass:"text-danger"
    });

    $('#form').validate({
        rules:{
            project_title:{
                required:true
            },
            client_name:{
                required:true
            },
            professional_email:{
                email:true,
                required:true
            },
            project_duration:{
                required:true,
            },
            price:{
                required:true,
                number:true
            }
        },
        messages:{
            project_title:{
                required:"Por favor, preencha este campo."
            },
            client_name:{
                required:"Por favor, preencha este campo."
            },
            professional_email:{
                required:"Por favor, preencha este campo."
            },
            project_duration:{
                required:"Por favor, preencha este campo."
            },
            price:{
                required:"Por favor, preencha este campo.",
                number:"Insira um número válido"
            }
        }
    });

    $('#confirm').on('click',function(event) {
        if($('#form').valid()){
            $('.form-group').submit();
        }
    }); 
    
});