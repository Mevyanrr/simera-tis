<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    // GET semua menu
    public function index()
    {
        $menus = Menu::all();
        return response()->json($menus);
    }

    // GET menu berdasarkan id
    public function show($id)
    {
        $menu = Menu::find($id);

        if(!$menu){
            return response()->json([
                "message" => "Menu tidak ditemukan"
            ],404);
        }

        return response()->json($menu);
    }

    // POST tambah menu
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:100',
            'kategori' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'deskripsi' => 'nullable|string'
        ]);

        $menu = Menu::create($validated);

        return response()->json([
            "message" => "Menu berhasil ditambahkan",
            "data" => $menu
        ],201);
    }

    // UPDATE menu
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if(!$menu){
            return response()->json([
                "message"=>"Menu tidak ditemukan"
            ],404);
        }

        $menu->update($request->all());

        return response()->json([
            "message"=>"Menu berhasil diupdate",
            "data"=>$menu
        ]);
    }

    // DELETE menu
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if(!$menu){
            return response()->json([
                "message"=>"Menu tidak ditemukan"
            ],404);
        }

        $menu->delete();

        return response()->json([
            "message"=>"Menu berhasil dihapus"
        ]);
    }
}