<table class="table table-light" id="tbl_laporan_sementara">
  <thead>
    <tr>
      <th></th>
      <th>No</th>
      <th>Pol</th>
      <th>Nama Pol</th>    
      <th>Periode</th>  
      <th>Proses</th>
      <th>Tanggal</th>
      <th>Jam mulai</th>
      <th>Line</th>
      <th>Inner </th>            
      <th>Selesai</th>      
    </tr>    
  </thead>
  <tbody>
    @foreach($record as $data)
    <tr>
      <td><a id="batal" href="#"  value="{{ $data->id_record }}"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
      </td>
      <td>{{ $no++ }}</td>
      <td>{{ $data->kode }} ( {{ $data->tahun }} )</td>
      <td>{{ $data->nama }}</td>                
      <td>{{ $data->nama_periode }}</td>                
      <td>Record</td>                
      <td>{{ ambil_tanggal($data->jam_mulai) }}</td>
      <td>{{ jam_tambah($data->jam_mulai) }}</td>
      <td>{{ $data->line }}</td>                
      <td>{{ $data->iner }}</td>                
      @if($tipe == 3)
      <td>                    
        <button onclick="showLot({{ $data->id_record }})" type='button' class='btn btn-success'>INPUT</button>
      </td> 
      @else
      <td>                    
        <input type='file' accept=.txt id='upload' value='{{ $data->id_record }}' >
      </td>              
      @endif  
    </tr>
    @endforeach
  </tbody>
</table>