@extends('layouts.app')

@section('judul')
    @if($tipe == 1)
        Record 
    @elseif($tipe == 2)
        Record Only

    @else
        Record Virgin
    @endif
@endsection

@section('title')
@if($tipe == 1)
        Record 
    @elseif($tipe == 2)
        Record Only

    @else
        Record Virgin
    @endif
@endsection

@section('breadcrumb')
@parent
<li>Record</li>
@endsection

@section('content')     
<div class="container-fluid">
    <br>            
    <div class="row">
        <!-- <div class="col-xs-1">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="checkbox"  checked="true">record
                </label>
            </div>
        </div> -->
        <div class="col-xs-1">
            <label for="pilih">Pilih</label>
            <button id="pilih" onclick="showRecord()" type="button" class="btn btn-info">...</button>
            <button id="pilih_pol" onclick="showPol()" type="button" class="btn btn-success" style="display: none;">...</button>
        </div>
        <div class="col-xs-1">
            <label for="kode_pol">Kode Pol</label>
            <input type="hidden" id="id_pol" name="id_pol">
            <input type="hidden" id="id_periode" name="id_periode">
            <input class="form-control" id="kode_pol" name="kode_pol" value="" type="text" disabled="disabled" autocomplete="off">
        </div>
        <div class="col-xs-2">
            <label for="nama_pol">Nama</label>
            
            <div id="nama_pol"></div>
        </div>
        <div class="col-xs-2 applet">
            <label for="preper" class="applet">ID Job Preperso</label>
            <input class="form-control applet" id="preper" type="number" min="1" disabled="" autocomplete="off">
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
        
        <div class="col-xs-1 nomor" style="display: none;" >                                 
            <label for="line">Terminal</label>
            <select class="form-control" id="line" required="required" autocomplete="off">
                <option selected="selected"></option>
                <option <?php if($data['line']=='A'){echo "selected";} ?> >A</option>
                <option <?php if($data['line']=='B'){echo "selected";} ?> >B</option>
                <option <?php if($data['line']=='C'){echo "selected";} ?> >C</option>
                <option <?php if($data['line']=='D'){echo "selected";} ?> >D</option>
                <option <?php if($data['line']=='E'){echo "selected";} ?> >E</option>
                <option <?php if($data['line']=='F'){echo "selected";} ?> >F</option>
                <option <?php if($data['line']=='G'){echo "selected";} ?> >G</option>
                <option <?php if($data['line']=='H'){echo "selected";} ?> >H</option>
                <option <?php if($data['line']=='I'){echo "selected";} ?> >I</option>
                <option <?php if($data['line']=='J'){echo "selected";} ?> >J</option>
                <option <?php if($data['line']=='K'){echo "selected";} ?> >K</option>
                <option <?php if($data['line']=='L'){echo "selected";} ?> >L</option>
                <option <?php if($data['line']=='M'){echo "selected";} ?> >M</option>
                <option <?php if($data['line']=='N'){echo "selected";} ?> >N</option>
                <option <?php if($data['line']=='O'){echo "selected";} ?> >O</option>
                <option <?php if($data['line']=='P'){echo "selected";} ?> >P</option>
                <option <?php if($data['line']=='Q'){echo "selected";} ?> >Q</option>
                <option <?php if($data['line']=='R'){echo "selected";} ?> >R</option>
                <option <?php if($data['line']=='S'){echo "selected";} ?> >S</option>
                <option <?php if($data['line']=='T'){echo "selected";} ?> >T</option>
                <option <?php if($data['line']=='U'){echo "selected";} ?> >U</option>
                <option <?php if($data['line']=='V'){echo "selected";} ?> >V</option>
                <option <?php if($data['line']=='W'){echo "selected";} ?> >W</option>
                <option <?php if($data['line']=='X'){echo "selected";} ?> >X</option>
                <option <?php if($data['line']=='Y'){echo "selected";} ?> >Y</option>
                <option <?php if($data['line']=='Z'){echo "selected";} ?> >Z</option>
                
            </select>
        </div>
        <div class="col-xs-2 nomor" style="display: none;">
            <label for="iner">Inner</label>
            <input class="form-control" id="iner" type="number" min="1" value="" autocomplete="off">                        
        </div>
        <div class="col-xs-1">
            <label for="iner">ISI</label>
            <input class="form-control" id="isi" type="number" min="1" value="500">
        </div>
        
        
        <div class="col-xs-6">
            <br>
            <button type="button" class="btn btn-primary" id="simpan_laporan_sementara" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Processing...."><span class="glyphicon glyphicon-pencil"></span> Mulai Mengerjakan</button>
            
            
            <!--<dIv class="pull-right"><button type="button" class="btn btn-danger" id="tunggu_bahan">Tunggu Bahan</button></div> -->
                <div id="aler" class="alert alert-dismissible" style="display:none">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-check"></i>
                    <span id="status"></span>    
                </div>
            </div>
            
        </div>
        <div class="row">
            <br>
            
            <div class="col-md-12"> 
                <div class="panel panel-info">
                    <div class="panel-heading">
                        List Job Sedang Dikerjakan
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
            <div class="col-md-12"> 
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
            
            <!-- modal Pol -->
            <div class="modal" id="modal-preperso" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                            <h3 class="modal-title">Pilih Inner</h3>
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
            
            <!-- modal Lot -->
        <div class="modal" id="modal-lot" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">                        
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                        <h3 class="modal-title">Isikan Nomor LOT dan Jumlah Reject</h3>
                    </div>
                    
                    <div class="modal-body">                        
                        <div class="row">
                            <input id="id_record" name="id_record" type="hidden" value="">
                            <div class="col-md-12">                                
                                <div class="form-group">
                                    <label for="lot">LOT</label>
                                    <textarea id="lot" class="form-control" name="lot" rows="3"></textarea>
                                </div>                                
                            </div>                            
                            <div class="col-md-12">
                                <label for="dead">Dead</label>
                                <input class="form-control" id="dead" name="dead" value="0" type="text">
                            </div>
                            <div class="col-md-12" >
                                <label for="Error">Error</label>
                                <input class="form-control" id="error" name="error" value="0" type="text">
                            </div>
                            <div class="col-md-12" >
                                <label for="card_body">6A82</label>
                                <input class="form-control" id="virgin" name="virgin" value="0" type="text">
                            </div>
                            <div class="col-md-12">                                
                                <!-- <input id="simpan_lot" class="btn btn-primary" value="simpan" type="button"> -->
                                <input type='file' accept=.txt id='simpan_lot'>
                            </div>                                    
                        </div>                           
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

                    $("#tbl_laporan_sementara").load("record/tbl_laporan_sementara/"+operator+'/'+tipe);        
                    $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                    
                    
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
                        var sam = $("#sam").val();
                        var id_pol=$("#id_pol").val();                         
                        var id_proses="17"; 
                        var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                        var line=$("#line").val();
                        var iner=$("#iner").val();
                        var isi=$("#isi").val();
                        var shift=$("#shift").val();
                        var tanggal="<?php echo date('Y-m-d'); ?>";
                        var preper = $("#preper").val();
                        var id_periode = $("#id_periode").val();
                        
                        var data = new FormData();
                        data.append('kode_pol', kode_pol);
                        data.append('sam', sam);
                        data.append('id_pol', id_pol);
                        data.append('id_proses', id_proses);
                        data.append('operator', operator);
                        data.append('iner', iner);
                        data.append('line', line);
                        data.append('isi', isi);
                        data.append('shift', shift);
                        data.append('tanggal', tanggal);
                        data.append('preper', preper);
                        data.append('group_record', tipe);
                        data.append('id_periode', id_periode);
                        data.append('_token', $('meta[name=csrf-token]').attr('content'));
                        
                        if(kode_pol=="" || line=="" || isi=="" || shift=="" || id_pol ==""){
                            alert("Semua data Harus diisi");
                        }else if(id_pol==""){
                            alert("isi pol dengan benar");
                        }else{
                            $this.button('loading');                                                 
                            $.ajax({
                                url:"record/simpan_sementara",
                                type: 'POST',
                                data:data,
                                cache:false,
                                processData: false,
                                contentType: false,     
                                success:function(msg){									
                                    $("#status").html(msg);
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                    $("#tbl_laporan_sementara").load("record/tbl_laporan_sementara/"+operator+'/'+tipe);
                                    $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                    iner++;
                                    $this.button('reset');         
                                    if(tipe != 3){
                                        $("#iner").val(iner);
                                        $("#preper").val("");                                    
                                        $(".nomor").css("display","none");         
                                    }                                    
                                    app.online();
                                }
                            });                            
                        }                       
                    });
                    
                    $("#tbl_laporan_sementara").on("click","#batal", function(){                        
                        if(confirm("Apakah yakin data akan dihapus?")){
                            var id_record = $(this).attr('value');
                            $.ajax({
                                url:"record/"+id_record,
                                type : "POST",
                                data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                                cache:false,
                                success:function(msg){
                                    $("#status").html("Berhasil dihapus");
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();
                                    $("#tbl_laporan_sementara").load("record/tbl_laporan_sementara/"+operator+'/'+tipe);
                                    $("#kode_pol").focus();
                                    app.online();
                                }
                            });
                        }                        
                    });
                    
                    $("#tmpt_laporan").on("click","#delete_laporan", function(){                     
                        if(confirm("Apakah yakin data akan dihapus?")){
                            var id_record   = $(this).attr('value');
                            $.ajax({
                                url         : "record/"+id_record,
                                type        : "POST",
                                data        : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                                cache       : false,
                                success:function(msg){
                                    $("#status").html("Berhasil dihapus");
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();
                                    $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                    $("#kode_pol").focus();
                                    app.online();
                                    app.sendMonitoring('record');
                                }
                            });
                        }                        
                    });
                    
                    $("#simpan_lot").change(function(){
                        var id_record = $("#id_record").val();
                        var lot = $("#lot").val();
                        var dead = $("#dead").val();
                        var error = $("#error").val();
                        var virgin = $("#virgin").val();

                        var data = new FormData();                    
                        data.append('id_record', id_record); 
                        data.append('lot', lot); 
                        data.append('dead', dead); 
                        data.append('error', error); 
                        data.append('virgin', virgin); 
                        data.append('upload', $(this)[0].files[0]);
                        data.append('_token', $('meta[name=csrf-token]').attr('content'));

                        $.ajax({
                            url: 'record/upload', // File tujuan
                            type: 'POST', // Tentukan type nya POST atau GET
                            data: data, // Set data yang akan dikirim
                            processData: false,
                            contentType: false,
                            dataType: 'json',                            
                            success: function(response){ // Ketika proses pengiriman berhasil                                                                                        
                                if(response[0]==1){
                                    $("#status").html("Gagal Menyimpan='Log tidak 500'");
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                }else if(response[0]==2){	
                                    app.online();
                                    $("#tbl_laporan_sementara").load("record/tbl_laporan_sementara/"+operator+'/'+tipe);								
                                    $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                    $("#status").html("berhasil disimpan");
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();									
                                    app.sendMonitoring('record');
                                    $('#modal-lot').modal('hide');                
                                }                                
                            },                            
                        });   
                    });

                    $("#tbl_laporan_sementara").on("change","#upload", function(){                    
                        var id_record = $(this).attr('value');
                        var input_tanggal =$("#input_tanggal").val();
                        $this = $(this);
                        var data = new FormData();                    
                        data.append('id_record', id_record); 
                        data.append('upload', $(this)[0].files[0]);
                        data.append('_token', $('meta[name=csrf-token]').attr('content'));
                        
                        $.ajax({
                            url: 'record/upload', // File tujuan
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
                                    $("#status").html("Gagal Menyimpan='Log tidak 500'");
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                }else if(response[0]==2){	
                                    app.online();
                                    $("#tbl_laporan_sementara").load("record/tbl_laporan_sementara/"+operator+'/'+tipe);								
                                    $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);    
                                    $("#status").html("berhasil disimpan");
                                    $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();									
                                    app.sendMonitoring('record');
                                }
                                
                            },                            
                        });             					                    
                    });
                    
                    $('#input_tanggal').change(function(){                        
                        var input_tanggal =$("#input_tanggal").val();
                        $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+input_tanggal+'/'+tipe);                                            
                    });
                    
                    $('#line').change(function(){                        
                        var line =$("#line").val();
                        var id_periode = $("#id_periode").val();
                        $.ajax({
                            url:"record/line/"+line+"/"+id_periode,                                                                
                            dataType: "json",
                            cache:false,
                            success:function(msg){
                                $("#iner").val(msg[0]);
                                $("#iner").focus();                                    
                            }
                        });
                    });
                    
                });
                
                function selectItem(kode,id_laporan,nama,id_pol,id_periode)
                {              
                    $("#nama_pol").html(nama);
                    $("#kode_pol").val(kode);
                    $("#preper").val(id_laporan);
                    $("#id_pol").val(id_pol);                                
                    $("#id_periode").val(id_periode);                                
                    $('#modal-preperso').modal('hide');
                    $(".nomor").css("display","block");                    
                }
                
                function selectPol(kode,id_pol,nama,id_periode)
                {
                    
                    $("#nama_pol").html(nama);
                    $("#kode_pol").val(kode);      
                    $("#preper").val("");          
                    $("#id_pol").val(id_pol);     
                    $("#id_periode").val(id_periode);                                                                 
                    $('#modal-pol').modal('hide');
                    $(".nomor").css("display","block");    
                }
                
                function showRecord()
                {
                    $("#tmpt_iner").load("record/list/"+{{ $tipe }});    
                    
                    $('#modal-preperso').modal('show');
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
                        url: "record/update/"+id,                    
                        type : 'POST',
                        data : data,
                        cache:false,
                        processData: false,
                        contentType: false,     
                        success: function(data){
                            $(editableObj).css("background","#FDFDFD");
                            var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                            var tanggal=$("#input_tanggal").val();                                   
                            $("#tmpt_laporan").load("record/tbl_laporan/"+operator+'/'+tanggal+'/'+tipe);                                    
                        }        
                    });
                }
                
                // function hapusRecord(id_periode,id_record){
                //     if(confirm("Apakah yakin data akan dihapus?")){                        
                //         $.ajax({
                //             url:"record/"+id_record+'/'+id_periode,
                //             type : "POST",
                //             data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                //             cache:false,
                //             success:function(operator){
                //                 $("#status").html("Berhasil dihapus");
                //                 $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();
                //                 $("#tbl_laporan_sementara").load("record/tbl_laporan_sementara/"+operator);
                //                 $("#kode_pol").focus();
                //                 online();
                //             }
                //         });
                //     }  
                // }
                
                function showPol()
                {
                    $("#tmpt_pol").load("record/list/pol");
                    $('#modal-pol').modal('show');
                }    

                function showLot(id)
                {                                
                    $('#id_record').val(id)                
                    $('#modal-lot').modal('show');                
                }
            </script>
            @endsection