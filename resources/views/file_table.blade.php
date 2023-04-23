@extends('partials.app')
@section('content')
    <div class="col-12">
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">File Summary</h6>
                <div class="px-0 w-50 my-2">
                    <form class="d-none d-md-flex ms-4" method="POST">
                        @csrf
                        <input class="form-control bg-dark border-0" type="search" name="Search" id="search"
                            placeholder="Search File">
                        <button class="btn btn-primary border-0 mx-2">Search</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Filename</th>
                                <th scope="col">Folder</th>
                                <th scope="col">Location</th>
                                <th scope="col">Description</th>
                                <th scope="col">Operation</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            {{-- loop to display db content --}}
                            @if (isset($files))
                                @foreach ($files as $file)
                                    <tr>
                                        <td>{{ $file->FileId }}</td>
                                        <td>{{ $file->Filename }}</td>
                                        <td>{{ $file->FileFolder }}</td>
                                        <td>{{ $file->FilePath }}</td>
                                        <td>{{ $file->FileDescription }}</td>
                                        <td>
                                            <button type="button" onclick="edit('{{$file->Filename}}')" class="btn btn-info">Edit</button>
                                            <button type="submit" class=" btn btn-primary">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- EDIT FILE MODAL --}}
    <div class="modal fade" id="edit_file" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:#191C24 !important">
                <div class="modal-body">
                    <div class="bg-secondary rounded h-200 p-4">
                        <h6 class="mb-4">Update File Info</h6>
                        @if (isset($Success))
                            <div class="alert alert-success" role="alert">
                                {{ $Success }}
                            </div>
                        @elseif(isset($Error))
                            <div class="alert alert-danger" role="alert">
                                {{ $Error }}
                            </div>
                        @endif
                        {{-- FILE UPLOAD FORM --}}
                        <form method="POST" action="{{ route('store') }}">
                            @csrf
                            {{-- PROGRAM TYPE --}}
                            <select class="form-select mb-3" aria-label="Default select example" name="FileFolder">
                                aria-placeholder="Folder Location">
                                <option value="SETUP">SETUP</option>
                                <option value="GIA">GIA</option>
                                <option value="OTHERS">OTHERS</option>
                            </select>
                            {{-- FILENAME --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control filename" id="floatingInput" placeholder="Filename"
                                    name="Filename">
                                <label for="floatingInput">Filename</label>
                            </div>
                            {{-- DESCRIPTION --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control filedesc" id="floatingInput" placeholder="Description"
                                    name="FileDescription">
                                <label for="floatingInput">Description</label>
                            </div>
                            {{-- LOCATION --}}
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control fileloc" id="floatingInput" placeholder="Location"
                                    name="FilePath">
                                <label for="floatingInput">Location</label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary ">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        // table buttons
        function edit(filename){
            // get inputs
            $('#edit_file').modal('toggle');
            var filename = $('.filename').val();
        
        }
    </script>
@endsection
