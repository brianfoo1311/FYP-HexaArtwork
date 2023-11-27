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
                            <h4 class="card-title">Update Your Profile</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{route('artist.update.profile')}}" method="POST"
                                      enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                       value="{{auth()->user()->name}}" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">About:</label>
                                                <textarea class="form-control" name="about" placeholder="About..."
                                                          required>{{auth()->user()->about}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input class="form-control form-control-sm" type="file"
                                                       name="image">
                                                <img src="{{asset('storage/images/artist/profile/'.auth()->user()->image)}}"
                                                     alt="logo" class="mt-2"
                                                     width="100px">
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
