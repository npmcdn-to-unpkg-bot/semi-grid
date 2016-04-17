$(function(){
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
			return ["undo", "redo", "|", "preview", "watch", "fullscreen", "goto-line", "search", "|", "code","code-block", "preformatted-text", "quote", "|", "datetime", "table", "image", "reference-link", "link", "emoji", "html-entities", "pagebreak", "|", "help", "||", "theme"];
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
				"Ctrl-S": function() {
					return false;
				},
				"F1": function() {
					_this.createInfoDialog($('.setting-dialog'));
					return false;
				}
			});
		},
		imageUpload    : true,
		imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
		imageUploadURL : "http://semi-grid.com/admin/blog/uploadimage"
	}
	var editor = editormd("editormd", config);

	/**
	 *    按键事件监听
	 *    @method onkeydown
	 *    @param  {[type]}  ev [description]
	 *    @return {[type]}     [description]
	 */
	document.onkeydown = function(ev) {
		//ctrl + s, F1两键取消默认设置
		if(ev.ctrlKey && ev.keyCode == 83 || ev.keyCode == 112)
			return false;
	}

	/**
	 *    Editor.md设置
	 *    @method
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
})