@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-10 offset-1 mt-2">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">Category Creation Form</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form action="{{ route('admin#store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                            <div class="m-3">
                                    <label for="name" class="form-label"><b class="text-danger">* </b>Category name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <small class="text-danger">{{ $errors->first('name') }}</small>
                                    @endif
                                </div>
                                <div class="mx-3 form-check mt-4 pt-2">
                                    <input type="checkbox" class="form-check-input" name="status">
                                    <label class="form-check-label" for="status">Status(Is Publish?)</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="m-3">
                                    <label for="image" class="form-label"><b class="text-danger">* </b>Category Photo</label>
                                    <input type="file" class="form-control" name="image">
                                    @if ($errors->has('image'))
                                        <small class="text-danger">{{ $errors->first('image') }}</small>
                                    @endif
                                </div><div class="m-3">
                                    <label for="icon" class="form-label"><b class="text-danger">* </b>Category icon</label>
                                    <input type="file" class="form-control" name="icon">
                                    @if ($errors->has('icon'))
                                        <small class="text-danger">{{ $errors->first('icon') }}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="my-3 ms-3">
                        <button type="submit" class="btn btn-primary mx-2" >Save</button>
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
    </section>
  </div>
  @endsection