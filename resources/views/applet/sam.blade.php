@extends('layouts.app')

@section('judul')
upload_sam
@endsection

@section('title')
upload_sam
@endsection

@section('breadcrumb')
@parent
<li>upload_sam</li>
@endsection

@section('content')     
<div class="row">
    <div class="col-md-8">        
        <br>        
        <div class="col-md-3">            
            <input class="form-control" type="number" id="iner" >            
        </div>
        <div class="col-md-4">
            <input type='file' accept=.txt id='upload_log'>
        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" id="upload"><span class="glyphicon glyphicon-upload"></span> Upload</button>
        </div>                
        <div id="status"></div>
    </div>    
</div>

    
@endsection
@section('script')
    <script type="text/javascript">
    $(function(){        
        $("#upload").click(function(){            
            var iner=$("#iner").val();
            var file=$("#upload_log").val();
            
            if(iner=="" || file==""){
                $("#status").html("tidak boleh ada yang kosong");
            }else{
                var data = new FormData();                
                data.append('iner', $("#iner").val()); 
                data.append('upload', $("#upload_log")[0].files[0]);                
                data.append('_token', $('meta[name=csrf-token]').attr('content'));
                $.ajax({
                    url:"{{ route('proses_sam') }}",
                    type: 'POST',
                    data: data,
                    cache:false,
                    processData: false,
                    contentType: false,
                    success:function(msg){
                        $("#status").html(msg);
                        $("#iner").val("");
                        $("#upload_log").val("");
                    }
                    
                });
            }
        });
        
    });
</script>  
@endsection