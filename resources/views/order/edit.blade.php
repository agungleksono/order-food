@extends('layouts.main')

@section('container')
<div class="card mt-4">
	<div class="card-header">
		<h3>Edit Pesanan</h3>
	</div>
	<div class="card-body col-lg-6">
    <form method="POST" action="/order/update/{{ $order->id }}">
      @method('put')
      @csrf
      <div class="mb-3">
        <label for="table_number" class="form-label">Nomor Meja</label>
        <input type="text" class="form-control" value="{{ $order->table_number }}" id="table_number" name="table_number" placeholder="Nomor Meja" required>            
      </div>
      <div class="mb-3">
        <label for="food" class="form-label">Menu Makanan</label>
        <select class="form-select" name="food" id="food" required>
          <option selected disabled>--- Pilih Makanan ---</option>
          @foreach ($foods as $food)
            <option value="{{ $food->id }}" {{ $food->id == $foodOrder->id ? 'selected' : '' }}>{{ $food->menu_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label for="drink" class="form-label">Menu Minuman</label>
        <select class="form-select" name="drink" id="drink" required>
          <option selected disabled>--- Pilih Makanan ---</option>
          @foreach ($drinks as $drink)
            <option value="{{ $drink->id }}" {{ $drink->id == $drinkOrder->id ? 'selected' : '' }}>{{ $drink->menu_name }}</option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
	</div>
</div>
@endsection