    <table class="table table-light" id="tbl_laporan">
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
                <th>Isi</th>
                <th>No Lot</th>
            </tr>
        </thead>
        <tbody>
            <tbody>
                @foreach($applet as $data)
                <tr>
                    <td><a id="delete_laporan" href="#"  value="{{ $data->id_applet }}"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
                    </td>                    
                    <td><?php echo $no++; ?></td>                    
                    <td>{{ $data->nama }}</td>                
                    <td>{{ $data->kode }}</td>           
                    <td>{{ $data->tahun }}</td>    
                    <td>Applet</td>
                    <td>{{ jam_tambah($data->jam_mulai) }}</td>
                    <td>{{ jam_tambah($data->jam_selesai) }}</td>
                    <td>{{ $data->line }}</td>                    
                    <td>{{ $data->shift }}</td>                    
                    <td>{{ $data->id_applet }}</td>                    
                    <td contenteditable="true" onBlur="saveToDatabase(this,'dead','{{ $data->id_applet }}')" onClick="showEdit(this);">{{ $data->dead }}</td>                    
                    <td>{{ $data->isi }}</td>                    
                    <td>{{ $data->lot }}</td>                     
                </tr>
                @endforeach
            </tbody>
        </table>