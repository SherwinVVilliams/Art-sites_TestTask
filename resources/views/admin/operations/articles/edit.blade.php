
	<div class = 'container' >
		<h1> Article Edit </h1>
		<br>
		<form id = 'create_form' method = 'post' action = " {{ route('admin.articles.update', ['id' => $article->id]) }} " enctype="multipart/form-data" class = 'contact-form' >
			{{ csrf_field() }}
			<div class="form-group">
	            	<div class="form-label-group">
	              		<input type="text" id="firstName" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="Title" value="{{ $article->title }}" required autofocus>
	              		<label for="firstName">Title</label>
	            	</div>
			</div>
			<div class = 'form-group'>
					<label for="lastName">Description</label>
	              	<textarea id="summernote_desc" class="form-control" placeholder="description" name = 'description'>{{ $article->description }}</textarea>

	        </div>
	        <div class = 'form-group'>
	        	
						<label for="lastName">Text</label>
						<br>
	              		<textarea id = 'summernote_text' name = 'text' class = 'form-control'>{{ $article->text }}</textarea>
	              		
	        </div>
	        <div class = 'form-group'>

	        			<img src = "\site\img\articles\{{ $article->image->path }}" id = 'image-path_attr' width = '525'>
	        			<img src = "\site\img\articles\{{ $article->image->max }}" id = 'image-max_attr' width = '245'>
	        			<img src = "\site\img\articles\{{ $article->image->mini}}" id = 'image-mini_attr' width = '70'>
	        			<br>
	        			<br>
	              		<input type="file" id="image" placeholder="Last name" name = 'image' value="{{ old('image') }}" >

	        </div>

	        <div class = 'form-group'>
				<p>Categories</p>
				<table class = 'table table-striped'>
					<tbody>
						@foreach($categories as $category)
							@foreach($article->categories as $art_category)
								@if($category->id == $art_category->id)
									<tr>
										<td>{{ $category->name }}</td>
										<td><input type="checkbox" name = "categories[]" value="{{ $category->id }}" checked> </td>
									</tr>
									@continue(2)
								@endif
							@endforeach
							<tr>
									<td>{{ $category->name }}</td>
									<td><input type="checkbox" name = "categories[]" value="{{ $category->id }}"> </td>
							</tr>
						@endforeach
					</tbody>
				</table>
	        </div>
			<input type="hidden" name="_method" value = "PUT">
	        <div class = 'form-group'>
	        	<button type = 'submit' id = 'submit-btn' class = 'btn-success'>Update</button>
	        </div>
	    </form>
	    <script>
	    $(document).ready(function() {
	        $('#summernote_desc').summernote();
	        $('#summernote_text').summernote();
	    });
  		</script>
	</div>

