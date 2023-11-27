@extends('layouts.master')
@section('body')
    <div class="page-heading">
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-6">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Artwork</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{route('admin.gallery.update',$gallery->id)}}"
                                      method="POST"
                                      enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{$gallery->name}}" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Description:</label>
                                                <textarea class="form-control" name="description"
                                                          required>{{$gallery->description}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Price:</label>
                                                <input type="text" class="form-control" name="location"
                                                       required value="{{$gallery->location}}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input class="form-control form-control-sm" type="file"
                                                       name="image">
                                                <img src="{{asset('storage/images/galleries/'.$gallery->image)}}"
                                                     alt="logo" class="mt-2"
                                                     width="100px">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
