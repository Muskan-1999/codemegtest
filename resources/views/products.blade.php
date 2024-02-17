@extends('layout')
@section('content')
    
<div class="row">
    @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
                <div class="caption">
                    <h4>{{ $product->name }}</h4>
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <p class="btn-holder"><a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a> </p>
                    <p class="btn-holder"><a href="{{ route('add.to.wishlist', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to Wishist</a> </p>
                </div>
            
        </div>
    @endforeach
</div>
    
@endsection