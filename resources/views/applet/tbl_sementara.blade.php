<table class="table table-light" id="tbl_laporan_sementara">
  <thead>
    <tr>
      <th></th>
      <th>No</th>
      <th>Periode</th>
      <th>Kode Pol</th>
      <th>Nama Pol</th>              
      <th>Proses</th>
      <th>Tanggal</th>
      <th>Jam mulai</th>
      <th>Line</th>
      <th>Inner</th>              
      <th>Selesaikan</th>              
    </tr>
  </thead>
  <tbody>
    @foreach($applet as $data)
    <tr>
      <td><a id="batal" href="#"  value="{{ $data->id_applet }}"><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>
      </td>
      <td>{{ $no++ }}</td>
      <td>{{ $data->nama_periode }}</td>
      <td>{{ $data->kode }} ( {{ $data->tahun }} )</td>
      <td>{{ $data->nama }}</td>                
      <td>Applet</td>                
      <td>{{ ambil_tanggal($data->jam_mulai) }}</td>
      <td>{{ jam_tambah($data->jam_mulai) }}</td>
      <td>{{ $data->line }}</td>                
      <td>{{ $data->id_applet }}</td>                
      <td>                    
        <button onclick="showLot({{ $data->id_applet }})" type='button' class='btn btn-success'>INPUT</button>
      </td>              
      
    </tr>
    @endforeach
  </tbody>
</table>