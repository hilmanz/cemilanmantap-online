// Start select2 Categories

    var base_url = window.location.origin;
	$('.roles-select').select2({
	placeholder: "Choose Category...",
	ajax: {
		url: base_url+'/backadmin/roles-select2',
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