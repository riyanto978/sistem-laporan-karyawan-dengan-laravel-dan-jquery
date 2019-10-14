@extends('layouts.app')

@section('judul')
Monitoring
@endsection

@section('title')
Monitoring
@endsection

@section('breadcrumb')
@parent
<li>Monitoring</li>
@endsection

@section('content')     
<div class="container">    	
    <div class="row">
        <div class="col-xs-2 pull-left">
            <center><label for="input_tglmonitor" >Tanggal Awal</label></center>
            <input class="form-control" id="input_tglmonitor" type="date" format="dd/mm/yyyy" value="{{ date('Y-m-d') }}" autocomplete="on">
        </div>
        <div class="col-xs-2 pull-left">
            <center><label for="input_tglmonitor_akhir" >Tanggal Akhir</label></center>
            <input class="form-control" id="input_tglmonitor_akhir" type="date" format="dd/mm/yyyy" value="{{ date('Y-m-d') }}">
        </div>
        <div class="col-xs-2 pull-left">
            <center><label for="shift">Shift </label></center>
            <select class="form-control" id="shift">
                <option value="1">1</option>                
                <option value="2">2</option>
            </select>
        </div>                
        <div class="col-xs-4 pull-right">
            <label for="rek"></label>
            <a onclick="window.location.reload()"> <button id="rek" type="button" class="btn btn-primary">Refresh</button></a>
        </div>                        
    </div>
    <div class="row">
        <br>
        <div class="col-md-11" id="resume_lap_monitor"></div>
    </div>    
    <div class="row">
        <div id="tmpt_applet_monitor" class="col-md-11"></div>    
    </div>
    <div class="row">
        <div id="tmpt_preper_monitor" class="col-md-11"></div>    
    </div>
    <div class="row">
        <br>
        <br>
        <div id="tmpt_record_monitor" class="col-md-11"></div>
    </div>
    <div class="row">
        <br>
        <div id="tmpt_laporan"></div>
    </div>    
</div>
<div class="modal" id="modal-laporan" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                <h3 class="modal-title">Lihat Laporan </h3>                            
            </div>
            
            <div class="modal-body">
                <div class="table-responsive">
                    <div id="lihat_laporan" ></div>                            
                </div>                                  
            </div>                        
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        var tanggal=$("#input_tglmonitor").val();
        var tanggal_akhir=$("#input_tglmonitor_akhir").val();
        var shift=$("#shift").val();
        
        $("#resume_lap_monitor").load("resume/laporan/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        $("#tmpt_preper_monitor").load("bar/preperso/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        $("#tmpt_record_monitor").load("bar/record/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        $("#tmpt_applet_monitor").load("bar/applet/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        
        
        $('#input_tglmonitor').change(function(){
            
            var tanggal=$("#input_tglmonitor").val();
            var tanggal_akhir=$("#input_tglmonitor_akhir").val();
            var shift=$("#shift").val();
            $("#resume_lap_monitor").load("resume/laporan/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_preper_monitor").load("bar/preperso/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_record_monitor").load("bar/record/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_applet_monitor").load("bar/applet/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        })
        
        $('#input_tglmonitor_akhir').change(function(){
            
            var tanggal=$("#input_tglmonitor").val();
            var tanggal_akhir=$("#input_tglmonitor_akhir").val();
            var shift=$("#shift").val();
            $("#resume_lap_monitor").load("resume/laporan/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_preper_monitor").load("bar/preperso/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_record_monitor").load("bar/record/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_applet_monitor").load("bar/applet/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        })
        
        $('#shift').change(function(){
            
            var tanggal=$("#input_tglmonitor").val();
            var tanggal_akhir=$("#input_tglmonitor_akhir").val();
            var shift=$("#shift").val();
            $("#resume_lap_monitor").load("resume/laporan/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_preper_monitor").load("bar/preperso/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_record_monitor").load("bar/record/"+tanggal+'/'+tanggal_akhir+'/'+shift);
            $("#tmpt_applet_monitor").load("bar/applet/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        })
    });
    function lihat(tipe,operator){
        var tanggal=$("#input_tglmonitor").val();
        var tanggal_akhir=$("#input_tglmonitor_akhir").val();
        
        if(tipe == 'applet'){
            $("#lihat_laporan").load("lihatlaporan/applet/"+tanggal+'/'+tanggal_akhir+'/'+operator);
        }else if(tipe == 'preperso'){
            $("#lihat_laporan").load("lihatlaporan/preperso/"+tanggal+'/'+tanggal_akhir+'/'+operator);
        }else{
            $("#lihat_laporan").load("lihatlaporan/record/"+tanggal+'/'+tanggal_akhir+'/'+operator);
        }
        
        $(".modal-title").text("Lihat Laporan " + tipe + " "+ operator);
        $('#modal-laporan').modal('show');
    }
</script>
@endsection