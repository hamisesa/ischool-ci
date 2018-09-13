<?php 
if($this->input->get('opt') == '' || !$this->input->get('opt')) {
  show_404();
} else {
?>

<div id="request" class="div-hide"><?php echo $this->input->get('opt'); ?></div>

<ol class="breadcrumb">
  <li><a href="<?php echo base_url('dashboard') ?>">Halaman Utama</a></li> 
  <?php   
  if($this->input->get('opt') == 'addst') {
    echo '<li class="active">Tambah Siswa</li>';
  } 
  else if ($this->input->get('opt') == 'mgst') {
    echo '<li class="active">Kelola Siswa</li>';
  }
  ?>  

</ol>

<?php if($this->input->get('opt') == 'addst' || $this->input->get('opt') == 'bulkst') { ?>

<div class="panel panel-default">
  <div class="panel-heading">
    <?php   
    if($this->input->get('opt') == 'addst') {
      echo "Tambah Siswa";
    } 
    else if ($this->input->get('opt') == 'bulkst') {
      echo "Add Bulk Student";
    }
    ?>  
  	
  </div>
  <div class="panel-body">
  	 <div id="messages"></div>

      <?php   
      if($this->input->get('opt') == 'addst') {
        // echo "Add Student";
        ?>
        <form action="student/create" method="post" id="createStudentForm" enctype="multipart/form-data">  
          <div class="col-md-7">
          <fieldset>
            <legend>Info Siswa</legend>

            <div class="form-group">
              <label for="fname">Nama Depan</label>
              <input type="text" class="form-control" id="fname" name="fname" placeholder="Nama Depan" autocomplete="off" >
            </div>
            <div class="form-group">
              <label for="lname">Nama Belakang</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Nama Belakang" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="dob">Tanggal Lahir</label>
                <input type="text" class="form-control" id="dob" name="dob" placeholder="Tanggal Lahir" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="age">Umur</label>
                <input type="text" class="form-control" id="age" name="age" placeholder="Umur" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="contact">Kontak</label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Kontak" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
            </div>

          </fieldset>     

          <fieldset>
            <legend>Info Tempat Tinggal</legend>

            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Alamat" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="city">Kota</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Kota" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="country">Negara</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Negara" autocomplete="off">
            </div>            
          </fieldset>       

          </div> 
          <!-- /col-md-6 -->

          <div class="col-md-5">          

          <fieldset>
            <legend>Info Input Data</legend>

            <div class="form-group">
              <label for="registerDate">Tanggal Input</label>
              <input type="text" class="form-control" id="registerDate" name="registerDate" placeholder="Tanggal Input" autocomplete="off">
            </div>
            <div class="form-group">
              <label for="className">Kelas</label>
              <select class="form-control" name="className" id="className">
                <option value="">Pilih</option>
                <?php foreach ($classData as $key => $value) { ?>
                  <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                <?php } // /forwach ?>
              </select>
            </div>
          </fieldset>       
		  <div class="form-group">
              <label for="sectionName">Sesi</label>
              <select class="form-control" name="sectionName" id="sectionName">
                <option value="">Pilih</option>
              </select>
            </div>
          <fieldset>
            <legend>Photo</legend>

            <div class="form-group">
              <label for="photo">Photo</label>
              <!-- the avatar markup -->
              <div id="kv-avatar-errors-1" class="center-block" style="max-width:500px;display:none"></div>             
                <div class="kv-avatar center-block" style="width:100%">
                    <input type="file" id="photo" name="photo" class="file-loading"/>                       
                </div>
            </div>
          
          </fieldset>       
           

          </div>
          <!-- /col-md-6 -->

          <div class="col-md-12">

            <br /> <br />
            <center>  
              <button type="submit" class="btn btn-primary">Simpan</button>
              <button type="button" class="btn btn-default">Reset</button>      
            </center>       
          </div>
                  

        </form>

        <?php
      } // /add student
      else if ($this->input->get('opt') == 'bulkst') {
        // echo "Add Bulk Student";        
        ?>        
        <form action="student/createBulk" method="post" id="createBulkForm">

        <center>          
          <button type="button" class="btn btn-default" onclick="addRow()">Add Row</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </center>
        <br /> <br />

        <table class="table" id="addBulkStudentTable">
           <thead>
             <tr>
               <th style="width: 20%;">First Name</th>
               <th style="width: 20%;">Last Name</th>
               <th style="width: 20%;">Class</th>
               <th style="width: 20%;">Section</th>
               <th style="width: 2%;">Action</th>
             </tr>
           </thead> 
           <tbody>
            <?php 
            for($x = 1; $x < 4; $x++) { ?>
              <tr id="row<?php echo $x; ?>">
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" id="bulkstfname<?php echo $x; ?>" name="bulkstfname[<?php echo $x; ?>]" placeholder="First Name" autocomplete="off">
                  </div>                  
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" id="bulkstlname<?php echo $x; ?>" name="bulkstlname[<?php echo $x; ?>]" placeholder="Last Name" autocomplete="off">
                  </div>                  
                </td>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="bulkstclassName[<?php echo $x; ?>]" id="bulkstclassName<?php echo $x; ?>" onchange="getSelectClassSection(<?php echo $x; ?>)">
                      <option value="">Select</option>
                      <?php foreach ($classData as $key => $value) { ?>
                        <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                      <?php } // /forwach ?>
                    </select>
                  </div>                    
                </td>
                <td>
                  <div class="form-group">
                    <select class="form-control" name="bulkstsectionName[<?php echo $x; ?>]" id="bulkstsectionName<?php echo $x; ?>">
                      <option value="">Jam Pelajaran</option>
                    </select>
                  </div>                  
                </td>
                <td>
                  <button type="button" class="btn btn-default" onclick="removeRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
              </tr>
            <?php
            } // /for
            ?>
             
           </tbody>
        </table>
        <!-- /.form -->

        </form>
        <!-- /.form -->

        <?php
      } // /add bulk student      
      ?>  
      
  
        	
  </div>
  <!-- /panle-bdy -->
</div>
<!-- /.panel -->

<?php 
} // /checking condition for add student and bulk student 
else if($this->input->get('opt') == 'mgst') { ?>
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
                  <a class="list-group-item">Tidak Ada.</a>
                  <?php
                }   
                ?>
              </div>

            </div>
            <!-- /.panel -->
          </div>
          <!-- /.col-md-4 -->
          <div class="col-md-8">              

            <div class="panel panel-default">
              <div class="panel-heading">Kelola Siswa</div>
              <div class="panel-body">
                <div id="result"></div>                                        

              </div>
              <!-- /panel-body -->
            </div>      
            <!-- /panel -->
          </div>
          <!-- /.col-md-08 -->
        </div>
        <!-- /.row -->
<?php  
} // /condition for manage student
?>

<!-- edit student modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editStudentModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Siswa</h4>
      </div>
     
      <div class="modal-body edit-modal">
      
        <div id="edit-teacher-messages"></div>

        <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Personal Detail</a></li>      
    </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <br /> 

        <form class="form-horizontal" method="post" id="updateStudentPhotoForm" action="student/updatePhoto" enctype="multipart/form-data">

        <div class="row">
          <div class="col-md-12">
            <div id="edit-upload-image-message"></div>

            <div class="col-md-6">
              <center>
                <img src="" id="student_photo" alt="Student Photo" class="img-thumbnail upload-photo" />
              </center>               
            </div>

            <div class="col-md-6">
              <div class="form-group">
                  <label for="editPhoto" class="col-sm-4 control-label">Photo: </label>
                  <div class="col-sm-8">                  
                      <!-- the avatar markup -->
                  <div id="kv-avatar-errors-1" class="center-block" style="max-width:500px;display:none"></div>             
                    <div class="kv-avatar center-block" style="width:100%">
                        <input type="file" id="editPhoto" name="editPhoto" class="file-loading"/>                       
                    </div>
                  </div>
              </div>
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <center>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </center>
                  </div>
                </div>

            </div>
            <!-- /col-md-6 -->
          </div>
          <!-- /col-md-12 -->
        </div>
        <!-- /row -->
          
        </form>
        </div>
        <!-- /tab panel of image -->

        <div role="tabpanel" class="tab-pane" id="profile">

        <br /> 
        <form class="form-horizontal" method="post" action="student/updateInfo" id="updateStudentInfoForm">
          <div class="row">

            <div class="col-md-12">
              <div id="edit-personal-student-message"></div>

              <div class="col-md-6">
                <div class="form-group">
                <label for="editFname" class="col-sm-4 control-label">Nama Depan </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="editFname" name="editFname" placeholder="Nama Depan" />
                  </div>
              </div>
              <div class="form-group">
                  <label for="editLname" class="col-sm-4 control-label">Nama Belakang </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="editLname" name="editLname" placeholder="Nama Belakang"/>
                  </div>
              </div>
              <div class="form-group">
                  <label for="editDob" class="col-sm-4 control-label">Tanggal Lahir </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editDob" name="editDob" placeholder="Tanggal Lahir" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="editAge" class="col-sm-4 control-label">Umur </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editAge" name="editAge" placeholder="Umur" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="editContact" class="col-sm-4 control-label">Kontak </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editContact" name="editContact" placeholder="Kontak" />
                  </div>
                </div>  
                <div class="form-group">
                  <label for="editEmail" class="col-sm-4 control-label">Email </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editEmail" name="editEmail" placeholder="Email" />
                  </div>
                </div>  
                <div class="form-group">
                  <label for="editAddress" class="col-sm-4 control-label">Alamat </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editAddress" name="editAddress" placeholder="Alamat" />
                  </div>
                </div>
                <div class="form-group">
                  <label for="editCity" class="col-sm-4 control-label">Kota </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editCity" name="editCity" placeholder="Kota" />
                  </div>
                </div>            
                <div class="form-group">
                  <label for="editCountry" class="col-sm-4 control-label">Negara </label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="editCountry" name="editCountry" placeholder="Negara" />
                  </div>
                </div>

              </div>
              <!-- /col-md-6 -->

              <div class="col-md-6">
                <div class="form-group">
                <label for="editRegisterDate" class="col-sm-4 control-label">Tanggal Input Data </label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="editRegisterDate" name="editRegisterDate" placeholder="Tanggal Input Data " />
                  </div>
              </div>              
                <div class="form-group">
                  <label for="editClassName" class="col-sm-4 control-label">Kelas</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="editClassName" id="editClassName">
                    <option value="">Pilih</option>
                    <?php foreach ($classData as $key => $value) { ?>
                      <option value="<?php echo $value['class_id'] ?>"><?php echo $value['class_name'] ?></option>
                    <?php } // /forwach ?>
                  </select>
                  </div>                  
                </div>

              </div>         
                <!-- /col-md-4 -->

              <div class="form-group">
                <div class="col-sm-12">
                  <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                  </center>
                </div>
              </div>
            </div>
            <!-- /col-md-12 -->
      
        </div>
        <!-- /row -->           
      </form>

        </div>        
        <!-- /tab-panel of teacher information -->
      </div>


      </div>
      <!-- /modal-body -->      
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- remove studet modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeStudentModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Hapus Siswa</h4>
      </div>
      <div class="modal-body">
        <p>Anda Yakin ingin menghapus siswa ini?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary" id="removeStudentBtn">Yakin</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 

} // /else show_404() 

?>



<script type="text/javascript" src="../custom/js/student.js"></script>
