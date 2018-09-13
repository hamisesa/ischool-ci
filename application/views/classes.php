<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Halaman Utama</a></li> 
  <li class="active">Kelola Kelas</li>
</ol>

<div class="panel panel-default">
  <div class="panel-heading">
    Kelola Kelas
  </div>
  <div class="panel-body">  	    
      <div id="messages"></div>

    	<div class="pull pull-right">
    		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addClass" id="addClassModelBtn"> 
    			<i class="glyphicon glyphicon-plus-sign"></i> Tambah Kelas
    		</button>
    	</div>

    	<br /> <br /> <br />
    	
    	<table id="manageClassTable" class="table table-bordered">
    		<thead>
    			<tr>
    				<th>No.</th>
    				<th>Kelas</th>
    				<th>Lokasi Kelas</th>
    				<th></th>
    			</tr>
    		</thead>
    	</table>	
    
  </div>
</div>

<!-- add class -->
<div class="modal fade" tabindex="-1" role="dialog" id="addClass">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Kelas</h4>
      </div>

      <form class="form-horizontal" method="post" id="createClassForm" action="classes/create">

      <div class="modal-body">
      
      <div id="add-class-messages"></div>

		  <div class="form-group">
		    <label for="className" class="col-sm-4 control-label">Kelas : </label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="className" name="className" placeholder="Kelas">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="numericName" class="col-sm-4 control-label">Lokasi Kelas : </label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="numericName" name="numericName" placeholder="Lokasi Kelas">
		    </div>
		  </div>		  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit class -->
<div class="modal fade" tabindex="-1" role="dialog" id="editClassModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Kelas</h4>
      </div>

      <form class="form-horizontal" method="post" id="editClassForm" action="classes/update">

      <div class="modal-body">
      
      <div id="edit-class-messages"></div>

      <div class="form-group">
        <label for="editClassName" class="col-sm-4 control-label">Kelas : </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="editClassName" name="editClassName" placeholder="Class Name">
        </div>
      </div>
      <div class="form-group">
        <label for="editNumericName" class="col-sm-4 control-label">Lokasi Kelas : </label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="editNumericName" name="editNumericName" placeholder="Numeric Name">
        </div>
      </div>      
      </div>
      <div class="modal-footer edit-class-modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove class -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeClassModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Kelas</h4>
      </div>
      
      <div class="modal-body">
        <div id="remove-messages"></div>
        <p> Anda yakin ingin menghapus kelas ini?</p>    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary" id="removeClassBtn">Yakin</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="<?php echo base_url('../custom/js/classes.js'); ?>"></script>