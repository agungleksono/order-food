@extends('layouts.main')

@section('container')

<div class="card mt-4">
	<div class="card-header">
		<h3>Daftar Pesanan</h3>
	</div>
	<div class="card-body">
    @if (session()->has('success'))
      <div class="card-body"><div class="alert alert-success text-center" role="alert">
        {{ session('success') }}
      </div>
    @endif
    <div>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#addModal">
        Buat Pesanan Baru
      </button>
		</div>

    <div class="mt-4">
      <h5 class="card-title">Daftar Pesanan</h5><hr>
      <div class="table-responsive-sm">
        <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Nomor Pesanan</th>
            <th class="text-center">Nomor Meja</th>
            <th class="text-center">Total Harga</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="table-container">
        @foreach ($orders as $order)
          <tr>
            <th class="text-center">{{ $loop->iteration }}</th>
            <td>{{ $order->order_number }}</td>
            <td class="text-center">{{ $order->table_number }}</td>
            <td class="text-center">{{ $order->bill }}</td>
            <td class="text-center"><span class="badge text-bg-{{ $order->status == 0 ? 'secondary' : 'info' }}">{{ $order->status == 0 ? 'Done' : 'Active' }}</span></td>
            <td class="text-center">
              <a href="/order/{{ $order->id }}" class="badge bg-warning"><span data-feather="eye"></span></a>
              <a href="/order/{{ $order->id }}/edit" class="badge bg-success"><span data-feather="edit"></span></a>
              <form method="POST" action="/order/delete/{{ $order->id }}" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin ingin menghapus pesanan ini?')"><span data-feather="trash"></span></button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
        </table>
      </div>

      <div>
        <a href="/order/report" class="btn btn-primary btn-sm mt-3"><span data-feather="printer"></span>Cetak Laporan</a>
      </div>
    </div>
	</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModalLabel">Tambah Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/order/store">
          @csrf
          <div class="mb-3">
            <label for="table_number" class="form-label">Nomor Meja</label>
            <input type="text" class="form-control" id="table_number" name="table_number" placeholder="Nama Menu" required>            
          </div>
          <div class="mb-3">
            <label for="food" class="form-label">Menu Makanan</label>
            <select class="form-select" name="food" id="food" required>
              <option selected disabled>--- Pilih Makanan ---</option>
              @foreach ($foods as $food)
                <option value="{{ $food->id }}">{{ $food->menu_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="drink" class="form-label">Menu Minuman</label>
            <select class="form-select" name="drink" id="drink" required>
              <option selected disabled>--- Pilih Minuman ---</option>
              @foreach ($drinks as $drink)
                <option value="{{ $drink->id }}">{{ $drink->menu_name }}</option>
              @endforeach
            </select>
          </div>
        <!-- </form> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection