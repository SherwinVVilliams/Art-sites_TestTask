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
                      <th>Name</th>
                      <th>Created_At</th>
                      <th>Update_At</th>
                      <th>Articles Count</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Created_At</th>
                      <th>Update_At</th>
                      <th>Articles Count</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @if($items)
                    @foreach($items as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->name }}</td>
                      <td>{{ $category->created_at ? $category->created_at : 'null' }}</td>
                      <td>{{ $category->update_at ? $category->updated_at : 'null' }}</td>
                      <td>{{ count($category->articles) }}</td>
                    </tr>
                    @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>