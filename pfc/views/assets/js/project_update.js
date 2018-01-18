$(document).ready(function(){

    $('#team-link').on('click',function(){
        $('#payment').hide();
        $('#payment-link').removeClass('active');
        $('#status').hide();
        $('#status-link').removeClass('active');
        $('#team-link').addClass('active');
        $('#team').show();
    });

    $('#payment-link').on('click',function(){
        $('#team').hide();
        $('#team-link').removeClass('active');
        $('#status').hide();
        $('#status-link').removeClass('active');
        $('#payment-link').addClass('active');
        $('#payment').show();
    });

    $('#status-link').on('click',function(){
        $('#team').hide();
        $('#team-link').removeClass('active');
        $('#payment').hide();
        $('#payment-link').removeClass('active');
        $('#status-link').addClass('active');
        $('#status').show();
    });

    $('#finish_project').on('click',function(){
        $('#confirmation').addClass('animated slideInUp')
        $('#confirmation').show();
    });

    $('#confirm_finish').on('click',function(){
        var method = window.location.href.split('/');
        method.pop();
        method.pop();
        method.push('finish');
        method = method.join('/');

        $.post(
            method,
            {
                'project_id':window.location.href.slice(-1),
                'password':$('#password').val()
            },
            function(data){
                if(JSON.parse(data).success){
                    window.location.reload();
                }else{
                    $('#alert-status').text(JSON.parse(data).cause);
                    $('#alert-status').show();
                }
            }
        )
    });

    $('#member_search').on('keyup',function(){
        $('#vendor-alert').hide();
        searchMember($('#member_search').val());
    });

    //Save payment data on server
    $('#confirm_payment').on('click',function(){
        var method = window.location.href.split('/');
        method.pop();
        method.pop();
        method.push('paymentCheckout');
        method = method.join('/');
        
        $.post(
            method,
            {
                'project_id':window.location.href.slice(-1),
                'value':$('#payment_receive').val()
            },
            function(data){
                $('#debit').text(JSON.parse(data)[0]);
                refreshList(JSON.parse(data)[1]);
            }
        );
    });
    
    //Refresh the payment list
    function refreshList(data){
        $('#payment-body').empty();

        data.forEach(function(element){
            $('#payment-body').append("<tr>"
                                        +"<td>"+element.date+"</td>"
                                        +"<td>"+element.value+"</td>"
                                        +"<td>"+element.receptor+"</td>"
                                     +"</tr>");
        });
        
    }

    //Search members in server
    function searchMember(name){
        //Get the url
        var method = window.location.href.split('/');
        method.pop();
        method.pop();
        method.push('searchMember');
        method = method.join('/');
        
        //Send request
        $.post(
            method,
            {
                'filter':name,
                'project_id':window.location.href.slice(-1)
            },function(data){
                createList(JSON.parse(data));
            }
        );
    }

    //Show the list with search results
    function createList(data){
        $("#member_list").empty();
        data.forEach(function(element){
            if(element.member_type != "admin"){
                $("#member_list").show()
                $("#member_list").append(
                    '<li class="list-group-item d-flex justify-content-between align-items-center">'
                    +'	<span>'+element.name+'</span>'
                    +'  <div class="float-right">'
                    +       concatOptions(element)
                    +'  </div>'
                    +'</li>'
                );
            }
        });
    }

    function concatOptions(element){
        var options = '<button class="btn btn-primary btn-add_vendor" onclick="add_vendor(\''+element.cpf+'\')" member_id="'+element.cpf+'">'
                        +'Vendedor'
                    +'</button>'
                    +'<button class="btn btn-primary btn-add_member" onclick="add_member(\''+element.cpf+'\')" member_id="'+element.cpf+'">'
                        +'Membro'
                    +'</button>'
        return options;
        
    }
});

//Send a request to server and associate a vendor in project
window.add_vendor = function(vendor_id){
    //Get the url
    var method = window.location.href.split('/');
    method.pop();
    method.pop();
    method.push('associateMember');
    method = method.join('/');

    //Send request
    $.post(
        method,
        {
            'member_id':vendor_id,
            'role':"vendor",
            'project_id':window.location.href.slice(-1)
        },
        function(data){
            $("#member_list").empty()
            $("#member_list").hide()
            var response = JSON.parse(data)
            
            if(response.success){
                response.data.forEach(function(element) {
                    vendor = element.cpf;
                    $("#team-body").append(
                        '<tr>'
                        +'	<td>'+element.name+'</td>'
                        +'	<td> Vendedor </td>'
                        +'	<td>'
                        +'      <button class="btn btn-danger" onclick="remove(this)" member_id="'+element.cpf+'" member_role="vendor">'
                        +'          Remover'
                        +'      </button>'
                        +   '</td>'
                        +'</tr>'
                    );
                })
            }else{
                $('#vendor-alert').text(response.cause);
                $('#vendor-alert').show();
                
            }
        }
    );
};

//Send a request to server and associate a member in project
window.add_member = function(member_id){
    //Get the url
    var method = window.location.href.split('/');
    method.pop();
    method.pop();
    method.push('associateMember');
    method = method.join('/');
    
    //Send request
    $.post(
        method,
        {
            'member_id':member_id,
            'role':"member",
            'project_id':window.location.href.slice(-1)
        },
        function(data){
            $("#member_list").empty()
            $("#member_list").hide()
            var response = JSON.parse(data)
            if(response.success){
                response.data.forEach(function(element) {
                $("#team-body").append(
                    '<tr>'
                    +'	<td>'+element.name+'</td>'
                    +'	<td> Membro </td>'
                    +'	<td>'
                    +'      <button class="btn btn-danger" onclick="remove(this)" member_id="'+element.cpf+'" member_role="member">'
                    +'          Remover'
                    +'      </button>'
                    +   '</td>'
                    +'</tr>'
                );
            });
            }
            
        }
    )
};

//Send a request to server and disassociate a member in project
window.remove = function(member){
    var clickedButton = $(member);
    member_id = $(member).attr('member_id');
    member_role = $(member).attr('member_role');
    
    var method = window.location.href.split('/');
    method.pop();
    method.pop();
    method.push('disassociateMember');
    method = method.join('/');
    
    $.post(
        method,
        {
            'member_id':member_id,
            'role':member_role,
            'project_id':window.location.href.slice(-1)
        },
        function(data){
            $("#member_list").empty()
            $("#member_list").hide()
            if(JSON.parse(data)){
                clickedButton.parent().parent().remove();
            }
        }
    );
}
