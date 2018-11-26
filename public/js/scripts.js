function init(){    
     $.ajax({      
        type: 'GET',
        url: baseUrl + '/permissoes/index/data',        
        dataType: "html",
        data:{},        
        success: function (data) {              
            $('#dataIntranet').html(data);
        }
    });         
}//init

$(function(){   
   setInterval(init,1000);//1000 = 1 segundo
   
   //Back to TOP
    if ( ($(window).height() + 100) < $(document).height() ) {
        $('#top-link-block').removeClass('hidden').affix({
            // how far to scroll down before link "slides" into view
            offset: {top:100}
        });
    }
});


