$(function(){
    $("button.markCompleted").click(function(e){
        e.preventDefault();
        var r = confirm('确定计划设计完成');
        if (r == true) {
            var target = $(e.target);
            var url = target.data('url');
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
        }
    })
})
