@extends('layout')
 @section('content')
 <div class="container-fluid">
 <h1>Products</h1>
 <a class="btn btn-success float-right" href="{{route('products.create')}} ">Create</a>
 <table class="table table-striped">
    <thead>
      <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Brand</th>
        <th>Price</th>
        <th>Description</th>
        <th>created_by</th>
        <th>Status</th>
        @if($deleted==1)
        <th>Deleted_by</th>
        <th>Deleted_at</th>
        @endif
        <th>created at</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($products as $product )
        <tr>
            <td>{{$product->name}}</td>
            <td><img width='100' src="{{url('storage/'.$product->image)}}"></td>
            <td>{{$product->brand?->name??"not found"}}</td>

    
            <td>{{$product->price}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->user?->name??"not found"}}</td>

            <td>{{$product->status}}</td>
            
        @if($deleted==1)
        <td>{{$product->userWhoDelete?->name??"not found"}}</td>
        <td>{{$product->Deleted_at}}</td>
        @endif
            <td>{{$product->created_at}}</td>
            <td>

              @if(!$deleted)
                <a href="{{route('products.edit',$product)}}">
                    <span class="btn  btn-outline-success btn-sm font-1 mx-1">
                        <span class="fas fa-wrench "></span> تحكم
                    </span>
                </a>

                <form method="post" action="{{route('products.destroy',$product)}}">
                  @csrf
                  @method('DELETE')
                    <button onclick="var result=confirm('R U sure?'); if(result){} else{event.preventDefault()}" class="btn btn-danger">Delete</button>

                </form>
                @endif


                @if($deleted)
                <a href="{{route('products.restore',$product->id)}}">
                    <span class="btn  btn-outline-success btn-sm font-1 mx-1">
                        <span class="fas fa-wrench "></span> استعادة
                    </span>
                </a>

                <form method="post" action="{{route('products.forceDelete',$product->id)}}">
                  @csrf
                  @method('DELETE')
                    <button onclick="var result=confirm('R U sure?'); if(result){} else{event.preventDefault()}" class="btn btn-danger">forceDelete</button>

                </form>
                @endif
            </td>
          </tr>
        @empty
        <h1>No data found</h1>

        @endforelse


    </tbody>
  </table>
  {!!$products->render()!!}
</div>
  @endsection
