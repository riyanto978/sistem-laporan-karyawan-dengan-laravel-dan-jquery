@extends('layouts.app')

@section('judul')
    @if($tipe == 3)
        Virgin
    @else()
        Preperso
    @endif

@endsection

@section('title')
    @if($tipe == 3)
        Virgin
    @else()
        Preperso
    @endif
@endsection

@section('breadcrumb')
@parent
<li>Preperso</li>
@endsection

@section('content')     
<div class="container">
    <div id="notifikasi" class="col-md-11 col-lg-11"></div>
    
    <br>        
    <div class="row">
        <!-- <div class="col-xs-1">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="checkbox"  checked="true">preperso
                </label>
            </div>
        </div> -->
        <div class="col-xs-1">
            <label for="pilih" class="lbl_pilih">preperso</label>
            <button id="pilih" onclick="showpreperso()" type="button" class="btn btn-info">...</button>
            <button id="pilih_pol" onclick="showPol()" type="button" class="btn btn-success" style="display: none;">...</button>
        </div>
        <div class="col-xs-1 col-lg-1">
            <label for="kode_pol">Kode Pol</label>
            <input type="hidden" id="id_pol">
            <input class="form-control" id="kode_pol" name="kode_pol" value="" type="text" disabled="disabled" autocomplete="off">
        </div>
        <div class="col-xs-2">
            <label for="nama_pol">Nama</label>
            
            <div id="nama_pol"></div>
        </div>
        <div class="col-xs-2 applet" >
            <label for="applet" class="applet">ID Job Applet</label>
            <input class="form-control applet" id="applet" type="number" min="1" disabled="true" autocomplete="off">
        </div> 
        <div class="col-xs-1">
            <label for="shift">Shift</label>
            
            <select class="form-control" id="shift" required="required">
                <option></option>
                <option 
                >1</option>
                <option 
                >2</option>
            </select>
        </div>
        <div class="col-xs-1">
            <label for="iner">Isi</label>
            <input class="form-control" id="isi" type="number" min="1" value="500">
        </div>
        <div class="col-xs-1">            
            <label for="line">Line</label>
            <select class="form-control" id="line" required="required">
                <option></option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
                <option>13</option>
                <option>14</option>
                <option>15</option>
                <option>16</option>
                
            </select>
            
        </div>
        
        <div class="col-xs-5">
            <br>
            <button type="button" class="btn btn-primary" id="simpan_laporan_sementara" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Processing...."><span class="glyphicon glyphicon-pencil"></span>  Mulai Mengerjakan</button>

            <div id="aler" class="alert alert-dismissible" style="display:none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-check"></i>
                <span id="status"></span>    
            </div>
            
            <!--<div class="pull-right"><button type="button" class="btn btn-danger" id="tunggu_bahan">Tunggu Bahan</button></div>-->
        </div>
        
    </div>
    <div class="row">
        <br>
        
        <div class="col-md-11"> 
            <div class="panel panel-info">
                <div class="panel-heading">
                    List Job yang sedang di kerjakan
                </div>
                
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="tbl_laporan_sementara">
                            
                        </table>
                    </div>                           
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="col-md-11"> 
            <div class="panel panel-success">
                <div class="panel-heading">
                    <span class="pull-right"><input class="form-control" id="input_tanggal" type="date" format="dd/mm/yyyy" value="<?php
                        if(date('H')<7){
                            echo date('Y-m-d',strtotime('- 1 days'));
                        }else{
                            echo date('Y-m-d'); 
                        }                            
                        
                        ?>"></span>
                        <h5>List Job Telah Selesai di kerjakan</h5>
                    </div>
                    
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div id="tmpt_laporan">
                                
                            </div>      
                        </div>                     
                    </div>
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
        
        <div class="modal" id="modal-pol" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                        <h3 class="modal-title">Cari Pol</h3>
                    </div>
                    
                    <div class="modal-body">
                        <div id="tmpt_pol"></div>                                                               
                    </div>
                </div>
            </div>
        </div>
        
        @endsection
        
        @section('script')
        
        <script>
            $(function(){                
                $('#tbl_iner').DataTable();
                var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                var tanggal=$("#input_tanggal").val();  
                var tipe = {{ $tipe }};
                
                $("#tbl_laporan_sementara").load("preperso/tbl_laporan_sementara/"+operator+"/"+tipe);        
                $("#tmpt_laporan").load("preperso/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                
                
                if(tipe == 1){
                    $("#pilih").css("display","block");
                    $("#pilih_pol").css("display","none");
                    $(".applet").css("display","block");
                    $(".lbl_pilih").html("Applet");
                }else{
                    $("#pilih_pol").css("display","block");
                    $("#pilih").css("display","none");
                    $(".applet").css("display","none");
                    $(".lbl_pilih").html("pol");
                }
                
                $("#simpan_laporan_sementara").click(function(){                        
                    $("#status").html("");
                    var $this = $(this);                        
                    var kode_pol=$("#kode_pol").val();                    
                    var id_pol=$("#id_pol").val();                         
                    var id_proses="17"; 
                    var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                    var line=$("#line").val();
                    var isi=$("#isi").val();
                    var shift=$("#shift").val();
                    var tanggal="<?php echo date('Y-m-d'); ?>";
                    var applet = $("#applet").val();
                    
                    var data = new FormData();
                    data.append('kode_pol', kode_pol);                    
                    data.append('id_pol', id_pol);
                    data.append('id_proses', id_proses);
                    data.append('operator', operator);
                    data.append('line', line);
                    data.append('isi', isi);
                    data.append('shift', shift);
                    data.append('tanggal', tanggal);
                    data.append('applet', applet);
                    data.append('grup', tipe);
                    data.append('_token', $('meta[name=csrf-token]').attr('content'));
                    
                    if(kode_pol=="" || line=="" || isi=="" || shift=="" ){
                        alert("Semua data Harus diisi");
                    }else if(id_pol==""){
                        alert("isi pol dengan benar");
                    }else{
                        $this.button('loading');      
                        
                        $.ajax({
                            url:"preperso/simpan_sementara",
                            type: 'POST',
                            data:data,
                            cache:false,
                            processData: false,
                            contentType: false,     
                            success:function(msg){									
                                $("#status").html(msg);
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                $("#tbl_laporan_sementara").load("preperso/tbl_laporan_sementara/"+operator+"/"+tipe);        
                                $("#tmpt_laporan").load("preperso/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                $("#iner").val("");
                                $this.button('reset');                                    
                                $("#nama_pol").html('');
                                $("#kode_pol").val('');
                                $("#applet").val('');
                                $("#id_pol").val('');   
                                app.online();
                            }
                        });                            
                    }                       
                });
                
                $("#tbl_laporan_sementara").on("click","#batal", function(){                        
                    if(confirm("Apakah yakin data akan dihapusss?")){
                        var id_preperso = $(this).attr('value');
                        var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                        $.ajax({
                            url:"preperso/"+id_preperso,
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            cache:false,
                            success:function(msg){
                                $("#status").html("Berhasil dihapus");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();                                
                                $("#tbl_laporan_sementara").load("preperso/tbl_laporan_sementara/"+operator+"/"+tipe);                        
                                $("#kode_pol").focus();
                                app.online();
                            }
                        });
                    }                        
                });
                
                $("#tmpt_laporan").on("click","#delete_laporan", function(){                     
                    if(confirm("Apakah yakin data akan dihapus?")){
                        var id_preperso   = $(this).attr('value');
                        $.ajax({
                            url         : "preperso/"+id_preperso,
                            type        : "POST",
                            data        : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            cache       : false,
                            success:function(msg){
                                $("#status").html("Berhasil dihapus");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();                                
                                $("#tmpt_laporan").load("preperso/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                $("#kode_pol").focus();
                                app.online();
                                app.sendMonitoring('preperso');
                            }
                        });
                    }                        
                });
                
                $("#tbl_laporan_sementara").on("change","#upload", function(){                    
                    var id_preperso = $(this).attr('value');
                    var input_tanggal =$("#input_tanggal").val();
                    $this = $(this);
                    var data = new FormData();                    
                    data.append('id_preperso', id_preperso); 
                    data.append('upload', $(this)[0].files[0]);
                    data.append('_token', $('meta[name=csrf-token]').attr('content'));
                    
                    $.ajax({
                        url: 'preperso/upload', // File tujuan
                        type: 'POST', // Tentukan type nya POST atau GET
                        data: data, // Set data yang akan dikirim
                        processData: false,
                        contentType: false,
                        dataType: 'json',
                        beforeSend: function(e) {                               
                            if(e && e.overrideMimeType) {
                                e.overrideMimeType("application/json;charset=UTF-8");
                            }
                        },
                        success: function(response){ // Ketika proses pengiriman berhasil                                                                                        
                            if(response[0]==1){
                                $("#status").html("Gagal Menyimpan='Nama Log tidak sama dengan Nomor Inner'");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                            }else if(response[0]==2){	
                                $("#tbl_laporan_sementara").load("preperso/tbl_laporan_sementara/"+operator+"/"+tipe);        
                                $("#tmpt_laporan").load("preperso/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                $("#status").html("berhasil disimpan");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();									
                                app.online();
                                app.sendMonitoring('preperso');
                            }else{
                                $("#status").html("Gagal Menyimpan='Log tidak 500'");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                            }                            
                        },                            
                    });             					                    
                });
                
                $('#input_tanggal').change(function(){                        
                    var input_tanggal =$("#input_tanggal").val();
                    $("#tmpt_laporan").load("preperso/tbl_laporan/"+operator+'/'+input_tanggal+"/"+tipe);                                            
                });
                
            });
            
            function selectItem(kode,id_laporan,nama,id_pol)
            {              
                $("#nama_pol").html(nama);
                $("#kode_pol").val(kode);
                $("#applet").val(id_laporan);
                $("#id_pol").val(id_pol);                                
                $('#modal-applet').modal('hide');
            }
            
            function selectPol(kode,id_pol,nama)
            {
                
                $("#nama_pol").html(nama);
                $("#kode_pol").val(kode);                
                $("#applet").val('');
                $("#id_pol").val(id_pol);                                
                $('#modal-pol').modal('hide');
            }
            
            function showpreperso()
            {
                $("#tmpt_iner").load("preperso/list");;
                $('#modal-applet').modal('show');
            }
            
            function showEdit(editableObj) {
                $(editableObj).css("background","#FFF");
            } 
            
            function saveToDatabase(editableObj,column,id) {
                $(editableObj).css("background","#FFF url({{ asset('public/loaderIcon.gif') }}) no-repeat right");
                var data = new FormData();
                data.append('kolom', column);                    
                data.append('val', editableObj.innerHTML);                    
                
                data.append('_method' , 'patch');
                data.append('_token', $('meta[name=csrf-token]').attr('content'));
                $.ajax({
                    url: "preperso/update/"+id,                    
                    type : 'POST',
                    data : data,
                    cache:false,
                    processData: false,
                    contentType: false,     
                    success: function(data){
                        $(editableObj).css("background","#FDFDFD");
                        var operator="{{ Auth::user()->username }}";
                        var tanggal=$("#input_tanggal").val();                                   
                        $("#tmpt_laporan").load("preperso/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);                                    
                    }        
                });
            }
            
            function showPol()
            {
                $("#tmpt_pol").load("preperso/list/pol");
                $('#modal-pol').modal('show');
            }    
        </script>
        @endsection