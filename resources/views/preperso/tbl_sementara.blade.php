<table class="table table-light" id="tbl_laporan_sementara">
  <thead>
    <tr>
      <th></th>
      <th>No</th>
      <th>Pol</th>
      <th>Nama Pol</th>      
      <th>Proses</th>
      <th>Tanggal</th>
      <th>Jam mulai</th>
      <th>Line</th>
      <th>Inner </th>      
      <th>Op applet</th>
      <th>Selesai</th>      
    </tr>    
  </thead>
  <tbody>
    @foreach($arr as $data)
    <tr>
      <td><a id="batal" href="#"  value="{{ $data['id_preperso'] }}"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
      </td>
      <td>{{ $no++ }}</td>
      <td>{{ $data['kode'] }} ( {{ $data['tahun'] }} )</td>
      <td>{{ $data['nama'] }}</td>                
      <td>Preperso</td>                
      <td>{{ ambil_tanggal($data['jam_mulai']) }}</td>
      <td>{{ jam_tambah($data['jam_mulai']) }}</td>
      <td>{{ $data['line'] }}</td>                
      <td>{{ $data['id_preperso'] }}</td>                
      <td>{{ $data['operator'] }}</td>
      <td>                    
        <input type='file' accept=.txt id='upload' value='{{ $data['id_preperso'] }}' >
      </td>              
      
    </tr>
    @endforeach
  </tbody>
</table>