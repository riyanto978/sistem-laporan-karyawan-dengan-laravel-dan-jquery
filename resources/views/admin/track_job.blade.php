@extends('layouts.app')

@section('judul')
Track Job
@endsection

@section('title')
Track Job
@endsection

@section('breadcrumb')
@parent
<li>Track Applet</li>
@endsection

@section('content')     

<div class="row">
    <form id="form_cari">
        <div class="col-md-8">        
            <br>        
            <div class="col-md-4">
                <label for="uid">Inner</label>            
                <input class="form-control" type="text" id="uid" >            
            </div>        
            <div class="col-md-2">
                <select class="form-control" id="tipe">
                    <option value="2">applet</option>
                    <option value="3">preper</option>
                    <option value="4">record</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary" id="cari"><span class="glyphicon glyphicon-upload"></span> Cari</button>
            </div>                
            <div id="status"></div>
        </div>    
    </form>
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
        $("#form_cari").on('submit', function(e){
            e.preventDefault();            
            var iner=$("#uid").val();            
            var tipe =$("#tipe").val();
            if(iner==""){
                $("#status").html("tidak boleh ada yang kosong");
            }else{
                $("#tbl_cari").load("track/job/"+iner+'/'+tipe);        
            }
        });
        
    });
</script>  
@endsection