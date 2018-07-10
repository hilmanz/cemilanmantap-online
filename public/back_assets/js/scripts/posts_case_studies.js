// Start Pagination Ajax
$(window).on('hashchange', function() {
	if (window.location.hash) {
		var page = window.location.hash.replace('#', '');
		if (page == Number.NaN || page <= 0) {
			return false;
		}else{
			getData(page);
		} 
	}
});
// Paginate Ajax
$(document).ready(function(){
	$(document).on('click', '.ajax .pagination a',function(event){
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		getData(page);
	});
});
jQuery(function(){
var delay = (function(){
	var timer = 0;
return function(callback, ms){
	clearTimeout (timer);
	timer = setTimeout(callback, ms);
};
})();
$('#search_keyword').keyup(function() {
	var keyword = $(this).val();
	delay(function(){
		getData(undefined,keyword);
	}, 800 );
});
});
// Paginate Ajax
function getData(page,keyword){
    var base_url = window.location.origin;
		$('#imagesList').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/modal-media",
				data: {
				_token  : CSRF_TOKEN,
				q 		: keyword,
			},
			success: function(html){
				$('#imagesList').html(html);
			}
			});
			return false;
		}else{
			$.ajax({
				url: base_url+"/backadmin/modal-media?page=" + page,
				type: "get",
				datatype: "html",
			}).done(function(data){
				$("#imagesList").empty().html(data);
				location.hash = page;
			}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
			});
		}
	}
function getEditcase(id){
    var base_url = window.location.origin;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/posts/"+id+"/edit",
			data: {
			_token: CSRF_TOKEN,
			id :id,
			section:'case-studies'
		},
		success: function(html){
			$('#get-data-case').html(html);
		}
		});
		return false;
	}
$(document).ready(function() {
	$('#add-case').on('click', function(){
		$('#modal-add-case').modal('show');
	});
	$('.edit-case').on('click', function(){
		var id = $(this).data('id');
		$('#modal-edit-case').modal('show');
		getEditcase(id);
	});
	$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		getData();
	});

	// Submit Action
	var progressbar     = $('.progress-bar');
	$(".submit-case").click(function(){
		$('#' + 'add_post').html( tinymce.get('add_post').getContent() );
		$(".submit-case").prop("disabled", true).css("cursor", 'not-allowed');
		$(".loading-button").css("display", 'inline-block');
			$("#form-add-case").ajaxForm(
				{
					target: '.preview',
					beforeSend: function() {
						$(".progress").css("display","block");
						progressbar.width('0%');
						progressbar.text('0%');
				},
				uploadProgress: function (event, position, total, percentComplete) {
				progressbar.width(percentComplete + '%');
				progressbar.text(percentComplete + '%');
				},
				success: function(data) {
					if(data.status == 'success'){
						$('.mess').removeClass('alert alert-danger');
						$('.mess').addClass('alert alert-success');
						$('.mess').html(data.message);
						$(".submit-case").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
						location.reload();
					}else{
						var errorString = '';
						$.each( data.message, function( key, value) {
							errorString += '<li>' + value + '</li>';
						});
						$('.mess').removeClass('alert alert-success');
						$('.mess').addClass('alert alert-danger');
						$('.mess').html(errorString);
						$(".submit-case").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
				}
				})
			.submit();
	});
	$('.modal').on("hidden.bs.modal", function (e) {
		if($('.modal:visible').length){
			$('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
			$('body').addClass('modal-open');
		}
		}).on("show.bs.modal", function (e) {
		if($('.modal:visible').length){
			$('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
			$(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
		}else{
			$('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
			$(".modal .modal-dialog").css('z-index', 99999);
		}
	});
});
$(document).on("click", ".button-delete", function() {
	var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-posts').attr('action',base_url + '/backadmin/posts/' + id);
	if (box.length > 0) {
		box.toggleClass("open");
		var sound = box.data("sound");
	if (sound === 'alert')
		playAudio('alert');
	if (sound === 'fail')
		playAudio('fail');
	}
	return false;
});
// Start select2 Categories
var base_url = window.location.origin;
$('.categories-select').select2({
	placeholder: "Choose Category...",
	ajax: {
		url: base_url+'/backadmin/categories-select2',
		dataType: 'json',
		type: "GET",
		quietMillis: 50,
		allowClear: true,
		data: function (params) {
			return {
				q: $.trim(params.term)
			};
		},
		processResults: function (data) {
			var myResults = [];
			$.each(data, function (index, category) {
				myResults.push({
					'id': category.id,
					'text': category.name
				});
			});
			return {
				results: myResults
			};
		},
		cache: true
	}
});
// End Select 2 Categories
$(document).ready(function() {
 var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
     plugins: [
      "advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
});
