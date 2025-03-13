@extends('layouts.app')

@section('title', 'Users')

@section('main')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-md-5 align-self-center">
            <h4 class="page-title">{{$desk_menu}}</h4>
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
    
    <div class="tab-content">
        <div  id="note-full-container" class="note-has-grid row">
            <div class="col-md-12 single-note-item ho">
                <div class="card card-body">
                    <div class="table-responsive">
                        <table id="scroll_ver" class="table table-striped table-bordered display no-wrap" style="width:100%; font-size: 14px">
                            <thead>
                                <tr>
                                    {{-- <th class="text-center" style="width: 4%;">No.</th> --}}
                                    <th class="text-center" style="width: 10%;">Username</th>
                                    <th class="text-center" style="width: 25%;">Email</th>
                                    <th class="text-center" style="width: 31%;">Nama</th>
                                    <th class="text-center" style="width: 5%;">Role</th>
                                    <th class="text-center" style="width: 20%;"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody id="user_body">
                                
                                @foreach($users as $row )
                                
                                <tr id="row-{{ $row->id }}">
                                    {{-- <td style="width: 10%">{{ $row->username }}</td> --}}
                                    <td >{{ $row->username }}</td>
                                    <td >{{ $row->email }}</td>
                                    <td >{{ $row->name }}</td>
                                    <td >{{$row->role->role_name }}</td>
                                    
                                    <td class="text-center">
                                        <a onclick="modal_edit('{{ $row->id }}')" id="btn-edit"  class="btn btn-primary btn-sm" style="color: white"><i class="fa fa-edit"></i> Edit</a>
                                        <a onclick="del('{{ $row->id }}')"    class="btn btn-danger btn-sm" style="color: white"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                                
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white" id="primary-header-modalLabel">
                    EDIT USER
                </h4>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="edit_user_form">
                    <input type="hidden" id="edit_id"> 
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="edit_username" id="edit_username" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select class="form-control" id="edit_role" required>
                            <!-- Role akan diisi oleh AJAX -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light"
                            data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Simpan</button>
                
                    </div>
                 </form>
            </div>
        </div>
    </div>
    </div>

<div id="created" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="primary-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-primary">
                <h4 class="modal-title text-white" id="primary-header-modalLabel">
                    NEW USER
                </h4>
                <button type="button" class="close ml-auto" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="form_add" >
                    @csrf
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="custom-select col-12" name="role" id="role" required>
                            
                            @foreach($roles as $role )
                                <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                        @endforeach
                        
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<script>

    $(function(){
        $("#form_add").submit(function (event){
            event.preventDefault();
            $.ajax({
                url: "{{ route('users.store') }}", // URL endpoint
                method: "POST",
                data: $(this).serialize(), // Data form
                success:function (response){
                        Swal.fire({
                        title: "Berhasil!",
                        text: response.message,
                        icon: "success",
                        timer: 2000, // Auto-close dalam 2 detik
                        showConfirmButton: false
                    });

                    $("#user_body").append(`
                    <tr>
                        <td>${response.data.username}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.name}</td>
                        <td>${response.data.role ? response.data.role.role_name : 'Tidak Ada Role'}</td>
                         <td class="text-center">
                            <a onclick="modal_edit('${response.data.id}')" class="btn btn-primary btn-sm" style="color: white">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a onclick="del('${response.data.id}')" class="btn btn-danger btn-sm" style="color: white">
                                <i class="fa fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                `);

                    $("#created").modal('hide'); // Tutup modal
                    $("#form_add")[0].reset(); // Reset form

                },
                error:function(xhr){
                    Swal.fire({
                    title: "Gagal!",
                    text: "Terjadi kesalahan: " + xhr.responseJSON.message,
                    icon: "error"
                });
                }
            });


        });

    });

    $(document).on("submit", "#edit_user_form", function(e) {
        e.preventDefault();

        let id = $("#edit_id").val();
        let formData = {
            username: $("#edit_username").val(),
            name: $("#edit_name").val(),
            email: $("#edit_email").val(),
            role_id: $("#edit_role").val(),
            _token: "{{ csrf_token() }}"
        };

        $.ajax({
        type: "PUT",
        url: `/users/${id}`,
        data: formData,
        dataType: "json",
        success: function(response) {
            if (response.success) {
                // Update baris tabel yang sesuai
                        $(`#row-${id}`).html(`
                        <td>${response.data.username}</td>
                        <td>${response.data.email}</td>
                        <td>${response.data.name}</td>
                            <td>${response.data.role ? response.data.role.role_name : 'Tidak Ada Role'}</td>
                            <td class="text-center">
                                <a onclick="modal_edit('${response.data.id}')" class="btn btn-primary btn-sm" style="color: white">
                                    <i class="fa fa-edit"></i> Edit
                                </a>
                                <a onclick="del('${response.data.id}')" class="btn btn-danger btn-sm" style="color: white">
                                    <i class="fa fa-trash"></i> Hapus
                                </a>
                            </td>
                        `);

                        // Tampilkan SweetAlert sukses
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });

                        // Tutup modal edit
                        $("#editUserModal").modal("hide");
                        // window.location.reload();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

    // Function untuk menampilkan modal edit dan mengisi data dari API
function modal_edit(id) {
    $.ajax({
        type: "GET",
        url: `/users/${id}/edit`,
        success: function(response) {
            if (response.success) {
                let user = response.data;
                
                // Isi input form dengan data dari API
                $("#edit_id").val(user.id);
                $("#edit_username").val(user.username);
                $("#edit_name").val(user.name);
                $("#edit_email").val(user.email);

                // Kosongkan select role sebelum menambahkan option
                $("#edit_role").html("");

                // Tambahkan opsi role dari response
                response.roles.forEach(role => {
                    let selected = user.role_id === role.id ? "selected" : "";
                    $("#edit_role").append(`<option value="${role.id}" ${selected}>${role.role_name}</option>`);
                });

                // Tampilkan modal edit
                $("#editUserModal").modal("show");
            }
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
}


function del(id) {
    Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, Hapus!",
        cancelButtonText: "Batal"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: `/users/${id}`,
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        // Hapus baris tabel yang sesuai
                        $(`#row-${id}`).fadeOut(500, function () {
                            $(this).remove();
                        });

                        // Tampilkan SweetAlert sukses
                        Swal.fire({
                            title: "Terhapus!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
                }
            });
        }
    });
}

</script>

@endsection