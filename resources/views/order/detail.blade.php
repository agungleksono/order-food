@extends('layouts.main')

@section('container')

<div class="card mt-4">
	<div class="card-header">
		<h3>Detail Pesanan</h3>
	</div>
	<div class="card-body col-lg-6">
    <form method="POST" action="/order/confirmation/{{ $order->id }}">
      @csrf
      <div class="mb-3">
        <label for="order_number" class="form-label">Nomor Meja</label>
        <input type="text" class="form-control" value="{{ $order->order_number }}" id="order_number" name="order_number" placeholder="Nomor Pesanan" disabled>            
      </div>
      <div class="mb-3">
        <label for="table_number" class="form-label">Nomor Meja</label>
        <input type="text" class="form-control" value="{{ $order->table_number }}" id="table_number" name="table_number" placeholder="Nomor Meja" disabled>            
      </div>
      <div class="mb-3">
        <label for="food" class="form-label">Menu Makanan</label>
        <input type="text" class="form-control" value="{{ $foodOrder->menu_name }}" id="food" name="food" disabled>            
      </div>
      <div class="mb-3">
        <label for="drink" class="form-label">Menu Minuman</label>
        <input type="text" class="form-control" value="{{ $drinkOrder->menu_name }}" id="drink" name="drink" disabled>            
      </div>
      @if($order->status == 1 && $user_role == 2)
        <button type="submit" class="btn btn-primary" onclick="return confirm('Konfirmasi pembayaran?')">Konfirmasi Pembayaran</button>
      @endif
    </form>
	</div>
</div>

@endsection