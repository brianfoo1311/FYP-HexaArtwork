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
                                    <h4 class="card-title">Artwork List</h4>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <a href="{{route('artist.artwork.create')}}" class="btn icon btn-primary">
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
                                        <th>LOGO</th>
                                        <th>Title</th>
                                        <th>DESCRIPTION</th>
                                        <th>PRICE</th>
                                        <th>DIMENSION</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($artworks as $key=>$artwork)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>
                                                <img src="{{asset('storage/images/artworks/'.$artwork->image)}}"
                                                     alt="logo"
                                                     width="45px">
                                            </td>
                                            <td>{{$artwork->title}}</td>
                                            <td>{{$artwork->description}}</td>
                                            <td>{{$artwork->price}}</td>
                                            <td>{{$artwork->dimension}}</td>
                                            <td>{{ $artwork->status == 1 ? 'Approved' : 'Pending' }}</td>
                                            <td>
                                                <a href="{{route('artist.artwork.edit',$artwork->id)}}"
                                                   class="btn icon btn-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('artist.artwork.delete',$artwork->id)}}"
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
                                    {{$artworks->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
