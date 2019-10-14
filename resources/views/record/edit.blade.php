@extends('layouts.app')

@section('judul')
    edit record virgin
@endsection

@section('title')
    edit Record virgin
@endsection

@section('breadcrumb')
@parent
<li>Record</li>
@endsection

@section('content')     
<div class="container-fluid">
    <br>                     
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
</div>
        
        @endsection
        
        @section('script')
        
        <script>
            $(function(){                
                 $('#tbl_iner').DataTable();
                    var operator=encodeURI("<?php echo Auth::user()->username;  ?>");
                    var tanggal=$("#input_tanggal").val();        

                    $("#tmpt_laporan").load("record/tbl_laporan/edit/"+operator+'/'+tanggal);    

                    $('#input_tanggal').change(function(){                        
                        var input_tanggal =$("#input_tanggal").val();
                        $("#tmpt_laporan").load("record/tbl_laporan/edit/"+operator+'/'+input_tanggal); 
                    });
            });

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
                           $("#tmpt_laporan").load("record/tbl_laporan/edit/"+operator+'/'+tanggal); 
                        }        
                    });
                }
        </script>
        @endsection