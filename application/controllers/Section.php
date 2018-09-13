<?php 	

class Section extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->isNotLoggedIn();

		// loading the section model
		$this->load->model('model_section');
		// loading the classes model
		$this->load->model('model_classes');
		// loading the teacher model
		$this->load->model('model_teacher');

		// loading the form validation library
		$this->load->library('form_validation');		
	}

	/*
	*----------------------------------------------
	* fetches the class's section table 
	*----------------------------------------------
	*/
	public function fetchSectionTable($classId = null)
	{
		if($classId) {
			$sectionData = $this->model_section->fetchSectionDataByClass($classId);
			$classData = $this->model_classes->fetchClassData($classId);
			
			$table = '

			<div class="well">
				Kelas : '.$classData['class_name'].'
			</div>

			<div id="messages"></div>

			<div class="pull pull-right">
	  			<button class="btn btn-default" data-toggle="modal" data-target="#addSectionModal" onclick="addSection('.$classId.')"><i class="glyphicon glyphicon-plus-sign"></i> Tambah Jam Pelajaran</button>	
		  	</div>
		  		
		  	<br /> <br />

		  	<!-- Table -->
		  	<table class="table table-bordered" id="manageSectionTable">
			    <thead>	
			    	<tr>
			    		<th> Sesi </th>
			    		<th> Nama Guru  </th>
			    		<th> </th>
			    	</tr>
			    </thead>
			    <tbody>';
			    	if($sectionData) {
			    		foreach ($sectionData as $key => $value) {

			    			$teacherData = $this->model_teacher->fetchTeacherData($value['teacher_id']);

			    			$button = '<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Tindakan <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a type="button" data-toggle="modal" data-target="#editSectionModal" onclick="editSection('.$value['section_id'].','.$value['class_id'].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
							    <li><a type="button" data-toggle="modal" data-target="#removeSectionModal" onclick="removeSection('.$value['section_id'].','.$value['class_id'].')"> <i class="glyphicon glyphicon-trash"></i> Hapus</a></li>		    
							  </ul>
							</div>';

				    		$table .= '<tr>
				    			<td>'.$value['section_name'].'</td>
				    			<td>'.$teacherData['fname'].' '.$teacherData['lname'].'</td>
				    			<td>'.$button.'</td>
				    		</tr>
				    		';
				    	} // /foreach				    	
			    	} 
			    	else {
			    		$table .= '<tr>
			    			<td colspan="3"><center>Tidak ada data.</center></td>
			    		</tr>';
			    	} // /else
			    $table .= '</tbody>
			</table>
			';
			echo $table;
		}
	}

	/*
	*----------------------------------------------
	* fetches the class's section information
	* through class_id and section_id 
	*----------------------------------------------
	*/
	public function fetchSectionByClassSection($classId = null, $sectionId = null)
	{
		if($classId && $sectionId) {
			$sectionData = $this->model_section->fetchSectionByClassSection($classId, $sectionId);		
			
			echo json_encode($sectionData);
		} // /if
 	}


	/*
	*----------------------------------------------
	* create the section  
	*----------------------------------------------
	*/
	public function create($classId = null) 
	{
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'sectionName',
				'label' => 'Section Name',
				'rules' => 'required'
			),
			array(
				'field' => 'teacherName',
				'label' => 'Teacher Name',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {							
			$create = $this->model_section->create($classId);					
			if($create == true) {
				$validator['success'] = true;
				$validator['messages'] = "Sesi berhasil ditambahkan!";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Sesi Pelajaran gagal ditambahkan!";
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
	*----------------------------------------------
	* update the section  
	*----------------------------------------------
	*/
	public function update($classId = null, $sectionId = null)
	{
		if($classId && $sectionId) {
		$validator = array('success' => false, 'messages' => array());

		$validate_data = array(
			array(
				'field' => 'editSectionName',
				'label' => 'Section Name',
				'rules' => 'required'
			),
			array(
				'field' => 'editTeacherName',
				'label' => 'Teacher Name',
				'rules' => 'required'
			)
		);

		$this->form_validation->set_rules($validate_data);
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {							
			$update = $this->model_section->update($classId, $sectionId);					
			if($update == true) {
				$validator['success'] = true;
				$validator['messages'] = "Jam Pelajaran berhasil diupdate!";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Jam Pelajaran gagal diupdate!";
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
	*----------------------------------------------
	* update the manage table function
	*----------------------------------------------
	*/
	public function fetchUpdateSectionTable($classId = null)
	{
		if($classId) {
			$sectionData = $this->model_section->fetchSectionDataByClass($classId);
			$table = '<thead>	
			    	<tr>
			    		<th> Sesi </th>
			    		<th> Nama Guru  </th>
			    		<th> </th>
			    	</tr>
			    </thead>
			    <tbody>';
			    	if($sectionData) {
			    		foreach ($sectionData as $key => $value) {

			    			$teacherData = $this->model_teacher->fetchTeacherData($value['teacher_id']);

			    			$button = '<div class="btn-group">
							  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    Tindakan <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu">
							    <li><a type="button" data-toggle="modal" data-target="#editSectionModal" onclick="editSection('.$value['section_id'].','.$value['class_id'].')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
							    <li><a type="button" data-toggle="modal" data-target="#removeSectionModal" onclick="removeSection('.$value['section_id'].','.$value['class_id'].')"> <i class="glyphicon glyphicon-trash"></i> Hapus</a></li>		    
							  </ul>
							</div>';

				    		$table .= '<tr>
				    			<td>'.$value['section_name'].'</td>
				    			<td>'.$teacherData['fname'].' '.$teacherData['lname'].'</td>
				    			<td>'.$button.'</td>
				    		</tr>
				    		';
				    	} // /foreach				    	
			    	} 
			    	else {
			    		$table .= '<tr>
			    			<td colspan="3"><center>No Data Available</center></td>
			    		</tr>';
			    	} // /else
			    $table .= '</tbody>';
			    echo $table;					
		} // /if
	}

	/*
	*----------------------------------------------
	* remove class's section function
	*----------------------------------------------
	*/	
	public function remove($sectionId = null)
	{
		if($sectionId) {
			$remove = $this->model_section->remove($sectionId);
			if($remove === true) {
				$validator['success'] = true;
				$validator['messages'] = "Sesi berhasil dihapus!";
			} 
			else{
				$validator['success'] = false;
				$validator['messages'] = "Sesi gagal dihapus!";
			}
			echo json_encode($validator);
		}
	}

}