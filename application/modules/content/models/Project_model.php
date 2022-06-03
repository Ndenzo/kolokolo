<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Project_model extends IBEMS_Model
{
     protected $__user_id;
     protected $img_base_path;
     protected $img_base_path_2;
     protected $doc_base_path;

     public function __construct()
     {
          parent::__construct();
          $this->__user_id = get_user_info('user_id');
          $this->img_base_path = './images/projects/';
          $this->img_base_path_2 = './images/galeries/';
          $this->doc_base_path = './dossiers/project_reports/';
     }

     // Insert project -----------------------------------------------------------

     public function insert($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('projects');
          $data['project_added_by'] = $this->__user_id;
          $data['project_added'] = time();
          $data['project_modified'] = time();
          $data['project_locked'] = 0;
          $this->db->insert('projects', $data);
          $project_id = $this->db->insert_id();

          if($this->input->post('photo') != null){
               $this->update_photo($project_id);
          }

          if($this->input->post('photos[]') != null){
               foreach($this->input->post('photos[]') as $key => $photo){
                    $this->update_galerie($project_id, $photo, $key);
               }
          }


          if($this->input->post('project_timeline_names[]') != null){
               $timeline_names = $this->input->post('project_timeline_names[]');
               $timeline_months = $this->input->post('project_timeline_months[]');
               $timeline_years = $this->input->post('project_timeline_years[]');

               foreach($timeline_names as $k => $timeline){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_timeline_name'] = $timeline_names[$k];
                    $data['project_timeline_month'] = $timeline_months[$k];
                    $data['project_timeline_year'] = $timeline_years[$k];

                    $data['project_timeline_added_by'] = $this->__user_id;
                    $data['project_timeline_added'] = time();
                    $data['project_timeline_modified'] = time();
                    $data['project_timeline_locked'] = 0;
                    $this->db->insert('project_timelines', $data);
               }
          }

          if($this->input->post('project_schedule_names[]') != null){
               $schedule_names = $this->input->post('project_schedule_names[]');
               $schedule_values = $this->input->post('project_schedule_values[]');

               foreach($schedule_names as $kk => $schedule){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_schedule_name'] = $schedule_names[$kk];
                    $data['project_schedule_value'] = $schedule_values[$kk];

                    $data['project_schedule_added_by'] = $this->__user_id;
                    $data['project_schedule_added'] = time();
                    $data['project_schedule_modified'] = time();
                    $data['project_schedule_locked'] = 0;
                    $this->db->insert('project_schedules', $data);
               }
          }

          if($this->input->post('project_charac_names[]') != null){
               $charac_names = $this->input->post('project_charac_names[]');
               $charac_values = $this->input->post('project_charac_values[]');

               foreach($charac_names as $kk => $charac){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_characteristic_code'] = $charac_names[$kk];
                    $data['project_characteristic_value'] = $charac_values[$kk];

                    $this->db->insert('project_characteristics', $data);
               }
          }

          if($this->input->post('project_neighbor_structures[]') != null){
               $neighbor_structures = $this->input->post('project_neighbor_structures[]');
               $neighbor_disctances = $this->input->post('project_neighbor_distances[]');

               foreach($neighbor_structures as $kk => $neighbor){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_neighborhood_structure'] = $neighbor_structures[$kk];
                    $data['project_neighborhood_distance'] = $neighbor_disctances[$kk];

                    $this->db->insert('project_neighborhoods', $data);
               }
          }

          if($this->input->post('convenience_ids[]') != null){
               $convenience_ids = $this->input->post('convenience_ids[]');

               foreach($convenience_ids as $kk => $convenience_id){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['convenience_id'] = $convenience_ids[$kk];

                    $this->db->insert('project_conveniences', $data);
               }
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               qry_debug();
               return false;
          }
          return true;
     }

     public function insert_invest($args = array())
     {
          $this->db->trans_start();

          $user_email = $this->input->post('investor_email');

          $this->db->select('*');
          $this->db->from('users');
          $this->db->join('investors','investors.user_id = users.user_id');
          $this->db->where('users.user_email', $user_email);
          $investor = @$this->db->get()->row();

          $partner_role_id = id_getter('role_id', 'users_roles', 'role_code', "partenaire");

          if($investor != null){
               $this->db->select('*');
               $this->db->from('project_invests');
               $this->db->where('project_invests.investor_id', $investor->investor_id);
               $investments = @$this->db->get()->result();

               if(@count($investments) < 1 && $partner_role_id != $investor->role_id){
                    $role_id = id_getter('role_id', 'users_roles', 'role_code', "investisseur");
                    $data = IBEMS_Model::sanitize_for('users');
                    $data['role_id'] = $role_id;
                    $data['modified'] = time();
                    $this->db->where('user_id', $investor->user_id);
                    $this->db->update('users', $data);
               }

               $data = IBEMS_Model::sanitize_for('project_invests');
               $data['investor_id'] = $investor->investor_id;
               $data['project_invest_added_by'] = $this->__user_id;
               $data['project_invest_added'] = time();
               $data['project_invest_modified'] = time();
               $data['project_invest_locked'] = 0;
               $this->db->insert('project_invests', $data);



          }else{
               $this->db->trans_complete();
               return false;
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function insert_report($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('project_reports');
          $data['project_report_added_by'] = $this->__user_id;
          $data['project_report_added'] = time();
          $data['project_report_modified'] = time();
          $data['project_report_locked'] = 0;
          $this->db->insert('project_reports', $data);
          $project_report_id = $this->db->insert_id();

          $this->update_file($project_report_id, $data['project_report_name']);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function insert_info($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('project_infos');
          $data['project_info_added_by'] = $this->__user_id;
          $data['project_info_added'] = time();
          $data['project_info_modified'] = time();
          $data['project_info_locked'] = 0;
          $this->db->insert('project_infos', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function insert_investor_request($args = array())
     {
          $this->db->trans_start();

          $data = IBEMS_Model::sanitize_for('investor_requests');
          $data['investor_request_added_by'] = $this->__user_id;
          $data['investor_request_added'] = time();
          $data['investor_request_modified'] = time();
          $data['investor_request_locked'] = 0;
          $this->db->insert('investor_requests', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }


     // Update project -----------------------------------------------------------

     public function update($args = array())
     {
          $this->db->trans_start();

          $project_id = $this->input->post('project_id');
          $data = IBEMS_Model::sanitize_for('projects');
          $data['project_modified'] = time();
          $this->db->where('project_id', $project_id);
          $this->db->update('projects', $data);

          if($this->input->post('photo') != null){
               $this->update_photo($project_id);
          }

          if($this->input->post('photos[]') != null){
               foreach($this->input->post('photos[]') as $key => $photo){
                    if($this->input->post('cpt_pictures') != null){
                         $key += $this->input->post('cpt_pictures');
                    }
                    $this->update_galerie($project_id, $photo, $key);
               }
          }

          if($this->input->post('project_timeline_names[]') != null){

               $this->db->where('project_id', $project_id);
               $this->db->delete('project_timelines');

               $timeline_names = $this->input->post('project_timeline_names[]');
               $timeline_months = $this->input->post('project_timeline_months[]');
               $timeline_years = $this->input->post('project_timeline_years[]');

               foreach($timeline_names as $k => $timeline){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_timeline_name'] = $timeline_names[$k];
                    $data['project_timeline_month'] = $timeline_months[$k];
                    $data['project_timeline_year'] = $timeline_years[$k];

                    $data['project_timeline_added_by'] = $this->__user_id;
                    $data['project_timeline_added'] = time();
                    $data['project_timeline_modified'] = time();
                    $data['project_timeline_locked'] = 0;
                    $this->db->insert('project_timelines', $data);
               }
          }

          if($this->input->post('project_schedule_names[]') != null){

               $this->db->where('project_id', $project_id);
               $this->db->delete('project_schedules');

               $schedule_names = $this->input->post('project_schedule_names[]');
               $schedule_values = $this->input->post('project_schedule_values[]');

               foreach($schedule_names as $kk => $schedule){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_schedule_name'] = $schedule_names[$kk];
                    $data['project_schedule_value'] = $schedule_values[$kk];

                    $data['project_schedule_added_by'] = $this->__user_id;
                    $data['project_schedule_added'] = time();
                    $data['project_schedule_modified'] = time();
                    $data['project_schedule_locked'] = 0;
                    $this->db->insert('project_schedules', $data);
               }
          }

          if($this->input->post('project_charac_names[]') != null){

               $this->db->where('project_id', $project_id);
               $this->db->delete('project_characteristics');

               $characteristic_names = $this->input->post('project_charac_names[]');
               $characteristic_values = $this->input->post('project_charac_values[]');

               foreach($characteristic_names as $kk => $characteristic){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_characteristic_code'] = $characteristic_names[$kk];
                    $data['project_characteristic_value'] = $characteristic_values[$kk];

                    $this->db->insert('project_characteristics', $data);
               }
          }

          if($this->input->post('project_neighbor_structures[]') != null){

               $this->db->where('project_id', $project_id);
               $this->db->delete('project_neighborhoods');

               $neighborhood_names = $this->input->post('project_neighbor_structures[]');
               $neighborhood_values = $this->input->post('project_neighbor_distances[]');

               foreach($neighborhood_names as $kk => $neighborhood){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['project_neighborhood_structure'] = $neighborhood_names[$kk];
                    $data['project_neighborhood_distance'] = $neighborhood_values[$kk];

                    $this->db->insert('project_neighborhoods', $data);
               }
          }

          if($this->input->post('convenience_ids[]') != null){

               $this->db->where('project_id', $project_id);
               $this->db->delete('project_conveniences');

               $convenience_ids = $this->input->post('convenience_ids[]');

               foreach($convenience_ids as $kk => $convenience_id){
                    $data = array();
                    $data['project_id'] = $project_id;
                    $data['convenience_id'] = $convenience_ids[$kk];

                    $this->db->insert('project_conveniences', $data);
               }
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update_info_picture($args = array())
     {
          $this->db->trans_start();

          $project_info_id = $this->input->post('project_info_id');

          if(!empty($_FILES['capture']['name'])){
               $this->update_info_galerie($project_info_id, $this->input->post('capture'));
          }

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function update_info($args = array())
     {
          $this->db->trans_start();

          $project_info_id = $this->input->post('project_info_id');
          $data = IBEMS_Model::sanitize_for('project_infos');
          $data['project_info_modified'] = time();
          $this->db->where('project_info_id', $project_info_id);
          $this->db->update('project_infos', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Locker project -----------------------------------------------------------

     public function timeline_locker($args = array())
     {
          $this->db->trans_start();

          $project_timeline_id = $this->input->post('project_timeline_id');
          $project_timeline_locked = $this->input->post('project_timeline_locked');
          $data = IBEMS_Model::sanitize_for('project_timelines');
          $data['project_timeline_modified'] = time();
          $this->db->where('project_timeline_id', $project_timeline_id);
          $this->db->update('project_timelines', $data);

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Delete project -----------------------------------------------------------

     public function delete($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('project_id');

          $this->db->where('project_id', $id);
          $this->db->delete('project_pictures');

          $this->db->where('project_id', $id);
          $this->db->delete('project_timelines');

          $this->db->where('project_id', $id);
          $this->db->delete('project_schedules');

          $this->db->where('project_id', $id);
          $this->db->delete('projects');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_picture($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('project_picture_id');

          $this->db->where('project_picture_id', $id);
          $this->db->delete('project_pictures');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_info_picture($args = array())
     {
          $this->db->trans_start();
          $id = $this->input->post('project_info_picture_id');

          $this->db->select('*');
          $this->db->from('project_info_pictures');
          $this->db->where('project_info_pictures.project_info_picture_id', $id);
          $picture = $this->db->get()->row();

          unlink($picture->project_info_picture_link);

          $this->db->where('project_info_picture_id', $id);
          $this->db->delete('project_info_pictures');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_report($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('project_report_id');

          $this->db->select('*');
          $this->db->from('project_reports');
          $this->db->where('project_report_id',$id);
          $project_report = $this->db->get()->row();

          unlink($project_report->project_report_link);

          $this->db->where('project_report_id', $id);
          $this->db->delete('project_reports');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_info($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('project_info_id');

          $this->db->where('project_info_id', $id);
          $this->db->delete('project_info_pictures');

          $this->db->where('project_info_id', $id);
          $this->db->delete('project_infos');

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     public function delete_invest($args = array())
     {
          $this->db->trans_start();

          $id = $this->input->post('project_invest_id');

          $this->db->where('project_invest_id', $id);
          $this->db->delete('project_invests');

          // qry_debug();

          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
               return false;
          }
          return true;
     }

     // Get One project -----------------------------------------------------------

     public function get_one($id)
     {
          $this->db->select('*');
          $this->db->from('projects');
          $this->db->join('sim_states','sim_states.sim_state_id = projects.sim_state_id');
          $this->db->join('sim_towns','sim_towns.sim_town_id = projects.sim_town_id');
          $this->db->join('sim_types','sim_types.sim_type_id = projects.sim_type_id');
          $this->db->join('users','users.user_id = projects.project_added_by');
          $this->db->where('projects.project_id', $id);
          $project = $this->db->get()->row();

          $this->db->select('*');
          $this->db->from('project_pictures');
          $this->db->where('project_pictures.project_id', $id);
          $project->pictures = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_timelines');
          $this->db->where('project_timelines.project_id', $id);
          $project->timelines = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_schedules');
          $this->db->where('project_schedules.project_id', $id);
          $project->schedules = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_reports');
          $this->db->where('project_reports.project_id', $id);
          $this->db->order_by('project_report_id', 'desc');
          $project->reports = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_conveniences');
          $this->db->join('conveniences','conveniences.convenience_id = project_conveniences.convenience_id');
          $this->db->where('project_conveniences.project_id', $id);
          $project->conveniences = $this->db->get()->result();

          $project->conveniences_array = array();

          foreach ($project->conveniences as $key => $value) {
               array_push($project->conveniences_array, $value->convenience_id);
          }

          $this->db->select('*');
          $this->db->from('project_characteristics');
          $this->db->where('project_characteristics.project_id', $id);
          $project->characteristics = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_neighborhoods');
          $this->db->where('project_neighborhoods.project_id', $id);
          $project->neighborhoods = $this->db->get()->result();

          $this->db->select('*');
          $this->db->from('project_infos');
          $this->db->join('users','users.user_id = project_infos.project_info_added_by');
          $this->db->where('project_infos.project_id', $id);
          $this->db->order_by('project_info_id', 'desc');
          $project->infos = $this->db->get()->result();

          foreach ($project->infos as $key => $info) {
               $this->db->select('*');
               $this->db->from('project_info_pictures');
               $this->db->where('project_info_pictures.project_info_id', $info->project_info_id);
               $info->pictures = $this->db->get()->result();
          }

          $this->db->select('sim_param_value as yield');
          $this->db->from('sim_params');
          $this->db->where('sim_params.sim_type_id', $project->sim_type_id);
          $this->db->where('sim_params.sim_state_id', $project->sim_state_id);
          $this->db->where('sim_params.sim_town_id', $project->sim_town_id);
          $project->param = @$this->db->get()->row();

          $this->db->select('sim_state_rate');
          $this->db->from('sim_states');
          $this->db->where('sim_states.sim_state_id', $project->sim_state_id);
          $tmp = @$this->db->get()->row();
          if ($project->param != null) {
               $project->param->tx_emp = @$tmp->sim_state_rate;
          }

          return ($project);
     }

     public function get_one_info($id)
     {
          $this->db->select('*');
          $this->db->from('project_infos');
          $this->db->where('project_infos.project_info_id', $id);
          $project = $this->db->get()->row();

          return ($project);
     }


     // Get All project -----------------------------------------------------------

     public function get_all($args = null)
     {
          $this->db->select('*');
          $this->db->from('projects');
          $this->db->join('users','users.user_id = projects.project_added_by');
          $this->db->order_by('project_id', 'desc');
          $projects = $this->db->get()->result();

          foreach ($projects as $key => $project) {

               $id = $project->project_id;

               $this->db->select('*');
               $this->db->from('project_pictures');
               $this->db->where('project_pictures.project_id', $id);
               $project->pictures = $this->db->get()->result();

               $this->db->select('*');
               $this->db->from('project_timelines');
               $this->db->where('project_timelines.project_id', $id);
               $project->timelines = $this->db->get()->result();

               $this->db->select('*');
               $this->db->from('project_schedules');
               $this->db->where('project_schedules.project_id', $id);
               $project->schedules = $this->db->get()->result();
          }

          return ($projects);
     }

     public function get_locked($args = null)
     {
          $this->db->select('*');
          $this->db->from('projects');
          $this->db->where('project_locked !=', '0');
          $projects = $this->db->get()->result();

          return ($projects);
     }

     // Picture project -----------------------------------------------------------

     public function update_picture($id, $name, $key)
     {
          $path = $this->img_base_path_2.'galerie-'.$id;

          $upload = do_upload($name,array(
               'upload_path' =>$path,
               'allowed_types' => 'jpg|png|gif|jpeg',
               'file_name' =>'cover_'.$key,
          ));

          $args = array();
          if($upload['statut']=='success')
          {
               $data = array();
               $data['project_id'] = $id;
               $data['project_picture_link'] = $path.'/'.$upload['data']['file_name'];
               $data['project_picture_added_by'] = $this->__user_id;
               $data['project_picture_added'] = time();
               $data['project_picture_modified'] = time();
               $data['project_picture_locked'] = 0;
               $this->db->insert('project_pictures', $data);
          }
     }

     public function update_galerie($id, $photo, $key){
          $path = $this->img_base_path_2.'galerie-'.$id."/cover_".$key.".jpg";

          if(!file_exists($this->img_base_path_2.'galerie-'.$id)){
               mkdir($this->img_base_path_2.'galerie-'.$id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $photo;

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $data = array();
               $data['project_id'] = $id;
               $data['project_picture_link'] = $path;
               $data['project_picture_added_by'] = $this->__user_id;
               $data['project_picture_added'] = time();
               $data['project_picture_modified'] = time();
               $data['project_picture_locked'] = 0;
               $this->db->insert('project_pictures', $data);
          }
     }

     public function update_info_galerie($id, $photo){

          if(!empty($_FILES['capture']['name'])){
               $upload_path = $this->img_base_path_2.'info_galerie-'.$id."/";
               $upload_file = $upload_path.basename($_FILES['capture']['name']);

               if(!file_exists($upload_path)){
                    mkdir($upload_path, 0777, true);
               }

               $upload = move_uploaded_file($_FILES['capture']['tmp_name'], $upload_file);

               $args = array();
               if($upload){
                    // $args['capture'] = $upload_file;
                    //
                    // $this->db->where('studie_id', $studie_id);
                    // return $this->db->update('studies', $args);

                    $data = array();
                    $data['project_info_id'] = $id;
                    $data['project_info_picture_link'] = $upload_file;
                    $data['project_info_picture_added_by'] = $this->__user_id;
                    $data['project_info_picture_added'] = time();
                    $data['project_info_picture_modified'] = time();
                    $data['project_info_picture_locked'] = 0;
                    $this->db->insert('project_info_pictures', $data);
               }else{
                    return false;
               }
          }else{
               return false;
          }

          // $path = $this->img_base_path_2.'info_galerie-'.$id."/";
          //
          // $upload = do_upload('capture',array(
          //      'upload_path' =>$path,
          //      'allowed_types' => '*',
          //      ''
          // ));
          //
          // $args = array();
          //
          // if($upload['statut']=='success')
          // {
          //      $data = array();
          //      $data['project_info_id'] = $id;
          //      $data['project_info_picture_link'] = $path.$upload['data']['file_name'];
          //      $data['project_info_picture_added_by'] = $this->__user_id;
          //      $data['project_info_picture_added'] = time();
          //      $data['project_info_picture_modified'] = time();
          //      $data['project_info_picture_locked'] = 0;
          //      $this->db->insert('project_info_pictures', $data);
          // }else{
          //      return false;
          // }
          // $path = $this->img_base_path_2.'info_galerie-'.$id."/cover_".$key.".jpg";
          //
          // if(!file_exists($this->img_base_path_2.'info_galerie-'.$id)){
          //      mkdir($this->img_base_path_2.'info_galerie-'.$id, 0777, true);
          // }
          //
          // $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          // $base64_string = $photo;
          //
          // $data = explode( ',', $base64_string );
          //
          // fwrite( $ifp, base64_decode( $data[1] ) );
          //
          // $args = array();
          // if(fclose( $ifp ))
          // {
          //      $data = array();
          //      $data['project_info_id'] = $id;
          //      $data['project_info_picture_link'] = $path;
          //      $data['project_info_picture_added_by'] = $this->__user_id;
          //      $data['project_info_picture_added'] = time();
          //      $data['project_info_picture_modified'] = time();
          //      $data['project_info_picture_locked'] = 0;
          //      $this->db->insert('project_info_pictures', $data);
          // }
     }

     public function update_photo($id){
          $path = $this->img_base_path.'project-'.$id."/cover.jpg";

          if(!file_exists($this->img_base_path.'project-'.$id)){
               mkdir($this->img_base_path.'project-'.$id, 0777, true);
          }

          $ifp = fopen($path, 'w') or die('Cannot open file:  '.$path);
          $base64_string = $this->input->post('photo');

          $data = explode( ',', $base64_string );

          fwrite( $ifp, base64_decode( $data[1] ) );

          $args = array();
          if(fclose( $ifp ))
          {
               $args['project_picture'] = $path;
               $args['project_modified'] = time();

               $this->db->where('project_id', $id);
               $this->db->update('projects', $args);
          }
     }

     public function update_file($project_report_id, $project_report_name)
     {
          $path = $this->doc_base_path;

          $upload = do_upload('project_report_link',array(
               'upload_path' =>$path,
               'allowed_types' => 'pdf',
               'file_name' => $project_report_name.'_'.$project_report_id,
          ));

          $args = array();

          if($upload['statut']=='success')
          {
               $args['project_report_link'] = $path.$upload['data']['file_name'];

               $this->db->where('project_report_id', $project_report_id);
               return $this->db->update('project_reports', $args);
          }else{
               return false;
          }
     }

}
