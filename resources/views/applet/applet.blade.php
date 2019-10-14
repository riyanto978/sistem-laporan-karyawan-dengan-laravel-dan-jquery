@extends('layouts.app')

@section('judul')
Applet
@endsection

@section('title')
Applet
@endsection

@section('breadcrumb')
@parent
<li>applet</li>
@endsection

@section('content')     
<div class="container">
    <div id="notifikasi" class="col-md-11 col-lg-11"></div>
    
    <br>
    
    
    <div class="row">
        <div class="col-xs-1">
            <label for="pilih">Pilih Pol</label>
            <button id="pilih" onclick="showPol()" type="button" class="btn btn-success">...</button>
        </div>
        <div class="col-xs-1 col-lg-1">
            <label for="kode_pol">Kode Pol</label>
            <input type="hidden" id="id_pol">
            <input class="form-control" id="kode_pol" name="kode_pol" value="" type="text" disabled="disabled">
        </div>
        <div class="col-xs-3">
            <label for="nama_pol">Nama</label>
            <div id="nama_pol"></div>
        </div>
        <div class="col-xs-1">
            <label for="tipe_chip">Tipe</label>
            <div id="tipe_chip"></div>
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
        <div class="col-xs-2">                        
            <label for="sam">Sam</label>
            <select class="form-control" id="sam" required="required">
                <option></option>
                @foreach($kartu_sam as $sam)
                <option value="{{ $sam->id_kartu_sam }}">{{ $sam->nama }}</option>
                @endforeach
            </select>                        
        </div>
        
        <div class="col-xs-5">
            <br>
            <button type="button" class="btn btn-success" id="simpan_laporan_sementara" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Processing...."><span class="glyphicon glyphicon-pencil"></span>  Mulai Mengerjakan</button>
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
                            <table class="table table-striped table-bordered table-hover" id="tmpt_laporan">
                                
                            </table>
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- modal Pol -->
        <div class="modal" id="modal-pol" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
                        <h3 class="modal-title">Cari Pol</h3>
                    </div>
                    
                    <div class="modal-body">
                        <table class="table table-striped " id="tabel-pol">
                            <thead>
                                <tr>
                                    <th>Kode Pol</th>
                                    <th>Tahun</th>
                                    <th>Nama Pol</th> 
                                    <th>Jml Order</th>   
                                    <th>tipe chip</th>         
                                    <th>Periode</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pol as $data)
                                <tr>
                                    <td><?php echo $data['kode']; ?></td>
                                    <td> {{ $data->tahun }}</td>
                                    <td><?php echo $data['nama']; ?></td>     
                                    <td><?php echo $data['jmlorder']; ?></td>
                                    <td><?php echo $data['tipe_chip']; ?></td>
                                    <td>{{ $data->nama_periode }}</td>
                                    <td><a onclick="selectItem(<?php echo $data['kode']; ?>,<?php echo $data['id_pol']; ?>,'<?php echo $data['nama']; ?>','<?php echo $data['tipe_chip']; ?>')" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
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
                            <input id="id_applet" name="id_applet" type="hidden" value="">
                            <div class="col-md-12">
                                <label for="lot_1">LOT Pertama</label>
                                <input class="form-control" id="lot_1" name="lot_1" value="" type="text">
                            </div>
                            <div class="col-md-12">
                                <label for="lot_2">LOT Kedua</label>
                                <input class="form-control" id="lot_2" name="lot_2" value="" type="text">
                            </div>
                            <div class="col-md-12">
                                <label for="lot_3">LOT Ketiga</label>
                                <input class="form-control" id="lot_3" name="lot_3" value="" type="text">
                            </div>
                            <div class="col-md-12">
                                <label for="dead">Dead</label>
                                <input class="form-control" id="dead" name="dead" value="0" type="text">
                            </div>
                            <div class="col-md-12" style="display:none">
                                <label for="Error">Error</label>
                                <input class="form-control" id="error" name="error" value="0" type="text">
                            </div>
                            <div class="col-md-12" style="display:none">
                                <label for="card_body">Card Body</label>
                                <input class="form-control" id="lemah" name="lemah" value="0" type="text">
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
                $('#tabel-pol').DataTable();
                var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                var tanggal=$("#input_tanggal").val();                        
                $("#tbl_laporan_sementara").load("applet/tbl_laporan_sementara/"+operator);        
                $("#tmpt_laporan").load("applet/tbl_laporan/"+operator+'/'+tanggal);    
                
                $("#simpan_laporan_sementara").click(function(){                        
                    $("#status").html("");
                    var $this = $(this);                        
                    var kode_pol=$("#kode_pol").val();
                    var sam = $("#sam").val();
                    var id_pol=$("#id_pol").val();                         
                    var id_proses="17"; 
                    var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                    var line=$("#line").val();
                    var isi=$("#isi").val();
                    var shift=$("#shift").val();
                    var tanggal="<?php echo date('Y-m-d'); ?>";
                    var tipe_chip = $("#tipe_chip").html();
                    
                    var data = new FormData();
                    data.append('kode_pol', kode_pol);
                    data.append('sam', sam);
                    data.append('id_pol', id_pol);
                    data.append('id_proses', id_proses);
                    data.append('operator', operator);
                    data.append('line', line);
                    data.append('isi', isi);
                    data.append('shift', shift);
                    data.append('tanggal', tanggal);
                    data.append('tipe_chip', tipe_chip);
                    data.append('_token', $('meta[name=csrf-token]').attr('content'));
                    
                    if(kode_pol=="" || line=="" || isi=="" || shift=="" || sam=="" || tipe_chip==null){
                        alert("Semua data Harus diisi");
                    }else if(id_pol==""){
                        alert("isi pol dengan benar");
                    }else{
                        $this.button('loading');                                                 
                        $.ajax({
                            url:"applet/simpan_sementara",
                            type: 'POST',
                            data:data,
                            cache:false,
                            processData: false,
                            contentType: false,     
                            success:function(msg){									
                                $("#status").html(msg);
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                $("#tbl_laporan_sementara").load("applet/tbl_laporan_sementara/"+operator);
                                $("#tmpt_laporan").load("applet/tbl_laporan/"+operator+'/'+tanggal);    
                                $("#iner").val("");
                                $this.button('reset');                                    
                                app.online();
                            }
                        });                            
                    }                       
                });
                
                $("#tbl_laporan_sementara").on("click","#batal", function(){                        
                    if(confirm("Apakah yakin data akan dihapus?")){
                        var id_applet = $(this).attr('value');
                        $.ajax({
                            url:"applet/"+id_applet,
                            type : "POST",
                            data : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            cache:false,
                            success:function(msg){
                                $("#status").html("Berhasil dihapus");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();
                                $("#tbl_laporan_sementara").load("applet/tbl_laporan_sementara/"+operator);
                                $("#kode_pol").focus();
                                app.online();
                            }
                        });
                    }                        
                });
                
                $("#tmpt_laporan").on("click","#delete_laporan", function(){                     
                    if(confirm("Apakah yakin data akan dihapus?")){
                        var id_applet   = $(this).attr('value');
                        $.ajax({
                            url         : "applet/"+id_applet,
                            type        : "POST",
                            data        : {'_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')},
                            cache       : false,
                            success:function(msg){
                                app.online();
                                $("#status").html("Berhasil dihapus");
                                $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-danger').css('display', 'block').delay(3000).fadeOut();
                                $("#tmpt_laporan").load("applet/tbl_laporan/"+operator+'/'+tanggal);    
                                $("#kode_pol").focus();                                
                                app.sendMonitoring('applet');
                            }
                        });
                    }                        
                });
                
                $("#simpan_lot").change(function(){
                    var lot_1 = $("#lot_1").val();
                    if(lot_1 == ""){
                        alert('lot_1 tidak boleh kosong');
                    }else{
                        if(confirm("Pastikan sudah mengisi Nomor LOT & Jumlah Reject dengan benar")){                                                         
                            var id_applet = $("#id_applet").val()
                            var input_tanggal =$("#input_tanggal").val();
                            $this = $(this);
                            var data = new FormData();
                            data.append('lot_1', $("#lot_1").val());                            
                            data.append('lot_2', $("#lot_2").val())
                            data.append('lot_3', $("#lot_3").val())
                            data.append('dead',$("#dead").val())
                            data.append('error',$("#error").val())
                            data.append('lemah',$("#lemah").val())
                            data.append('id_applet', $("#id_applet").val()); // Ambil data nis
                            data.append('upload', $(this)[0].files[0]);
                            data.append('_token', $('meta[name=csrf-token]').attr('content'));
                            
                            $.ajax({
                                url: 'applet/upload', // File tujuan
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
                                    $("#modal-lot").modal('hide');
                                    $("#lot_1").val("");
                                    $("#lot_2").val("");
                                    $("#lot_3").val("");
                                    $("#dead").val("0");
                                    $("#error").val("0");
                                    $("#lemah").val("0");
                                    
                                    if(response[0]==1){
                                        $("#status").html("Gagal Menyimpan='Nama Log tidak sama dengan Nomor Inner'");
                                        $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                    }else if(response[0]==2){	
                                        app.online()
                                        $("#tbl_laporan_sementara").load("applet/tbl_laporan_sementara/"+operator);								
                                        $("#tmpt_laporan").load("applet/tbl_laporan/"+operator+'/'+tanggal);    
                                        $("#status").html("berhasil disimpan");
                                        $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();									
                                        app.sendMonitoring('applet');
                                    }else{
                                        $("#status").html("Gagal Menyimpan='Log tidak 500'");
                                        $('#aler').removeClass('alert-info').removeClass('alert-danger').addClass('alert-info').css('display', 'block').delay(3000).fadeOut();
                                    }
                                },                            
                            });             					
                        }
                    }
                });
                
                $('#input_tanggal').change(function(){                        
                    var input_tanggal =$("#input_tanggal").val();
                    $("#tmpt_laporan").load("applet/tbl_laporan/"+operator+'/'+input_tanggal);                                            
                });
                
            })
            
            function showPol()
            {
                $('#modal-pol').modal('show');
            }
            function selectItem(kode,id_pol,nama,tipe_chip)
            {            
                $("#nama_pol").html(nama);
                $("#kode_pol").val(kode);                
                $("#id_pol").val(id_pol);       
                $("#tipe_chip").html(tipe_chip);
                $('#modal-pol').modal('hide');
            }
            function showLot(id)
            {                                
                $('#id_applet').val(id)                
                $('#modal-lot').modal('show');                
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
                    url: "applet/update/"+id,                    
                    type : 'POST',
                    data : data,
                    cache:false,
                    processData: false,
                    contentType: false,     
                    success: function(data){
                        $(editableObj).css("background","#FDFDFD");
                        var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                        var tanggal=$("#input_tanggal").val();                                   
                        $("#tmpt_laporan").load("applet/tbl_laporan/"+operator+'/'+tanggal);                                    
                    }        
                });
            }
        </script>        
        @endsection