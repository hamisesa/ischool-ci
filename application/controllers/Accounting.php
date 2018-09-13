<?php 

class Accounting extends MY_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->isNotLoggedIn();

		// loading the teacher model
		$this->load->model('model_student');
		// loading the classes model		
		$this->load->model('model_classes');
		// loading the section model
		$this->load->model('model_section');		
		// accounting
		$this->load->model('model_accounting');
		

		// loading the form validation library
		$this->load->library('form_validation');	
	}


	/*
	* CREATE PAYMENT
	*---------------------------------------------------------------
	*/

	public function fetchType($type = null)
	{
		if($type == 1) {

			$classData = $this->model_classes->fetchClassData();			

			$div = '<form class="form-horizontal" action="accounting/createIndividual" method="post" id="createIndividualForm">	    	
		  	<div class="form-group">
		    	<label for="className" class="col-sm-2 control-label">Kelas</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="className" id="className">
		      			<option value="">Pilih</option>';
		      			foreach ($classData as $key => $value) {		      				
		      				$div .= '<option value="'.$value['class_id'].'">'.$value['class_name'].'</option>';
		      			} // .foreach
		      		$div .= '</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="sectionName" class="col-sm-2 control-label">Sesi</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="sectionName" id="sectionName">
		      			<option value="">Pilih</option>
		      		</select>
		    	</div>
		  	</div>		  				 		  
		  	<div class="form-group">
		    	<label for="studentName" class="col-sm-2 control-label">Nama Siswa</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="studentName" id="studentName">
		      			<option value="">Pilih</option>
		      		</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="paymentName" class="col-sm-2 control-label">Judul Buku</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="paymentName" name="paymentName" placeholder="Judul Buku">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="startDate" class="col-sm-2 control-label">Awal Pinjam</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="startDate" name="startDate" placeholder="Awal Pinjam">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="endDate" class="col-sm-2 control-label">Batas Akhir</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="endDate" name="endDate" placeholder="Batas Akhir">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="totalAmount" class="col-sm-2 control-label">Jumlah</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="totalAmount" name="totalAmount" placeholder="Jumlah">
		    	</div>
		  	</div>
			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Simpan</button>
			    </div>
			</div>
		</form>';
		} // /.individual
		else if($type == 2) {
			$classData = $this->model_classes->fetchClassData();			

			$div = '<form class="form-horizontal" action="accounting/createBulk" method="post" id="createBulkForm">	    	

			<div class="col-sm-6">
				<div class="form-group">
			    	<label for="className" class="col-sm-2 control-label">Kelas</label>
			    	<div class="col-sm-10">
			      		<select class="form-control" name="className" id="className">
			      			<option value="">Pilih</option>';
			      			foreach ($classData as $key => $value) {		      				
			      				$div .= '<option value="'.$value['class_id'].'">'.$value['class_name'].'</option>';
			      			} // .foreach
			      		$div .= '</select>
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="sectionName" class="col-sm-2 control-label">Sesi</label>
			    	<div class="col-sm-10">
			      		<select class="form-control" name="sectionName" id="sectionName">
			      			<option value="">Pilih</option>
			      		</select>
			    	</div>
			  	</div>		  				 		  		  	
			  	<div class="form-group">
			    	<label for="paymentName" class="col-sm-2 control-label">Judul Buku</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="paymentName" name="paymentName" placeholder="Judul Buku">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="startDate" class="col-sm-2 control-label">Awal Pinjam</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="startDate" name="startDate" placeholder="Awal Pinjam">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="endDate" class="col-sm-2 control-label">Batas Akhir</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="endDate" name="endDate" placeholder="Batas Akhir">
			    	</div>
			  	</div>
			  	<div class="form-group">
			    	<label for="totalAmount" class="col-sm-2 control-label">Jumlah</label>
			    	<div class="col-sm-10">
			      		<input type="text" class="form-control" id="totalAmount" name="totalAmount" placeholder="Jumlah">
			    	</div>
			  	</div>
			</div>
			<!--/.col-sm-6--> 

			<div class="col-sm-6">
				<div class="page-header">
					<h3>Data Siswa</h3>
				</div>

				<table id="studentName" class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>							
							<th>Nama Siswa</th>							
						</tr>						
					</thead>
					<tbody>
						<tr>
							<td colspan="2"><center>&nbsp;</center></td>	
						</tr>
					</tbody>
				</table>
			</div>
			  	
			<div class="form-group">
			    <div class="col-sm-offset-1 col-sm-10">
			      <button type="submit" class="btn btn-primary">Simpan</button>
			    </div>
			</div>
		</form>';
		} // /.bulk
		else {
			$div = '';
		}

		echo $div;
	}

	/*
	*------------------------------------------------
	* fetches the class's section info	
	*------------------------------------------------
	*/
	public function fetchClassSection($classId = null) 
	{
		if($classId) {
			$sectionData = $this->model_section->fetchSectionDataByClass($classId);
			$option = '';
			if($sectionData) {
				foreach ($sectionData as $key => $value) {
					$option .= '<option value="'.$value['section_id'].'">'.$value['section_name'].'</option>';
				} // /foreach
			}
			else {
				$option = '<option value="">No Data</option>';
			} // /else empty section

			echo $option;
		}
	}

	/*
	*------------------------------------------------
	* fetches the student info by class and section 
	*------------------------------------------------
	*/
	public function fetchStudent($classId = null, $sectionId = null, $type = null) 
	{
		if($classId && $sectionId && $type) {

			$studentData = $this->model_student->fetchStudentByClassAndSection($classId, $sectionId);

			if($type == 1) {
				// /.individual
				if($studentData) {
					$option = '';					
					foreach ($studentData as $key => $value) {
						$studentName = $value['fname'] . ' ' .$value['lname'];
						$option .= '<option value="'.$value['student_id'].'">'.$studentName.'</option>';
					} // /foreach
				}
				else {
					$option = '<option value="">No Data</option>';
				} // /else empty section
			}
			else if($type == 2) {

				if($studentData) {				
					$option = '<thead>
						<tr>
							<th>#</th>							
							<th>Name</th>							
						</tr>						
					</thead>
					<tbody>';
						$x = 1;
						foreach ($studentData as $key => $value) {
							$option .= '<tr>
								<td><input type="checkbox" name="studentId['.$x.']" value="'.$value['student_id'].'" class="form-control" /> </td>
								<td>'.$value['fname'] .' '. $value['lname'] .'</td>
							</tr>';
							$x++;
						}							
					$option .= '</tbody>';
				} else {
					$option = '<thead>
						<tr>
							<th>#</th>							
							<th>Name</th>							
						</tr>						
					</thead>
					<tbody>
						<tr>
							<td colspan="2"><center>No Data Available</center></td>	
						</tr>
					</tbody>';
				}				 
			}				

			echo $option;
		}
	}

	/*
	*---------------------------------------------------------
	* fetches the student info for update by class and section 
	*----------------------------------------------------------
	*/
	public function fetchEditStudent($classId = null, $sectionId = null, $type = null) 
	{
		if($classId && $sectionId && $type) {

			$studentData = $this->model_student->fetchStudentByClassAndSection($classId, $sectionId);

			if($type == 1) {
				// /.individual
				if($studentData) {
					foreach ($studentData as $key => $value) {
						$studentName = $value['fname'] . ' ' .$value['lname'];
						$option .= '<option value="'.$value['student_id'].'">'.$studentName.'</option>';
					} // /foreach
				}
				else {
					$option = '<option value="">No Data</option>';
				} // /else empty section
			}
			else if($type == 2) {

				if($studentData) {				
					$option = '<thead>
						<tr>
							<th>#</th>							
							<th>Name</th>							
						</tr>						
					</thead>
					<tbody>';
						$x = 1;
						foreach ($studentData as $key => $value) {
							$option .= '<tr>
								<td><input type="checkbox" name="editStudentId['.$x.']" value="'.$value['student_id'].'" class="form-control" /> </td>
								<td>'.$value['fname'] .' '. $value['lname'] .'</td>
							</tr>';
							$x++;
						}							
					$option .= '</tbody>';
				} else {
					$option = '<thead>
						<tr>
							<th>#</th>							
							<th>Name</th>							
						</tr>						
					</thead>
					<tbody>
						<tr>
							<td colspan="2"><center>No Data Available</center></td>	
						</tr>
					</tbody>';
				}				 
			}				

			echo $option;
		}
	}

	/*
	*------------------------------------------------
	* creates the individual student's payment
	*------------------------------------------------
	*/
	public function createIndividual() 
	{
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'className',
				'label' => 'Class Name',
				'rules' => 'required'
			),
			array(
				'field' => 'sectionName',
				'label' => 'Section Name',
				'rules' => 'required'
			),
			array(
				'field' => 'studentName',
				'label' => 'Student Name',
				'rules' => 'required'
			),
			array(
				'field' => 'paymentName',
				'label' => 'Payment Name',
				'rules' => 'required'
			),
			array(
				'field' => 'startDate',
				'label' => 'Start Date',
				'rules' => 'required'
			),
			array(
				'field' => 'endDate',
				'label' => 'End Date',
				'rules' => 'required'
			),
			array(
				'field' => 'totalAmount',
				'label' => 'Total Amount',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {	
			$create = $this->model_accounting->createIndividual();					
			if($create === true) {
				$validator['success'] = true;
				$validator['messages'] = "Peminjaman berhasil ditambahkan!";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Peminjaman gagal ditambahkan!";
			}			
		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	}


	/*
	*------------------------------------------------
	* creates the bulk student's payment
	*------------------------------------------------
	*/
	public function createBulk() 
	{
		$validator = array('success' => false, 'messages' => array());
			
		$validate_data = array(
			array(
				'field' => 'className',
				'label' => 'Class Name',
				'rules' => 'required'
			),
			array(
				'field' => 'sectionName',
				'label' => 'Section Name',
				'rules' => 'required'
			),			
			array(
				'field' => 'paymentName',
				'label' => 'Payment Name',
				'rules' => 'required'
			),
			array(
				'field' => 'startDate',
				'label' => 'Start Date',
				'rules' => 'required'
			),
			array(
				'field' => 'endDate',
				'label' => 'End Date',
				'rules' => 'required'
			),
			array(
				'field' => 'totalAmount',
				'label' => 'Total Amount',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {				
			$create = $this->model_accounting->createBulk();					
			if($create === true) {
				$validator['success'] = true;
				$validator['messages'] = "Peminjaman berhasil ditambahkan!";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Peminjaman gagal ditambahkan!";
			}			
		} 	
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);
			}			
		} // /else

		echo json_encode($validator);
	}


	/*
	* /. END OF CREATE PAYMENT SECTION
	*---------------------------------------------------------------
	*/

	/*
	*---------------------------------------------------------------
	* fetch payments' information from the database
	*---------------------------------------------------------------
	*/
	public function fetchPaymentData()
	{
		$paymentData = $this->model_accounting->fetchPaymentData();

		$result = array('data' => array());
		foreach ($paymentData as $key => $value) {

			$button = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			   Tindakan <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a href="#" data-toggle="modal" data-target="#editPayment" onclick="updatePayment('.$value['id'].','.$value['type'].')">Edit</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#removePayment" onclick="removePayment('.$value['id'].')">Hapus</a></li>    
			  </ul>
			</div>';

			$result['data'][$key] = array(
				$value['name'],
				$value['start_date'],
				$value['end_date'],
				$button
			);	
		}			

		echo json_encode($result);
	}

	/*
	*---------------------------------------------------------------
	* fetch students' payment information from the database
	*---------------------------------------------------------------
	*/
	public function fetchManageStudentPayData()
	{
		$paymentData = $this->model_accounting->fetchStudentPayData();

		$result = array('data' => array());
		foreach ($paymentData as $key => $value) {
			$classData = $this->model_classes->fetchClassData($value['class_id']);
			$sectionData = $this->model_section->fetchSectionByClassSection($value['class_id'], $value['section_id']);
			$studentData = $this->model_student->fetchStudentData($value['student_id']);
			$paymentNameData = $this->model_accounting->fetchPaymentData($value['payment_name_id']);

			$status = '';

			if($value['status'] == 0) {
				$status = '<label class="label label-info">Belum dikembalikan</label>';
			} else if($value['status'] == 1) {
				$status = '<label class="label label-success">Sudah dikembalikan</label>';
			} else if($value['status'] == 2) {
				$status = '<label class="label label-danger">Hilang</label>';
			}

			$button = '
			<div class="btn-group">
			  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Tindakan <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu">			  				  	
			    <li><a href="#" data-toggle="modal" data-target="#editStudentPay" onclick="updateStudentPay('.$value['id_pengembalian'].')">Edit</a></li>
			    <li><a href="#" data-toggle="modal" data-target="#removeStudentPay" onclick="removeStudentPay('.$value['id_pengembalian'].')">Hapus</a></li>    
			  </ul>
			</div>';

			$result['data'][$key] = array(
				$paymentNameData['name'],
				$studentData['fname'] . ' ' . $studentData['lname'],
				$classData['class_name'],
				$sectionData['section_name'],
				$status,
				$button
			);	
		}			

		echo json_encode($result);
	}

	/*
	*---------------------------------------------------------------
	* checks payment type id and retreives the form group
	* type = `1` individual student
	* type = `2` bulk student
	*---------------------------------------------------------------
	*/
	public function fetchUpdatePaymentForm($type = null)
	{
		$classData = $this->model_classes->fetchClassData();

		if($type == 1) {
			$option = '<form class="form-horizontal" action="accounting/updatePayment" method="post" id="updatePaymentFrom">	    	
		  	<div class="form-group">
		    	<label for="editClassName" class="col-sm-2 control-label">Kelas</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="editClassName" id="editClassName">
		      			<option value="">Pilih</option>';
		      			foreach ($classData as $key => $value) {		      				
		      				$option .= '<option value="'.$value['class_id'].'">'.$value['class_name'].'</option>';
		      			} // .foreach
		      		$option .= '</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="editSectionName" class="col-sm-2 control-label">Sesi</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="editSectionName" id="editSectionName">
		      			<option value="">Pilih</option>
		      		</select>
		    	</div>
		  	</div>		  				 		  
		  	<div class="form-group">
		    	<label for="studentData" class="col-sm-2 control-label">Nama Siswa</label>
		    	<div class="col-sm-10">
		      		<select class="form-control" name="studentData" id="studentData">
		      			<option value="">Pilih</option>
		      		</select>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="editPaymentName" class="col-sm-2 control-label">Judul Buku</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="editPaymentName" name="editPaymentName" placeholder="Judul Buku">
		    	</div>
		  	</div> 
		  	<div class="form-group">
		    	<label for="editStartDate" class="col-sm-2 control-label">Awal Peminjaman</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="editStartDate" name="editStartDate" placeholder="Awal Peminjaman">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="editEndDate" class="col-sm-2 control-label">Batas Akhir</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="editEndDate" name="editEndDate" placeholder="Batas Akhir">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="editTotalAmount" class="col-sm-2 control-label">Jumlah</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" id="editTotalAmount" name="editTotalAmount" placeholder="Jumlah">
		    	</div>
		  	</div>
			<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      	<button type="submit" class="btn btn-primary">Update</button>
			    </div>
			</div>
		</form>';
		}
		else if($type == 2) {
		
			$option = '<form class="form-horizontal" action="accounting/updatePayment" method="POST" id="updatePaymentFrom">
	      	
	      	<div class="row">
	      	
	      	<div class="col-md-6">

				<div class="form-group">
			    	<label for="editClassName" class="col-sm-4 control-label">Kelas</label>
			    	<div class="col-sm-8">
			      		<select class="form-control" name="editClassName" id="editClassName">      	
			      			<option value="">Pilih</option>';			      			
			      			foreach ($classData as $key => $value) {
			      				$option .= '<option value="'.$value['class_id'].'">'.$value['class_name'].'</option>';
			      			}			      		
			      		$option .= '</select>
			    	</div>
			  	</div>	
			  	<div class="form-group">
			    	<label for="editSectionName" class="col-sm-4 control-label">Sesi</label>
			    	<div class="col-sm-8">
			      		<select class="form-control" name="editSectionName" id="editSectionName">
			      			<option value="">Pilih</option>
			      		</select>
			    	</div>
			  	</div>	
			  	<div class="form-group">
			    	<label for="editPaymentName" class="col-sm-4 control-label">Judul Buku</label>
			    	<div class="col-sm-8">
			      		<input type="text" name="editPaymentName" id="editPaymentName" placeholder="Judul Buku" class="form-control" />
			    	</div>
			  	</div>	
			  	<div class="form-group">
			    	<label for="editStartDate" class="col-sm-4 control-label">Awal Pinjam</label>
			    	<div class="col-sm-8">
			      		<input type="text" name="editStartDate" id="editStartDate" placeholder="Awal Pinjam" class="form-control" />
			    	</div>
			  	</div>	
			  	<div class="form-group">
			    	<label for="editEndDate" class="col-sm-4 control-label">Batas Akhir</label>
			    	<div class="col-sm-8">
			      		<input type="text" name="editEndDate" id="editEndDate" placeholder="Batas Akhir" class="form-control" />
			    	</div>
			  	</div>	
			  	<div class="form-group">
			    	<label for="sectionName" class="col-sm-4 control-label">Jumlah</label>
			    	<div class="col-sm-8">
			      		<input type="text" name="editTotalAmount" id="editTotalAmount" class="form-control" placeholder="Jumlah"/>
			    	</div>
			  	</div>	

			  	<div class="form-group">
			  		<div class="col-sm-offset-2 col-sm-10">
			  			<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			        	<button type="submit" class="btn btn-primary">Simpan</button>
			        </div>	
			  	</div>
				  	
			</div>
			<!-- /.col-md-6 -->


			<div class="col-md-6">
				<table class="table table-bordered" id="studentData">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
						</tr>
					</thead>
					
				</table>
			</div>
			<!-- /.col-md-6 -->

	      	</div>
	      	<!-- /.row -->
		   		
      		</form>';

		} 
		else {
			$option = '';
		}

		echo $option;
	}

	/*
	*---------------------------------------------------------------
	* fetches the section data by the class id 	
	*---------------------------------------------------------------
	*/
	public function fetchSectionClassForBulkStudent($classId = null)
	{
		if($classId) {
			$sectionData = $this->model_section->fetchSectionDataByClass($classId);

			if($sectionData) {
				$option = '';
				foreach ($sectionData as $key => $value) {
					$option .= '<option value="'.$value['section_id'].'">'.$value['section_name'].'</option>'; 		
				}
			} 
			else {
				$option = '<option value="">No Data</option>';
			}			
		} 
		else {
			$option = '<option value="">First Select Class</option>';
		}

		echo $option;
	}
	
	/*
	*---------------------------------------------------------------
	* fetch payment' information by payment id from the datatable
	* `$id` = payment_name table's id
	*---------------------------------------------------------------
	*/
	public function fetchPaymentById($id = null)
	{
		if($id) {
			$result['name'] = $this->model_accounting->fetchPaymentData($id);
			$result['payment'] = $this->model_accounting->fetchStudentPaymentById($id);

			echo json_encode($result);
		}
	}

	/*
	*---------------------------------------------------------------
	* fetch student data for payment update
	*---------------------------------------------------------------
	*/
	public function fetchStudentForPaymentUpdate($classId = null, $sectionId = null) 
	{
		$studentData = $this->model_student->fetchStudentByClassAndSection($classId, $sectionId);

		if($studentData) {				
			$option = '<thead>
				<tr>
					<th>#</th>							
					<th>Name</th>							
				</tr>						
			</thead>
			<tbody>';
				$x = 1;
				foreach ($studentData as $key => $value) {
					$option .= '<tr>
						<td><input type="checkbox" name="editStudentId['.$x.']" value="'.$value['student_id'].'" id="editStudentId'.$value['student_id'].'" class="form-control" /> </td>
						<td>'.$value['fname'] .' '. $value['lname'] .'</td>
					</tr>';
					$x++;
				}							
			$option .= '</tbody>';
		} else {
			$option = '<thead>
				<tr>
					<th>#</th>							
					<th>Name</th>							
				</tr>						
			</thead>
			<tbody>
				<tr>
					<td colspan="2"><center>No Data Available</center></td>	
				</tr>
			</tbody>';
		}
		echo $option;
	}

	/*
	*---------------------------------------------------------------
	* fetch the manage payment information table function
	*---------------------------------------------------------------
	*/
	public function fetchManagePaymentTable() 
	{
		$div = '
		<div class="panel panel-default">
			<div class="panel-heading">
				Peminjaman Buku
			</div>
			<div class="panel-body">						
				<div id="remove-payment-message"></div>
					<table id="managePaymentTable" class="table table-bordered">
						<thead>
							<tr>
								<th>Nama Buku</th>
								<th>Awal Pinjam</th>
								<th>Batas Akhir</th>
								<th></th>
							</tr>
						</thead>				
					</table>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		';

		echo $div;
	}

	/*
	*---------------------------------------------------------------
	* fetch the manage student's payment information table function
	*---------------------------------------------------------------
	*/
	public function fetchManageStudentPayTable() 
	{
		$div = '
		<div class="panel panel-default">
			<div class="panel-heading">
				Pengembalian Buku
			</div>
			<div class="panel-body">						
				<div id="remove-stu-payment-message"></div>
				<table id="manageStudentPayTable" class="table table-bordered">
					<thead>
						<tr>
							<th>Judul Buku</th>
							<th>Nama Siswa</th>
							<th>Kelas</th>
							<th>Sesi</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>				
				</table>
			</div><!-- /.panel-body -->
		</div><!-- /.panel -->
		';

		echo $div;
	}
	

	/*
	*---------------------------------------------------------------
	* update the payment information
	* id = `payment_name` table's id primary key
	* type = `1` individual student
	* type = `2` bulk student
	*---------------------------------------------------------------
	*/
	public function updatePayment($id = null, $type = null) 
	{
		if($id && $type) {
			$validator = array('success' => false, 'messages' => array());
			if($type == 1) {
				// individual update
				$validate_data = array(
				array(
					'field' => 'editClassName',
					'label' => 'Class Name',
					'rules' => 'required'
				),
				array(
					'field' => 'editSectionName',
					'label' => 'Section Name',
					'rules' => 'required'
				),
				array(
					'field' => 'studentData',
					'label' => 'Student Name',
					'rules' => 'required'
				),
				array(
					'field' => 'editPaymentName',
					'label' => 'Payment Name',

				),
				array(
					'field' => 'editStartDate',
					'label' => 'Start Date',
					'rules' => 'required'
				),
				array(
					'field' => 'editEndDate',
					'label' => 'End Date',
					'rules' => 'required'
				),
				array(
					'field' => 'editTotalAmount',
					'label' => 'Total Amount',
					'rules' => 'required'
				)
			);

			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {	
				$create = $this->model_accounting->updatePayment($id, $type);					
				if($create === true) {
					$validator['success'] = true;
					$validator['messages'] = "Peminjaman berhasil diupdate!";
				}
				else {
					$validator['success'] = false;
					$validator['messages'] = "Peminjaman gagal diupdate!";
				}			
			} 	
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);
				}			
			} // /else

				echo json_encode($validator);
			}
			else if($type == 2) {
				// bulk update
				$validate_data = array(
					array(
						'field' => 'editClassName',
						'label' => 'Class Name',
						'rules' => 'required'
					),
					array(
						'field' => 'editSectionName',
						'label' => 'Section Name',
						'rules' => 'required'
					),
					array(
						'field' => 'editPaymentName',
						'label' => 'Payment Name',
						'rules' => 'required'
					),
					array(
						'field' => 'editStartDate',
						'label' => 'Start Date',
						'rules' => 'required'
					),
					array(
						'field' => 'editEndDate',
						'label' => 'End Date',
						'rules' => 'required'
					),
					array(
						'field' => 'editTotalAmount',
						'label' => 'Total Amount',
						'rules' => 'required'
					)
				);

				$this->form_validation->set_rules($validate_data);
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

				$this->form_validation->set_rules($validate_data);
				$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

				if($this->form_validation->run() === true) {				
					$create = $this->model_accounting->updatePayment($id, $type);					
					if($create === true) {
						$validator['success'] = true;
						$validator['messages'] = "Successfully added";
					}
					else {
						$validator['success'] = false;
						$validator['messages'] = "Select at least one student";
					}			
				} 	
				else {
					$validator['success'] = false;
					foreach ($_POST as $key => $value) {
						$validator['messages'][$key] = form_error($key);
					}			
				} // /else

				echo json_encode($validator);
			} // /.if
		} // /.if id && type
	}

	/*
	*---------------------------------------------------------------
	* remove the payment info from the database
	*---------------------------------------------------------------
	*/
	public function removePayment($id = null)
	{
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$remove = $this->model_accounting->removePayment($id);
			if($remove === true) {
				$validator['success'] = true;
				$validator['messages'] = 'Peminjaman berhasil dihapus!';
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = 'Peminjaman gagal dihapus!';
			}

			echo json_encode($validator);
		}
	}

	/*
	*---------------------------------------------------------------
	* Manage student's payment functions section
	* paymentId is for `payment` table
	* not for `payment_name` table
	* the paymentId will get the data from the `payment` table
	* through the `payment` table data, the function will fetch the 
	* data from the `payment_name` table  
	*---------------------------------------------------------------
	*/
	public function fetchStudentPaymentInfo($paymentId = null)
	{
		if($paymentId) {
			$paymentData = $this->model_accounting->fetchStudentPayData($paymentId);
			$paymentNameData = $this->model_accounting->fetchPaymentData($paymentData['payment_name_id']);
			$classData = $this->model_classes->fetchClassData($paymentData['class_id']);
			$sectionData = $this->model_section->fetchSectionByClassSection($paymentData['class_id'], $paymentData['section_id']);
			$studentData = $this->model_student->fetchStudentData($paymentData['student_id']);

			if($paymentData['denda'] == '') {
				$totalPaid = 0;
			} 
			else {
				$totalPaid = $paymentData['denda'];
			}

			$div = '

			<div id="update-student-payment-message"></div>

			<form class="form-horizontal" action="accounting/updateStudentPay" method="post" id="updateStudentPayForm">
      		<div class="col-md-6">
      			<div class="form-group">
				    <label for="paymentName" class="col-sm-4 control-label">Judul Buku : </label>
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="paymentName" placeholder="Payment Name" disabled value="'.$paymentNameData['name'].'"/>
				    </div>
				  </div>				  
				  <div class="form-group">
				    <label for="startDate" class="col-sm-4 control-label">Awal Peminjaman : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="startDate" placeholder="Start Date" disabled value="'.$paymentNameData['start_date'].'"/>
				    </div>
				  </div>			  
				  <div class="form-group">
				    <label for="endDate" class="col-sm-4 control-label">Batas Akhir : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="endDate" placeholder="End Date" disabled value="'.$paymentNameData['end_date'].'">
				    </div>
			  	  </div>
			  	  <div class="form-group">
				    <label for="className" class="col-sm-4 control-label">Kelas : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="className" placeholder="Class" disabled value="'.$classData['class_name'].'">
				    </div>
			  	  </div>
			  	  <div class="form-group">
				    <label for="section" class="col-sm-4 control-label">Sesi : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="section" placeholder="Section" disabled value="'.$sectionData['section_name'].'">
				    </div>
			  	  </div>
      		</div><!-- /div.col-md-6 -->

      		<div class="col-md-6">
      			<div class="form-group">
				    <label for="studentName" class="col-sm-4 control-label">Nama Siswa : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="studentName" placeholder="Student Name" disabled value="'.$studentData['fname'].' '.$studentData['lname'].'">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-4 control-label">Jumlah : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="totalAmount" placeholder="Total Amounts" disabled value="'.$paymentNameData['total'].'">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="studentPayDate" class="col-sm-4 control-label">Hari Mengembalikan : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="studentPayDate" name="studentPayDate" placeholder="Payment Date" value="'.$paymentData['date'].'">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="paidAmount" class="col-sm-4 control-label">Keterangan : </label>
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="paidAmount" name="paidAmount" placeholder="Keterangan" ">
				    </div>
				  </div>			  
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-4 control-label">Denda : </label>
				    <div class="col-sm-8">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="" '; 
				      	if($paymentData['status'] == 0) {
				      		$div .="selected";
				      	}
				      	$div.= '>Tidak</option>
				      	<option value="1" '; 
				      	if($paymentData['status'] == 1) {
				      		$div .="selected";
				      	}
				      	$div.= '>Ya</option>
				      </select>
				    </div>				    
			  	  </div>			  	  
			  	  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-4 control-label">Status : </label>
				    <div class="col-sm-8">
				      <select class="form-control" name="status" id="status">
				      	<option value="0" '; 
				      	if($paymentData['status'] == 0) {
				      		$div .="selected";
				      	}
				      	$div.= '>Belum dikembalikan</option>
				      	<option value="1" '; 
				      	if($paymentData['status'] == 1) {
				      		$div .="selected";
				      	}
				      	$div.= '>Sudah dikembalikan</option>
				      	<option value="2" '; 
				      	if($paymentData['status'] == 2) {
				      		$div .="selected";
				      	}
				      	$div.= '>Hilang</option>
				      </select>
				    </div>				    
			  	  </div>
      		</div><!-- /div.col-md-6 -->
      			 
			  <div class="form-group">
			    <div class="col-sm-12">
			    	<center>
			      		<button type="submit" class="btn btn-primary">Simpan</button>
			      		<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			      	</center>
			    </div>
			  </div>
			</form>';
		echo $div;
		}
	}


	/*
	*---------------------------------------------------------------
	* update student's payment info section
	* paymentId for `payment` table
	*---------------------------------------------------------------
	*/
	public function updateStudentPay($paymentId = null)
	{
		if($paymentId) {
			$validator = array('success' => false, 'messages' => array());

			$validate_data = array(
				array(
					'field' => 'studentPayDate',
					'label' => 'Payment Date',
					'rules' => 'required'
				),
				array(
					'field' => 'paidAmount',
					'label' => 'Paid Amount',
				),
				array(
					'field' => 'paymentType',
					'label' => 'Payment Type',
				),
				array(
					'field' => 'status',
					'label' => 'Status',
					'rules' => 'required'
				)
			);

			$this->form_validation->set_rules($validate_data);
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

			if($this->form_validation->run() === true) {	
				$create = $this->model_accounting->updateStudentPay($paymentId);					
				if($create === true) {
					$validator['success'] = true;
					$validator['messages'] = "Pengembalian berhasil diupdate!";
				}
				else {
					$validator['success'] = false;
					$validator['messages'] = "Pengembalian gagal diupdate!";
				}			
			} 	
			else {
				$validator['success'] = false;
				foreach ($_POST as $key => $value) {
					$validator['messages'][$key] = form_error($key);
				}			
			} // /else

			echo json_encode($validator);	
		}
	}

	/*
	*---------------------------------------------------------------	
	* paymentId is for `payment` table 
	*---------------------------------------------------------------
	*/
	public function removeStudentPay($paymentId = null) 
	{
		if($paymentId) {
			$validator = array('success' => false, 'messages' => array());

			$remove = $this->model_accounting->removeStudentPay($paymentId);
			if($remove === true) {
				$validator['success'] = true;
				$validator['messages'] = 'Pengembalian berhasil dihapus!';
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = 'Pengembalian gagal dihapus!';
			}

			echo json_encode($validator);
		}
	}

}