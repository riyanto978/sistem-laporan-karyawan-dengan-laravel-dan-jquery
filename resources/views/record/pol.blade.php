<table class="table table-striped " id="tabel-pol">
    <thead>
        <tr>
            <th>Kode Pol</th>
            <th>Nama Pol</th> 
            <th>Tahun</th>
            <th>Jml order</th>            
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $data)
        <tr>
            <td>{{ $data->kode }}</td>
            <td>{{ $data->nama }}</td>
            <td>{{ $data->tahun }}</td>
            <td>{{ $data->jmlorder }}</td>                
            <td><a onclick="selectPol({{ $data->kode }},{{ $data->id_pol }},'{{ $data->nama }}')" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></td>
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
        $('#tabel-pol').DataTable( {        
        } );
    } );
</script>
