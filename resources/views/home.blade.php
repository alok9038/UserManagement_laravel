@extends('layouts.base')
@section('content')
@include('sweetalert::alert')
    <div class="container-fluid mx-auto my-5" style="width: 96%">
        <div class="row">
            <div class="col-lg-4">
                <div class="card border-0 round-25 mat-shadow mb-5">
                    <div class="card-body">
                        <h4 class="fw-light text-center">Insert Record</h4>
                        <hr>
                        <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control border-muted text-capitalize shadow-none @error('name') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    Please Enter Your Name.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">E-mail <span class="text-danger">*</span></label>
                                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control border-muted shadow-none @error('email') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    Please Enter Your Valid Email.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pincode">Pincode <span class="text-danger">*</span></label>
                                <input type="text" name="pincode" id="pincode" value="{{ old('pincode') }}" class="form-control border-muted shadow-none @error('pincode') is-invalid @enderror">
                                <div class="invalid-feedback">
                                    Pincode Must be 6 digits.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Image <span class="text-danger">*</span></label>
                                <div class="">
                                    <input type="file" name="image" id="file-1" class="inputfile inputfile-1 @error('image') is-invalid @enderror" data-multiple-caption="{count} files selected" style="opacity: 0;" multiple />
                                    <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                                    <br>
                                    @error('image') <span class="text-danger">Image field is Required.</span>@enderror
                                </div>
                                <div class="invalid-feedback">
                                    User Image Required!
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="submit" class="btn btn-dark mat-shadow float-end">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card border-0 round-25 mat-shadow">
                    <div class="card-body table-responsive">
                        <table class="table table-hover  table-responsive">
                            <tr class="bg-dark text-light">
                                <th>Sr no.</th>
                                <th>Name</th>
                                <th>E-mail</th>
                                <th>Pincode</th>
                                <th>Action</th>
                            </tr>
                            @php
                                $sr = 0
                            @endphp
                            @foreach ($agt_user as $user)
                            <tr>
                                <td><h6 class="mt-3">{{ $sr += 1 }}</h6></td>
                                <td class="text-capitalize">
                                    <div class="d-flex">
                                        <img src="{{ asset('image/'.$user->image) }}" style="height: 60px; width:60px;" alt="{{ $user->name }}" class="img-fluid rounded-circle mat-shadow">
                                        <h6 class="mt-3 ms-2">{{ $user->name }}</h6>
                                    </div>
                                </td>
                                <td><h6 class="mt-3">{{ $user->email }}</h6></td>
                                <td><h6 class="mt-3">{{ $user->pincode }}</h6></td>
                                <td><div class="btn-group mat-shadow rounded mt-2">
                                        <a href="" class="btn btn-info rounded-0 btn-sm" data-bs-toggle="modal" data-bs-target="#view{{ $user->id }}" title="View"><i class="fa fa-eye"></i></a>
                                        <a href="" class="btn btn-info rounded-0 btn-sm" data-bs-toggle="modal" data-bs-target="#edit{{ $user->id }}" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="" class="btn btn-info rounded-0 btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $user->id }}" title="Delete"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    

  <!-- Delete Modal -->
  @foreach ($agt_user as $user)
  <div class="modal fade mt-5 pt-3" id="delete{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0">
        <div class="modal-header border-0 pt-3 pe-4">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <i class="fa fa-exclamation-circle fa-5x text-muted text-center mx-auto"></i>
        <h6 class="h4 fw-light my-2 text-center">Are You Sure!</h6>
        <div class="modal-footer border-0 d-inline-flex mx-auto">
            <form action="{{ route('drop',['id'=>$user->id]) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-success rounded-3">Yes</button>
            </form>
            <button type="button" class="btn btn-info rounded-3" data-bs-dismiss="modal">No</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @foreach ($agt_user as $user)
  <div class="modal fade mt-5 pt-3" id="edit{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0 border-0">
        <div class="modal-header border-0 pt-3 pe-4">
          <button type="button" class="btn-close sticky-top" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="card border-0 rounded-0" style="margin-top: -50px;">
            <div class="card-body">
                <h4 class="fw-light text-center text-muted ">Update Records</h4>
                <hr>
                <form action="{{ route('edit',['id'=>$user->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $user->name }}{{ old('name') }}" class="form-control shadow-none @error('name') is-invalid @else is-valid @enderror">
                        <div class="invalid-feedback">
                            Please Enter Your Name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" value="{{ $user->email }}{{ old('email') }}" class="form-control shadow-none @error('email') is-invalid @enderror">
                        <div class="invalid-feedback">
                            Please Enter Your Valid Email.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="pincode">Pincode</label>
                        <input type="text" name="pincode" value="{{ $user->pincode }}{{ old('pincode') }}" class="form-control shadow-none @error('pincode') is-invalid @enderror">
                        <div class="invalid-feedback">
                            Pincode Must be 6 digits.
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="submit" value="Update" class="btn float-end btn-dark shadow-none">
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @foreach ($agt_user as $user)
  <div class="modal fade mt-5 pt-3" id="view{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content rounded-0 border-0">
        <div class="modal-header border-0 pt-3 pe-4">
          <button type="button" class="btn-close sticky-top" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="card border-0 rounded-0" style="margin-top: -50px;">
            <div class="card-body">
                <div class="p-0 rounded-circle mx-auto text-center mat-shadow" style="height: 110px; width:110px;">
                    <img src="{{ asset('image/'.$user->image) }}" alt="" class="img-fluid mx-auto rounded-circle" style="height: 110px; width:110px;">
                </div>
               <div class="h3 fw-light text-center text-capitalize mt-2">{{ $user->name }}</div> 
               <div class="h5 fw-light text-center">{{ $user->email }}</div> 
               <div class="small fw-light text-center"><strong class="fw-bold">Pincode : </strong>{{ $user->pincode }}</div> 
            </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endsection