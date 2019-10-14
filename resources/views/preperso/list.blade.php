<table class="table table-striped " id="tbl_iner">
    <thead>
        <tr>
            <th>Inner</th>
            <th>Nama Pol</th> 
            <th>Kode Pol</th>                                        
            <th>Jml order</th>
            <th>Tipe Chip</th>            
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $ca = mysqli_query($koneksi,"select applet.tip,applet.id_applet,applet.id_pol,pol.nama,pol.kode,pol.jmlorder from applet inner join pol on applet.id_pol = pol.id_pol where applet.status = '2'  group by applet.id_applet");
        while ($data = mysqli_fetch_array($ca)) {                                                   
            ?> 
            <tr>
                <td><?php echo $data['id_applet']; ?></td>                                            
                <td><?php echo $data['nama']; ?></td>     
                <td><?php echo $data['kode']; ?></td>
                <td><?php echo $data['jmlorder']; ?></td>
                <td><?php echo $data['tip']; ?></td>
                <td><a onclick="selectItem(<?php echo $data['kode']; ?>,<?php echo $data['id_applet']; ?>,'<?php echo $data['nama']; ?>',<?php echo $data['id_pol']; ?>)" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>