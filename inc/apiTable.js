function tableShow(cls, url){
    var table = $(cls).DataTable({
        'destroy': true,										
        'ajax': url
    })    
}

