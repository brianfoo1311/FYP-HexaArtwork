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
                            <h4 class="card-title">Add Artwork</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" action="{{route('artist.artwork.store')}}" method="POST"
                                      enctype="multipart/form-data" data-parsley-validate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title"
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
                                                <label class="form-label">Price:</label>
                                                <input type="number" class="form-control" name="price"
                                                       placeholder="price" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Dimension:</label>
                                                <input type="number" class="form-control" name="dimension"
                                                       placeholder="Dimension" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Image</label>
                                                <input class="form-control form-control-sm" type="file"
                                                       name="image" required>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset
                                            </button>
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
