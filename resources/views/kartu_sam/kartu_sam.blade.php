@extends('layouts.app')

@section('judul')
Daftar Sam
@endsection

@section('title')
Daftar Sam
@endsection

@section('breadcrumb')
@parent
<li>Sam</li>
@endsection

@section('content')     
<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah Sam</a>
<center><h3 class="box-title" > <b>@yield('title')  </b></h3></center>         				
<table class="table table-striped">
	<thead>
		<tr>
			<th width="30">No</th>
			<th>kartu_sam</th>
			<th>Isi</th>
			<th>Pol</th>
			<th>Dibuat_tgl</th>
			<th width="100">Aksi</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
@include('kartu_sam.form')
@endsection

@section('script')
<script>
	var table, save_method;
	$(function(){
		
		
		
		table = $('.table').DataTable({
			"processing" : true,
			"ajax" : {
				"url" : "{{ route('kartu_sam.data') }}",
				"type" : "GET"
			},
			"language":{
				"sProcessing":   "Sedang memproses...",
				"sLengthMenu":   "Tampilkan _MENU_ entri",
				"sZeroRecords":  "Tidak ditemukan data yang sesuai",
				"sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
				"sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
				"sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
				"sInfoPostFix":  "",
				"sSearch":       "Cari:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "Pertama",
					"sPrevious": "Sebelumnya",
					"sNext":     "Selanjutnya",
					"sLast":     "Terakhir"
				}
			},
		}); 			
		
		$("#modal-form form").on('submit', function(e){ // Ketika tombol simpan di klik
			e.preventDefault();
			var id = $('#id').val();
			if(save_method == "add") url = "{{ route('kartu_sam.store') }}";
			else url = "kartu_sam/"+id;
			
			var data = new FormData();
			data.append('nama', $("#modal-form #nama").val()); // Ambil data nis
			data.append('isi', $("#modal-form #isi").val()); // Ambil data nis
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
					alert("Nama kartu_sam sudah ada");
				}   
			});        
		});
		
	});
	
	function addForm(){
		save_method = "add";
		$('input[name=_method]').val('POST');
		$('#modal-form').modal('show');
		$('#modal-form form')[0].reset();            
		$('.modal-title').text('Tambah kartu_sam');
	}
	
	function editForm(id){
		save_method = "edit";
		$('input[name=_method]').val('PATCH');
		$('#modal-form form')[0].reset();
		$.ajax({
			url : "kartu_sam/"+id+"/edit",
			type : "GET",
			dataType : "JSON",
			success : function(data){
				$('#modal-form').modal('show');
				$('.modal-title').text('Edit kartu_sam');
				$('#id').val(data.id_kartu_sam);
				$('#nama').val(data.nama);					
				$('#isi').val(data.isi);										
			},
			error : function(){
				alert("Tidak dapat menampilkan data!");
			}
		});
	}
	
	function deleteData(id){
		if(confirm("Apakah yakin data akan dihapus?")){				
			$.ajax({
				url : "kartu_sam/"+id,
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