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
      <label for="nama" class="col-md-3 control-label">Nama User</label>
      <div class="col-md-6">
         <input id="nama" type="text" class="form-control" name="nama" autofocus required>
         <span class="help-block with-errors"></span>
      </div>
   </div>

   <div class="form-group">
      <label for="Username" class="col-md-3 control-label">Username</label>
      <div class="col-md-6">
         <input id="username" type="text" class="form-control" name="username" required>
         <span class="help-block with-errors"></span>
      </div>
   </div>

    <div class="form-group">
      <label for="password" class="col-md-3 control-label">Password</label>
      <div class="col-md-6">
         <input id="password" type="password" class="form-control" name="password" required>
         <span class="help-block with-errors"></span>
      </div>
   </div>

   <div class="form-group">
      <label for="level" class="col-md-3 control-label">Level</label>
      <div class="col-md-6">
         <select id="level" name="level" class="form-control">
            <option value="1">Administrator</option>
            <option value="2" selected="selected">operator</option>            
         </select>
         <span class="help-block with-errors"></span>
      </div>
   </div>

  <div class="form-group">
      <label for="foto" class="col-md-3 control-label">Foto</label>
      <div class="col-md-6">
      <input id="foto" type="file" class="form-control" name="foto" required="required">     
               <span class="help-block with-errors"></span>
      </div>
   </div>

   
</div>
   
   <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Simpan </button>
      <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
   </div>
      
   </form>

         </div>
      </div>
   </div>
