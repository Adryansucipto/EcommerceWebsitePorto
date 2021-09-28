$(document).ready(function(){
    //hilangkan tombol cari
    //buat event ketika keyword ditulis
    $('#keyword').on('keyup',function(){   
        //ajax menggunakan load
        // $('#container').load('ajax/mahasiswa.php?keyword='+$('#keyword').val());
        $.get('ajax/page.php?keyword='+$('#keyword').val(),function(data){
            $('.latest .miniContainer .rows').html(data);
        })
    })

});
