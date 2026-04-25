@extends('layouts.admin')

@section('header', 'Edit Promo / Diskon')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6 max-w-2xl mx-auto">
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.diskon.update', $diskon->ID_Diskon) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Promo</label>
            <input type="text" name="Kode_Diskon" value="{{ old('Kode_Diskon', $diskon->Kode_Diskon) }}" required 
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black uppercase">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Persentase Diskon (%)</label>
            <input type="number" name="Persentase" value="{{ old('Persentase', $diskon->Persentase) }}" required min="1" max="100"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Berlaku</label>
                <input type="date" name="Tanggal_Berlaku" value="{{ old('Tanggal_Berlaku', $diskon->Tanggal_Berlaku) }}" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="Tanggal_Akhir" value="{{ old('Tanggal_Akhir', $diskon->Tanggal_Akhir) }}" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="Statues" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-black focus:border-black">
                <option value="Aktif" {{ old('Statues', $diskon->Statues) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ old('Statues', $diskon->Statues) == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.diskon.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Batal</a>
            <button type="submit" class="px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">Perbarui Promo</button>
        </div>
    </form>
</div>
@endsection
