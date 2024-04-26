@extends('dashboard')
@section('content')

<div>
<table class="table ">
  <thead>
    <tr style ="background-color:   rgb(148, 148, 236);">
      <th scope="col">STT</th>
      <th scope="col">Image</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      
      <th scope="col">phone</th>
      <th scope="col">created_at</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($data as $a)
    <tr>  
      <th scope="row">{{++$i}}</th>
      <td><img src="/uploads/{{$a -> image}}" style="width: 100px"></td></td>
      <td>{{$a->name}}</td>
      <td>{{$a->email}}</td>
      
      <td>{{$a->phone}}</td>
      <td>{{$a->created_at }}</td>
      <td class="text-right">
        <a href="{{route('user.edit',['id' => $a->id ])}}" class="btn btn-sm  btn-success"><i class="fas fa edit">Sửa</i></a>
        a href="{{route('user.edit',['i<d' => $a->id ])}}" class="btn btn-sm  btn-success"><i class="fas fa trash">Xóa</i></a>
       
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<div class="" >{{$data->links()}}</div>
@endsection
