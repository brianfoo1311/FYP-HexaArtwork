@extends('layouts.master')
@section('body')
    <div class="page-heading">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Gallery List</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{route('admin.gallery.create')}}" class="btn icon btn-primary">
                                        <i class="bi bi-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-content">
                            <!-- table hover -->
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>IMAGE</th>
                                        <th>NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>LOCATION</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($galleries as $key=>$gallery)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>
                                                <img src="{{asset('storage/images/galleries/'.$gallery->image)}}"
                                                     alt="logo"
                                                     width="45px">
                                            </td>
                                            <td>{{$gallery->name}}</td>
                                            <td>{{$gallery->description}}</td>
                                            <td>{{$gallery->location}}</td>
                                            <td>
                                                <a href="{{route('admin.gallery.edit',$gallery->id)}}"
                                                   class="btn icon btn-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('admin.gallery.delete',$gallery->id)}}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn icon btn-primary"
                                                            onclick="return confirm('Are you sure you want to delete it')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Record Yet</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-2" style="justify-content: center; display: flex">
                                    {{$galleries->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
