@extends('layouts.admin')

@section('content')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-grey-800">Paket Travel</h1>
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Produk
                        </a>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produk</th>
                                            <th>Tipe</th>
                                            <th>Gambar</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{$item->id}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($item->image) }}" alt="Gambar Produk" class="img-thumbnail" style="width: 150px;">
                                                </td>
                                                <td>{{Str::limit($item->description,15)}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>
                                                    <a href="{{ route('product.edit', $item->id) }}" class="btn btn-info">
                                                        <i class="fa fa-pencil-alt"></i>
                                                    </a>
                                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    Data Kosong
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection