@extends('layouts.app')

@section('judul')
Banding Log Ektp 2018
@endsection

@section('title')
Banding Log
@endsection

@section('breadcrumb')
@parent
<li>Banding Log</li>
@endsection

@section('content')     
<div class="row">
	<div class="col-md-12">
		<form id="form_preper">
			<div class="col-md-3">				
				<input class="form-control" id="iner" type="text" min="1">				
			</div>		
			<div class="col-md-2">
				<select class="form-control" id="tipe">
					<option value="1">preperso</option>
					<option value="2">record</option>
				</select>
			</div>
			<button type="submit" style="display:none" class="btn btn-primary lihat" id="cari_preper" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading...."><span class="glyphicon glyphicon-search"></span> Cari</button>
		</form>	   
	</div>
	
	
</div>
<br>
<br>
<div class="row">
	<div class="col-md-12">
		<div id="tmpt_banding"></div>
	</div>	
</div>
@endsection

@section('script')
<script type="text/javascript">				
	$(function(){
		$("#iner").focus();     
		var url = "{{ url('/') }}";				
		
		$("#form_preper").on('submit', function(e){
			e.preventDefault();	
			$('.lihat').css('display', 'block').delay(2000).fadeOut();
			$("#cari_preper").button('loading');		
			var iner=$("#iner").val();
			var tipe=$("#tipe").val();
			
			if(iner=="" ){
				alert("iner Harus diisi");
			}else{       
				$("#tmpt_banding").load(url+"/bandinglog/"+tipe+"/"+iner);
			}  
			setTimeout(function(){ 
				$("#cari_preper").button('reset');
			},2100);																						
			$("#iner").focus();                                  
		});
		
	});

	function simpanlogrecord(id_record) {
                var data = new FormData();                
                data.append('id_record', id_record);                                    
                data.append('_method' , 'post');
                data.append('_token', $('meta[name=csrf-token]').attr('content'));
                $.ajax({
                    url: "log/simpan",                    
                    type : 'POST',
                    data : data,
                    cache:false,
                    processData: false,
                    contentType: false,     
                    success: function(data){
						alert(data);                        
                    }        
                });		
	}
</script>
@endsection
