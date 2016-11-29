<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Student extends Admin_Controller {

/*

| -----------------------------------------------------

| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM

| -----------------------------------------------------

| AUTHOR:			INILABS TEAM

| -----------------------------------------------------

| EMAIL:			info@inilabs.net

| -----------------------------------------------------

| COPYRIGHT:		RESERVED BY INILABS IT

| -----------------------------------------------------

| WEBSITE:			http://inilabs.net

| -----------------------------------------------------

*/

	function __construct () {

		parent::__construct();

		$this->load->model("student_m");

		$this->load->model("parentes_m");
		
		$this->load->model("package_m");

		$this->load->model("section_m");

		$this->load->model("mark_m");

		$this->load->model("grade_m");

		$this->load->model("invoice_m");

		$this->load->model("classes_m");

		$this->load->model("exam_m");

		$this->load->model("subject_m");

		$this->load->model("user_m");

		$this->load->model("tmember_m");

		$language = $this->session->userdata('lang');

		$this->lang->load('student', $language);

	}



	public function index() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin" || $usertype == "Teacher") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));
			// $pack_id = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if((int)$id) {

				$this->data['set'] = $id;
				// $this->data['pack_id'] = $pack_id;
				$this->data['classes'] = $this->student_m->get_classes();
				$this->data['packages'] = $this->student_m->get_package($id);

				$this->data['students'] = $s_data = $this->student_m->get_order_by_student(array('classesID' => $id));

				foreach ($s_data as $key => $value) {
					$sub_se_ar = unserialize($value->subject);

					if(isset($sub_se_ar) && count($sub_se_ar)>0){
						$subnames = $this->student_m->get_subjectNameCode(array_keys($sub_se_ar));
						$subnames_ar = array();
						foreach ($subnames as $m => $n) {
							$subnames_ar[] = $n->subject." (".$n->subject_code.")";
						}
						$this->data['students'][$key]->subject = implode(",", $subnames_ar);
					}else{
						$this->data['students'][$key]->subject = "-";
					}

					/*if(!empty($value->additional_pack)){
						$add_pack_ar = unserialize($value->additional_pack);
						$psubnames_ar = array();
						foreach ($add_pack_ar as $kp => $vp) {
							$pack_data = $this->package_m->get_package($vp);
							if(!empty($pack_data->subject)){
								$sub_p_names = $this->student_m->get_subjectNameCode(unserialize($pack_data->subject));
								foreach ($sub_p_names as $m => $n) {
									$psubnames_ar[] = $n->subject." (".$n->subject_code.")";
								}
							}
						}
						$this->data['students'][$key]->addsubject = implode(",", $psubnames_ar);
					}else{
						$this->data['students'][$key]->addsubject = "";
					}*/
					/*$str_arr = array();
					if(count($sub_a)>0){
						// $resteah = $this->student_m->get_subjectName(array_keys($sub_a));
						// $sub_js= $resteah[0]->subject;
						
						foreach ($sub_a as $m => $n) {
							$resteah_s = $this->student_m->get_sectionName(array($n));
							$resteah = $this->student_m->get_subjectName(array($m));

							$str_arr[] = trim($resteah[0]->subject,",")." (".trim($resteah_s[0]->section,",").")";
						}
						
						$this->data['students'][$key]->subject = implode(",", $str_arr);
					}else{
						$this->data['students'][$key]->subject = "-";
					}*/

				}

				if($this->data['students']) {

					$packages = $this->student_m->get_package($id);

					$this->data['packages'] = $packages;

					foreach ($packages as $key => $package) {
						if($package->category==1){
							$this->data['allpackage'][$package->packageID] = $this->student_m->get_order_by_student(array('classesID' => $id, "packageID" => $package->packageID));
							foreach ($this->data['allpackage'][$package->packageID] as $key => $value) {
								$sub_se_ar = unserialize($value->subject);
								
								
								if(isset($sub_se_ar) && count($sub_se_ar)>0){
									$subnames = $this->student_m->get_subjectNameCode(array_keys($sub_se_ar));
									$subnames_ar = array();
									foreach ($subnames as $m => $n) {
										$subnames_ar[] = $n->subject." (".$n->subject_code.")";
									}
									$this->data['allpackage'][$package->packageID][$key]->subject = implode(",", $subnames_ar);
								}else{
									$this->data['allpackage'][$package->packageID][$key]->subject = "-";
								}

								/*if(!empty($value->additional_pack)){
									$add_pack_ar = unserialize($value->additional_pack);
									$psubnames_ar = array();
									foreach ($add_pack_ar as $kp => $vp) {
										$pack_data = $this->package_m->get_package($vp);
										if(!empty($pack_data->subject)){
											$sub_p_names = $this->student_m->get_subjectNameCode(unserialize($pack_data->subject));
											foreach ($sub_p_names as $m => $n) {
												$psubnames_ar[] = $n->subject." (".$n->subject_code.")";
											}
										}
									}
									$this->data['allpackage'][$package->packageID][$key]->addsubject = implode(",", $psubnames_ar);
								}else{
									$this->data['allpackage'][$package->packageID][$key]->addsubject = "";
								}*/

								/*$str_arr = array();
								if(count($sub_a)>0){
									// $resteah = $this->student_m->get_subjectName(array_keys($sub_a));
									// $sub_js= $resteah[0]->subject;
									
									foreach ($sub_a as $m => $n) {
										$resteah_s = $this->student_m->get_sectionName(array($n));
										$resteah = $this->student_m->get_subjectName(array($m));

										$str_arr[] = trim($resteah[0]->subject,",")." (".trim($resteah_s[0]->section,",").")";
									}
									
									$this->data['allpackage'][$package->packageID][$key]->subject = implode(",", $str_arr);
								}else{
									$this->data['allpackage'][$package->packageID][$key]->subject = "-";
								}*/

							}
						}
					}

				} else {
					$this->data['students'] = NULL;
				}

				// exit;

				$this->data["subview"] = "student/index";

				$this->load->view('_layout_main', $this->data);

			} else {

				$this->data['classes'] = $this->student_m->get_classes();

				$this->data["subview"] = "student/search";

				$this->load->view('_layout_main', $this->data);

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('_layout_main', $this->data);

		}

	}



	protected function rules() {

		$rules = array(

			array(

				'field' => 'name',

				'label' => $this->lang->line("student_name"),

				'rules' => 'trim|required|xss_clean|max_length[60]'

			),

			array(

				'field' => 'dob',

				'label' => $this->lang->line("student_dob"),

				'rules' => 'trim|required|max_length[10]|callback_date_valid|xss_clean'

			),

			array(

				'field' => 'sex',

				'label' => $this->lang->line("student_sex"),

				'rules' => 'trim|required|max_length[10]|xss_clean'

			),

			array(

				'field' => 'ic_no',

				'label' => $this->lang->line("student_ic_no"),

				'rules' => 'trim|max_length[25]|xss_clean'

			),

			/*array(

				'field' => 'email',

				'label' => $this->lang->line("student_email"),

				'rules' => 'trim|required|max_length[40]|valid_email|xss_clean|callback_unique_email'

			),*/

			array(

				'field' => 'phone',

				'label' => $this->lang->line("student_phone"),

				'rules' => 'trim|max_length[25]|min_length[5]|xss_clean'

			),

			array(

				'field' => 'address',

				'label' => $this->lang->line("student_address"),

				'rules' => 'trim|max_length[200]|xss_clean'

			),

			array(

				'field' => 'classesID',

				'label' => $this->lang->line("student_classes"),

				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_unique_classesID'

			),

			array(

				'field' => 'sectionID',

				'label' => $this->lang->line("student_section"),

				'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_unique_sectionID'

			),

			array(

				'field' => 'roll',

				'label' => $this->lang->line("student_roll"),

				'rules' => 'trim|required|max_length[40]|callback_unique_roll|xss_clean'

			),

			array(

				'field' => 'guargianID',

				'label' => $this->lang->line("student_guargian"),

				'rules' => 'trim|required|max_length[11]|xss_clean|numeric'

			),

			array(

				'field' => 'photo',

				'label' => $this->lang->line("student_photo"),

				'rules' => 'trim|max_length[200]|xss_clean'

			),



			/*array(

				'field' => 'username',

				'label' => $this->lang->line("student_username"),

				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean|callback_lol_username'

			),

			array(

				'field' => 'password',

				'label' => $this->lang->line("student_password"),

				'rules' => 'trim|required|min_length[4]|max_length[40]|xss_clean'

			)*/

		);

		return $rules;

	}

	function subjectcall() {

		$classID = $this->input->post('id');



		if((int)$classID) {

			$allclasses = $this->student_m->get_subject($classID);

			

			foreach ($allclasses as $value) {

				echo "<option value=\"$value->subject\">",$value->subject,"</option>";

			}

		} 

	}

	function callPackage() {

		$classID = $this->input->post('id');



		if((int)$classID) {

			$allclasses = $this->student_m->get_package($classID);

			
				echo "<option value=\"0\">","Select Package","</option>";
			foreach ($allclasses as $value) {
				if($value->category==1){
					echo "<option value=\"$value->packageID\">",$value->package,"</option>";
				}

			}

		} 

	}

	function callAdditionalPackage() {

		$classID = $this->input->post('id');



		if((int)$classID) {

			$allclasses = $this->student_m->get_package($classID);

			
				echo "<option value=\"0\">","Select Package","</option>";
			foreach ($allclasses as $value) {
				if($value->category==2){
					echo "<option value=\"$value->packageID\">",$value->package,"</option>";
				}
			}

		} 

	}

	public function getPackSection(){
		$packageID = $this->input->post('id');
		if((int)$packageID) {

			$pack_data = $this->package_m->get_package($packageID);

			echo $pack_data->sectionID;

		} 
	}

	function packagesubjectcall() {

		$packageID = $this->input->post('packageID');
		// $sectionID = $this->input->post('sectionID');

		if((int)$packageID) {

			$allclasses = $this->student_m->get_packsubject($packageID);
			$students = $this->student_m->get_student();
			foreach ($allclasses as $value) {

				if($value->subject != ""){
					$sub_ar = unserialize($value->subject);
					$over_subs = array();
					foreach ($sub_ar as $s => $sv) {
						$scount = 0;
						if(count($students)){
							foreach ($students as $k => $v) {
								$subject = unserialize($v->subject);
								if(count($subject)>0){
									if(array_key_exists($sv, $subject)){
										$scount++;
									}
								}
							}
						}
						// echo $scount."<br>";
						
						$slm = $this->subject_m->get_subject($sv);
						
						if($scount >= $slm->studentLimit){
							$over_subs[] = $sub_ar[$s];
						}
						/*if($sectionID != $slm->sectionID){
							unset($sub_ar[$s]);
						}*/

					}
					if(isset($sub_ar) && count($sub_ar)>0){
						$subnames = $this->student_m->get_subjectNameCode($sub_ar);
						$subnames_ar = array();
						foreach ($subnames as $m => $n) {
							$subnames_ar[] = $n->subject." (".$n->subject_code.")";
						}
						$com_ar = array_combine($sub_ar, $subnames_ar);
					}else{
						$com_ar = array();
					}

					echo json_encode(array("overs"=>$over_subs,"subs"=>$com_ar));
					

				}else{
					echo " ";
				}
				

			}

		} 

	}

	function checkSubjectAvailable(){
		$subID = $this->input->post('subID');
		$classesID = $this->input->post('classesID');
		$secID = $this->input->post('secID');
		if((int)$classesID) {
			$sub_data = $this->subject_m->get_subject($subID);
			$sections = $this->section_m->get_section($secID);
			$subject_code = $sub_data->subject_code;
			$section_name = $sections->section;
			$sub_c_ar = explode(" ", trim($subject_code));
			$sec_code = end($sub_c_ar);
				array_pop($sub_c_ar);
				array_push($sub_c_ar, $section_name);
				$new_sub_code = implode(" ", $sub_c_ar);
				$new_sub_data = $this->subject_m->get_order_by_subject(array("subject_code"=>$new_sub_code,"classesID"=>$classesID,"sectionID"=>$secID));
				$scount = 0;
				$students = $this->student_m->get_student();
				if(count($students)){
					foreach ($students as $k => $v) {
						$subject = unserialize($v->subject);
						if(count($subject)>0){
							if(array_key_exists($new_sub_data[0]->subjectID, $subject)){
								$scount++;
							}
						}
					}
				}
				if($scount >= $new_sub_data[0]->studentLimit){
					echo "err";
				}else{
					echo "ok";
				}
			
		}
	}


	function insert_with_image($username) {

	    $random = rand(1, 10000000000000000);

	    $makeRandom = hash('sha512', $random. $username . config_item("encryption_key"));

	    return $makeRandom;

	}


	public function add() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin") {

			$this->data['classes'] = $this->student_m->get_classes();

			$this->data['sections'] = $this->section_m->get_section();

			$this->data['transports'] = $this->student_m->get_transport();

			$this->data['parents'] = $this->parentes_m->get_parentes();

			$classesID = $this->input->post("classesID");

			if($classesID != 0) {

				$this->data['sections'] = $this->section_m->get_order_by_section(array("classesID" =>$classesID));

			} else {

				$this->data['sections'] = "empty";

			}

			

			if($_POST) {

				$rules = $this->rules();

				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() == FALSE) {

					$this->data["subview"] = "student/add";

					$this->load->view('student/add', $this->data);

				} else {



					$sectionID = $this->input->post("sectionID");

					if($sectionID == 0) {

						$this->data['sectionID'] = 0;

					} else {

						$this->data['sections'] = $this->section_m->get_allsection($classesID);

						$this->data['sectionID'] = $this->input->post("sectionID");

					}



					$dbmaxyear = $this->student_m->get_order_by_student_single_max_year($classesID);

					$maxyear = "";

					if(count($dbmaxyear)) {

						$maxyear = $dbmaxyear->year;

					} else {

						$maxyear = date("Y");

					}

					$sub_ject = $this->input->post('subject');
					$section_arr = $this->input->post('section');

					if(count($sub_ject)>0){
						foreach ($sub_ject as $key => $value) {
							$sub_data = $this->subject_m->get_subject($value);
							$sections = $this->section_m->get_section($section_arr[$key]);
							$subject_code = $sub_data->subject_code;
							$section_name = $sections->section;
							$sub_c_ar = explode(" ", trim($subject_code));
							$sec_code = end($sub_c_ar);
							
								array_pop($sub_c_ar);
								array_push($sub_c_ar, $section_name);
								$new_sub_code = implode(" ", $sub_c_ar);
								$new_sub_data = $this->subject_m->get_order_by_subject(array("subject_code"=>$new_sub_code,"classesID"=>$this->input->post("classesID"),"sectionID"=>$section_arr[$key]));

								$sub_ject[$key] = $new_sub_data[0]->subjectID;
								$scount = 0;
								$students = $this->student_m->get_student();
								if(count($students)){
									foreach ($students as $k => $v) {
										$subject = unserialize($v->subject);
										if(count($subject)>0){
											if(array_key_exists($new_sub_data[0]->subjectID, $subject)){
												$scount++;
											}
										}
									}
								}
								if($scount >= $new_sub_data[0]->studentLimit){
									unset($sub_ject[$key]);
									unset($section_arr[$key]);
								}
							
							/*echo "<pre>";
							print_r($sub_ject);
							print_r($sub_data);
							print_r($sections);
							echo "</pre>";*/
						}
						
					}

					if(count($sub_ject)>0 && count($section_arr)>0){

					$section = $this->section_m->get_section($sectionID);

					$additional_pack = $this->input->post("additional_pack");
					
					$sub_section_arr = array_combine($sub_ject, $section_arr);

					$additional_pack_ar = array();

					
					if(!empty($additional_pack)){
						$additional_pack_ar = $additional_pack;
						foreach ($additional_pack_ar as $key => $value) {
							$pack_data = $this->package_m->get_package($value);
							if(!empty($pack_data->subject)){
								$su_a = unserialize($pack_data->subject);
								$sub_section_arr[$su_a[0]]=$this->input->post("sectionID");
							}
						}
					}

					

					$sub_section_str = serialize($sub_section_arr);

					$additional_pack_str = serialize($additional_pack_ar);

					$array = array();

					$array["name"] = $this->input->post("name");
					

					$array["dob"] = date("Y-m-d", strtotime($this->input->post("dob")));

					$array["sex"] = $this->input->post("sex");

					$array["religion"] = $this->input->post("religion");

					// $array["email"] = $this->input->post("email");

					$array["email"] = 0;

					$array["phone"] = $this->input->post("phone");

					$array["address"] = $this->input->post("address");

					$array["classesID"] = $this->input->post("classesID");

					$array["sectionID"] = $this->input->post("sectionID");

					$array["section"] = $section->section;

					$array["roll"] = $this->input->post("roll");

					// $array["username"] = $this->input->post("username");

					// $array['password'] = $this->student_m->hash($this->input->post("password"));

					$array["username"] = 0;

					$array['password'] = 0;

					$array['usertype'] = "Student";

					$array['parentID'] = $this->input->post('guargianID');

					$array['library'] = 0;

					$array['hostel'] = 0;

					$array['transport'] = 0;

					$array['create_date'] = date("Y-m-d");

					$array['year'] = $maxyear;

					$array['totalamount'] = 0;

					$array['paidamount'] = 0;

					$array["create_date"] = date("Y-m-d h:i:s");

					$array["modify_date"] = date("Y-m-d h:i:s");

					$array["create_userID"] = $this->session->userdata('loginuserID');

					$array["create_username"] = $this->session->userdata('username');

					$array["create_usertype"] = $this->session->userdata('usertype');

					$array["studentactive"] = 1;

					echo $array["subject"] = $sub_section_str;

					$array["ic_no"] = $this->input->post('ic_no');

					$array["packageID"] = $this->input->post('package');

					$array["additional_pack"] = $additional_pack_str;

					$array["transportID"] = $this->input->post('transportID');



					$new_file = "defualt.png";

					if(isset($_FILES["image"]['name']) && $_FILES["image"]['name'] !="") {

						$file_name = $_FILES["image"]['name'];

						$file_name_rename = $this->insert_with_image($this->input->post("username"));

			            $explode = explode('.', $file_name);

			            if(count($explode) >= 2) {

				            $new_file = $file_name_rename.'.'.$explode[1];

							$config['upload_path'] = "./uploads/images";

							$config['allowed_types'] = "gif|jpg|png";

							$config['file_name'] = $new_file;

							$config['max_size'] = '1024';

							$config['max_width'] = '3000';

							$config['max_height'] = '3000';

							$array['photo'] = $new_file;

							$this->load->library('upload', $config);

							if(!$this->upload->do_upload("image")) {

								$this->data["image"] = $this->upload->display_errors();

								$this->data["subview"] = "student/add";

								$this->load->view('student/add', $this->data);

							} else {

								$data = array("upload_data" => $this->upload->data());

								$this->student_m->insert_student($array);

								if((int)$insert_id) {

								/*$classesID = $this->input->post("classesID");

								$getclasses = $this->classes_m->get_classes($classesID);
								
								$pack = $this->student_m->get_packsubject($packageID);
								
								$amount = (($pack[0]->price)+($pack[0]->price_monthly));

								$feetype_arr = array($packageID."_1::".$pack[0]->package);
							$amount_arr = array($amount);
							$quantity_arr = array(1);
							$tax_code_arr = array($pack[0]->tax_code);
							$fp_arr = array($pack[0]->description);

							$i_data = array("feetype_arr"=>$feetype_arr,"amount_arr"=>$amount_arr,"quantity_arr"=>$quantity_arr,"tax_code_arr"=>$tax_code_arr,"fp_arr"=>$fp_arr);

							$invoce_data =serialize($i_data);

							$array = array(

								'classesID' => $classesID,

								'classes' => $getclasses->classes,

								'studentID' => $insert_id,

								'student' => $this->input->post("name"),

								'roll' => $this->input->post("roll"),

								'feetype' => "package-".$pack[0]->package,

								'amount' => $amount,

								'status' => 0,

								'tax_code' => $pack[0]->tax_code,

								'invoce_data' => $invoce_data,

								'item_no' => 1,

								'date' => date("Y-m-d"),

								'year' => date('Y'),

								'invoce_type' => 1

							);

								$oldamount = 0;

								$nowamount = $oldamount+$amount;

								$this->student_m->update_student(array('totalamount' => $nowamount), $insert_id);

								$returnID = $this->invoice_m->insert_invoice($array);
								*/
								$packageID = $this->input->post('package');
								array_push($additional_pack_ar, $packageID);
								if(!empty($additional_pack_ar) && count($additional_pack_ar)>0){
									$amount = 0;
									$c=0;
									foreach ($additional_pack_ar as $add_pack) {
										$classesID = $this->input->post("classesID");
										$getclasses = $this->classes_m->get_classes($classesID);
										$pack = $this->student_m->get_packsubject($add_pack);
										$amt = (($pack[0]->price)+($pack[0]->price_monthly));
										$amount += $amt;

										$set_feetype_arr[] = $pack[0]->package;
										$feetype_arr[] = $packageID."_1::".$pack[0]->package;
										$amount_arr[] = $amt;
										$quantity_arr[] = 1;
										$tax_code_arr[] = $pack[0]->tax_code;
										$fp_arr[] = $pack[0]->description;
										$c++;
									}

										if($this->input->post('transportID')!=0){
											$transportID = $this->input->post('transportID');
											$transport_data = $this->student_m->get_transport(array("transportID"=>$transportID));
											$set_feetype_arr[] = "Transport";
											$feetype_arr[] = $transportID."_3::".$transport_data[0]->route;
											$amount_arr[] = $transport_data[0]->fare;
											$amount += $transport_data[0]->fare;
											$quantity_arr[] = 1;
											$tax_code_arr[] = $transport_data[0]->tax_code;
											$fp_arr[] = $transport_data[0]->route." (".$transport_data[0]->vehicle.")";
											$c++;

											$tarray = array(

												"studentID" => $insert_id,

												"transportID" => $this->input->post("transportID"),

												"name" => $this->input->post("name"),

												"email" => 0,

												"phone" => $this->input->post("phone"),

												"tbalance" => $transport_data[0]->fare,

												"tjoindate" => date("Y-m-d")

											);



											$this->tmember_m->insert_tmember($tarray);

											$this->student_m->update_student(array("transport" => 1), $insert_id);

										}

										$i_data = array("feetype_arr"=>$feetype_arr,"amount_arr"=>$amount_arr,"quantity_arr"=>$quantity_arr,"tax_code_arr"=>$tax_code_arr,"fp_arr"=>$fp_arr);

										$invoce_data =serialize($i_data);

										$array = array(

											'classesID' => $classesID,

											'classes' => $getclasses->classes,

											'studentID' => $insert_id,

											'student' => $this->input->post("name"),

											'roll' => $this->input->post("roll"),

											'feetype' => serialize($set_feetype_arr),

											'amount' => $amount,

											'status' => 0,

											'tax_code' => $pack[0]->tax_code,

											'invoce_data' => $invoce_data,

											'item_no' => $c,

											'date' => date("Y-m-d"),

											'year' => date('Y'),

											'invoce_type' => 1,

											"subcategory" => 2

										);

										// $ald_amt = $this->student_m->get_student($insert_id);
										$oldamount = 0;

										$nowamount = $oldamount+$amount;

										$this->student_m->update_student(array('totalamount' => $nowamount), $insert_id);

										$returnID = $this->invoice_m->insert_invoice($array);
									
								}

								$this->session->set_flashdata('success', $this->lang->line('menu_success'));

								// redirect(base_url("student/index"));
								echo "ok";

							}
						}

						} else {

							$this->data["image"] = "Invalid file";

							$this->data["subview"] = "student/add";

							$this->load->view('student/add', $this->data);

						}

					} else {

						$array["photo"] = $new_file;

						$insert_id = $this->student_m->insert_student($array);

						if((int)$insert_id) {

							$packageID = $this->input->post('package');
								array_push($additional_pack_ar, $packageID);

								if(!empty($additional_pack_ar) && count($additional_pack_ar)>0){
									$amount = 0;
									$c=0;
									foreach ($additional_pack_ar as $add_pack) {
										$classesID = $this->input->post("classesID");
										$getclasses = $this->classes_m->get_classes($classesID);
										$pack = $this->student_m->get_packsubject($add_pack);
										$amt = (($pack[0]->price)+($pack[0]->price_monthly));
										$amount += $amt;

										$set_feetype_arr[] = $pack[0]->package;
										$feetype_arr[] = $packageID."_1::".$pack[0]->package;
										$amount_arr[] = $amt;
										$quantity_arr[] = 1;
										$tax_code_arr[] = $pack[0]->tax_code;
										$fp_arr[] = $pack[0]->description;
										$c++;
									}
										if($this->input->post('transportID')!=0){
											$transportID = $this->input->post('transportID');
											$transport_data = $this->student_m->get_transport(array("transportID"=>$transportID));
											$set_feetype_arr[] = "Transport";
											$feetype_arr[] = $transportID."_3::".$transport_data[0]->route;
											$amount_arr[] = $transport_data[0]->fare;
											$amount += $transport_data[0]->fare;
											$quantity_arr[] = 1;
											$tax_code_arr[] = $transport_data[0]->tax_code;
											$fp_arr[] = $transport_data[0]->route." (".$transport_data[0]->vehicle.")";
											$c++;


											$tarray = array(

												"studentID" => $insert_id,

												"transportID" => $this->input->post("transportID"),

												"name" => $this->input->post("name"),

												"email" => 0,

												"phone" => $this->input->post("phone"),

												"tbalance" => $transport_data[0]->fare,

												"tjoindate" => date("Y-m-d")

											);



											$this->tmember_m->insert_tmember($tarray);

											$this->student_m->update_student(array("transport" => 1), $insert_id);

										}
										$i_data = array("feetype_arr"=>$feetype_arr,"amount_arr"=>$amount_arr,"quantity_arr"=>$quantity_arr,"tax_code_arr"=>$tax_code_arr,"fp_arr"=>$fp_arr);

										$invoce_data =serialize($i_data);

										$array = array(

											'classesID' => $classesID,

											'classes' => $getclasses->classes,

											'studentID' => $insert_id,

											'student' => $this->input->post("name"),

											'roll' => $this->input->post("roll"),

											'feetype' => serialize($set_feetype_arr),

											'amount' => $amount,

											'status' => 0,

											'tax_code' => $pack[0]->tax_code,

											'invoce_data' => $invoce_data,

											'item_no' => $c,

											'date' => date("Y-m-d"),

											'year' => date('Y'),

											'invoce_type' => 1,

											"subcategory" => 2

										);

										// $ald_amt = $this->student_m->get_student($insert_id);
										$oldamount = 0;

										$nowamount = $oldamount+$amount;

										$this->student_m->update_student(array('totalamount' => $nowamount), $insert_id);

										$returnID = $this->invoice_m->insert_invoice($array);
									
								}

						}

						$this->session->set_flashdata('success', $this->lang->line('menu_success'));

						// redirect(base_url("student/index"));
						echo "ok";

					}
                                        }else{
                                         echo "ErrorSubject";
                                        }
				}

			} else {

				$this->data["subview"] = "student/add";

				$this->load->view('student/add', $this->data);

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('error', $this->data);

		}

	}



	public function edit() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if((int)$id && (int)$url) {

				$this->data['classes'] = $this->student_m->get_classes();

				$this->data['student'] = $this->student_m->get_student($id);

				$this->data['transports'] = $this->student_m->get_transport();

				$this->data['parents'] = $this->parentes_m->get_parentes();

				$this->data['allpackage'] = $this->student_m->get_package($url);

				$classesID = $this->data['student']->classesID;

				$sub_se_ar = unserialize($this->data['student']->subject);

				if(isset($sub_se_ar) && count($sub_se_ar)>0){
					$subnames_ar = array();
					foreach ($sub_se_ar as $s => $t) {
						$subnames = $this->student_m->get_subjectNameCode(array($s));
						foreach ($subnames as $m => $n) {
							$subnames_ar[$s] = $n->subject." (".$n->subject_code.")";
						}
					}
					$this->data['student']->subjectnane = $subnames_ar;
				}else{
					$this->data['student']->subjectnane = "";
				}		

				// print_r($this->data['student']);exit;

				$this->data['sections'] = $this->section_m->get_order_by_section(array('classesID' => $classesID));

				$this->data['set'] = $url;

				if($this->data['student']) {

					if($_POST) {

						$rules = $this->rules();

						unset($rules[11],$rules[12], $rules[13]);

						$this->form_validation->set_rules($rules);

						if ($this->form_validation->run() == FALSE) {

							$this->data["subview"] = "student/edit";

							$this->load->view('student/edit', $this->data);

						} else {

							$sub_ject = $this->input->post('subject');
							$section_arr = $this->input->post('section');

							if(count($sub_ject)>0){
								foreach ($sub_ject as $key => $value) {
									$sub_data = $this->subject_m->get_subject($value);
									$sections = $this->section_m->get_section($section_arr[$key]);
									$subject_code = $sub_data->subject_code;
									$section_name = $sections->section;
									$sub_c_ar = explode(" ", trim($subject_code));
									$sec_code = end($sub_c_ar);
									
										array_pop($sub_c_ar);
										array_push($sub_c_ar, $section_name);
										$new_sub_code = implode(" ", $sub_c_ar);
										$new_sub_data = $this->subject_m->get_order_by_subject(array("subject_code"=>$new_sub_code,"classesID"=>$this->input->post("classesID"),"sectionID"=>$section_arr[$key]));

										$sub_ject[$key] = $new_sub_data[0]->subjectID;

										$scount = 0;
										$students = $this->student_m->get_student();
										if(count($students)){
											foreach ($students as $k => $v) {
												$subject = unserialize($v->subject);
												if(count($subject)>0){
													if(array_key_exists($new_sub_data[0]->subjectID, $subject)){
														$scount++;
													}
												}
											}
										}
										if($scount >= $new_sub_data[0]->studentLimit){
											unset($sub_ject[$key]);
											unset($section_arr[$key]);
										}
									
									/*echo "<pre>";
									print_r($sub_ject);
									print_r($sub_data);
									print_r($sections);
									echo "</pre>";*/
								}
								
							}

							$sub_section_arr = array_combine($sub_ject, $section_arr);

							

							$additional_pack = $this->input->post("additional_pack");

							$additional_pack_ar = array();

							if(!empty($additional_pack)){
								$additional_pack_ar = $additional_pack;
								foreach ($additional_pack_ar as $key => $value) {
									$pack_data = $this->package_m->get_package($value);
									
									if(!empty($pack_data->subject)){
										$su_a = unserialize($pack_data->subject);
										$sub_section_arr[$su_a[0]]=$this->input->post("sectionID");
									}
								}
							}

							$sub_section_str = serialize($sub_section_arr);

							$additional_pack_str = serialize($additional_pack_ar);


							$array = array();

							$array["name"] = $this->input->post("name");

							$array["dob"] = date("Y-m-d", strtotime($this->input->post("dob")));

							$array["sex"] = $this->input->post("sex");

							$array["religion"] = $this->input->post("religion");

							// $array["email"] = $this->input->post("email");
							$array["email"] = 0;

							$array["phone"] = $this->input->post("phone");

							$array["address"] = $this->input->post("address");

							$array["classesID"] = $this->input->post("classesID");

							$array["sectionID"] = $this->input->post("sectionID");

							$section = $this->section_m->get_section($this->input->post("sectionID"));

							$array["section"] = $section->section;

							$array["roll"] = $this->input->post("roll");

							$array["parentID"] = $this->input->post("guargianID");

							$array["modify_date"] = date("Y-m-d h:i:s");

							$array["subject"] = $sub_section_str;

							$array["ic_no"] = $this->input->post('ic_no');

							$array["packageID"] = $this->input->post('package');

							$array["additional_pack"] = $additional_pack_str;



							if(isset($_FILES["image"]['name']) && $_FILES["image"]['name'] !="") {

								if($this->data['student']->photo != 'defualt.png') {

									unlink(FCPATH.'uploads/images/'.$this->data['student']->photo);

								}

								$file_name = $_FILES["image"]['name'];

								$file_name_rename = $this->insert_with_image($this->data['student']->username);

					            $explode = explode('.', $file_name);

					            if(count($explode) >= 2) {

						            $new_file = $file_name_rename.'.'.$explode[1];

									$config['upload_path'] = "./uploads/images";

									$config['allowed_types'] = "gif|jpg|png";

									$config['file_name'] = $new_file;

									$config['max_size'] = '1024';

									$config['max_width'] = '3000';

									$config['max_height'] = '3000';



									$array['photo'] = $new_file;

									$this->load->library('upload', $config);

									if(!$this->upload->do_upload("image")) {

										$this->data["image"] = $this->upload->display_errors();

										$this->data["subview"] = "student/edit";

										$this->load->view('student/edit', $this->data);

									} else {

										$data = array("upload_data" => $this->upload->data());

										$this->student_m->update_student($array, $id);

										$this->session->set_flashdata('success', $this->lang->line('menu_success'));

										// redirect(base_url("student/index/$url"));
										echo "ok";

									}

								} else {

									$this->data["image"] = "Invalid file";

									$this->data["subview"] = "student/edit";

									$this->load->view('student/edit', $this->data);

								}

							} else {

								$this->student_m->update_student($array, $id);

								$this->session->set_flashdata('success', $this->lang->line('menu_success'));

								//redirect(base_url("student/index/$url"));
								echo "ok";

							}

						}

					} else {

						$this->data["subview"] = "student/edit";

						$this->load->view('student/edit', $this->data);

					}

				} else {

					$this->data["subview"] = "error";

					$this->load->view('error', $this->data);

				}

			} else {

				$this->data["subview"] = "error";

				$this->load->view('error', $this->data);

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('error', $this->data);

		}

	}



	public function view() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin" || $usertype == "Teacher") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {

				$this->data["student"] = $this->student_m->get_student($id);

				$this->data["class"] = $this->student_m->get_class($url);

				if($this->data["student"] && $this->data["class"]) {

					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

					$this->data['set'] = $url;

					$this->data["exams"] = $this->exam_m->get_exam();

					$this->data["grades"] = $this->grade_m->get_grade();

					$this->data["marks"] = $this->mark_m->get_order_by_mark_with_highest_mark($url,$id);

					if ($this->data["student"]->parentID) {

						$this->data["parent"] = $this->parentes_m->get_parentes($this->data["student"]->parentID);

					}

					$this->data["subview"] = "student/view";

					$this->load->view('student/view', $this->data);

				} else {

					$this->data["subview"] = "error";

					$this->load->view('error', $this->data);

				}

			} else {

				$this->data["subview"] = "error";

				$this->load->view('error', $this->data);

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('error', $this->data);

		}

	}



	public function print_preview() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));



			if ((int)$id && (int)$url) {

				$this->data["student"] = $this->student_m->get_student($id);

				$this->data["class"] = $this->student_m->get_class($url);

				if($this->data["student"] && $this->data["class"]) {

					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

				    $this->load->library('html2pdf');

				    $this->html2pdf->folder('./assets/pdfs/');

				    $this->html2pdf->filename('Report.pdf');

				    $this->html2pdf->paper('a4', 'portrait');

				    $this->data['panel_title'] = $this->lang->line('panel_title');

					$this->data["parent"] = $this->parentes_m->get_parentes($this->data["student"]->parentID);

					$html = $this->load->view('student/print_preview', $this->data, true);

					$this->html2pdf->html($html);

					$this->html2pdf->create();

				} else {

					$this->data["subview"] = "error";

					$this->load->view('_layout_main', $this->data);

				}

			} else {

				$this->data["subview"] = "error";

				$this->load->view('_layout_main', $this->data);

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('_layout_main', $this->data);

		}

	}



	public function send_mail() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin") {

			$id = $this->input->post('id');

			$url = $this->input->post('set');

			if ((int)$id && (int)$url) {

				$this->data["student"] = $this->student_m->get_student($id);

				$this->data["class"] = $this->student_m->get_class($url);

				if($this->data["student"] && $this->data["class"]) {

					$this->data["section"] = $this->section_m->get_section($this->data['student']->sectionID);

				    $this->load->library('html2pdf');

				    $this->html2pdf->folder('uploads/report');

				    $this->html2pdf->filename('Report.pdf');

				    $this->html2pdf->paper('a4', 'portrait');

				    $this->data['panel_title'] = $this->lang->line('panel_title');

					$this->data["parent"] = $this->parentes_m->get_parentes($this->data["student"]->parentID);

					$html = $this->load->view('student/print_preview', $this->data, true);

					$this->html2pdf->html($html);

					$this->html2pdf->create('save');



					if($path = $this->html2pdf->create('save')) {

					$this->load->library('email');

					$this->email->set_mailtype("html");

					$this->email->from($this->data["siteinfos"]->email, $this->data['siteinfos']->sname);

					$this->email->to($this->input->post('to'));

					$this->email->subject($this->input->post('subject'));

					$this->email->message($this->input->post('message'));

					$this->email->attach($path);

						if($this->email->send()) {

							$this->session->set_flashdata('success', $this->lang->line('mail_success'));

						} else {

							$this->session->set_flashdata('error', $this->lang->line('mail_error'));

						}

					}



				} else {

					$this->data["subview"] = "error";

					$this->load->view('_layout_main', $this->data);

				}

			} else {

				$this->data["subview"] = "error";

				$this->load->view('_layout_main', $this->data);

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('_layout_main', $this->data);

		}

	}







	public function delete() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin") {

			$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

			$url = htmlentities(mysql_real_escape_string($this->uri->segment(4)));

			if ((int)$id && (int)$url) {

				$this->data['student'] = $this->student_m->get_student($id);

				if($this->data['student']) {

					if($this->data['student']->photo != 'defualt.png') {

						unlink(FCPATH.'uploads/images/'.$this->data['student']->photo);

					}

					$this->student_m->delete_student($id);

					$this->session->set_flashdata('success', $this->lang->line('menu_success'));

					redirect(base_url("student/index/$url"));

				} else {

					redirect(base_url("student/index"));

				}

			} else {

				redirect(base_url("student/index/$url"));

			}

		} else {

			$this->data["subview"] = "error";

			$this->load->view('_layout_main', $this->data);

		}

	}



	public function unique_roll() {

		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

		if((int)$id) {

			$student = $this->student_m->get_order_by_roll(array("roll" => $this->input->post("roll"), "studentID !=" => $id, "classesID" => $this->input->post('classesID')));

			if(count($student)) {

				$this->form_validation->set_message("unique_roll", "%s already exists");

				return FALSE;

			}

			return TRUE;

		} else {

			$student = $this->student_m->get_order_by_roll(array("roll" => $this->input->post("roll"), "classesID" => $this->input->post('classesID')));



			if(count($student)) {

				$this->form_validation->set_message("unique_roll", "%s already exists");

				return FALSE;

			}

			return TRUE;

		}

	}



	public function lol_username() {

		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

		if((int)$id) {

			$student_info = $this->student_m->get_single_student(array('studentID' => $id));

			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');

			$array = array();

			$i = 0;

			foreach ($tables as $table) {

				$user = $this->student_m->get_username($table, array("username" => $this->input->post('username'), "email !=" => $student_info->email));

				if(count($user)) {

					$this->form_validation->set_message("lol_username", "%s already exists");

					$array['permition'][$i] = 'no';

				} else {

					$array['permition'][$i] = 'yes';

				}

				$i++;

			}

			if(in_array('no', $array['permition'])) {

				return FALSE;

			} else {

				return TRUE;

			}

		} else {

			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');

			$array = array();

			$i = 0;

			foreach ($tables as $table) {

				$user = $this->student_m->get_username($table, array("username" => $this->input->post('username')));

				if(count($user)) {

					$this->form_validation->set_message("lol_username", "%s already exists");

					$array['permition'][$i] = 'no';

				} else {

					$array['permition'][$i] = 'yes';

				}

				$i++;

			}



			if(in_array('no', $array['permition'])) {

				return FALSE;

			} else {

				return TRUE;

			}

		}

	}



	public function date_valid($date) {

		if(strlen($date) <10) {

			$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");

	     	return FALSE;

		} else {

	   		$arr = explode("-", $date);

	        $dd = $arr[0];

	        $mm = $arr[1];

	        $yyyy = $arr[2];

	      	if(checkdate($mm, $dd, $yyyy)) {

	      		return TRUE;

	      	} else {

	      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");

	     		return FALSE;

	      	}

	    }

	}



	public function unique_classesID() {

		if($this->input->post('classesID') == 0) {

			$this->form_validation->set_message("unique_classesID", "The %s field is required");

	     	return FALSE;

		}

		return TRUE;

	}



	public function unique_sectionID() {

		if($this->input->post('sectionID') == 0) {

			$this->form_validation->set_message("unique_sectionID", "The %s field is required");

	     	return FALSE;

		}

		return TRUE;

	}



	public function student_list() {

		$classID = $this->input->post('id');
		$pack_id = $this->input->post('pack_id');

		if((int)$classID) {

			$string = base_url("student/index/$classID");

			echo $string;

		} else {

			redirect(base_url("student/index"));

		}

	}



	public function unique_email() {

		$id = htmlentities(mysql_real_escape_string($this->uri->segment(3)));

		if((int)$id) {

			$student_info = $this->student_m->get_single_student(array('studentID' => $id));

			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');

			$array = array();

			$i = 0;

			foreach ($tables as $table) {

				$user = $this->student_m->get_username($table, array("email" => $this->input->post('email'), 'username !=' => $student_info->username ));

				if(count($user)) {

					$this->form_validation->set_message("unique_email", "%s already exists");

					$array['permition'][$i] = 'no';

				} else {

					$array['permition'][$i] = 'yes';

				}

				$i++;

			}

			if(in_array('no', $array['permition'])) {

				return FALSE;

			} else {

				return TRUE;

			}

		} else {

			$tables = array('student' => 'student', 'parent' => 'parent', 'teacher' => 'teacher', 'user' => 'user', 'systemadmin' => 'systemadmin');

			$array = array();

			$i = 0;

			foreach ($tables as $table) {

				$user = $this->student_m->get_username($table, array("email" => $this->input->post('email')));

				if(count($user)) {

					$this->form_validation->set_message("unique_email", "%s already exists");

					$array['permition'][$i] = 'no';

				} else {

					$array['permition'][$i] = 'yes';

				}

				$i++;

			}



			if(in_array('no', $array['permition'])) {

				return FALSE;

			} else {

				return TRUE;

			}

		}

	}



	function sectioncall() {

		$classesID = $this->input->post('id');

		if((int)$classesID) {

			$allsection = $this->section_m->get_order_by_section(array('classesID' => $classesID));

			echo "<option value='0'>", $this->lang->line("student_select_section"),"</option>";

			foreach ($allsection as $value) {
				// $student = $this->student_m->get_studentCount(array('sectionID'=>$value->sectionID));

				// if($student[0]->studs < $value->studentLimit){
					echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
				// }

			}

		}

	}



	function active() {

		$usertype = $this->session->userdata("usertype");

		if($usertype == "Admin") {

			$id = $this->input->post('id');

			$status = $this->input->post('status');

			if($id != '' && $status != '') {

				if((int)$id) {

					if($status == 'chacked') {

						$this->student_m->update_student(array('studentactive' => 1), $id);

						echo 'Success';

					} elseif($status == 'unchacked') {

						$this->student_m->update_student(array('studentactive' => 0), $id);

						echo 'Success';

					} else {

						echo "Error";

					}

				} else {

					echo "Error";

				}

			} else {

				echo "Error";

			}

		} else {

			echo "Error";

		}

	}

}


?>
