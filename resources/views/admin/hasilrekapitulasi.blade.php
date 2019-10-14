<div class='panel panel-success'>
    <div class='panel-heading' >
        <center>Resume Laporan</center>
    </div>
    
    <div class='panel-body'>  
        <table class="table table-bordered ">                        
            <thead> 
                <th>Kode Pol</th>       
                <th class="bg-light">Pre Applet</th>                                                                                                          
                <th class="bg-info">Dead</th>                                                                                                                                                     
                <th class="bg-light">Applet</th>                            
                <th class="bg-success">Dead</th>                                                                
                <th class="bg-light">Preperso</th>                                                                                                          
                <th class="bg-info">Dead</th>                                
                <th class="bg-light">Record</th>                            
                <th class="bg-warning">Dead</th>                                
            </thead>
            <tbody>     
                <?php
                $jml_pre_applet =0;
                $jml_dead_pre_applet=0;
                $jml_applet=0;
                $jml_dead_applet=0;
                $jml_preperso=0;
                $jml_dead_preperso=0;
                $jml_record =0;
                $jml_dead_record=0;
                ?>
                @foreach ($cari as $data)
                <tr >                                                            
                    <td>{{ $data->kode }}</td>
                    <td>{{ $data->pre_applet }}</td>
                    <td>{{ $data->pre_applet_dead }}</td>
                    <td>{{ $data->applet }}</td>
                    <td>{{ $data->applet_dead }}</td>                    
                    <td>{{ $data->preperso }}</td>
                    <td>{{ $data->preperso_dead }}</td>
                    <td>{{ $data->record }}</td>
                    <td>{{ $data->record_dead }}</td>
                </tr>    
                <?php                                
                $jml_pre_applet += $data->pre_applet;
                $jml_dead_pre_applet += $data->pre_applet_dead;
                $jml_applet += $data->applet;
                $jml_dead_applet += $data->applet_dead;
                $jml_preperso += $data->preperso;
                $jml_dead_preperso += $data->preperso_dead;
                $jml_record += $data->record;
                $jml_dead_record += $data->record_dead;
                ?>
                @endforeach                          
                <tr>
                    <td>Jumlah</td>
                    <td>{{ $jml_pre_applet }}</td>
                    <td>{{ $jml_dead_pre_applet }}</td>
                    <td>{{ $jml_applet }}</td>
                    <td>{{ $jml_dead_applet }}</td>
                    <td>{{ $jml_preperso }}</td>
                    <td>{{ $jml_dead_preperso }}</td>
                    <td>{{ $jml_record }}</td>
                    <td>{{ $jml_dead_record }}</td>
                </tr>             
            </tbody>                        
        </table>                
    </div>
</div>