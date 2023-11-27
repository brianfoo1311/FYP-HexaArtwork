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
                            <h4 class="card-title">Add Gallery</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{route('admin.gallery.store')}}" method="POST"
                                      enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name"
                                                       placeholder="Title" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Description:</label>
                                                <textarea class="form-control" name="description"
                                                          placeholder="Description..."
                                                          required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Location:</label>
                                                <input type="text" class="form-control" name="location"
                                                       placeholder="Location" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input class="form-control form-control-sm" type="file"
                                                       name="image" required>
                                            </div>
                                        </div>

                                        {{--                                        <div class="col-12">--}}
                                        {{--                                            <div class="form-group">--}}
                                        {{--                                                <div class="form-item">--}}
                                        {{--                                                    <label class="form-label">Location: </label>--}}
                                        {{--                                                    <input id="country_selector" type="text">--}}
                                        {{--                                                    <label for="country_selector" style="display:none;">Select a country here...</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <div class="form-item" style="display:none;">--}}
                                        {{--                                                    <input class="form-control" type="text" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />--}}
                                        {{--                                                    <label for="country_selector_code">...and the selected country code will be updated here</label>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}


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
