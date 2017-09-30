$(function(){
	// 申请加入项目
	$("#apply").click(function(e){
		e.preventDefault();
		var target = $(e.target);
		var url = target.attr('href');
		var isGuest = target.data('guest') ? true : false;
		if (isGuest) {
			alert('Please login first!');
		} else {
			$.ajax({
				url: url,
				type: "POST",
				dataType : "json",
			}).done(function(data){
				if (!data.success) {
					alert(data.message);
				}
				else
				{
					alert('Submit successfully!');
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
				var role = '';
				bootbox.prompt({
					title: "Please select the role for the user!",
					inputType: 'select',
					inputOptions: [
						{
							text: 'Make it as Test Manager',
							value: 'M',
						},
						{
							text: 'Make it as Tester',
							value: 'E',
						}
					],
					callback: function (result) {
						role = result;
						for(var i = 0; i< roles.length; i++) {
							if(roles[i].toUpperCase() == String(role).trim().toUpperCase()) {
								url = url + '&role=' + role.toUpperCase(); // 将 role 的值添加到 url 中
							}
						}
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
				});
				
		}

	})
});
