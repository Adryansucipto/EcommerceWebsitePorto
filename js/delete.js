$(document).ready(function(){
    $('#deletebtn').on('click',function(){  
        $.get('ajax/deleteitem.php?keyword='+$('#deletebtn').val(),function(data){
            $('.checkOutPage #tableCheckOut #content').html(data);
        })
    })
});