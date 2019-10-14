@extends('layouts.app')

@section('judul')
Rekapitulasi
@endsection

@section('title')
Rekapitulasi
@endsection

@section('breadcrumb')
@parent
<li>Rekapitulasi</li>
@endsection

@section('content')     
<div class="container">		  
    <div class="row">
        <div class="col-xs-2">                        
            <label for="sam">Periode</label>
            <select class="form-control" id="periode" required="required">
                <option></option>
                @foreach($periode as $data)
                    <option value="{{ $data->id_periode }}">{{ $data->nama_periode }}</option>
                @endforeach
            </select>                        
        </div>
    </div>  
    <div class="row">
        <br>    
        <div class='col-md-11'> 
            <div id="tmpt_laporan"></div>            
        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none'; 
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        
        $('#tbl1').DataTable( {
            "paging":   false,
            "searching": false,
            "info":     false
        } );                
    } );
</script>    --}}

@endsection
@section('script')
<script>
    $(function(){
        $('#periode').change(function(){
            var periode=$("#periode").val();            
            if(periode != ""){
                $("#tmpt_laporan").load("rekapitulasi/"+periode);            
            }else{
                $("#tmpt_laporan").html('');
            }            
            
        })
    });
</script>
@endsection
