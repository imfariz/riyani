@extends('layouts.admin')

@section('content')
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-grey-800">Daftar Transaksi</h1>
                    </div>

                    <div class="row">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor</th>
                                            <th>Total Transaksi</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                          <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>${{ $item->transaction_total }}</td>
                                            <td>
                                              @if($item->transaction_status == 'PENDING')
                                                <span class="badge badge-info">
                                              @elseif($item->transaction_status == 'SUCCESS')
                                                <span class="badge badge-success">
                                              @elseif($item->transaction_status == 'FAILED')
                                                <span class="badge badge-warning">
                                              @else
                                                <span>
                                              @endif
                                                {{ $item->transaction_status }}
                                                </span>
                                            </td>
                                            <td>
                                              @if ($item->transaction_status == 'PENDING')
                                                <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-sm">
                                                  <i class="fa fa-check"></i>
                                                </a>
                                                <a href="{{ route('transactions.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-sm">
                                                  <i class="fa fa-times"></i>
                                                </a>
                                              @endif
                                              <a href="#mymodal"
                                                data-remote="{{ route('transactions.show', $item->id) }}"
                                                data-toggle="modal"
                                                data-target="#mymodal"
                                                data-title="Detail Transaksi {{ $item->uuid }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                              </a>
                                              <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                              </a>
                                              <form action="{{ route('transactions.destroy', $item->id) }}" 
                                                    method="post" 
                                                    class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm">
                                                  <i class="fa fa-trash"></i>
                                                </button>
                                              </form>
                                            </td>
                                          </tr>
                                        @empty
                                            <tr>
                                              <td colspan="6" class="text-center p-5">
                                                Data tidak tersedia
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