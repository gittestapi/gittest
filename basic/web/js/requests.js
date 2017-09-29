$(function(){
	// 申请加入项目
	$("#apply").click(function(e){
		e.preventDefault();
		var target = $(e.target);
		var url = target.attr('href');
		var isGuest = target.data('guest') ? true : false;
		if (isGuest) {
			alert('Please login');
		} else {
			$.ajax({
				url: url,
				type: "POST",
				dataType : "json",
			}).done(function(data){
				if (!data.success) {
					alert(data.message);
				}
			})
		}
	});

	// 处理请求（申请加入项目或邀请某某进入项目）
	$(".approve").click(function(e){
		e.preventDefault();
		var target = $(e.target);
		var url = target.attr('href');

		var roles = target.data('roleoptions');
		if (roles) { // 如果需要设置role
			roles = roles.split(',');
			do {
				var role = prompt("Please input role values:" + roles[0] + "," + roles[1],"E");
				var invalidValue = true;
				for(var i = 0; i< roles.length; i++) {
					if(roles[i].toUpperCase() == role.trim().toUpperCase()) {
						invalidValue = false;
						url = url + '&role=' + role.toUpperCase(); // 将 role 的值添加到 url 中
						break;
					}						
				}
			} while(invalidValue)
		}

		$.ajax({
			url: url,
			type: "POST",
			dataType : "json",
		}).done(function(data){
			if(data.success) {
				// 刷新页面
				location.reload();
			} else {
				alert(data.message);
			}
		});

	})
});
