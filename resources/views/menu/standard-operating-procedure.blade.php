@extends('layouts.app')

@section('title', 'Standard Operating Procedure')

@section('main')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <h4 class="page-title">Standard Operating Procedure</h4>
        </div>
        <div class="col-md-7 d-flex justify-content-end align-self-center d-none d-md-flex">
            <div class="d-flex">
                <button class="btn btn-primary mr-1" data-toggle="modal" data-target="#created">
                    <i class="mdi mdi-plus-circle mr-2"></i> Create
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid note-has-grid">
    <ul class="nav nav-pills p-3 bg-light mb-3 rounded-pill align-items-center">
        <li class="nav-item">
            <a href="#" class="nav-link rounded-pill note-link d-flex align-items-center active px-2 px-md-3 mr-0 mr-md-2"  id="ho">
                <i class="fas fa-id-badge mr-1"></i>
                <span class="d-none d-md-block">Head Office</span>
            </a> 
        </li>
        <li class="nav-item"> 
            <a href="#" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="cabang">
                <i class="fas fa-dolly-flatbed mr-1"></i>
                <span class="d-none d-md-block">Branch</span>
            </a> 
        </li>
        <li class="nav-item"> 
            <a href="#" class="nav-link rounded-pill note-link d-flex align-items-center px-2 px-md-3 mr-0 mr-md-2" id="subsi">
                <i class="fas fa-clone mr-1"></i>
                <span class="d-none d-md-block">Subsidiary</span>
            </a> 
        </li>
        <li class="nav-item ml-auto"> 
            <a href="#" class="nav-link btn-success rounded-pill d-flex align-items-center px-3">
                <i class="fas fa-file-excel mr-2"></i> Export
            </a> 
        </li>
        <li class="nav-item ml-2"> 
            <button class="nav-link btn btn-danger rounded-pill d-flex align-items-center px-3" data-toggle="modal" data-target="#restore">
                <i class="fas fa-archive mr-2"></i> Restore Data
            </button> 
        </li>
    </ul>
    <div class="tab-content">
        <div  id="note-full-container" class="note-has-grid row">
            <div class="col-md-12 single-note-item ho">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="scroll_ver" class="table table-striped table-bordered display no-wrap" style="width:100%; font-size: 14px">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 4%;">No.</th>
                                    <th class="text-center" style="width: 10%;">Kode SOP</th>
                                    <th class="text-center">Divisi</th>
                                    <th class="text-center">Penanggung Jawab</th>
                                    <th class="text-center">Tipe SOP</th>
                                    <th class="text-center" style="width: 5%;">Tanggal Upload</th>
                                    <th class="text-center" style="width: 10%;">File</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 4%;" class="text-center">1.</td>
                                    <td style="width: 10%;" class="text-center">SOP/HO-0001</td>
                                    <td>Informasi Teknologi</td>
                                    <td>David Ruskandi</td>
                                    <td>IK (Instruksi Kerja)</td>
                                    <td style="width: 5%;" class="text-center">10/02/2025</td>
                                    <td style="width: 10%;" class="text-center">
                                        <button type="button" class="btn btn-info btn-circle-lg">
                                            <i class="fa fa-file text-white"></i>
                                        </button>
                                    </td>
                                    <td style="width: 10%;" class="text-center">
                                        <button type="button" class="btn btn-danger btn-circle-lg ml-1"  data-toggle="modal" data-target="#delete" >
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 single-note-item cabang">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="scroll_ver" class="table table-striped table-bordered display no-wrap" style="width:100%; font-size: 14px">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 4%;">No.</th>
                                    <th class="text-center" style="width: 10%;">Kode SOP</th>
                                    <th class="text-center">Regional</th>
                                    <th class="text-center">Cabang</th>
                                    <th class="text-center">Penanggung Jawab</th>
                                    <th class="text-center">Tipe SOP</th>
                                    <th class="text-center" style="width: 5%;">Tanggal Upload</th>
                                    <th class="text-center" style="width: 10%;">File</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 4%;" class="text-center">1.</td>
                                    <td style="width: 10%;" class="text-center">SOP/BR-0001</td>
                                    <td style="width: 20%;">Kalimantan Selatan</td>
                                    <td>Banjarmasin</td>
                                    <td>Tatang Budi</td>
                                    <td>IM (Internal Memo)</td>
                                    <td style="width: 5%;" class="text-center">10/02/2025</td>
                                    <td style="width: 10%;" class="text-center">
                                        <button type="button" class="btn btn-info btn-circle-lg">
                                            <i class="fa fa-file text-white"></i>
                                        </button>
                                    </td>
                                    <td style="width: 10%;" class="text-center">
                                        <button type="button" class="btn btn-danger btn-circle-lg ml-1"  data-toggle="modal" data-target="#delete">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12 single-note-item subsi">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="scroll_ver" class="table table-striped table-bordered display no-wrap" style="width:100%; font-size: 14px">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 4%;">No.</th>
                                    <th class="text-center" style="width: 10%;">Kode SOP</th>
                                    <th class="text-center">Nama Perusahaan</th>
                                    <th class="text-center">Penanggung Jawab</th>
                                    <th class="text-center">Tipe SOP</th>
                                    <th class="text-center" style="width: 5%;">Tanggal Upload</th>
                                    <th class="text-center" style="width: 10%;">File</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 4%;" class="text-center">1.</td>
                                    <td style="width: 10%;" class="text-center">SOP/SU-0001</td>
                                    <td>PT. Internasional Asia Pasifik Sinergi</td>
                                    <td>Kristianto</td>
                                    <td>Kebijakan</td>
                                    <td style="width: 5%;" class="text-center">10/02/2025</td>
                                    <td style="width: 10%;" class="text-center">
                                        <button type="button" class="btn btn-info btn-circle-lg">
                                            <i class="fa fa-file text-white"></i>
                                        </button>
                                    </td>
                                    <td style="width: 10%;" class="text-center">
                                        <button type="button" class="btn btn-danger btn-circle-lg ml-1"  data-toggle="modal" data-target="#delete">
                                            <i class="fas fa-trash text-white"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection