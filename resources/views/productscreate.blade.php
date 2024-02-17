@extends('layouts.app')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecommerce</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  </head>
<body>
    
    <div class="container ">
    <div class="d-flex justify-content-between  py-3">
    <div class="h4">CREATE PRODUCT</div>
    </div>
   <form action="{{route('products.store')}}"  method="post" enctype="multipart/form-data">
      @csrf
    <div class="card border-0 shadow-lg">
        <div class="card-body">
@if(Session::has('success'))
<div class="alert alert-success">
{{Session::get('success')}}
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger">
{{Session::get('error')}}
</div>
@endif

             <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" name="name" id="name" value="{{ old('name') }}"
              placeholder="Enter Product" class="form-control
              @error('name') is-invalid @enderror"  >
              @error('name')
              <p class="invalid-feedback">{{$message}}</p>
              @enderror
            </div>
            <div class="mb-3">
              <label for="price" class="form-label">Price</label>
              <input type="number" name="price" id="price" value="{{ old('price') }}"
              placeholder="Enter Price" class="form-control
              @error('price') is-invalid @enderror"  >
              @error('price')
              <p class="invalid-feedback">{{$message}}</p>
              @enderror
            </div>
          
            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" name="stock" id="stock" value="{{ old('stock') }}"
              placeholder="Enter Stock" class="form-control
              @error('stock') is-invalid @enderror"  >
              @error('stock')
              <p class="invalid-feedback">{{$message}}</p>
              @enderror
            </div>
          
            <div class="mb-3">
            <label for="images">Images (Many):</label>
            <input type="file" name="images[]" id="images" multiple required>
        </div>

        </div>
    </div>
    <button class="btn btn-primary">Save Details</button>
</form>
</div>
@endsection