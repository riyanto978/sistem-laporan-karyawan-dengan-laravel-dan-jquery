
<div class='panel panel-primary'>
    <div class='panel-heading' >
        <center>Resume Laporan Harian {{ ambil_tanggal($awal) }}  sampai  {{ ambil_tanggal($akhir) }}</center>
    </div>
    
    <div class='panel-body'>
        <table  class="table"  >
            <thead>
                <th>Pol</th>
                <th>Nama</th>
                <th>Proses</th>
                <th>Jumlah</th>                                        
                <th>Dead</th>                                         
            </thead>
            <tbody>
                @foreach ($cari as $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->proses }}</td>                    
                    <td>{{ $item->jumlah }}</td>                    
                    <td>{{ $item->dead }}</td>
                </tr>    
                @endforeach                
            </tbody>
        </table>
    </div>
</div>