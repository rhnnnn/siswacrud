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
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
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
                'foto' => '',
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
                'foto' => 'storage/photos/' . $image->getClientOriginalName(),
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

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'nis' => 'required',
            'nm' => 'required',
            'kls' => 'required',
            'jkl' => 'required',
            'tlp' => 'required',
            'alamat' => 'required',
            'foto' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $upd = Siswa::find($id);
        if ($request->file('foto') == "") {
            $upd->update([
                'nis' => $request->nis,
                'nama' => $request->nm,
                'kelas' => $request->kls,
                'kelamin' => $request->jkl,
                'telp' => $request->tlp,
                'alamat' => $request->alamat,
            ]);
        } else {
            //proses upload gambar baru
            $image = $request->file('foto');

            $image->move(public_path('storage/photos'), $image->getClientOriginalName());

            $upd->update([
                'nis' => $request->nis,
                'nama' => $request->nm,
                'kelas' => $request->kls,
                'kelamin' => $request->jkl,
                'telp' => $request->tlp,
                'alamat' => $request->alamat,
                'foto' => 'storage/photos/' . $image->getClientOriginalName(),
            ]);
        }
        if ($upd) {
            //redirect dengan pesan sukses
            Alert::success('Ubah Data','data siswa sukses diubah');
            return redirect('/');
        } else {
            //redirect dengan pesan error
            Alert::error('Ubah Data', 'data siswa gagal diubah');
            return redirect('/');
        }
    }

    public function destroy($id){
        $del=Siswa::find($id);
        $del->delete();

        if ($del) {
            //redirect dengan pesan sukses
            Alert::success('Hapus Data','data siswa sukses dihapus');
            return redirect()->back();
        } else {
            //redirect dengan pesan error
            Alert::error('Hapus Data', 'data siswa gagal dihapus');
            return redirect()->back();
        }
    }
}
