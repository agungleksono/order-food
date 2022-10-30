@extends('layouts.main')

@section('container')
<div class="card mt-4">
	<div class="card-header">
		<h3>Edit Menu</h3>
	</div>
	<div class="card-body col-lg-6">
    <form method="POST" action="/menu/update/{{ $menu->id }}">
      @method('put')
      @csrf
      <div class="mb-3">
        <label for="menu_name" class="form-label">Nama Menu</label>
        <input type="text" class="form-control" value="{{ $menu->menu_name }}" id="menu_name" name="menu_name" placeholder="Nama Menu" required>            
      </div>
      <div class="mb-3">
        <label for="menu_price" class="form-label">Harga</label>
        <input type="number" class="form-control" value="{{ $menu->menu_price }}" id="menu_price" name="menu_price" placeholder="Harga" required>
      </div>
      <div class="mb-3">
        <label for="menu_type" class="form-label">Jenis</label>
        <select class="form-select" name="menu_type" id="menu_type" required>
          <option disabled>--- Pilih Jenis Menu ---</option>
          <option value="1" {{ $menu->menu_type == 1 ? 'selected' : '' }}>Makanan</option>
          <option value="2" {{ $menu->menu_type == 2 ? 'selected' : '' }}>Minuman</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="menu_status" class="form-label">Status</label>
        <select class="form-select" name="menu_status" id="menu_status" required>
          <option disabled>--- Pilih Status Menu ---</option>
          <option value="0" {{ $menu->menu_status == 0 ? 'selected' : '' }}>Not Ready</option>
          <option value="1" {{ $menu->menu_status == 1 ? 'selected' : '' }}>Ready</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
	</div>
</div>
@endsection