<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $foods = Menu::where('menu_type', 1)->where('menu_status', 1)->get();
        $drinks = Menu::where('menu_type', 2)->where('menu_status', 1)->get();

        return view('order.index', [
            'orders' => $orders,
            'foods' => $foods,
            'drinks' => $drinks,
        ]);
    }

    public function show(Order $order)
    {
        $foodOrder = DB::table('detail_orders')
            ->join('orders', 'orders.id', '=', 'detail_orders.order_id')
            ->join('menus', 'menus.id', '=', 'detail_orders.menu_id')
            ->select('menus.menu_name', 'menus.id', 'menus.menu_type')
            ->where('order_id', $order->id)
            ->where('menus.menu_type', 1)
            ->first();

        $drinkOrder = DB::table('detail_orders')
            ->join('orders', 'orders.id', '=', 'detail_orders.order_id')
            ->join('menus', 'menus.id', '=', 'detail_orders.menu_id')
            ->select('menus.menu_name', 'menus.id', 'menus.menu_type')
            ->where('order_id', $order->id)
            ->where('menus.menu_type', 2)
            ->first();
        
        $foods = Menu::where('menu_type', 1)->where('menu_status', 1)->get();
        $drinks = Menu::where('menu_type', 2)->where('menu_status', 1)->get();
        
        return view('order/detail', [
            'order' => $order,
            'foodOrder' => $foodOrder,
            'drinkOrder' => $drinkOrder,
            'foods' => $foods,
            'drinks' => $drinks,
            'user_role' => Auth::user()->role,
        ]);
    }

    public function store(Request $request)
    {
        $order = Order::get();

        $foodOrder = Menu::where('id', $request->food)->first();
        $drinkOrder = Menu::where('id', $request->drink)->first();
        $bill = $foodOrder->menu_price + $drinkOrder->menu_price;
        
        $lastOrder = Order::orderBy('id', 'desc')->first();
        $lastOrderNumber = $order->isEmpty() ? '1' : substr($lastOrder->order_number, 12) + 1;
        $orderNumber = 'ABC' . Carbon::now()->format('dmY') . '-' . $lastOrderNumber;

        DB::transaction(function () use ($orderNumber, $request, $bill) {
            $order = Order::create([
                'order_number' => $orderNumber,
                'table_number' => $request->table_number,
                'bill' => $bill,
                'status' => 1,
                'user_id' => Auth::id(),
            ]);

            DetailOrder::create([
                'menu_id' => $request->food,
                'order_id' => $order->id,
            ]);

            DetailOrder::create([
                'menu_id' => $request->drink,
                'order_id' => $order->id,
            ]);
        });

        return redirect('order')->with('success', 'Pesanan baru telah ditambahkan.');
    }

    public function confirmation(Order $order)
    {
        Order::where('id', $order->id)
            ->update([                
                'status' => 0,
            ]);

        return redirect('order')->with('success', 'Pembayaran telah dikonfirmasi.');
    }

    public function report()
    {
        if (Auth::user()->role == 1) {
            $orders = Order::where('user_id', Auth::id())->get();
        } else {
            $orders = Order::all();
        }
        
        return view('order.report', [
            'user_name' => Auth::user()->name,
            'orders' => $orders,
        ]);
    }

    public function edit(Order $order)
    {
        $foodOrder = DB::table('detail_orders')
            ->join('orders', 'orders.id', '=', 'detail_orders.order_id')
            ->join('menus', 'menus.id', '=', 'detail_orders.menu_id')
            ->select('menus.menu_name', 'menus.id', 'menus.menu_type')
            ->where('order_id', $order->id)
            ->where('menus.menu_type', 1)
            ->first();

        $drinkOrder = DB::table('detail_orders')
            ->join('orders', 'orders.id', '=', 'detail_orders.order_id')
            ->join('menus', 'menus.id', '=', 'detail_orders.menu_id')
            ->select('menus.menu_name', 'menus.id', 'menus.menu_type')
            ->where('order_id', $order->id)
            ->where('menus.menu_type', 2)
            ->first();
        
        $foods = Menu::where('menu_type', 1)->where('menu_status', 1)->get();
        $drinks = Menu::where('menu_type', 2)->where('menu_status', 1)->get();
        
        return view('order/edit', [
            'order' => $order,
            'foodOrder' => $foodOrder,
            'drinkOrder' => $drinkOrder,
            'foods' => $foods,
            'drinks' => $drinks,
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $foodOrder = Menu::where('id', $request->food)->first();
        $drinkOrder = Menu::where('id', $request->drink)->first();
        // return $foodOrder;      
        $bill = $foodOrder->menu_price + $drinkOrder->menu_price;

        DB::transaction(function () use ($request, $bill, $order) {
            Order::where('id', $order->id)
                ->update([
                    'table_number' => $request->table_number,
                    'bill' => $bill,
                ]);
            
            DB::table('detail_orders')->where('order_id', $order->id)->delete();
            
            DetailOrder::create([
                'menu_id' => $request->food,
                'order_id' => $order->id,
            ]);

            DetailOrder::create([
                'menu_id' => $request->drink,
                'order_id' => $order->id,
            ]);
        });
        
        return redirect('order')->with('success', 'Pesanan berhasil diubah.');
    }

    public function destroy(Order $order)
    {
        Order::destroy($order->id);
        return redirect('order')->with('success', 'Pesanan berhasil dihapus.');
    }
}
