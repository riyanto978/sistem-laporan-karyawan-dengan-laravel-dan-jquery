@extends('layouts.app')

@section('judul')
notifikasi
@endsection

@section('title')
notifikasi
@endsection

@section('breadcrumb')
@parent
<li>notifikasi</li>
@endsection

@section('content')     

<a onclick="addForm()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
<table class="table table-striped">
	<thead>
		<tr>
			<th width="30">No</th>
			<th>Pesan</th>
			<th>warna</th>
			<th>Sampai</th>
			<th>dibuat_tgl</th>
			<th width="100">Aksi</th>
			<th>Broadcast</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>


<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">			
			<form class="form-horizontal"  method="POST" enctype="multipart/form-data">								
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
					<h3 class="modal-title"></h3>
				</div>
				
				<div class="modal-body">					
					<input type="hidden" id="id_notifikasi" name="id_notifikasi">
					<div class="form-group">
						<label for="pesan" class="col-md-3 control-label">Pesan</label>
						<div class="col-md-6">
							<textarea id="pesan" class="form-control" name="pesan" required="required"></textarea>         
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="warna" class="col-md-3 control-label">warna</label>
						<div class="col-md-6">
							<select id="warna" name="warna" class="form-control">
								<option value="success" class="bg-success">success</option>
								<option value="warning" class="bg-warning">warning</option>
								<option value="danger" class="bg-danger">danger</option>
								<option value="info" class="bg-info">info</option>
							</select>
							<span class="help-block with-errors"></span>
						</div>
					</div>                        
				</div>                
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
				</div>                
			</form>            
		</div>
	</div>
</div>

<div class="modal" id="broadcast-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">			
			<form class="form-horizontal"  method="POST" enctype="multipart/form-data">								
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
					<h3 class="modal-title"></h3>
				</div>
				
				<div class="modal-body">					
					<input type="hidden" id="id_notifikasi_broadcast" name="id_notifikasi_broadcast">
					<div class="form-group">
						<label for="pesan_broadcast" class="col-md-3 control-label">Pesan</label>
						<div class="col-md-6">
							<textarea id="pesan_broadcast" class="form-control" name="pesan_broadcast" required="required"></textarea>         
							<span class="help-block with-errors"></span>
						</div>
					</div>
					<div class="form-group">
						<label for="warna_broadcast" class="col-md-3 control-label">warna</label>
						<div class="col-md-6">
							<select id="warna_broadcast" name="warna_broadcast" class="form-control">
								<option value="success" class="bg-success">success</option>
								<option value="warning" class="bg-warning">warning</option>
								<option value="danger" class="bg-danger">danger</option>
								<option value="info" class="bg-info">info</option>
							</select>
							<span class="help-block with-errors"></span>
						</div>
					</div>                        
					<div class="form-group">
						<label for="pesan_broadcast" class="col-md-3 control-label">waktu(menit)</label>
						<div class="col-md-6">
							<input class="form-control" type="number" name="waktu_broadcast" id="waktu_broadcast" value="60">
							<span class="help-block with-errors"></span>
						</div>
					</div>
				</div>                
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Broadcast </button>
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
				</div>                
			</form>            
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
	var table, save_method;
	$(function(){
		
		
		
		table = $('.table').DataTable({
			"processing" : true,
			"ajax" : {
				"url" : "{{ route('notifikasi.data') }}",
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
			var id = $('#id_notifikasi').val();
			if(save_method == "add") url = "{{ route('notifikasi.store') }}";
			else url = "notifikasi/"+id;
			
			var data = new FormData();
			data.append('pesan', $("#modal-form #pesan").val()); // Ambil data nis
			data.append('warna', $("#modal-form #warna").val()); // Ambil data nis			
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
					alert("Nama notifikasi sudah ada");
				}   
			});        
		});
		
		$("#broadcast-form form").on('submit', function(e){ // Ketika tombol simpan di klik
			e.preventDefault();
			var id = $('#id_notifikasi_broadcast').val();			
			url = "broadcast/"+id;
			
			var data = new FormData();
			data.append('pesan', $("#broadcast-form #pesan_broadcast").val());
			data.append('warna', $("#broadcast-form #warna_broadcast").val());			
			data.append('waktu', $("#broadcast-form #waktu_broadcast").val());			
			data.append('_method', 'PATCH');			
			data.append('_token', $('meta[name=csrf-token]').attr('content'));
			
			$.ajax({
				url: url, // File tujuan
				type: 'POST', // Tentukan type nya POST atau GET
				data: data, // Set data yang akan dikirim
				processData: false,
				contentType: false,            
				success : function(data){
					$('#broadcast-form').modal('hide');
					table.ajax.reload();
					console.log(data);
					app.sendTypingEvent(data);
				},
				error : function(){
					alert("Nama notifikasi sudah ada");
				}   
			});        
		});
		
	});
	
	function addForm(){
		save_method = "add";
		$('input[name=_method]').val('POST');
		$('#modal-form').modal('show');
		$('#modal-form form')[0].reset();            
		$('.modal-title').text('Tambah notifikasi');
	}
	
	function editForm(id){
		save_method = "edit";
		$('input[name=_method]').val('PATCH');
		$('#modal-form form')[0].reset();
		$.ajax({
			url : "notifikasi/"+id+"/edit",
			type : "GET",
			dataType : "JSON",
			success : function(data){
				$('#modal-form').modal('show');
				$('.modal-title').text('Edit notifikasi');
				$('#id_notifikasi').val(data.id_notifikasi);
				$('#pesan').val(data.pesan);														
				$('#warna').val(data.warna);
			},
			error : function(){
				alert("Tidak dapat menampilkan data!");
			}
		});
	}
	
	function deleteData(id){
		if(confirm("Apakah yakin data akan dihapus?")){				
			$.ajax({
				url : "notifikasi/"+id,
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
	
	function broadcast(id)
	{
		$('#broadcast-form form')[0].reset();
		$.ajax({
			url : "notifikasi/"+id+"/edit",
			type : "GET",
			dataType : "JSON",
			success : function(data){
				$('#broadcast-form').modal('show');
				$('.modal-title').text('broadcast notifikasi');
				$('#id_notifikasi_broadcast').val(data.id_notifikasi);
				$('#pesan_broadcast').val(data.pesan);														
				$('#warna_broadcast').val(data.warna);
			},
			error : function(){
				alert("Tidak dapat menampilkan data!");
			}
		});
	}
	
</script>
@endsection