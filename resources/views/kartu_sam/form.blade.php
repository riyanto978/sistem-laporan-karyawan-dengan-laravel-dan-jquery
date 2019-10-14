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
        <input type="hidden" id="id" name="id">
        <div class="form-group">
          <label for="nama" class="col-md-3 control-label">Nama</label>
          <div class="col-md-6">
            <input id="nama" name="nama" class="form-control" type="text">
          <span class="help-block with-errors"></span>
        </div>
      </div>
      <div class="form-group">
        <label for="isi" class="col-md-3 control-label">Isi</label>
        <div class="col-md-6">
          <input class="form-control" id="isi" type="number" min="1" required="required" name="isi">
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
