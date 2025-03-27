@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('main')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <h4 class="page-title">Struktur Organisasi</h4>
        </div>
        <div class="col-md-7 d-flex justify-content-end align-self-center d-none d-md-flex">
            <div class="d-flex">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-plus-circle mr-2"></i> Create
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal_ho">Head Office</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal_branch">Branch</a>
                        <a class="dropdown-item" data-toggle="modal" data-target="#modal_subsidiary">Subsidiary</a>
                    </div>
                </div>

                {{-- <button class="btn btn-primary mr-1" data-toggle="modal" data-target="#created">
                    <i class="mdi mdi-plus-circle mr-2"></i> Create
                </button> --}}
            </div>
        </div>
    </div>
</div>

<div id="modal_ho" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white" id="primary-header-modalLabel">
                    SOP/HO-0002
                </h4>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              
            
                <div class="form-group">
                    <label>Divisi</label>
                    <select class="custom-select col-12 select2" name="division" id="division" onchange="fetchDivisionHead()">
                        <option selected="">Loading...</option>
                    </select>
                    <p id="error-division" style="color: red; display: none;"></p>
                </div>
                <div class="form-group">
                    <label>Penanggung Jawab</label>
                    <input type="text" class="form-control" name="head_name" id="head_name" readonly>
                    <input type="hidden" class="form-control" name="head_id" id="head_id" readonly>
                    <p id="error-head" style="color: red; display: none;"></p>
                </div>
                <div class="form-group">
                    <label>File</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile" accept="application/pdf" name="file">
                        <label class="custom-file-label form-control" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Upload File</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div id="modal_branch" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white" id="primary-header-modalLabel">
                    SOP/BR-0002
                </h4>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Regional</label>
                    <select class="custom-select col-12 select2" name="region" id="region" onchange="fetchBranchByRegional()">
                        <option selected="">Loading...</option>
                       
                    </select>
                    <p id="error-region" style="color: red; display: none;"></p>
                </div> 
            
                <div class="form-group">
                    <label>Cabang</label>
                    <select class="custom-select col-12 select2" name="branch" id="branch" onchange="fetchHeadBranchByBranch()" >
                        <option selected="">Loading...</option>
                    </select>
                    <p id="error-branch" style="color: red; display: none;"></p>
                </div>
                <div class="form-group">
                    <label>Penanggung Jawab</label>
                    <input type="text" class="form-control" name="branch_head_name" id="branch_head_name" readonly>
                    <input type="hidden" class="form-control" name="branch_head_id" id="branch_head_id" readonly>
                    <p id="error-heads" style="color: red; display: none;"></p>
                </div>
                <div class="form-group">
                    <label>File</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile" accept="application/pdf" name="file">
                        <label class="custom-file-label form-control" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Upload File</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div> 


<div id="modal_subsidiary" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white" id="primary-header-modalLabel">
                    SOP/SU-0002
                </h4>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                    <label>Nama Perusahaan</label>
                    <select class="custom-select col-12 select2" name="company" id="company"  onchange="fetchHeadCompanyByid()">
                        <option selected="">Loading...</option>
                    </select>
                    <p id="error-company" style="color: red; display: none;"></p>
                </div> 
                <div class="form-group">
                    <label>Penanggung Jawab</label>
                    <input type="text" class="form-control" name="sub_head_name" id="sub_head_name" readonly>
                    <input type="hidden" class="form-control" name="sub_head_id" id="sub_head_id" readonly>
                    <p id="error-head" style="color: red; display: none;"></p>
                </div>
                <div class="form-group">
                    <label>File</label>
                    <div class="custom-file mb-3">
                        <input type="file" class="custom-file-input" id="customFile" accept="application/pdf" name="file">
                        <label class="custom-file-label form-control" for="customFile">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Upload File</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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
                                    <th class="text-center" style="width: 10%;">Kode SO</th>
                                    <th class="text-center" style="width: 25%;">Divisi</th>
                                    <th class="text-center" style="width: 31%;">Penanggung Jawab</th>
                                    <th class="text-center" style="width: 5%;">Tanggal Upload</th>
                                    <th class="text-center" style="width: 10%;">File</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 4%;" class="text-center">1.</td>
                                    <td style="width: 10%;" class="text-center">SO/HO-0001</td>
                                    <td style="width: 25%;">Informasi Teknologi</td>
                                    <td style="width: 31%;">David Ruskandi</td>
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
                                    <th class="text-center" style="width: 10%;">Kode SO</th>
                                    <th class="text-center" style="width: 20%;">Regional</th>
                                    <th class="text-center" style="width: 15%;">Cabang</th>
                                    <th class="text-center" style="width: 21%;">Penanggung Jawab</th>
                                    <th class="text-center" style="width: 5%;">Tanggal Upload</th>
                                    <th class="text-center" style="width: 10%;">File</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 4%;" class="text-center">1.</td>
                                    <td style="width: 10%;" class="text-center">SO/BR-0001</td>
                                    <td style="width: 20%;">Kalimantan Selatan</td>
                                    <td style="width: 15%;">Banjarmasin</td>
                                    <td style="width: 21%;">Tatang Budi</td>
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
                                    <th class="text-center" style="width: 10%;">Kode SO</th>
                                    <th class="text-center" style="width: 30%;">Nama Perusahaan</th>
                                    <th class="text-center" style="width: 26%;">Penanggung Jawab</th>
                                    <th class="text-center" style="width: 5%;">Tanggal Upload</th>
                                    <th class="text-center" style="width: 10%;">File</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 4%;" class="text-center">1.</td>
                                    <td style="width: 10%;" class="text-center">SO/SU-0001</td>
                                    <td style="width: 30%;">PT. Internasional Asia Pasifik Sinergi</td>
                                    <td style="width: 26%;">Kristianto</td>
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

<script>
    $(function(){

        


        

    })

    


</script>



@endsection