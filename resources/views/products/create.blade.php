@extends('layout')

@section('content')


<form class="mx-5"  enctype="multipart/form-data" method="post"
 action="{{route('products.store')}}">
 @{{ csrf_token() }}

    {{-- put and post methods --}}
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" 
      name="name" id="name" value="{{old('name')}}">
    </div>
    @error('name')
    <div class="alert alert-danger">{{$message}}</div>

    @enderror

    <div class="form-group">
        <label for="brand_id">Example Brand</label>
        <select class="form-control select2" name="brand_id" id="brand_id">

        @foreach ($brands as $brand)
            <option value ="{{$brand->id}}">{{$brand->name}}</option>
        @endforeach
        </select>
      </div>

      
    <div class="form-group">
      <label for="category_id">Example categories</label>
      <select class="form-control select2" multiple name="categories[]" id="category_id">
      @foreach ($categories as $category)
          <option value ="{{$category->id}}">{{$category->name}}</option>
      @endforeach


      </select>
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" class="form-control @error('price') is-invalid @enderror" placeholder="Enter price" name="price" id="price" value="{{old('price')}}">
      </div>
      @error('price')
      <div class="alert alert-danger">{{$message}}</div>
  
      @enderror


    <div class="form-group">
      <label for="description">Discription:</label>
      <textarea  class="form-control" name="description" id="description">{{old('description' )}}</textarea>
    </div>

    <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" accept="image/*"
         class="form-control @error('image') is-invalid @enderror"  name="image" id="image" value="{{old('image')}}">
      </div> 

      <div class="form-group form-check">
        <label class="form-check-label">
          <input name="status"
  
          @checked(old('status')=='on' )   class="form-check-input "  type="checkbox"> Status
        </label>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>


@endsection
