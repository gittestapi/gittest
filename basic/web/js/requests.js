$(function(){
	// 申请加入项目
	$("a.apply").click(function(e){
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
				data: {repoid: target.data('repoid')}
			}).done(function(data){
				if (!data.success) {
					alert(data.message);
				} else {
					alert(data.message);
				}
			})
		}
	});

	// 邀请他人加入项目
	$("button.invite").click(function(e){
		var target = $(e.target);
		var url = target.data('url');
		var repoid = target.data('repoid');
		var role = target.data('role');
		var inputs = target.siblings('input');
		var uname = target.siblings('input').eq(0).val();
		$.ajax({
			url : url,
			type: "POST",
			dataType: "json",
			data: {
				repoid: repoid,
				role: role,
				uname: uname,
			}
		}).done(function(data){
			if(!data.success) {
				alert(data.message);
			} else {
				alert(data.message);
			}
		})
	});

	// 处理请求（申请加入项目或邀请某某进入项目）
	$(".approve").click(function(e){
		e.preventDefault();
		var target = $(e.target);
		var url = target.attr('href');

		var roles = target.data('roleoptions');
		var data = {
			rid: target.data('rid'),
			approved: target.data('approved'),
		};
		if (roles) { // 如果需要设置role
			roles = roles.split(',');
			do {
				var role = prompt("Please input role values:" + roles[0] + "," + roles[1],"E");
				var invalidValue = true;
				for(var i = 0; i< roles.length; i++) {
					if(roles[i].toUpperCase() == role.trim().toUpperCase()) {
						invalidValue = false;
						data.role = role.toUpperCase();
						break;
					}						
				}
			} while(invalidValue)
		}

		$.ajax({
			url: url,
			type: "POST",
			dataType : "json",
			data: data,
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
