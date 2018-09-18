          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Data Table Example</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Text</th>
                      <th>Image</th>
                      <th>Views</th>
                      <th>User</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Text</th>
                      <th>Image</th>
                      <th>Views</th>
                      <th>User</th>
                      <th>Delete</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if($items)
                      @foreach($items as $article)
                        @if(!empty($article->title))
                          <tr>
                            <td>{{ $article->id }}
                            <td><a href = "{{ route('admin.articles.edit', ['id' => $article->id]) }}" >{{ $article->title }}</a></td>
                            <td>{{ str_limit($article->description, 75) }}</td>
                            <td>{{ str_limit($article->text, 75) }}</td>
                            <td><img src = "{{ config('setting.project_folder_name') }}/img/articles/{{ $article->image->mini }}"></td>
                            <td>{{ $article->views }}</td>
                            <td>{{ $article->user->name }} {{ $article->user->last_name }}</td>
                            <td><a href = "{{ route('admin.articles.destroy', ['id' => $article->id]) }}" ><img src = '/site/img/cross-24-512.png' width="70" height="70"></a></td>
                          </tr>
                        @endif
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class = 'container'>
              <a class = 'btn btn-success' href = "{{ route('admin.articles.create') }}" style = 'margin-bottom: 25px; width:100px'>ADD</a>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>