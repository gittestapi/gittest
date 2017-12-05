$(function(){
    $("a.dtc").click(function(e){
        e.preventDefault();
        var target = $(e.target);
        var url =target.attr('href');
        $.ajax({
            url: url,
            type: "POST",
            dataType : "json",
        }).done(function(data){
            if(data.success) {
                location.reload();
            } else {
                alert(data.message);
            }
        });
    })
})
