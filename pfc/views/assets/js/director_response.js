$(document).ready(function(){
    
    $.validator.setDefaults({
        errorClass:"text-danger"
    });
    
    $('#form').validate({
        rules:{
            value_required:{
                required:true,
                number:true
            }
        },
        messages:{
            value_required:{
                required:"Por favor, preencha este campo.",
                number:"Insira um número válido"
            }
        }
    });

    $('#value_required').on('keyup blur',function(){
        if($('#form').valid()){
            $('#confirm').attr('disabled',false);
        }else{
            $('#confirm').attr('disabled','disabled');
        }
    });   
});

