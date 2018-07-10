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