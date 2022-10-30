<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $foods = Menu::where('menu_type', 1)->get();
        $drinks = Menu::where('menu_type', 2)->get();

        return view('menu/index', [
            'foods' => $foods,
            'drinks' => $drinks,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Menu::create([
            'menu_name' => $request->menu_name,
            'menu_price' => $request->menu_price,
            'menu_type' => $request->menu_type,
            'menu_status' => $request->menu_status,
        ]);

        return redirect('menu')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        return view('menu/edit', [
            'menu' => $menu,
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        Menu::where('id', $menu->id)
            ->update([
                'menu_name' => $request->menu_name,
                'menu_price' => $request->menu_price,
                'menu_type' => $request->menu_type,
                'menu_status' => $request->menu_status,
            ]);
        
        return redirect('menu')->with('success', 'Menu berhasil diubah.');
    }

    public function destroy(Menu $menu)
    {
        Menu::destroy($menu->id);
        return redirect('menu')->with('success', 'Menu berhasil dihapus.');

    }
}
