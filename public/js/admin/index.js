var abc = jQuery.noConflict();
abc(function () {

	abc('#nav').tree({
		url : '/admin/nav',
		lines : true,
		onLoadSuccess : function (node, data) {
			var _this = this;
			if (data) {
				abc(data).each(function () {
					if (this.state == 'closed') {
						abc(_this).tree('expandAll');
					}
				})
			} else {
				abc('#nav').tree('remove', node.target);
			}
		},
		onClick : function (node) {
			if (node.url) {
				if (abc('#tabs').tabs('exists', node.text)) {
					abc('#tabs').tabs('select', node.text)
				} else {
					abc('#tabs').tabs('add', {
						title : node.text,
						closable : true,
						// iconCls : node.iconCls,
						href : '/' + node.url,
					});

				}
			}
		},
	});

	abc('#tabs').tabs({
		// fit : true,
		border : false,
	});

});
