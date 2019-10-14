@extends('layouts.app')

@section('judul')
Applet Penganti
@endsection

@section('title')
Applet Pengganti
@endsection

@section('breadcrumb')
@parent
<li>Applet Pengganti</li>
@endsection

@section('content')     
<div class="container">
    <form method="post" id="form_pengganti">
        <div class="row">
            <div class="col-xs-1">
                <label for="iner">Inner</label>
                <button id="pilih" onclick="showpreperso()" type="button" class="btn btn-info">...</button>
            </div>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col-md-11">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th width="30">No</th>
                        <th>Periode</th>
                        <th>POL</th>
                        <th>Tahun</th>
                        <th>Inner</th>                                                
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        
    </div>
</div>

<div class="modal" id="modal-applet" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                <h3 class="modal-title">Inner preperso</h3>
            </div>
            
            <div class="modal-body">
                <div id="tmpt_iner"></div>          
                
            </div>
            
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){        
        table = $('.table').DataTable({
            "processing" : true,
            "ajax" : {
                "url" : "{{ route('applet_pengganti.data') }}",
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
    });
    
    function showpreperso()
    {
        $("#tmpt_iner").load("../preperso/preperso/list");;
        $('#modal-applet').modal('show');
    }
    
    function selectItem(kode,id_laporan,nama,id_pol)
    {                      
        if(confirm("Jadikan Iner Pengganti ?")){                                                                                                                                                                
            var data = new FormData();        
            data.append('id_laporan', id_laporan);
            data.append('_token', $('meta[name=csrf-token]').attr('content'));
            $.ajax({
                url:"{{ route('proses_applet_pengganti') }}",
                type: 'POST',
                data:data,
                cache:false,
                processData: false,
                contentType: false,     
                success:function(msg){									                    
                    $('#modal-applet').modal('hide');     
                    table.ajax.reload();
                }
            });                                    
        }        
    }

    function deleteData(id_applet)
    {                      
        if(confirm("jadikan Iner Job ?")){                                                                                                                                                                
            var data = new FormData();                    
            data.append('_token', $('meta[name=csrf-token]').attr('content'));
            data.append('_method', 'PATCH');
            
            $.ajax({
                url: "update_pengganti/"+ id_applet,
                type: 'POST',
                data:data,
                cache:false,
                processData: false,
                contentType: false,     
                success:function(msg){									                    
                    table.ajax.reload();
                }
            });                                    
        }        
    }


</script>
@endsection