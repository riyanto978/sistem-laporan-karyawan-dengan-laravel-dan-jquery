{{-- <script>
    function online(){
        
        Echo.leave('online')
        
        Echo.join('online')
        .here(user => {                
            app.users = user
        })
        .joining(user => {
            app.users.push(user)
        })
        .leaving(user => {
            app.users = app.users.filter(u => u.id != user.id)
        });            
    }
</script> --}}
<script type="text/javascript">
    //set timezone
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    //buat object date berdasarkan waktu di server
    var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
    //buat object date berdasarkan waktu di client
    var clientTime = new Date();
    //hitung selisih
    var Diff = serverTime.getTime() - clientTime.getTime();    
    //fungsi displayTime yang dipanggil di bodyOnLoad dieksekusi tiap 1000ms = 1detik
    function displayServerTime(){
        //buat object date berdasarkan waktu di client
        var clientTime = new Date();
        //buat object date dengan menghitung selisih waktu client dan server
        var time = new Date(clientTime.getTime() + Diff);
        //ambil nilai jam
        var sh = time.getHours().toString();
        //ambil nilai menit
        var sm = time.getMinutes().toString();
        //ambil nilai detik
        var ss = time.getSeconds().toString();
        //tampilkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
        
        var x = document.getElementsByClassName("clock");
        var i;
        for (i = 0; i < x.length; i++) {
            x[i].innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
        }        
    }
</script>

<script>
    window.monitoring = function (tipe){    
        var tanggal=$("#input_tglmonitor").val();
        var tanggal_akhir=$("#input_tglmonitor_akhir").val();
        var shift=$("#shift").val();
        
        $("#resume_lap_monitor").load("resume/laporan/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        if(tipe == 'preperso'){
            $("#tmpt_preper_monitor").load("bar/preperso/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        }else if(tipe == 'record'){
            $("#tmpt_record_monitor").load("bar/record/"+tanggal+'/'+tanggal_akhir+'/'+shift);
        }else if(tipe == 'applet'){
            $("#tmpt_applet_monitor").load("bar/applet/"+tanggal+'/'+tanggal_akhir+'/'+shift); 
        }                        
    }
</script>