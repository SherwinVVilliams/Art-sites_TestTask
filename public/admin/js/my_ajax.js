$(document).ready(function(){

		$('#image').on('change', function(e){
			var $input = $("#image");
    		var fd = new FormData;

    		fd.append('img', $input.prop('files')[0]);

			$.ajax({
				url: '/admin/table/articles/async',
				data: fd,
				type: 'POST',
				datatype: "json",
        		processData: false,
        		contentType: false,
				headers: { "X-CSRF-TOKEN" : $("meta[name='csrf-token']").attr('content')},
				success: function(resp){
					console.log(resp);
					$('#image-mini_attr').attr('src', resp.mini);
					$('#image-max_attr').attr('src', resp.max);
					$('#image-path_attr').attr('src', resp.path);
				},
				/*error: function(resp){
					console.log(resp);
					alert(resp);
					$('#image-mini_attr').attr('src', resp.mini);
					$('#image-max_attr').attr('src', resp.max);
					$('#image-path_attr').attr('src', resp.path);
				}*/
			});

		});

});