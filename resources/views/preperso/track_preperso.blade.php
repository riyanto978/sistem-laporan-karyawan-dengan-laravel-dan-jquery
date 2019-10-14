@extends('layouts.app')

@section('judul')
Track Preperso
@endsection

@section('title')
Track Preperso
@endsection

@section('breadcrumb')
@parent
<li>Track Preperso</li>
@endsection

@section('content')     
<div class="box-header with-border">
    <center><h3 class="box-title" style="font-size: 34px ;font-family:Constantia;color: Black"> <b>Track Preperso</b></h3></center>
</div>
<div class="row">
    <div class="col-md-8">        
        <br>        
        <div class="col-md-4">            
            <input class="form-control" type="text" id="uid" >            
        </div>        
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" id="cari"><span class="glyphicon glyphicon-upload"></span> Cari</button>
        </div>                
        <div id="status"></div>
    </div>    
</div>
<div class="row">
    <br>
    <div class="col-xs-12"> 
        <div class="panel panel-info">
            <table class="table table-striped table-bordered table-hover" id="tbl_cari">
                
            </table>
        </div>
    </div>
</div>


@endsection
@section('script')
<script type="text/javascript">
    $(function(){        
        $("#cari").click(function(){            
            var uid=$("#uid").val();            
            
            if(uid==""){
                $("#status").html("tidak boleh ada yang kosong");
            }else{
                $("#tbl_cari").load("preperso/"+uid);        
            }
        });
        
    });
</script>  
@endsection