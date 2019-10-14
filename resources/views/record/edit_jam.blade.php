<table class="table table-light " id="tbl_laporan">
    <thead>
        <tr>            
            <th>No</th>            
            <th>Jam mulai</th>
            <th>Jam selesai</th>            
            <th>Line</th>            
            <th>Inner</th>
            <th>Dead</th>            
            <th>error</th>            
            <th>6a82</th>            
        
        </tr>
    </thead>
    <tbody>        
        @foreach($record as $data)
        <tr>            
            <td><?php echo $no++; ?></td>                                
            <td contenteditable="true" onBlur="saveToDatabase(this,'jam_mulai','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->jam_mulai }}</td>                    
            <td contenteditable="true" onBlur="saveToDatabase(this,'jam_selesai','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->jam_selesai }}</td>      
            <td>{{ $data->line }}</td>                                
            <td>{{ $data->iner }}</td>                                
            <td contenteditable="true" onBlur="saveToDatabase(this,'dead','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->dead }}</td>                                
            <td contenteditable="true" onBlur="saveToDatabase(this,'error','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->error }}</td>                    
            <td contenteditable="true" onBlur="saveToDatabase(this,'virgin','{{ $data->id_record }}')" onClick="showEdit(this);">{{ $data->virgin }}</td>                                
        </tr>
        @endforeach
    </tbody>
</table>