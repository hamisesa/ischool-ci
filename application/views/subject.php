<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Halaman Utama</a></li> 
  <li class="active">Kelola Mata Pelajaran</li>
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
		  <div class="panel-heading">Kelola Mata Pelajaran</div>

		  <div class="panel-body">		  
		  	<div class="result"></div>
		  </div>			  
		</div>
	</div>
	<!-- /col-md-8 -->
</div>
<!-- /row -->

<!-- create section modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addSubjectModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Mata Pelajaran</h4>
      </div>
      <form action="subject/create" method="post" id="addSubjectForm">
      <div class="modal-body">
          <div id="add-subject-message"></div>

		  <div class="form-group">
		    <label for="sectionName">Mata Pelajaran</label>
		    <input type="text" class="form-control" id="subjectName" name="subjectName" placeholder="Mata Pelajaran">
		  </div>
		  <div class="form-group">
		    <label for="totalMark">Keterangan</label>
		    <input type="text" class="form-control" id="totalMark" name="totalMark" placeholder="Keterangan">
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
		    		<option value="">Tidak Tersedia.</option>
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

<!-- update subject modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editSubjectModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Mata Pelajaran</h4>
      </div>
      <form action="subject/update" method="post" id="editSubjectForm">
      <div class="modal-body">
          <div id="edit-subject-messages"></div>

		  <div class="form-group">
		    <label for="editSubjectName">Mata Pelajaran</label>
		    <input type="text" class="form-control" id="editSubjectName" name="editSubjectName" placeholder="Mata Pelajaran">
		  </div>
		  <div class="form-group">
		    <label for="editTotalMark">Total Jam Pelajaran</label>
		    <input type="text" class="form-control" id="editTotalMark" name="editTotalMark" placeholder="Total Jam Pelajaran">
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
		    		<option value="">Tidak Tersedia.</option>
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

<!-- remove subject modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeSubjectModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Mata Pelajaran</h4>
      </div>
      <div class="modal-body">
        <div id="remove-messages"></div>

        <p>Anda yakin ingin hapus Mata Pelajaran ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="removeSubjectBtn">Yakin</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript" src="../custom/js/subject.js"></script>