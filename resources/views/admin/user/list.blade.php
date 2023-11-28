@extends('layouts.master')
@section('body')
    <div class="page-heading">
        <section class="section">
            <div class="row" id="table-hover-row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="card-title">User List</h4>
                                </div>
                                <div class="col-md-3 text-right">
                                    <label for="roleFilter" class="mr-2">Filter by Role:</label>
                                    <select id="roleFilter" class="form-control" onchange="filterUsers()">
                                        <option value="">All</option>
                                        <option value="2">Artist</option>
                                        <option value="3">User</option>
                                    </select>
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
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $key=>$user)
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Record Yet</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="mt-2" style="justify-content: center; display: flex">
                                    {{$users->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function () {
            // jQuery code to handle filter
            $('#roleFilter').change(function () {
                var selectedRole = $(this).val();
                var url = "{{ route('admin.userList') }}";

                // Update the URL based on the selected role
                if (selectedRole) {
                    url += "?role=" + selectedRole;
                }

                // Redirect to the constructed URL
                window.location.href = url;
            });

            // Set the selected option in the dropdown based on the 'role' query parameter
            var selectedRole = "{{ request('role') }}";
            $('#roleFilter').val(selectedRole);
        });
    </script>
@endsection