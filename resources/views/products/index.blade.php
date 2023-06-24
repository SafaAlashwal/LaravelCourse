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
        <th>Category</th>
        <th>Price</th>
        <th>Description</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($products as $product )
        <tr>
            <td>{{$product->name}}</td>
            <td><img width="50" src="{{url('storage/'.$product->image)}}"></td>
            <td>{{$product->brand->price}}</td>

            <td>
            
              @foreach({{$product->$categories as $category}})
       

              @endforeach
            </td>
            <td>{{$product->price}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product['status']}}</td>
            <td>

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

            </td>
          </tr>
        @empty
        <h1>No data found</h1>

        @endforelse


    </tbody>
  </table>
  {!!!!}
</div>
  @endsection
