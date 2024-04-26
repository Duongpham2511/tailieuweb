@extends('dashboard')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Update user with Image <a href="{{ route('dashboard')}}"
                                class="btn btn-danger float-end">BACK</a></h3>

                    </div>
                    <div class="card-body">
                        <form action="{{route('user.update', ['id'=>$user->id]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="">Họ tên:</label>
                                <input type="text" name="name" id="" value="{{$user->name}}" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email:</label>
                                <input type="text" name="email" id="" class="form-control" value="{{$user->email}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone:</label>
                                <input type="text" name="phone" id="" class="form-control" value="{{$user->phone}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Favorities</label>
                                <input type="text" name="hobby" id="hobby" class="form-control" value="{{$user->hobby}}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Ảnh đại diện:</label>
                                <input type="file" name="anhdaidien" id="" class="form-control">
                                <img src="{{ asset('uploads/students/'.$user->anhdaidien)}}" width="70px"
                                    height="70px" alt="Anh dai dien" />
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
