<div class="panel panel-default">
    <table class="table " id="tbl_laporan">
        <thead>
            <tr>            
                <th>No</th>
                <th>Nama Pol</th>
                <th>Kode Pol</th>
                <th>Tahun</th>
                <th>Periode</th>
                <th>Proses</th>
                <th>Jam mulai</th>
                <th>Jam selesai</th>            
                <th>Line</th>            
                <th>Inner</th>
                <th>Shift</th>
                <th>Dead</th>            
                <th>Isi</th>
                
            </tr>
        </thead>
        <tbody>        
            @foreach($cari as $data)
            <tr>                            
                <td><?php echo $no++; ?></td>                    
                <td>{{ $data->nama }}</td>           
                <td>{{ $data->kode }}</td>           
                <td>{{ $data->tahun }}</td>          
                <td>{{ $data->nama_periode }}</td>          
                <td>{{ $tipe }}</td>
                <td>{{ jam_tambah($data->jam_mulai) }}</td>
                <td>{{ jam_tambah($data->jam_selesai) }}</td>
                <td>{{ $data->line }}</td>                                
                @if($tipe == 'applet')
                <td>{{ $data->id_applet }}</td>                    
                @elseif($tipe == 'preperso')
                <td>{{ $data->id_preperso }}</td>                    
                @else
                <td>{{ $data->iner }}</td>                    
                @endif
                <td>{{ $data->shift }}</td>                    
                <td>{{ $data->dead }}</td>                    
                <td>{{ $data->isi }}</td>                                    
            </tr>
            @endforeach
        </tbody>
    </table>
</div>