<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Halaman Utama</a></li> 
  <li class="active">Kelola Sesi</li>
</ol>

<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			
			<div class="panel-heading">
				Kelas
			</div>

			<div class="list-group">			
				<?php 
				if($classData) {
					$x = 1;
					foreach ($classData as $value) { 
					?>
						<a class="list-group-item classSideBar <?php if($x == 1) { echo 'active'; } ?>" onclick="getClassSection(<?php echo $value['class_id'] ?>)" id="classId<?php echo $value['class_id'] ?>">
				    		<?php echo $value['class_name']; ?>(<?php echo $value['numeric_name']; ?>)
					  	</a>	
					<?php 
					$x++;
					}
				} 
				else {
					?>
					<a class="list-group-item">Tidak ada.</a>
					<?php
				}		
				?>
			</div>

		</div>		
	</div>
	<!-- /col-md-4 -->

	<div class="col-md-8">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Kelola Sesi</div>

		  <div class="panel-body">		  
		  	<div class="result"></div>
		  </div>			  
		</div>
	</div>
	<!-- /col-md-8 -->
</div>
<!-- /row -->

<!-- create section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addSectionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambahkan Sesi</h4>
      </div>
      <form action="section/create" method="post" id="addSectionForm">
      <div class="modal-body">
          <div id="add-section-message"></div>

		  <div class="form-group">
		    <label for="sectionName">Sesi</label>
		    <input type="text" class="form-control" id="sectionName" name="sectionName" placeholder="Sesi">
		  </div>
		  <div class="form-group">
		    <label for="teacherName">Guru : </label>
		    <select class="form-control" name="teacherName" id="teacherName">
		    	<option value="">Pilih Guru</option>
		    	<?php 
		    	if($teacherData) { 
	    			foreach ($teacherData as $key => $value): ?>
			    		<option value="<?php echo $value['teacher_id'] ?>"><?php echo $value['fname'] . ' ' . $value['lname'] ?></option>
			    	<?php 
			    	endforeach 
			    	?>
	    		<?php
		    	} 
		    	else { ?>
		    		<option value="">Tidak Tersedia</option>
		    	<?php 
		    	}
		    	?>
		    </select>
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

<!-- update section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editSectionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Sesi</h4>
      </div>
      <form action="section/update" method="post" id="editSectionForm">
      <div class="modal-body">
          <div id="edit-section-messages"></div>

		  <div class="form-group">
		    <label for="editSectionName">Sesi</label>
		    <input type="text" class="form-control" id="editSectionName" name="editSectionName" placeholder="Sesi">
		  </div>
		  <div class="form-group">
		    <label for="editTeacherName">Guru : </label>
		    <select class="form-control" name="editTeacherName" id="editTeacherName">
		    	<option value="">Pilih Guru</option>
		    	<?php 
		    	if($teacherData) { 
	    			foreach ($teacherData as $key => $value): ?>
			    		<option value="<?php echo $value['teacher_id'] ?>"><?php echo $value['fname'] . ' ' . $value['lname'] ?></option>
			    	<?php 
			    	endforeach 
			    	?>
	    		<?php
		    	} 
		    	else { ?>
		    		<option value="">Tidak Tersedia</option>
		    	<?php 
		    	}
		    	?>
		    </select>
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

<!-- remove section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeSectionModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Sesi</h4>
      </div>
      <div class="modal-body">
        <div id="remove-messages"></div>

        <p>Anda yakin ingin menghapus Sesi ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="removeSectionBtn">Yakin</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="../custom/js/section.js"></script>