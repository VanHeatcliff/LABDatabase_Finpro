<?php

namespace App\Http\Controllers\Diskon;

use App\Http\Controllers\Controller;
use App\Models\DiskonPromosi;
use App\Helpers\IDGenerator;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
    {
        $diskon = DiskonPromosi::orderBy('ID_Diskon', 'desc')->get();
        return view('admin.diskon.index', compact('diskon'));
    }

    public function create()
    {
        return view('admin.diskon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Kode_Diskon' => 'required|unique:diskon_promosi,Kode_Diskon',
            'Persentase' => 'required|numeric|min:1|max:100',
            'Tanggal_Berlaku' => 'required|date',
            'Tanggal_Akhir' => 'required|date|after_or_equal:Tanggal_Berlaku',
            'Statues' => 'required|in:Aktif,Tidak Aktif'
        ]);

        $id = IDGenerator::generate('diskon_promosi', 'ID_Diskon', 'DS', 3);

        DiskonPromosi::create([
            'ID_Diskon' => $id,
            'Kode_Diskon' => $request->Kode_Diskon,
            'Persentase' => $request->Persentase,
            'Tanggal_Berlaku' => $request->Tanggal_Berlaku,
            'Tanggal_Akhir' => $request->Tanggal_Akhir,
            'Statues' => $request->Statues
        ]);

        return redirect()->route('admin.diskon.index')->with('success', 'Promo berhasil ditambahkan');
    }

    public function edit($id)
    {
        $diskon = DiskonPromosi::findOrFail($id);
        return view('admin.diskon.edit', compact('diskon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Kode_Diskon' => 'required|unique:diskon_promosi,Kode_Diskon,'.$id.',ID_Diskon',
            'Persentase' => 'required|numeric|min:1|max:100',
            'Tanggal_Berlaku' => 'required|date',
            'Tanggal_Akhir' => 'required|date|after_or_equal:Tanggal_Berlaku',
            'Statues' => 'required|in:Aktif,Tidak Aktif'
        ]);

        $diskon = DiskonPromosi::findOrFail($id);
        $diskon->update([
            'Kode_Diskon' => $request->Kode_Diskon,
            'Persentase' => $request->Persentase,
            'Tanggal_Berlaku' => $request->Tanggal_Berlaku,
            'Tanggal_Akhir' => $request->Tanggal_Akhir,
            'Statues' => $request->Statues
        ]);

        return redirect()->route('admin.diskon.index')->with('success', 'Promo berhasil diperbarui');
    }

    public function destroy($id)
    {
        $diskon = DiskonPromosi::findOrFail($id);
        $diskon->delete();

        return redirect()->route('admin.diskon.index')->with('success', 'Promo berhasil dihapus');
    }
}
