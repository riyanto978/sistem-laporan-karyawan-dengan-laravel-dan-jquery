<table class="table table-light " id="tbl_laporan">
    <thead>
        <tr>
            <th></th>
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
            <th>Isi</th>
            <th>Dead</th>            
            @if($tipe == 3)
            <th>error</th>            
            <th>6a82</th>            
            @endif
        </tr>
    </thead>
    <tbody>        
        @foreach($record as $data)
        <tr>
            <td><a id="delete_laporan" href="#"  value="{{ $data->id_record }}"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
            </td>                    
            <td><?php echo $no++; ?></td>                    
            <td>{{ $data->nama }}</td>           
            <td>{{ $data->kode }}</td>           
            <td>{{ $data->tahun }}</td>          
            <td>{{ $data->nama_periode }}</td>            
            <td>Record</td>
            {{-- <td contenteditable="true" onBlur="saveToDatabase(this,'jam_mulai','{{ $data->id_record }}')" onClick="showEdit(this);">{{ jam_tambah($data->jam_mulai) }}</td>                    
            <td contenteditable="true" onBlur="saveToDatabase(this,'jam_selesai','{{ $data->id_record }}')" onClick="showEdit(this);">{{ jam_tambah($data->jam_selesai) }}</td>                     --}}
            <td>{{ jam_tambah($data->jam_mulai) }}</td>
            <td>{{ jam_tambah($data->jam_selesai) }}</td>
            <td>{{ $data->line }}</td>                                
            <td>{{ $data->iner }}</td>                    
            <td>{{ $data->shift }}</td>                    
            <td>{{ $data->isi }}</td>       
            <td contenteditable="true" onBlur="saveToDatabase(this,'dead','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->dead }}</td>                    
            @if($tipe == 3)
            <td contenteditable="true" onBlur="saveToDatabase(this,'error','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->error }}</td>                    
            <td contenteditable="true" onBlur="saveToDatabase(this,'virgin','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->virgin }}</td>                    
            @endif               
        </tr>
        @endforeach
    </tbody>
</table>