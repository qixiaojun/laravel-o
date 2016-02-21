$(function () {
	//登录弹窗
	$('#admin').dialog({
		title : '登录后台',
		width : 300,
		height : 180,
		iconCls : 'icon-reg',
		modal : true,
		buttons : '#btn',
	});

	//管理员帐号
	$('#manager').validatebox({
		required : true,
		missingMessage : '请输入管理员帐号',
		invalidMessage : '管理员帐号不得为空',
	});

	//管理员密码
	$('#password').validatebox({
		required : true,
		validType : 'length[6,40]',
		missingMessage : '请输入管理员密码',
		invalidMessage : '管理员密码在6-40位之间',
	});

	//加载后定位光标至输入框
	if (!$('#manager').validatebox('isValid')) {
		$('#manager').focus();
		// $('#manager').blur(function () {
		// 	$.ajax({
		// 		url : '/admin/store',
		// 		type : 'POST',
		// 		data : {
		// 			manager : $('#manager').val(),
		// 			password : $('#password').val(),
		// 		},
		// 		beforeSend : function () {
		// 			$.messager.progress({
		// 				text : '正在验证...',
		// 			});
		// 		},
		// 		success : function(data, response, status) {
		// 			$.messager.progress('close');
		// 			// $('#password').select();
		// 			// $('#manager').validatebox({
		// 			// 	validator: function(response){
		// 			//
		// 			// 	},
		// 			// 	invalidMessage : '管理员名称被占用',
		// 			// 	// validate(function () {
		// 			// 	// 	alert('msg');
		// 			// 	// })
		// 			// });
		// 		},
		// 		error : function(data, response, status) {
		// 			// alert(data.responseText);
		// 			$.messager.progress('close');
		// 			// var manager = JSON.parse(data.responseText).manager;
		// 			// var password = JSON.parse(data.responseText).password;
		// 			// $.messager.progress('close');
		// 			// location.href = '/admin/reg';
		// 			//return data.responseText;
		// 			// $('#manager').select();
		// 			// console.log(data.responseText);
		// 			// console.log(password);
		// 			// $('#manager').validatebox({
		// 			// 	$.extend($.fn.validatebox.defaults.rules, {
		// 			// 		unique: {
		// 			// 			validator: function(){
		// 			// 				return 123;
		// 			// 		},
		// 			// 			message: manager
		// 			// 		}
		// 			// 	});
		// 			// 	invalidMessage : manager,
		// 			// });
		// 			// console.log($('#manager').validatebox('validate'),function () {
		// 			// 	alert('msg');
		// 			//
		// 			// });
		// 		},
		// 	});
		// });
	} else if (!$('#password').validatebox('isValid')) {
		$('#password').focus();
	}


	//登录提交
	$('#btn a').click(function () {
		if (!$('#manager').validatebox('isValid')) {
			$('#manager').focus();
		} else if (!$('#password').validatebox('isValid')) {
			$('#password').focus();
		} else {
			$.ajax({
				url : '/admin',
				type : 'POST',
				data : {
					manager : $('#manager').val(),
					password : $('#password').val(),
				},
				beforeSend : function () {
					$.messager.progress({
						text : '正在注册...',
					});
				},
				success : function(data, response, status) {
					$.messager.progress('close');
					if (data > 0) {
						//location.href = '/admin/store';
					} else {
						 //location.href = '/admin/store';
						// $.messager.alert('注册失败！', '管理员帐号或密码不符合规则！', 'warning', function () {
						// 	$('#password').select();
						// });
					}
				}
			})
		}
	});
});
