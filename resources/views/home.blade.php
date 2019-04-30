@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div class="row">
                    <div class="col">  
                        Dashboard
                    </div>
                    @if($user->role === 'admin')
                    <div class="col text-right">  
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                          Add product to Inventory
                        </button>
                    </div>
                    @endif
                </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif      
                </div>
                <div class="productlist p-2">
                <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                    <div class="col">
                    Product:{{$product->product_name}}
                </div>
                     @if($user->role === 'admin')
                    <div class="col supplier">
                    Supplier: {{$product->name}}
                    </div>
                    @endif
                    </li>
                @endforeach
                </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="{{ route('addproduct') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Product name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                           <label for="name" class="col-md-4 col-form-label text-md-right">Select role</label>

                            <div class="col-md-6">
                                    <select class="form-control" name="id" id="exampleFormControlSelect1">
                                    @foreach($supplier as $individual_supplier)
                                      <option value="{{$individual_supplier->id}}">{{$individual_supplier->name}}</option>
                                    @endforeach
                                    </select>

                                
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">
                                    Add Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

