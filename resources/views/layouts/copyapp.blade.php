<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <link href="{{ asset('public/images/gopaperlesslogo2.jpg') }}" rel="shortcut icon">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('judul')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="{{ asset('public/adminLTE/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/adminLTE/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/adminLTE/dist/css/skins/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('public/adminLTE/plugins/datepicker/datepicker3.css') }}">
  <style type="text/css">
    .modal-backdrop {
      /* bug fix - no overlay */    
      display: none;    
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini" >
  <div class="wrapper" id="appku">
    
    <!-- Header -->
    <header class="main-header">
      
      <a href="#" class="logo">
        <span class="logo-mini"><b>Perso</b></span>
        <span class="logo-lg"><b>Perso</b>Nalisasi</span>
      </a>
      
      
      <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        
        <div class="navbar-custom-menu" >
          <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">                
                <span class="hidden-xs"> @{{ users.length }} Online</span>
              </a>
            </li>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-font"></i>
                <span class="label label-success">@{{ usersApplet.length }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">@{{ usersApplet.length }} Online</li>
                <li>                  
                  <ul class="menu">
                    <li v-for="(user, index) in usersApplet" :key="index">
                      <a href="#">
                        <div class="pull-left">
                          <img :src="`public/foto/300/${ user.foto }`" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          @{{ user.name }}
                          <small>Line @{{ user.job.line }}</small>
                        </h4>
                        <p>Inner @{{ user.job.id_applet }}
                          <span class="pull-right"> @{{ user.job.nama }}</span>
                        </p>
                      </a>
                    </li>                    
                  </ul>
                </li>                
              </ul>
            </li> 
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file-powerpoint-o"></i>
                <span class="label label-success">@{{ usersPreperso.length }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">@{{ usersPreperso.length }} Online</li>
                <li>                  
                  <ul class="menu">
                    <li v-for="(user, index) in usersPreperso" :key="index">
                      <a href="#">
                        <div class="pull-left">
                          <img :src="`../public/foto/300/${ user.foto }`" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          @{{ user.name }}
                          <small>Line @{{ user.job.line }}</small>
                        </h4>
                        <p>Inner @{{ user.job.id_preperso }}
                          
                        </p>
                      </a>
                    </li>                    
                  </ul>
                </li>                
              </ul>
            </li> 
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-registered"></i>
                <span class="label label-success">@{{ usersRecord.length }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">@{{ usersRecord.length }} Online</li>
                <li>                  
                  <ul class="menu">
                    <li v-for="(user, index) in usersRecord" :key="index">
                      <a href="#">
                        <div class="pull-left">
                          <img :src="`../public/foto/300/${ user.foto }`" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          @{{ user.name }}
                          <small>Line @{{ user.job.line }}</small>
                        </h4>
                        <p>Inner @{{ user.job.iner }}
                          <span class="pull-right"> @{{ user.job.nama }}</span>
                        </p>
                      </a>
                    </li>                    
                  </ul>
                </li>                
              </ul>
            </li> 
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-circle-o"></i>
                <span class="label label-success">@{{ usersOther.length }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">@{{ usersOther.length }} Online</li>
                <li>                  
                  <ul class="menu">
                    <li v-for="(user, index) in usersOther" :key="index">
                      <a href="#">
                        <div class="pull-left">
                          <img :src="`public/foto/300/${ user.foto }`" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          @{{ user.name }}
                          
                        </h4>
                        <p>Halaman  @{{ user.halaman }}                          
                        </p>
                      </a>
                    </li>                    
                  </ul>
                </li>                
              </ul>
            </li>       
            
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('public/foto/300/'.Auth::user()->foto) }}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <img src="{{ asset('public/foto/300/'.Auth::user()->foto) }}" class="img-circle" alt="User Image">
                  
                  <p>
                    {{ Auth::user()->name }}
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a class="btn btn-default btn-flat" href="{{ route('user.profil') }}">Edit Profil</a>
                  </div>
                  <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </li>
                
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- End Header -->
    
    
    <!-- Sidebar -->
    <aside class="main-sidebar">
      
      <section class="sidebar">
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{ asset('public/foto/300/'.Auth::user()->foto) }}" class="img-circle user-image" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }} </p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        
        <ul class="sidebar-menu">
          <li class="header">Menu</li>    
          <?php
          $side = $user->halaman;
          ?>
          @if( Auth::user()->level == 1 )                    
          <li class="treeview 
          <?php                     
          if($side == 'pol' || $side == 'user' || $side == 'kartu_sam' || $side =="periode"){
            echo "active";
          }
          ?>
          ">
          <a href="?kirim=rekapitulasi">
            <i class="fa fa-key"></i> <span>Administrator</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $side==='pol' ? 'active' : '' }}"><a href="{{ route('pol.index') }}"><i class="fa fa-list"></i> <span>POL</span></a></li>          
            <li class="{{ $side==='periode' ? 'active' : '' }}"><a href="{{ route('periode.index') }}"><i class="fa fa-list"></i> <span>periode</span></a></li>          
            <li class="{{ $side==='user' ? 'active' : '' }}"><a href="{{ route('user.index') }}"><i class="fa fa-users"></i> <span>User</span></a></li>          
            <li class="{{ $side==='kartu_sam' ? 'active' : '' }}"><a href="{{ route('kartu_sam.index') }}"><i class="fa fa-users"></i> <span>kartu_sam</span></a></li>                        
            <li class="{{ $side==='resume_kartu_sam' ? 'active' : '' }}"><a href="{{ route('resume_sam') }}"><i class="fa fa-users"></i> <span>resume kartu_sam</span></a></li>                        
            <li class="{{ $side==='notifikasi' ? 'active' : '' }}"><a href="{{ route('notifikasi.index') }}"><i class="fa fa-bell-o"></i> <span>Notifikasi</span></a></li>                        
          </ul>
        </li>  
        @endif
        
        <li class="header"></li>              
        <li class="{{ $side==='applet' ? 'active' : '' }}"><a href="{{ route('applet.index') }}"><i class="fa fa-font text-green"></i> <span>Applet</span></a></li>          
        <li class="header"></li>              
        <li class="{{ $side==='preperso' ? 'active' : '' }}"><a href="{{ route('preperso.index', 1) }}"><i class="fa fa-file-powerpoint-o text-blue"></i> <span>Preperso</span></a></li>          
        <li class="{{ $side==='preperso_only' ? 'active' : '' }}"><a href="{{ route('preperso.index', 2) }}"><i class="fa fa-file-powerpoint-o text-blue"></i> <span>Preperso Only</span></a></li>          
        <li class="header"></li>              
        <li class="{{ $side==='record' ? 'active' : '' }}"><a href="{{ route('record.index', 1) }}"><i class="fa fa-registered text-yellow"></i> <span>Record</span></a></li>          
        <li class="{{ $side==='record_only' ? 'active' : '' }}"><a href="{{ route('record.index', 2) }}"><i class="fa fa-registered text-yellow"></i> <span>Record Only</span></a></li>          
        <li class="header"></li>              
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i> <span>Manual</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-blue">2</small>
            </span>
            
          </a>
          <ul class="treeview-menu">
            <li ><a href="{{ route('upload_log') }}"><i class="fa fa-cloud-upload"></i><span>Upload log</span></a></li>
            <li ><a href="{{ route('upload_sam') }}"><i class="fa fa-upload"></i><span>Upload sam</span></a></li>
            <li><a href="{{ route('banding.log') }}"><i class="fa fa-search-plus"></i> <span>Banding Log</span></a></li>  
          </ul>
        </li>        
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i> <span>Tracking</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <small class="label pull-right bg-red">3</small>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ $side==='track_applet' ? 'active' : '' }}"><a href="{{ route('track_applet') }}"><i class="fa fa-search-minus"></i><span>Track Inner Applet</span></a></li>
            <li class="{{ $side==='track_preperso' ? 'active' : '' }}"><a href="{{ route('track_preperso') }}"><i class="fa fa-search-plus"></i><span>Track Inner Preperso</span></a></li>
            <li class="{{ $side==='track job' ? 'active' : '' }}"><a href="{{ route('track_job') }}"><i class="fa fa-search-plus"></i><span>Track Job</span></a></li>
            <li class="{{ $side==='monitoring' ? 'active' : '' }}"><a href="{{ route('monitoring') }}"><i class="fa fa-eye text-red"></i><span>Monitoring</span></a></li>
            <li class="{{ $side==='rekapitulasi' ? 'active' : '' }}"><a href="{{ route('rekapitulasi') }}"><i class="fa fa-columns text-red"></i><span>Rekapitulasi</span></a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>
  
  <div class="content-wrapper">
    <section class="content-header">
      
      <ol class="breadcrumb">
        @section('breadcrumb')
        <li><a href="#"><i class="fa fa-home"></i>Home</a></li>
        @show
      </ol>
    </section>
    
    <section class="content">
      <body onload="setInterval('displayServerTime()', 1000);">
        <span class="clock"><?php print date('H:i:s'); ?></span>                
      </body>
      
      <div class="box" v-if="notifikasi.notifikasi != null">
        <div :class="`box-header with-border bg-${notifikasi.notifikasi.warna}`">
          <center><h3 class="box-title " style="font-size: 34px ;font-family:Constantia;color: Black"> <b>Pengumuman</b></h3></center>
        </div>
        <div class="box-body">
          <div class="col-xs-11">
            @{{ notifikasi.notifikasi.pesan }}
          </div>            
        </div>
      </div>      
      <br>
      <div class="box">        
        <div class="box-header with-border">
          <center><h3 class="box-title" style="font-size: 34px ;font-family:Constantia;color: Black"> <b> @yield('title')</b></h3></center>
        </div>
        <div class="box-body">
          @yield('content')
        </div>        
      </div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      Personalisai 2.0
    </div>
    <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>  
</div>
<script src="{{ asset('public/adminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('public/adminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/adminLTE/dist/js/app.min.js') }}"></script>
<script src="{{ asset('public/js/adminlte.min.js') }}"></script>
<script src="{{ asset('public/js/demo.js') }}"></script>

<script src="{{ asset('public/adminLTE/plugins/chartjs/Chart.min.js') }}"></script>
<script src="{{ asset('public/adminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/adminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('public/adminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/js/validator.min.js') }}"></script>
<script src="{{ asset('public/js/highcharts.js') }}"></script>
{{-- <script src="http://localhost:7777/socket.io/socket.io.js"></script> --}}
<script src="{{ asset('public/js/app.js') }}"></script>

<script>
  var app = new Vue({ 
    el: '#appku', 
    data: {
      messages : [],
      newMessage : '',                       
      user : '',
      users: [],
      event : [],
      activeUser: false,
      typingTimer: false,
      side : '',
      notifikasi : false
    },
    computed: {
      usersApplet() {
        return this.users.filter(x => x.halaman =="applet" )
      },
      usersPreperso() {
        return this.users.filter(x => x.halaman =="preperso" || x.halaman == "preperso_only")
      },
      usersRecord() {
        return this.users.filter(x => x.halaman =="record" || x.halaman == "record_only")
      },
      usersOther() {
        return this.users.filter(x => x.halaman != "preperso" && x.halaman != "preperso_only" && x.halaman != "applet" && x.halaman != "applet_only" && x.halaman != "record" && x.halaman != "record_only")
      },
    },
    
    watch: {
      
    },
    
    mounted() {              
      this.side = '{{ $side }}';
      this.user = <?php echo json_encode(Auth::user());  ?>;      
      this.ambilNotifikasi();
      this.online();
      
    },      
    methods: {
      ambilNotifikasi(){
        axios.get('https://persopaperless.cardtech.co.id/ktp/notifikasi/ambil').then(response => {
          this.notifikasi = response.data;          
          console.log(window.location.hostname);
          if(this.typingTimer) {
            clearTimeout(this.typingTimer);
          }
          this.typingTimer = setTimeout(() => {
            this.notifikasi = false;
          }, this.notifikasi.detik);          
          
        })
      },  
      sendTypingEvent(data){
        // alert('hi');
        Echo.join('online')
        .whisper('typing', data);
      },
      online(){        
        Echo.leave('online')
        
        Echo.join('online')
        .here(user => {                
          this.users = user
        })
        .joining(user => {
          this.users.push(user)
        })
        .leaving(user => {
          this.users = this.users.filter(u => u.id != user.id)
        })        
        
        .listen('send_notifikasi', (notifikasi) =>{
          alert('hi');
          this.notifikasi = notifikasi          
          if(this.typingTimer) {
            clearTimeout(this.typingTimer);
          }
          this.typingTimer = setTimeout(() => {
            this.notifikasi = false;
          }, this.notifikasi.detik);          
        })  
        .listenForWhisper('typing', notifikasi => {          
          this.notifikasi = notifikasi        
          if(this.typingTimer) {
            clearTimeout(this.typingTimer);
          }
          this.typingTimer = setTimeout(() => {
            this.notifikasi = false;
          }, this.notifikasi.detik);  
        })        
      },                  
    }
  })
</script>    


@yield('script')
@include('layouts.script')
</body>
</html>
