<div class="row container">
  <div class="col-md-4">
    <div class="list-group">
      <a href="#" class="list-group-item bg-danger">
        <i class="fa fa-envelope fa-fw"></i> Preperso
        <span class="pull-right  small "></span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Inner
        <span class="pull-right  ">{{ $list->iner1 }} </span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Jumlah
        <span class="pull-right  ">{{ count($uid) }}</span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Operator
        <span class="pull-right  ">{{ $op1 }} ({{ $line }})</span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Jam selesai
        <span class="pull-right  ">{{ $jam1 }}</span>
      </a>
      
    </div>      
  </div>
  <div class="col-md-4">
    <div class="list-group">
      
      <a href="#" class="list-group-item ">
        <i class="fa fa-briefcase fa-fw"></i> Record
        <span class="pull-right  small "></span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Inner
        <span class="pull-right  ">{{ $list->iner2 }} </span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Jumlah
        <span class="pull-right  ">{{ count($record) }}</span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Operator
        <span class="pull-right  ">{{ $op2 }}</span>
      </a>
      <a href="#" class="list-group-item">
        <span class="text-center">&nbsp;</span>
        <span class="text-center">&nbsp;</span>
        <i class="fa fa-caret-right fa-fw"></i>Jam selesai
        <span class="pull-right  ">{{ $jam2 }}</span>
      </a>
    </div>      
  </div>
</div>

<div class='row'>  
  <div class="col-md-6">
    Error Record ke Preperso  
  <br>
  @foreach ($result1 as $key1 => $value1) 
  <?php $key1++; ?>
  {{ $key1}} => {{ $value1  }}<br>
  @endforeach 
  </div>
  <div class="col-md-3">
    <input type="button" value="simpan Log" class="btn btn-success" onclick="simpanlogrecord({{ $list->id2 }})">
  </div>
  
</div>

