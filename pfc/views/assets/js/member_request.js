$(document).ready(function(){

    $('#img-file').on('click',function(event) {
        $('#arquivo').click();
        $('#arquivo').on('change',function(){
            var files = Array.from($('input[type=file]')[0].files);
            files.forEach(function(element,index){
                 addToList(files[index].name,index);
            });
            $('#alert').hide()
        });

        function addToList(filename,index){
            $('#filelist').append('<li class="list-group-item d-flex justify-content-between align-items-center">'
                                    +'<span>'+filename+'</span>'
                                    +'</li>')
        }
    });

    $("#form").validate({
        rules:{
            request_reason:{
                required:true
            }
        },
        messages:{
            request_reason:{
                required:"Campo Obrigatório"
            }
        }
    })

    $('#confirm').on('click',function(){
        if($("#form").valid() && Array.from($('input[type=file]')[0].files).length > 0){
            $('#form').submit();
        }else if(Array.from($('input[type=file]')[0].files).length == 0){
            $('#alert').show()
        }
    });
});