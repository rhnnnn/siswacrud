<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SiswaController extends Controller
{
    function index()
    {
        $siswas = Siswa::paginate(10);
        return view('pages.siswa', compact('siswas'));
    }

    // public function store(Request $request)
    // {
    //     //
    //     $validatedData=$request->validate([
    //         'nis' => 'required',
    //         'nama' => 'required',
    //         'kelas' => 'required',
    //         'jenis_kelamin' => 'required',
    //         'no_telp' => 'required',
    //         'alamat' => 'required',
    //         'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     Siswa::create([
    //         'nis' => $validatedData['nis'],
    //         'nama' => $validatedData['nama'],
    //         'kelas' => $validatedData['kelas'],
    //         'kelamin' => $validatedData['jenis_kelamin'],
    //         'telp' => $validatedData['no_telp'],
    //         'alamat' => $validatedData['alamat'],
    //         'foto' => $validatedData['foto']
    //     ]);

    //     // dd($simpan);

    //     // // Process upload foto
    //     // if ($request->file('foto') == "") {

    //     //     dd($simpan);

    //     // } elseif ($request->hasFile('foto')) {
    //     //     $image = $request->file('foto');

    //     //     $image->move(public_path('photos'), $image->getClientOriginalName());

    //     //     $simpan = Siswa::create([
    //     //         'nis' => $request->nis,
    //     //         'nama' => $request->nama,
    //     //         'kelas' => $request->kelas,
    //     //         'kelamin' => $request->jenis_kelamin,
    //     //         'telp' => $request->no_telp,
    //     //         'alamat' => $request->alamat,
    //     //         'foto' => $image->getClientOriginalName()
    //     //     ]);
    //     // }

    //     // if ($simpan) {
    //     //     // Redirect with success message
    //     //     Alert::success('Simpan Data', 'Data siswa sukses diSimpan');

    //     //     return redirect('/')->with(['success' => 'Data berhasil disimpan!']);
    //     // } else {
    //     //     // Redirect with error message
    //     //     Alert::error('Simpan Data', 'Data siswa gagal disimpan');
    //     //     return redirect('/')->with(['error' => 'Data gagal disimpan!']);
    //     // }

    // }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'nis' => 'required',
            'nm' => 'required',
            'kls' => 'required',
            'jkl' => 'required',
            'tlp' => 'required',
            'alamat' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|max:2048'
        ]);
        
        // Process upload foto
        if ($request->file('foto') == "") {
            $simpan = Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->nm,
                'kelas' => $request->kls,
                'kelamin' => $request->jkl,
                'telp' => $request->tlp,
                'alamat' => $request->alamat,
                'foto' => ''
            ]);
        } elseif ($request->hasFile('foto')) {
            $image = $request->file('foto');
            
            $image->move(public_path('storage/photos'), $image->getClientOriginalName());
            
            $simpan = Siswa::create([
                'nis' => $request->nis,
                'nama' => $request->nm,
                'kelas' => $request->kls,
                'kelamin' => $request->jkl,
                'telp' => $request->tlp,
                'alamat' => $request->alamat,
                'foto' => 'storage/photos/'.$image->getClientOriginalName()
            ]);
        }
        
        if ($simpan) {
            // Redirect with success message
            Alert::success('Simpan Data', 'Data siswa sukses diSimpan');
            
            return redirect('/')->with(['success' => 'Data berhasil disimpan!']);
        } else {
            // Redirect with error message
            Alert::error('Simpan Data', 'Data siswa gagal disimpan');
            return redirect('/')->with(['error' => 'Data gagal disimpan!']);
        }
        
    }
}
