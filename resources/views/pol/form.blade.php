<div class="modal" id="modal-form" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <form class="form-horizontal" data-toggle="validator" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }} {{ method_field('POST') }}
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span> </button>
          <h3 class="modal-title"></h3>
        </div>
        
        <div class="modal-body">
          <input type="hidden" id="id_pol" name="id_pol">
          <div class="form-group">
            <label for="kode" class="col-md-3 control-label">Kode Pol</label>
            <div class="col-md-6">
              <input class="form-control" id="kode" type="number" min="1" required="required" name="kode">
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="tahun" class="col-md-3 control-label">Tahun</label>
            <div class="col-md-6">
              <input class="form-control" id="tahun" type="number"  required="required" name="tahun" value="{{ date('Y') }}">
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="nama" class="col-md-3 control-label">Nama</label>
            <div class="col-md-6">
              <input id="namapol" name="namapol" class="form-control" type="text">
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group">
            <label for="jmlorder" class="col-md-3 control-label">Jumlah Order</label>
            <div class="col-md-6">
              <input class="form-control" id="jmlorder" type="number" min="1" required="required" name="jmlorder">
              <span class="help-block with-errors"></span>
            </div>
          </div>   
          <div class="form-group">
            <label for="stat" class="col-md-3 control-label">Status</label>
            <div class="col-md-6">
              <select name="stat" id="stat" class="form-control">
                <option value="1">Applet Dahulu</option>
                <option value="2">Preperso Dahulu</option>
                <option value="3">Record Saja</option>
                <option value="0">Selesai</option>
              </select>
              <span class="help-block with-errors"></span>
            </div>
          </div>   
          <div class="form-group">
            <label for="tipe_chip" class="col-md-3 control-label">Tipe_Chip</label>
            <div class="col-md-6">
              <select name="tipe_chip" id="tipe_chip" class="form-control">
                <option value="A">A</option>
                <option value="B">B</option>              
              </select>
              <span class="help-block with-errors"></span>
            </div>
          </div>   
          <div class="form-group">
            <label for="periode" class="col-md-3 control-label">Periode</label>
            <div class="col-md-6">
              <select name="id_periode" id="id_periode" class="form-control" autocomplete="off">
                <option value=""></option>
                @foreach ($periode as $item)
                  <option value="{{ $item->id_periode }}">{{ $item->nama_periode }}</option>
                @endforeach
              </select>
              <span class="help-block with-errors"></span>
            </div>
          </div>             
        </div>                
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
        </form>
        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
      </div>
      
      
      
    </div>
  </div>
</div>
