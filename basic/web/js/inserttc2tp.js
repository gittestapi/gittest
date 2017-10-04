$(function(){
	$('#inserttc2tp').click(function(e){
		e.preventDefault();
		var keys = $('#w0').yiiGridView('getSelectedRows');
		alert(keys);
		if (keys.length > 0) {
			var target = $(e.target);
			var url =target.attr('href');
			$.ajax({
				url: url,
				type: "POST",
				dataType : "json",
				data:{
					tcids:keys,
					tpid:target.data('tpid')
				}
			}).done(function(data){
				;
			});		
		}
	});	
})