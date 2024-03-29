@extends('layouts.app',['title'=>'Home']) 
@section('content') 
{{-- start table from aku_crud --}}
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-6">
                    <h2>Data <b> Siswa</b></h2>
                </div>
                <div class="col-6">
                    <button href="#addGedungModal" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahSiswa">Add New Data</button>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <div class="row">
                {{--
                <div class="col-md-3">
                    <span>Rows per page:</span>
                    <select class="custom-select form-select" onchange="changePaginationLength(this.value)">
                        <option value="10" {{ $gedungs->perPage() == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $gedungs->perPage() == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $gedungs->perPage() == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $gedungs->perPage() == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <span>Filter by AM:</span>
                    <select class="form-select" id="filter-am" name="filter-am">
                        <option value="" {{ request()->input('filter-am') == '' ? 'selected' : '' }}>All AMs </option>
                        @foreach ($ams as $am)
                        <option value="{{ $am }}" {{ request()->input('filter-am') == $am ? 'selected' : '' }}> {{ $am }} </option>
                        @endforeach
                    </select>
                </div>
                --}} {{--
                <div class="col-md-3 pb-2 pt-2"></div>
                --}}
                <div class="col-md-3 form-inline">
                    {{-- <label>Search</label> --}}
                    <input type="text" class="form-control mr-sm-2" id="search" name="search" oninput="liveSearch()" placeholder="Search by Name or AMs" />
                </div>
            </div>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Foto</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @php $no=1; @endphp 
                @foreach ($siswas as $siswa)
                <tr>
                    <td>{{$no++}}</td>
                    <td>
                        @if ($siswa->foto)
                        <img src="{{asset($siswa->foto)}}" alt="" height="125" style="border-radius: 5px;" />
                        @else {{-- <img src="{{ asset('assets/img/default/OIP.jpeg') }}" alt="" width="75" height="75" style="border-radius: 5px;" /> --}}
                        <img src="{{ asset('assets/img/default/OIP.jpeg') }}" alt="" height="125" style="border-radius: 5px;" />
                        @endif
                    </td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas }}</td>
                    <td>{{ $siswa->kelamin }}</td>
                    <td>{{ $siswa->telp }}</td>
                    <td>{{ $siswa->alamat }}</td>
                    <td>
                        <a href="#" class="edit" data-bs-toggle="modal" data-bs-target="#ubahSiswa-{{$siswa->id}}">
                            <i class="fa-regular fa-pen-to-square" title="Edit" data-bs-toggle="tooltip"></i>
                        </a>
                        <a href="#" class="delete" data-bs-toggle="modal" data-bs-target="#hapusSiswa-{{$siswa->id}}">
                            <i class="fa-regular fa-trash-can" title="Delete" data-bs-toggle="tooltip"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="hint-text">Showing <b>{{ $siswas->firstItem() }}</b> to <b>{{ $siswas->lastItem() }}</b> of <b>{{ $siswas->total() }}</b> entries</div>
            <ul class="pagination">
                @if ($siswas->currentPage() > 1)
                <li class="page-item">
                    <a href="{{ $siswas->previousPageUrl() }}" class="page-link">Previous</a>
                </li>
                @endif @for ($i = 1; $i <= $siswas->lastPage(); $i++)
                <li class="page-item{{ $siswas->currentPage() == $i ? ' active' : '' }}">
                    <a href="{{ $siswas->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
                @endfor @if ($siswas->currentPage() < $siswas->lastPage())
                <li class="page-item">
                    <a href="{{ $siswas->nextPageUrl() }}" class="page-link">Next</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
{{-- emd table from aku_crud --}}

<!-- Modal tambah-->

<x-modal-component id="tambahSiswa" idTitle="tambahSiswaTitle" title="Add Siswa" formAction="/" method="POST" classHeader="bg-success text-white">
    <div class="mb-3">
        <label class="form-label">NIS</label>
        <input type="number" min="1" max="99999" minlength="1" maxlength="5" class="form-control" name="nis" placeholder="masukkan nis siswa"/>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="nm" placeholder="masukkan nama siswa" />
    </div>
    <div class="mb-3">
        <label class="form-label">Kelas</label>
        <select name="kls" class="form-select">
            <option>Pilih KElas</option>
            <option value="XII-Abydos">XII-Abydos</option>
            <option value="XII-Millenium">XII-Millenium</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select class="form-select" name="jkl">
            <option selected>Pilih Jenis Kelamin</option>
            <option value="lakilaki">Laki-Laki</option>
            <option value="perembuan">Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Telp</label>
        <input type="number" min="1" max="9999999999999" minlength="9" maxlength="13" class="form-control" name="tlp" placeholder="masukkan no. telp siswa"/>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat Domisili</label>
        <textarea class="form-control" name="alamat" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="file-input">
            Foto
        </label>
        <div class="d-flex justify-content-center mt-2">
            <div class="card" style="background-color: #f5f5f5; max-width: 75%;">
                <div class="card-body d-flex align-items-center flex-column">
                    <img id="image-preview" src="" alt="Image Preview" class="img-fluid rounded image-preview mb-3" />
                    <input type="file" name="foto" id="file-input" class="form-control" accept="image/*" onchange="previewImage()" />
                </div>
            </div>
        </div>
    </div>
</x-modal-component>

{{-- modal ubah --}}
@foreach ($siswas as $siswa)
<x-modal-component id="ubahSiswa-{{$siswa->id}}" idTitle="ubahSiswaTitle" title="Edit Siswa" formAction="/update/{{$siswa->id}}" method="PUT" classHeader="bg-warning" >
    <div class="mb-3">
        <label class="form-label">NIS</label>
        <input type="number" min="1" max="99999" minlength="1" maxlength="5" class="form-control" name="nis" value="{{$siswa->nis}}" />
    </div>
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" class="form-control" name="nm" placeholder="masukkan nama siswa" value="{{$siswa->nama}}" />
    </div>
    <div class="mb-3">
        <label class="form-label">Kelas</label>
        <select name="kls" class="form-select">
            <option value="XII-Abydos" {{$siswa->kelas=="XII-Abydos" ? "selected":""}}>XII-Abydos</option>
            <option value="XII-Millenium" {{$siswa->kelas=="XII-Millenium" ? "selected":""}}>XII-Millenium</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Jenis Kelamin</label>
        <select class="form-select" name="jkl">
            <option value="lakilaki" {{$siswa->kelamin=="lakilaki" ? "selected" : ""}}>Laki-Laki</option>
            <option value="perembuan" {{$siswa->kelamin=="perembuan" ? "selected" : ""}}>Perempuan</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Telp</label>
        <input type="number" min="1" max="9999999999999" minlength="9" maxlength="13" class="form-control" name="tlp" value="{{$siswa->telp}}" />
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat Domisili</label>
        <textarea class="form-control" name="alamat" rows="3">{{$siswa->alamat}}</textarea>
    </div>
    <div class="mb-3">
        <label for="file-input-edit-{{$siswa->id}}">
            Foto
        </label>
        <div class="d-flex justify-content-center mt-2">
            <div class="card" style="background-color: #f5f5f5; max-width: 75%;">
                <div class="card-body d-flex align-items-center flex-column edit-modal" id="up-preview-image-{{$siswa->id}}" data-foto-url="{{$siswa->foto}}">
                    <img id="image-preview-edit-{{$siswa->id}}" src="" alt="Image Preview" class="img-fluid rounded image-preview-edit mb-3"  />
                    <input type="file" name="foto" id="file-input-edit-{{$siswa->id}}" class="form-control" accept="image/*" onchange="previewImageEdit({{$siswa->id}})" />
                </div>
            </div>
        </div>
    </div>
</x-modal-component>

@endforeach 

{{-- Modal HApus --}}
@foreach ($siswas as $siswa)
<x-modal-component id="hapusSiswa-{{$siswa->id}}" idTitle="hapusSiswaTitle" title="Delete Siswa" formAction="/destroy/{{$siswa->id}}" method="DELETE" classHeader="bg-danger text-white">
<h4 class="text-center">Apakah anda yakin untuk menghapus data <b class="text-danger">{{$siswa->nama}}</b> ?</h4>
</x-modal-component>
@endforeach

@endsection
