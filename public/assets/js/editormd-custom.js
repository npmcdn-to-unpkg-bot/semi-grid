$(function(){
	$.ajaxSetup({
	 	headers: {
	 		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	 	}
	 });
	
	/**
	 *    editor.md配置文件
	 *    @type {Object}
	 */
	 var config = {
	 	height: 640,
	 	path : "/assets/bower/editor.md/lib/",
	 	syncScrolling : "single",
	 	emoji:true,
	 	tex  : true,
	 	flowChart : true,
	 	saveHTMLToTextarea: true,
	 	toolbarIcons : function() {
	 		return ["undo", "redo", "|", "preview", "watch", "fullscreen", "goto-line", "search", "|", "code",
	 		"code-block", "preformatted-text", "quote", "|", "datetime", "table", "image", "reference-link",
	 		"link", "emoji", "html-entities", "pagebreak", "|", "help", "||", "theme"];
	 	},
	 	toolbarIconsClass: {
	 		theme: "fa-gears"
	 	},
	 	lang : {
	 		toolbar : {
	 			theme: "设置( F1 )"
	 		}
	 	},
	 	toolbarHandlers : {
	 		theme: function() {
	 			this.createInfoDialog($('.setting-dialog'));
	 		}
	 	},
	 	onload : function() {
	 		var _this = this;
	 		this.addKeyMap({
	 			"Ctrl-S": function(cm) {
	 				return false;
	 			},
	 			"F1": function() {
	 				_this.createInfoDialog($('.setting-dialog'));
	 				return false;
	 			}
	 		});
	 	},
	 	onfullscreen: function() {
	 		$('#editormd').css({zIndex: 800});
	 	},
	 	onfullscreenExit: function() {
	 		$('#editormd').css({zIndex: 'initial'});
	 	},
	 	imageUpload    : true,
	 	imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
	 	imageUploadURL : "http://semi-grid.com/admin/blog/upload-image"
	 }
	 var editor = editormd("editormd", config);

	/**
	 *    按键事件监听
	 */
	 document.onkeydown = function(ev) {
		//ctrl + s, F1两键取消默认设置
		if(ev.ctrlKey && ev.keyCode == 83 || ev.keyCode == 112)
			return false;
	}

	/**
	 *    Editor.md设置
	 */
	 $('.editormd-dialog-container input').iCheck({
	 	labelHover: false,
	 	cursor: true,
	 	checkboxClass: 'icheckbox_square-grey',
	 	radioClass: 'iradio_square-grey',
	 	increaseArea: '20%'
	 }).on('ifChecked', function(event){
	 	switch($(this).attr('name')) {
	 		case "code":
	 		editor.setEditorTheme($(this).val());
	 		break;
	 		case "preview":
	 		editor.setPreviewTheme($(this).val());
	 		break;
	 		case "toolbar_theme":
	 		editor.setTheme($(this).val());
	 		break;
	 		case "toolbar_fixed":
	 		editor.setToolbarAutoFixed(false);
	 		break;
	 		case "toolbar_display":
	 		editor.hideToolbar();
	 		break;
	 		default: break;
	 	}
	 }).on('ifUnchecked', function(event) {
	 	switch($(this).attr('name')) {
	 		case "toolbar_fixed":
	 		editor.setToolbarAutoFixed(true);
	 		break;
	 		case "toolbar_display":
	 		editor.showToolbar();
	 		break;
	 		default: break;
	 	}
	 });

	/**
	 *    发表文章
	 */
	 $('.publish-btn').click(function() {
	 	var $_this = $(this);
	 	var $tagList = [];
	 	$('.tag-list .tag-item').each(function(index, elem){
	 		$tagList.push(parseInt($(elem).attr('data-tag-id')));
	 	});
	 	$.post("http://semi-grid.com/admin/blog/store-article",
	 	{
	 		'store': $('.edit-box input[name="store"]').val(),
	 		'id': $('.edit-box input[name="id"]').val(),
	 		'title': $('.edit-box .title').val(),
	 		'tags': $tagList,
	 		'content': $('#editormd textarea').val()
	 	}, function(data) {
	 		console.log(data);
	 		if(data.status == 1) {
	 			var $msgContent = "文章内容已保存"
	 			$('.edit-box input[name="id"]').val(data.content.id);
	 			$('.edit-box input[name="store"]').val('update');
	 			$_this.text("保存文章");
	 			$('.message-box').removeClass('alert-danger');
	 		} else {
	 			$msgContent = "有一些错误需要你修正<ul>";
	 			for(var error in data.content) {
	 				$msgContent += "<li>"+data.content[error] + "</li>";
	 			}
	 			$msgContent+="</ul>";
	 			$('.message-box').addClass('alert-danger');
	 		}
	 		$('.message-content').html($msgContent);
	 		$('.message-box').show(200).delay(3000).hide(200);
	 	}, "json");
	 });

	/**
	 *    处理标签选择器
	 *    @method showTagSelect
	 *    @return {[type]}      返回jquery对象
	 */
	 function showTagSelect() {
	 	$('.tag-select .tag-select-item').each(function(index, elem){
	 		var $val = $('.add-tag').val().toLowerCase();
	 		if($(elem).attr('data-tag-name').toLowerCase().indexOf($val) < 0 ||
	 			$('.tag-list .tag-item[data-tag-id="'+$(elem).attr('data-tag-id')+'"]').index() >= 0)
	 			$(elem).hide(100);
	 		else	$(elem).show(100);
	 	});
	 	return $('.tag-select').css({top: $('.add-tag').offset().top+25, left: $('.add-tag').offset().left});
	 }

	/**
	 *    添加标签按钮事件
	 */
	 $('.add-tag-btn').click(function(){
		/**
		 *    点击添加标签按钮后显示/隐藏输入框 输入框获得焦点，值为空
		 *    显示/隐藏 标签选择器
		 */
		 $('.add-tag').toggle(100).focus().val('').attr('placeholder', '1-10个中文数字字母');
		 showTagSelect().toggle();
	});

	 function addTag(tagName, tagId) {
	 	$html = "<li class=\"tag-item\" data-tag-id=\""+tagId+
	 	"\">"+tagName+" <i class=\"remove-tag\">&times;</i></li>";
	 	$('.tag-list').append($html);
	 	$('.add-tag').hide(100);
	 	$('.tag-select').hide(250);
	 }

	 $('.add-tag').keyup(function(event){
	 	showTagSelect().show();
	 	/**
		 *    输入框按键事件，当按下回车键，并且输入框的值符合正则时添加标签
		 */
		 var $_this = $(this);
		 if(event.which == 13 && /^[\u4e00-\u9fa5\w]{1,10}$/.test($_this.val())) {
		 	var $hasTag = false;
		 	var $addedTag = false;
		 	var $tagId;
			/**
			 *    1.判断是否已存在输入的标签
			 *    	有：判断输入的标签是否已添加
			 *    		是：清空
			 *    		否：添加此标签，将此标签对应的选择器隐藏
			 *    	无：post请求新建标签，返回id并添加此标签
			 */
			 $('.tag-select .tag-select-item').each(function(index, elem){
			 	if($(elem).attr('data-tag-name') == $_this.val()) {
			 		$hasTag = true;
			 		$tagId = $(elem).attr('data-tag-id');
			 		return;
			 	}
			 });
			 if($hasTag) {
			 	$('.tag-list .tag-item').each(function(index, elem){
			 		if($(elem).attr('data-tag-id') == $tagId) {
			 			$addedTag = true;
			 			return;
			 		}
			 	});
			 	if($addedTag)
			 		$_this.val('').attr('placeholder', "This tag already exists");
			 	else {
			 		addTag($_this.val(), $tagId);
			 		$('.tag-select-item[data-tag-id="'+$tagId+'"]').addClass('hide');
			 	}
			 } else {
			 	$.post("http://semi-grid.com/admin/blog/add-tag",
			 	{
			 		'tag_name': $_this.val()
			 	}, function(data) {
			 		if(data.status == 1) {
			 			addTag(data.content.tag_name, data.content.id);
			 			var $html = ""+
			 			"<li class=\"tag-select-item hide\" data-tag-name=\""+
			 			""+data.content.tag_name+"\""+
			 			" data-tag-id=\""+data.content.id+"\">"+
			 			"<i class=\"fa fa-tag fa-fw\"></i> "+data.content.tag_name+"</li>";
			 			$('.tag-select').append($html);
			 		} else {
			 			$_this.val('').attr('placeholder', data.content);
			 		}
			 	}, "json");
			 }
		}
	});

	 /**
	  *    标签选择器点击事件
	  */
	  $('.tag-select').delegate('.tag-select-item', 'click', function() {
	  	addTag($(this).attr('data-tag-name'), $(this).attr('data-tag-id'));
	  });

	/**
	 *    删除标签
	 */
	 $('.tag-list').delegate(".tag-item .remove-tag", "click", function(){
	 	$(this).parent().remove();
	 	showTagSelect();
	 });
});