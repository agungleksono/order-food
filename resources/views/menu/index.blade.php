@extends('layouts.main')

@section('container')

<div class="card mt-4">
	<div class="card-header">
		<h3>Daftar Menu</h3>
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
        Tambah Menu
      </button>
		</div>

    <div class="mt-4">
      <h5 class="card-title">Daftar Makanan</h5><hr>
      <div class="table-responsive-sm">
        <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Menu</th>
            <th>Harga</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="table-container">
        @foreach ($foods as $food)
          <tr>
            <th class="text-center">{{ $loop->iteration }}</th>
            <td>{{ $food->menu_name }}</td>
            <td>{{ $food->menu_price }}</td>
            <td class="text-center"><span class="badge text-bg-{{ $food->menu_status == 0 ? 'secondary' : 'info' }}">{{ $food->menu_status == 0 ? 'Not Ready' : 'Ready' }}</span></td>
            <td class="text-center">
              <a href="/menu/{{ $food->id }}/edit" class="badge bg-success"><span data-feather="edit"></span></a>
              <form method="POST" action="/menu/delete/{{ $food->id }}" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?')"><span data-feather="trash"></span></button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
        </table>
      </div>
    </div>

    <div class="mt-5">
      <h5 class="card-title mt-3">Daftar Minuman</h5><hr>
      <div class="table-responsive-sm">
        <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Menu</th>
            <th>Harga</th>
            <th class="text-center">Status</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="table-container">
        @foreach ($drinks as $drink)
          <tr>
            <th class="text-center">{{ $loop->iteration }}</th>
            <td>{{ $drink->menu_name }}</td>
            <td>{{ $drink->menu_price }}</td>
            <td class="text-center"><span class="badge text-bg-{{ $drink->menu_status == 0 ? 'secondary' : 'info' }}">{{ $drink->menu_status == 0 ? 'Not Ready' : 'Ready' }}</span></td>
            <td class="text-center">
              <a href="/menu/{{ $drink->id }}/edit" class="badge bg-success"><span data-feather="edit"></span></a>
              <form method="POST" action="/menu/delete/{{ $drink->id }}" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin ingin menghapus menu ini?')"><span data-feather="trash"></span></button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
        </table>
      </div>
    </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addModalLabel">Tambah Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/menu/store">
          @csrf
          <div class="mb-3">
            <label for="menu_name" class="form-label">Nama Menu</label>
            <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Nama Menu" required>            
          </div>
          <div class="mb-3">
            <label for="menu_price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="menu_price" name="menu_price" placeholder="Harga" required>
          </div>
          <div class="mb-3">
            <label for="menu_type" class="form-label">Jenis</label>
            <select class="form-select" name="menu_type" id="menu_type" required>
              <option selected disabled>--- Pilih Jenis Menu ---</option>
              <option value="1">Makanan</option>
              <option value="2">Minuman</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="menu_status" class="form-label">Status</label>
            <select class="form-select" name="menu_status" id="menu_status" required>
              <option selected disabled>--- Pilih Status Menu ---</option>
              <option value="0">Not Ready</option>
              <option value="1">Ready</option>
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