@extends('admin.layouts.app')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col mt-2">
              <div class="card">
                <div class="card-header"><legend class="text-center">Category Information</legend></div>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">       
                    <div class="d-flex justify-content-end m-3">
                        <a href="{{ route('admin#create') }}"><button class="btn btn-primary">Create Category + </button></a>
                    </div>
                        @if (Session::has('deleteSuccess'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ Session::get('deleteSuccess') }} </strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div> 
                        @endif
                        @if (Session::has('updateSuccess'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ Session::get('updateSuccess') }} </strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        @if (Session::has('categorySuccess'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <strong>{{ Session::get('categorySuccess') }} </strong>
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        @endif
                        <table class="table table-hover text-nowrap table-striped shadow-sm">
                        <thead class="bg-dark text-white">
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Category Icon</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Publish</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if ($status == 0 )
                            <tr>
                                <td  colspan="7" class="text-center text-muted">There is no data.</td>
                            </tr>
                        @else
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td><img src="{{ asset('uploads/category/img/'.$category->image) }}" alt="" width="40" height="40" class="mt-1 rounded"></td>
                            <td><img src="{{ asset('uploads/category/icon/'.$category->icon) }}" alt="" width="35" height="35" class="mt-1 rounded"></td>
                            <td><a href="{{ route('admin#edit', $category->id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a></td>           
                            <td><a href="{{ route('admin#destory',$category->id) }}"><button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button></a></td>
                            @if ($category->status == '1')
                                <td><a href="{{ route('admin#publish',$category->id) }}"><button class="btn btn-sm bg-secondary text-white">No</button></a></td>
                            @else
                                <td><a href="{{ route('admin#publish',$category->id) }}"><button class="btn btn-sm bg-success text-white">Yes</button></a></td>
                            @endif
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                    <div class="mt-2 d-flex justify-content-center">{{ $categories->links() }}</div>                
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  @endsection