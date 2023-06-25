if (!RedactorPlugins) var RedactorPlugins = {};

(function($)
{
	RedactorPlugins.filemanager = function()
	{
		return {
			init: function()
			{
				if (!this.opts.fileManagerJson) return;

				this.modal.addCallback('file', this.filemanager.load);
			},
			load: function()
			{
				var $modal = this.modal.getModal();

				this.modal.createTabber($modal);
				this.modal.addTab(1, 'Upload', 'active');
				this.modal.addTab(2, 'Choose');

				$('#redactor-modal-file-upload-box').addClass('redactor-tab redactor-tab1');

				var $box = $('<div id="redactor-file-manager-box" style="overflow: auto; height: 300px;" class="redactor-tab redactor-tab2">').hide();
				$modal.append($box);


				$.ajax({
				  dataType: "json",
				  cache: false,
				  url: this.opts.fileManagerJson,
				  success: $.proxy(function(data)
					{
						var ul = $('<ul id="redactor-modal-list">');
						$.each(data, $.proxy(function(key, val)
						{
							var a = $('<a href="#" title="' + val.title + '" rel="' + val.link + '" class="redactor-file-manager-link"><span style="font-size: 13px; color: #777;">' + val.name + '</span> <span style="position: absolute; right: 35px; font-size: 11px; color: #888;">(' + val.size + ')</span></a>');
							var li = $('<li style="position:relative" />');
							var span = $('<span style="position:absolute;font-size: 15px;padding:4px 8px;top: 3px; right: 10px;color:rgb(242, 51, 51);cursor:pointer;font-weight:bold;" data-filepath="'+val.link+'">X</span>');
							a.on('click', $.proxy(this.filemanager.insert, this));
							span.on('click', $.proxy(this.filemanager.delete, this));
 
							li.append(a);
							li.append(span);
							ul.append(li);

						}, this));

						$('#redactor-file-manager-box').append(ul);


					}, this)
				});

			},
			insert: function(e)
			{
				e.preventDefault();

				var $target = $(e.target).closest('.redactor-file-manager-link');

				this.file.insert('<a href="' + $target.attr('rel') + '">' + $target.attr('title') + '</a>');
			},
			delete: function(e){

				var elm = $(e.target);

				var data =elm.data('filepath');
				
				data = JSON.stringify(data);


				if (confirm("Are sure you want to delete this file?") == true) {

					$.ajax({
						url: 	ajaxBasePath+"/cms/delete_file?_token="+window.csrfToken,
						type: 	"post",
						data: 	{ 'file_url' : data },
						success: function(data){
							elm.parent().fadeOut( "slow" ).remove();
						},
						error: function(data){
							console.log(data);
						}

					});

				}
			}
		};
	};
})(jQuery);