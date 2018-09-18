
	<div class = 'container' >
		<h1> Article Create </h1>
		<br>
		<form id = 'create_form' method = 'post' action = " {{ route('admin.articles.store') }} " enctype="multipart/form-data" class = 'contact-form' >
			<div class = 'form-group'>
				@if($locales)
				<label for = 'sel1'>Pick Language</label>
			    <select class="form-control" id="sel1" name = 'language'>
			        @for($i = 0; $i < count($locales); $i++)
						@if($i == 0)
							<option selected value = "{{ $locales[$i] }}">{{ $locales[$i] }}</option>
							@continue
						@endif
						<option value = "{{ $locales[$i] }}">{{ $locales[$i] }}</option>
					@endfor
				</select>
					
				@endif
				<br>
			</div>

			{{ csrf_field() }}
			<div class="form-group">
	            	<div class="form-label-group">
	              		<input type="text" id="firstName" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title" value="{{ old('title') }}" required autofocus>
	              		<label for="firstName">Title</label>
	            	</div>
			</div>
			<div class = 'form-group'>
					<label for="lastName">Description</label>
	              	<textarea id="summernote_desc" class="form-control" placeholder="description" name = 'description' >{{ old('description') }}</textarea>

	        </div>
	        <div class = 'form-group'>
	        	
						<label for="lastName">Text</label>
						<br>
	              		<textarea id = 'summernote_text' name = 'text' class = 'form-control'>{{ old('text') }}</textarea>
	              		
	        </div>
	        <div class = 'form-group'>

	        			<img src = "\site\img\articles\no-image-path.jpg" id = 'image-path_attr' width = '525'>
	        			<img src = "\site\img\articles\no-image-max.jpg" id = 'image-max_attr' width = '245'>
	        			<img src = "\site\img\articles\no-image-mini.jpg" id = 'image-mini_attr' width = '70'>
	        			<br>
	        			<br>
	              		<input type="file" id="image" placeholder="Last name" name = 'image' value="{{ old('image') }}" >

	        </div>

	        <div class = 'form-group'>
				<p>Categories</p>
				<table class = 'table table-striped'>
					<tbody>
						@foreach($categories as $category)
							<tr>
								<td>{{ $category->name }}</td>
								<td><input type="checkbox" name = "categories[]" value="{{ $category->id }}"> </td>
							</tr>
						@endforeach
					</tbody>
				</table>
	        </div>

	        <div class = 'form-group'>
	        	<button type = 'submit' id = 'submit-btn' class = 'btn-success'>Create</button>
	        </div>
	    </form>
	    <script>
	    $(document).ready(function() {
	        $('#summernote_desc').summernote();
	        $('#summernote_text').summernote();
	    });
  		</script>
	</div>

