    <table class="table table-light" id="tbl_laporan">
        <thead>
            <tr>                
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
                
            </tr>
        </thead>
        <tbody>
            <tbody>
                @foreach($preperso as $data)
                <tr>
                          
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
                    <td>{{ $data->dead }}</td>                    
                    <td>{{ $data->isi }}</td>                    
                    
                </tr>
                @endforeach
            </tbody>
        </table>