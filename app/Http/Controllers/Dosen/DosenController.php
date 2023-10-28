<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// import model 
use App\Models\Dosen;
// import View
use Illuminate\View\View;
// tambahkan import untuk munculkan pesan
use Illuminate\Http\RedirectResponse;
// import kode ini untuk akses storage
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    // buat method dalam class untuk view halaman
    public function index(): View{
        // buat property untuk handle data tabel Dosen di database
        $dosen= Dosen::latest()->paginate(5);
        // hubungkan View 
        return view('dosen.index', compact('dosen'));
    }
    // method untk tampilkan halaman input data dosen
    public function create(): View{
        // panggil halaman view input data
        return view('dosen.create');
    }

    // method untuk kirim data dari form inputan ke tabel database
    public function store(Request $request): RedirectResponse
    {
        // kode untuk validasi inputan
            $this->validate($request, [
            'foto'     => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama'     => 'required|min:5',
            'nidn'   => 'required|min:8',
            'jns_kelamin' => 'required|min:5',
            'alamat'   => 'required|min:10'
        ]);

        // kode untuk uploads dan ubah nama file gambar
        $image = $request->file('foto');
        $image->storeAs('public/gambar', $image->hashName());

        // kode untuk kirim data input ke tabel di database
        Dosen::create([
            'foto'     => $image->hashName(),
            'nama'     => $request->nama,
            'nidn'     => $request->nidn,
            'jns_kelamin'=> $request->jns_kelamin,
            'alamat'   => $request->alamat
        ]);
        // kode untuk redirect halaman ketika sukses simpan data ke database
        return redirect()->route('dosen.index')->with(['success' => 'Data Sukses Disimpan!']);



    }
    // buat metdhod untuk mengambil data di tabel databse berdasarkan ID
    public function edit(string $id): View
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    // buat method untuk kirimkan dan ubah data di tabel database
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required',
            'nidn' => 'required',
            'jns_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        $dosen = Dosen::findOrFail($id);
        // percabangan IF
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $foto->storeAs('public/gambar', $foto->hashName());
            Storage::delete('public/gambar/'.$dosen->image);
            $dosen->update([
                'foto' => $foto->hashName(),'nama' => $request->nama,
                'nidn' => $request->nidn,
                'jns_kelamin' => $request->jns_kelamin,
                'alamat' => $request->alamat
            ]);
        } else {
            $dosen->update([
                'nama' => $request->nama,
                'nidn' => $request->nidn,
                'jns_kelamin' => $request->jns_kelamin,
                'alamat' => $request->alamat
            ]);
        }
        return redirect()->route('dosen.index')->with(['success'=> 'Data Berhasil Diubah!']);
    }

    // buat method untuk hapus data
    public function destroy($id): RedirectResponse
    {
        $dosen = Dosen::findOrFail($id);
        Storage::delete('public/gambar/'. $dosen->foto);
        $dosen->delete();
        
        return redirect()->route('dosen.index')->with(['success'=> 'Data Berhasil Dihapus!']);
    }
    // buat method untuk tampilkan view data detail 
    public function show(string $id): View
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.show', compact('dosen'));
    }

}


