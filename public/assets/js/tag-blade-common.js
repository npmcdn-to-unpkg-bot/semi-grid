/**
 *    设置ajax请求头部信息，laravel验证token
 */
 $.ajaxSetup({
 	headers: {
 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 	}
 });

/**
 *    关闭修改标签页面按钮
 */
 $('.mask .close, .edit-panel .cancel-edit').click(function(){
 	$('.mask').animate({opacity:0}, function(){
 		$(this).css({display: ''});
 	});
 });

 /**
  *    提交编辑内容
  */
 $('.edit-panel .submit-edit').click(function() {
 	/**
	 *    匹配1-10个中文、数字、字母字符
	 *    不匹配则提示标签规则
	 */
	 if(!/^[\u4e00-\u9fa5\w]{1,10}$/.test($('.edit-panel input').val())) {
	 	$('.edit-panel .form-group').addClass('has-error');
	 	$('.edit-panel input').val('').attr('placeholder', "标签为1-10个中文、数字、字母");
	 	return;
	 }
	 /**
	 *    通过匹配规，继续发送ajax请求
	 *    参数：tag_name
	 *    回调函数：
	 *    	成功添加则刷新本页
	 *    	不成功则提示错误信息
	 *    	(一般不成功的原因是已经有此标签)
	 */
	 $.post("http://semi-grid.com/admin/blog/update-tag",
	 {
	 	'tag_name': $('.edit-panel input').val(),
	 	'id': $(this).attr('data-tag-id')
	 }, function(data) {
	 	if(data == 1) window.location.reload();
	 	else {
	 		$('.edit-panel').addClass('has-error');
	 		$('.edit-panel input').val('').attr('placeholder', data);
	 	}
	 });
 });

/**
 *    编辑标签按钮
 */
 $('.edit-tag').click(function(){
 	$('.mask').css({display: 'block'}).animate({opacity: 1});
 	$('.edit-panel input').val($(this).attr('data-tag-name')).focus();
 	$('.edit-panel .submit-edit').attr('data-tag-id', $(this).attr('data-tag-id'));
 });

/**
 *    添加标签按钮事件
 */
 $('.add-tag').click(function() {
	/**
	 *    匹配1-10个中文、数字、字母字符
	 *    不匹配则提示标签规则
	 */
	 if(!/^[\u4e00-\u9fa5\w]{1,10}$/.test($('.tag-name input').val())) {
	 	$('.tag-name').addClass('has-error');
	 	$('.tag-name input').val('').attr('placeholder', "标签为1-10个中文、数字、字母");
	 	return;
	 }

	/**
	 *    通过匹配规，继续发送ajax请求
	 *    参数：tag_name
	 *    回调函数：
	 *    	成功添加则刷新本页
	 *    	不成功则提示错误信息
	 *    	(一般不成功的原因是已经有此标签)
	 */
	 $.post("http://semi-grid.com/admin/blog/add-tag",
	 {
	 	'tag_name': $('.tag-name input').val()
	 }, function(data) {
	 	if(data.status == 1) window.location.reload();
	 	else {
	 		$('.tag-name').addClass('has-error');
	 		$('.tag-name input').val('').attr('placeholder', data.content);
	 	}
	 }, "json");
});

/**
 *    删除标签按钮事件
 *    参数：id
 *    回调：刷新页面
 */
 $('.del-tag').click(function() {
 	$.post("http://semi-grid.com/admin/blog/del-tag",
 	{
 		'id': $(this).attr('data-tagid')
 	}, function(data) {
 		window.location.reload();
 	});
 });

/**
 *    表格排序
 */
 $('.table').tablesorter();

/**
 *    表格查找
 */
 $('.tag-name input').keyup(function() {
 	var $val = $(this).val().toLowerCase();
 	/**
 	 *    对input的值进行简单索引，隐藏/显示对应表行
 	 */
 	$('.table tbody tr').each(function(index, elem) {
 		if($(elem).text().trim().toLowerCase().indexOf($val) < 0 )
 			$(elem).hide(100);
 		else $(elem).show(100);
 	});
 }).blur(function(){
 		/**
 		 *    input框失去焦点时显示所有行
 		 */
 		$('.table tbody tr').each(function(index, elem) {
	 		$(elem).show(100);
 		});
 	});