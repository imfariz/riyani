@extends('layouts.admin')

@section('content')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-grey-800">Edit Produk {{$item->name}}</h1>
                    </div>

                    {{--  Jika ada Error  --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nama" value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="type">Brand Produk</label>
                                    <input type="text" class="form-control" name="type" placeholder="type" value="{{ $item->type }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control-form" placeholder="Image" accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" cols="10" class="d-block w-100 form-control">{{ $item->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Jumlah</label>
                                    <input type="number" class="form-control" name="amount" placeholder="0" value="{{ $item->amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" class="form-control" name="price" placeholder="price" value="{{ $item->price }}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">
                                    Ubah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
@endsection