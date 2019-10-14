@extends('layouts.app')

@section('judul')
User
@endsection

@section('title')
Daftar User
@endsection

@section('breadcrumb')
@parent
<li>user</li>
@endsection

@section('content')     

<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
<br>
<br>
<table class="table table-striped">
  <thead>
    <tr>
      <th width="30">No</th>
      <th>Foto</th>
      <th>Nama</th>
      <th>Nama User</th>
      <th>Level</th>
      <th width="100">Aksi</th>
    </tr>
  </thead>
  <tbody></tbody>
</table>
@include('user.form')
@endsection

@section('script')
<script type="text/javascript">
  var table, save_method;
  $(function(){
    table = $('.table').DataTable({
      "processing" : true,
      "ajax" : {
        "url" : "{{ route('user.data') }}",
        "type" : "GET"
      }
    }); 
    
    $("#modal-form form").on('submit', function(e){ // Ketika tombol simpan di klik
      e.preventDefault();
      var id = $('#id').val();
      if(save_method == "add") url = "{{ route('user.store') }}";
      else url = "user/"+id;
      
      var data = new FormData();
      data.append('nama', $("#modal-form #nama").val()); // Ambil data nis
      data.append('username', $("#modal-form #username").val()); // Ambil data nama
      data.append('password', $("#modal-form #password").val()); // Ambil data jenis kelamin
      data.append('level', $("#modal-form #level").val()); // Ambil data telepon
      data.append('foto', $("#modal-form #foto")[0].files[0]);
      if(save_method=='add'){
        data.append('_method', 'POST');
      }else{
        data.append('_method', 'PATCH');
      }
      data.append('_token', $('meta[name=csrf-token]').attr('content'));
      
      $.ajax({
        url: url, // File tujuan
        type: 'POST', // Tentukan type nya POST atau GET
        data: data, // Set data yang akan dikirim
        processData: false,
        contentType: false,            
        success : function(data){
          $('#modal-form').modal('hide');
          table.ajax.reload();
        },
        error : function(){
          alert("User Name sudah ada");
        }   
      });        
    });
  });
  
  function addForm(){
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form form')[0].reset();            
    $('.modal-title').text('Tambah User');
    $('#password, #foto').attr('required', true);
  }
  
  function editForm(id){
    save_method = "edit";
    $('input[name=_method]').val('PATCH');
    $('#modal-form form')[0].reset();
    $.ajax({
      url : "user/"+id+"/edit",
      type : "GET",
      dataType : "JSON",
      success : function(data){
        $('#modal-form').modal('show');
        $('.modal-title').text('Edit User');
        
        $('#id').val(data.id);
        $('#nama').val(data.name);
        $('#level').val(data.level);
        $('#username').val(data.username);
        $('#password, #foto').removeAttr('required');
        
      },
      error : function(){
        alert("Tidak dapat menampilkan data!");
      }
    });
  }
  
  function deleteData(id){
    if(confirm("Apakah yakin data akan dihapus?")){
      $.ajax({
        url : "user/"+id,
        type : "POST",
        data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
        success : function(data){
          table.ajax.reload();
        },
        error : function(){
          alert("Tidak dapat menghapus data!");
        }
      });
    }
  }
</script>
@endsection