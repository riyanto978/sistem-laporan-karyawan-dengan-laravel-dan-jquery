@extends('layouts.app')

@section('judul')
Daftar Pol
@endsection

@section('title')
Daftar Pol
@endsection

@section('breadcrumb')
@parent
<li>Pol</li>
@endsection

@section('content')     

				<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
				<br>
				<br>
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="30">No</th>
							<th>POL</th>
							<th>Tahun</th>
							<th>Nama</th>
							<th>Jumlah Order</th>      
							<th>Step_Proses</th>
							<th>Tipe_Chip</th>
							<th>Periode</th>
							<th width="100">Aksi</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>						
@include('pol.form')
@endsection

@section('script')
<script>
	var table, save_method;
	$(function(){
						
		table = $('.table').DataTable({
			"processing" : true,
			"ajax" : {
				"url" : "{{ route('pol.data') }}",
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
			var id = $('#id_pol').val();
			if(save_method == "add") url = "{{ route('pol.store') }}";
			else url = "pol/"+id;
			
			var data = new FormData();
			data.append('kode', $("#modal-form #kode").val()); // Ambil data nis
			data.append('tahun', $("#modal-form #tahun").val()); // Ambil data nis
			data.append('nama', $("#modal-form #namapol").val()); // Ambil data nis
			data.append('jmlorder', $("#modal-form #jmlorder").val()); // Ambil data nis              
			data.append('stat', $("#modal-form #stat").val()); // Ambil data nis
			data.append('id_periode', $("#modal-form #id_periode").val()); // Ambil data nis
			data.append('tipe_chip', $("#modal-form #tipe_chip").val()); // Ambil data nis							
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
					if(data == 'tersimpan'){
						$('#modal-form').modal('hide');
						table.ajax.reload();
					}else{
						alert('kode pol di periode ini sudah ada');
					}
					
				},
				error : function(){
					alert("Nama pol sudah ada");
				}   
			});        
		});
		
	});
	
	function addForm(){
		save_method = "add";
		$('input[name=_method]').val('POST');
		$('#modal-form').modal('show');
		$('#modal-form form')[0].reset();            
		$('.modal-title').text('Tambah pol');
	}
	
	function editForm(id){
		save_method = "edit";
		$('input[name=_method]').val('PATCH');
		$('#modal-form form')[0].reset();
		$.ajax({
			url : "pol/"+id+"/edit",
			type : "GET",
			dataType : "JSON",
			success : function(data){
				$('#modal-form').modal('show');
				$('.modal-title').text('Edit pol');
				$('#id_pol').val(data.id_pol);
				$('#namapol').val(data.nama);
				$('#kode').val(data.kode);					
				$('#jmlorder').val(data.jmlorder);										
				$('#stat').val(data.stat);					
				$('#id_periode').val(data.id_periode);					
				$('#tipe_chip').val(data.tipe_chip);										
			},
			error : function(){
				alert("Tidak dapat menampilkan data!");
			}
		});
	}
	
	function deleteData(id){
		if(confirm("Apakah yakin data akan dihapus?")){				
			$.ajax({
				url : "pol/"+id,
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