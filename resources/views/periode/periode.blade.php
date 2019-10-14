@extends('layouts.app')

@section('judul')
Daftar periode
@endsection

@section('title')
Daftar periode
@endsection

@section('breadcrumb')
@parent
<li>periode</li>
@endsection

@section('content')     
				<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
				<center><h3 class="box-title" > <b>@yield('title')  </b></h3></center>         			
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="30">No</th>
							<th>periode</th>							              
							<th>Jumlah Order</th>      
							<th>Dibuat Tgl</th>              
							<th width="100">Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
@include('periode.form')
@endsection

@section('script')
<script>
	var table, save_method;
	$(function(){
		
		
		
		table = $('.table').DataTable({
			"processing" : true,
			"ajax" : {
				"url" : "{{ route('periode.data') }}",
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
			var id_periode = $('#id_periode').val();
			if(save_method == "add") url = "{{ route('periode.store') }}";
			else url = "periode/"+id_periode;
			
			var data = new FormData();							
			data.append('nama', $("#modal-form #nama").val()); // Ambil data nis
			data.append('jmlorder', $("#modal-form #jmlorder").val()); // Ambil data nis              							
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
					alert("Nama periode sudah ada");
				}   
			});        
		});
		
	});
	
	function addForm(){
		save_method = "add";
		$('input[name=_method]').val('POST');
		$('#modal-form').modal('show');
		$('#modal-form form')[0].reset();            
		$('.modal-title').text('Tambah periode');
	}
	
	function editForm(id){
		save_method = "edit";
		$('input[name=_method]').val('PATCH');
		$('#modal-form form')[0].reset();
		$.ajax({
			url : "periode/"+id+"/edit",
			type : "GET",
			dataType : "JSON",
			success : function(data){
				$('#modal-form').modal('show');
				$('.modal-title').text('Edit periode');
				$('#id_periode').val(data.id_periode);
				$('#nama').val(data.nama_periode);					
				$('#jmlorder').val(data.jmlorder);																														
			},
			error : function(){
				alert("Tidak dapat menampilkan data!");
			}
		});
	}
	
	function deleteData(id){
		if(confirm("Apakah yakin data akan dihapus?")){				
			$.ajax({
				url : "periode/"+id,
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