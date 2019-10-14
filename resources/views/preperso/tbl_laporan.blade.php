<table class="table" id="tbl_laporan">
    <thead>
        <tr>
            <th></th>
            <th>No</th>
            <th>Nama Pol</th>
            <th>Kode Pol</th>
            <th>Tahun</th>
            <th>Proses</th>
            <th>Jam mulai</th>
            <th>Jam selesai</th>
            <th>Line</th>
            <th>Shift</th>
            <th>Inner</th>
            <th>Dead</th>            
            <th>error</th> 
            <th>Isi</th>
            
        </tr>
    </thead>
    <tbody>
        <tbody>
            
            @foreach($preperso as $data)
            <tr>
                <td><a id="delete_laporan" href="#"  value="{{ $data->id_preperso }}"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                </td>                    
                <td><?php echo $no++; ?></td>                    
                <td>{{ $data->nama }}</td>           
                <td>{{ $data->kode }}</td>           
                <td>{{ $data->tahun }}</td>           
                <td>Preperso</td>
                <td>{{ jam_tambah($data->jam_mulai) }}</td>
                <td>{{ jam_tambah($data->jam_selesai) }}</td>
                <td>{{ $data->line }}</td>                    
                <td>{{ $data->shift }}</td>                    
                <td>{{ $data->id_preperso }}</td>                    
                <td contenteditable="true" onBlur="saveToDatabase(this,'dead','{{ $data->id_preperso }}')" onClick="showEdit(this);">{{ $data->dead }}</td>                    
                <td contenteditable="true" onBlur="saveToDatabase(this,'error','{{ $data->id_preperso }}')" onClick="showEdit(this);">{{ $data->error }}</td>                    
                <td>{{ $data->isi }}</td>                                    
            </tr>
            @endforeach
        </tbody>
    </table>