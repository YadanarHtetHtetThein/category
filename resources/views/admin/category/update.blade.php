@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-10 offset-1 mt-2">
            <div class="col-md-10 offset-md-1">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Category Update Form</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form action="{{ route('admin#update',$category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="my-3 mx-2">
                            <label for="name" class="form-label"><b class="text-danger">* </b>Category name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name',$category->name) }}">
                            @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>    
                        <div class="my-3 mx-2">
                            <label for="image" class="form-label"><b class="text-danger">* </b>Category Photo</label>
                            <input type="file" class="form-control" name="image">
                            <input type="hidden" class="form-control" name="image">
                            <span>Current Category image is </span><img src="{{ asset('uploads/category/img/'.$category->image) }}" alt="" width="60" height="60" class='mt-1 rounded'>
                        </div><div class="my-3 mx-2">
                            <label for="icon" class="form-label"><b class="text-danger">* </b>Category icon</label>
                            <input type="file" class="form-control" name="icon">
                            <input type="hidden" class="form-control" name="icon">
                            <span>Current Category icon is </span><img src="{{ asset('uploads/category/icon/'.$category->icon) }}" alt="" width="40" height="40" class="mt-1 rounded">
                        </div>
                        <div class="mx-2 my-3 form-check mt-4 pt-2">
                            <input type="checkbox" class="form-check-input" name="status" @if ($category->status == '1')
                                {{'checked'}}
                            @endif>
                            <label class="form-check-label" for="status">Status(Is Publish?)</label>
                        </div>
                        <div class="mt-4 mb-2 ms-3">
                        <button type="submit" class="btn btn-primary mx-2" >Update</button>
                        <button type="reset" class="btn btn-secondary mx-2">Cancel</button>
                        </div>
                        </form>
                      
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @endsection