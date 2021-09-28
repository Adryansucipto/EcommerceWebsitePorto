$(document).ready(function(){
    //hilangkan tombol cari
    //buat event ketika keyword ditulis
    $('#keyword').on('keyup',function(){   
        //ajax menggunakan load

        $.get('ajax/pagebrand2.php?keyword='+$('#keyword').val(),function(data){
            $('.latest .productperbrand .rows').html(data);
        })
    })

});
