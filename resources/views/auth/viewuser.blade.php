@extends('dashboard')
@section('content')
<table class="table">
  <thead>
    <tr style="background-color:  rgb(17, 143, 226);">
      <th scope="col">STT</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">Favorities</th>
      <th scope="col">email</th>
      <th scope="col">phone</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <tbody>
    @foreach($user as $user)
    <tr>
      <th>{{ $user->id }}</th>
      <td><img src="/uploads/{{$user -> image}}" style="width: 100px"></td>
      </td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->hobby }}</td>
      <td>{{ $user->email }}</td>
      <td>{{$user->phone}}</td>
      <td class="text-right">
        <a href="{{route('user.edit',['id' => $user->id ])}}" class="btn btn-sm  btn-success"><i class="fas fa edit">Sửa</i></a>
        <form action="{{ route('user.delete', ['id'=>$user->id])}}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-success">Xóa</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection