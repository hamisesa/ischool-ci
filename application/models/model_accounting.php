<?php 

class Model_Accounting extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	/*
	*---------------------------------------------------
	* Insert the student pengembalian info into the database
	*---------------------------------------------------
	*/
	public function createIndividual()
	{
		$insert_name = array(
			'name' => $this->input->post('paymentName'),
			'start_date' 	=> $this->input->post('startDate'),
			'end_date' 		=> $this->input->post('endDate'),
			'total' 	=> $this->input->post('totalAmount'),
			'type'			=> 1
		);

		$this->db->insert('peminjaman', $insert_name);
		$payment_name_id = $this->db->insert_id();

		$insert_data = array(									
			'class_id' 		=> $this->input->post('className'),
			'section_id' 	=> $this->input->post('sectionName'),
			'student_id' 	=> $this->input->post('studentName'),			
			'payment_name_id' => $payment_name_id
		);
		$status = $this->db->insert('pengembalian', $insert_data);		
		return ($status === true ? true : false);
	}

	/*
	*---------------------------------------------------
	* Insert the bulk pengembalian info into the database
	*---------------------------------------------------
	*/
	public function createBulk()
	{
		if($this->input->post('studentId')) {
			$insert_name = array(
				'name' => $this->input->post('paymentName'),
				'start_date' 	=> $this->input->post('startDate'),
				'end_date' 		=> $this->input->post('endDate'),
				'total' 	=> $this->input->post('totalAmount'),
				'type'			=> 2
			);

			$this->db->insert('peminjaman', $insert_name);
			$payment_name_id = $this->db->insert_id();

			for($x = 1; $x <= count($this->input->post('studentId')); $x++) {								
				$insert_data = array(									
					'class_id' 		=> $this->input->post('className'),
					'section_id' 	=> $this->input->post('sectionName'),
					'student_id' 	=> $this->input->post('studentId')[$x],			
					'payment_name_id' => $payment_name_id
				);

				$status = $this->db->insert('pengembalian', $insert_data);
			}
						
			return ($status === true ? true : false);
		} 
		else {
			return false;
		}		
	}	

	/*
	*--------------------------------------------------
	* fetches the pengembalian name from the peminjaman table
	*--------------------------------------------------
	*/
	public function fetchPaymentData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM peminjaman WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM peminjaman";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/*
	*--------------------------------------------------
	* fetches the pengembalian date by the pengembalian name id
	*--------------------------------------------------
	*/
	public function fetchStudentPaymentById($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM pengembalian WHERE payment_name_id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}		
	}

	/*
	*--------------------------------------------------
	* removes the pengembalian info from the database
	*--------------------------------------------------
	*/
	public function removePayment($id = null) 
	{
		if($id) {
			$this->db->where('id', $id);
			$peminjaman = $this->db->delete('peminjaman');

			$this->db->where('payment_name_id', $id);
			$pengembalian = $this->db->delete('pengembalian');

			return ($peminjaman === true && $pengembalian === true ? true: false); 
		}
	}

	/*
	*---------------------------------------------------------------
	* Manage student's pengembalian functions section
	* id = `peminjaman` table's id primary key
	* type = `1` individual student
	* type = `2` bulk student
	*---------------------------------------------------------------
	*/
	public function updatePayment($id = null, $type = null)
	{
		if($id && $type) {

			if($type == 1) {
				$update_name = array(
					'name' => $this->input->post('editPaymentName'),
					'start_date' 	=> $this->input->post('editStartDate'),
					'end_date' 		=> $this->input->post('editEndDate'),
					'total' 	=> $this->input->post('editTotalAmount'),
					'type'			=> 1
				);

				$this->db->where('id', $id);
				$this->db->update('peminjaman', $update_name);

				$this->db->where('payment_name_id', $id);
				$this->db->delete('pengembalian');

				$update_payment_data = array(									
					'class_id' 		=> $this->input->post('editClassName'),
					'section_id' 	=> $this->input->post('editSectionName'),
					'student_id' 	=> $this->input->post('studentData'),			
					'payment_name_id' => $id
				);
				
				$status = $this->db->insert('pengembalian', $update_payment_data);		

				return ($status === true ? true : false);								
			} 
			else if($type == 2) {
				if(count($this->input->post('editStudentId')) > 0) {

					$update_data = array(
						'name' 			=> $this->input->post('editPaymentName'),
						'start_date' 	=> $this->input->post('editStartDate'),
						'end_date' 		=> $this->input->post('editEndDate'),
						'total' 	=> $this->input->post('editTotalAmount'),
						'type'			=> 2
					);

					$this->db->where('id', $id);
					$this->db->update('peminjaman', $update_data);				

					$this->db->where('payment_name_id', $id);
					$this->db->delete('pengembalian');

					for($x = 1; $x <= count($this->input->post('editStudentId')); $x++) {								
						$update_payment_data = array(									
							'class_id' 		=> $this->input->post('editClassName'),
							'section_id' 	=> $this->input->post('editSectionName'),
							'student_id' 	=> $this->input->post('editStudentId')[$x],			
							'payment_name_id' => $id
						);

						$status = $this->db->insert('pengembalian', $update_payment_data);
					}
							
					return ($status === true ? true : false);
				}
				else {
					return false;
				}	
			}				
		}
	}

	/*
	*--------------------------------------------------
	* fetches the pengembalian date by the pengembalian name id
	*--------------------------------------------------
	*/
	public function fetchStudentPayData($id = null) 
	{
		if($id) {
			$sql = "SELECT * FROM pengembalian WHERE id_pengembalian = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM pengembalian";
		$query = $this->db->query($sql);
		return $query->result_array();
	}



	/*
	*---------------------------------------------------------------
	* update student's pengembalian info section
	* paymentId for `pengembalian` table `payment_id`
	*---------------------------------------------------------------
	*/
	public function updateStudentPay($paymentId = null)
	{
		if($paymentId) {
			$update_data = array(
				'date' => $this->input->post('studentPayDate'),
				'denda'  => $this->input->post('paidAmount'),
				'jumlah' => $this->input->post('paymentType'),
				'status'       => $this->input->post('status')
			);

			$this->db->where('id_pengembalian', $paymentId);
			$query = $this->db->update('pengembalian', $update_data);
			return ($query === true ? true: false); 
		}
	}

	/*
	*---------------------------------------------------------------	
	* remove student's pengembalian
	* paymentId is for `pengembalian` table 
	*---------------------------------------------------------------
	*/
	public function removeStudentPay($paymentId = null)
	{
		if($paymentId) {
			$this->db->where('id_pengembalian', $paymentId);
			$pengembalian = $this->db->delete('pengembalian');			
			return ($pengembalian === true ? true: false); 
		} 
		return false;
	}
}