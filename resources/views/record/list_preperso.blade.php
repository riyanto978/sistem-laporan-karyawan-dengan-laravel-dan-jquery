<table class="table table-striped " id="tbl_iner">
    <thead>
        <tr>
            <th>Inner</th>
            <th>Nama Pol</th> 
            <th>Kode Pol</th>   
            <th>Tahun</th>                                     
            <th>Jml order</th>
            <th>Tipe Chip</th>        
            <th>Nama Periode</th>    
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $data)  
        <tr>
            <td>{{ $data->id_applet }}</td>                                            
            <td>{{ $data->nama }}</td>                                            
            <td>{{ $data->kode }}</td>                                            
            <td>{{ $data->tahun }}</td>                                            
            <td>{{ $data->jmlorder }}</td>                                            
            <td>{{ $data->tip }}</td>  
            <td>{{ $data->nama_periode }}</td>                             
            <td><a onclick="selectItem({{ $data->kode }},{{ $data->id_applet }},'{{ $data->nama }}',{{ $data->id_pol }})" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></td>
        </tr>          
        @endforeach
    </tbody>
</table>

<script>
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
        $('#tbl_iner').DataTable( {        
        } );
    } );
</script>