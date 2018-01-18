$(document).ready(function(){
    $('.img-membro').on('click',function(event) {
        let cpf = $(this).attr('cpf')

        var method = window.location.href.split('/');
        method.pop();
        method.push('selectMemberHistory');
        method = method.join('/');
        
        var formData = new FormData();
        formData.append('cpf', cpf);

        $.ajax({
            url:method,
            contentType:false,
            processData:false,
            data:formData,
            type:'POST',
            success:function(data){
                member = JSON.parse(data)[0];
                member_history = JSON.parse(data)[1];
                member_request = JSON.parse(data)[2];


                $('#name').text(member.name);
                $('#personal_email').text(member.personal_email);
                $('#professional_email').text(member.professional_email);
                $('#birthdate').text(member.birthdate);
                $('#telephone').text(member.telephone);                
                $('#marital_status').text(getMaritalStatus(member.marital_status));
                $('#member_type').text(getMemberType(member.member_type));
                $('#score').text(member.score);
                
                
                
                $('#withdrawal-name').text(member.name);
                $('#withdrawal-cpf').val(cpf);
                $('#exclude-name').text(member.name);
                $('#exclude-cpf').val(cpf);
                $('#moved-score').text(member.score);
                
                $('#history-body').empty();
                $('#request-body').empty();

                member_history.forEach(function(element) {
                    addToHistoryList(element);
                });

                member_request.forEach(function(element){
                    addToRequestList(element);
                });

                $('.btn-request').click(function(event){
                    console.log('oi')
                    let request_id = $(this).attr('request_id');
                    var link = window.location.href.split('/');
                    link.pop();
                    link.push('response/'+request_id);
                    link = link.join('/');
                    window.location.href = link;
                });
                
                $('.badge-request').text(member_request.length);
            }
        });
    });


    function getMaritalStatus(marital_status){
        if(marital_status == "single"){
            return "Solteiro"
        }else if(marital_status == "married"){
            return "Casado"
        }else if(marital_status == "widower"){
            return "Viúvo"
        }else if(marital_status == "divorced"){
            return "Divorciado"
        }
    }

    function getMemberType(member_type){
        $('#desligar_membro').show();
        if(member_type == "director"){
            return "Diretor"
        }else if(member_type == "member"){
            return "Membro"
        }else if(member_type == "trainee"){
            return "Trainee"
        }else if(member_type == "admin"){
            $('#desligar_membro').hide();
            return "Empresa"
        }
    }
    function getStatus(status){
        if(status == "opened"){
            return "Aberto"
        }else if(status == "accepted"){
            return "Aprovado"
        }else if(status == "rejected"){
            return "Rejeitado"
        }
    }
    function getBalance(action,value){
        if(action == "gain"){
            return "<td class='text-success'>"+value+" pontos</td>"
        }else{
            return "<td class='text-danger'>"+value+" pontos</td>"
        }
    }

    function addToHistoryList(element){
        $('#history-body').append(
            "<tr>"
            +"<td>"+element.reason+"</td>"
            +"<td>"+element.date+"</td>"
            +getBalance(element.action,element.value)
            +"</tr>"
        )
    }

    function addToRequestList(element){
        $('#request-body').append(
            "<tr>"
            +"<td>"+element.reason+"</td>"
            +"<td>"+getStatus(element.status)+"</td>"
            +"<td>"
            +   "<button type='button' class='btn btn-success btn-request' id='btn_request' request_id='"+element.request_id+"'>"
            +       "Ver Solicitação"
            +   "</button>"
            +"</td>"
            +"</tr>"
        )
    }

    if($('.img-membro').length > 0){
        ($('.img-membro')[0]).click(); //Execute on start
    }

    $('#desligar_membro').on('click', function(event) {
        $('#member_data').hide();
        $('#exclude_member').css({display:'inline-block'}).addClass('animated slideInLeft'); 
    });
    
    $('#voltar-exclude').on('click', function(event) {
        $('#exclude_member').hide();
        $('#member_data').css({display:'inline-block'}).addClass('animated slideInRight'); 
    });

    $('#confirm_exclude').on('click',function(){
        let cpf = $('#exclude-cpf').val();
        let admin_password = $('#password').val();
        console.log('oi');
        var method = window.location.href.split('/');
        method.pop();
        method.push('removeMember');
        method = method.join('/');

        $.post(
            method,
            {
                member_cpf:cpf,
                password_director:admin_password
            },
            function(data){
                data = JSON.parse(data);
                if(data.success){
                    window.location.reload();
                }else{
                    $('#response').text(data.message);
                }
            }
        );
    });
    

    $('#history-link').on('click',function(){
        $('#request').hide();
        $('#request-link').removeClass('active');
        $('#history-link').addClass('active');
        $('#history').show();
    });

    $('#request-link').on('click',function(){
        $('#history').hide();
        $('#history-link').removeClass('active');
        $('#request-link').addClass('active');
        $('#request').show();
    });

    $.validator.setDefaults({
        errorClass:"col-9 text-danger float-right"
    });

    $.validator.addMethod("scoreLessThan", function( value) {
        var target = 250;
        return value <= target;
    }, "Pontuação Máxima: 250." );

    $.validator.addMethod("scoreGreaterThan", function( value) {
        var target = 0;
        return value >= target;
    }, "Pontuação Mínima: 0." );

    $('#form').validate({
        rules:{
            reason:{
                required:true
            },
            value_required:{
                required:true,
                scoreGreaterThan:true,
                scoreLessThan:true
            }
        },
        messages:{
            reason:{
                required:"Campo Obrigatório"
            },
            value_required:{
                required:"Campo Obrigatório",
                scoreGreaterThan:"Pontuação Mínima: 0.",
                scoreLessThan:"Pontuação Máxima: 250."
            }
        },
        unhighlight:function(element){
            $(element).removeClass('text-danger')
        }     
    });
});
