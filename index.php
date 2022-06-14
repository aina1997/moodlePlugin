<?php


require_once(__DIR__ . '/../../config.php');
require_once('./forms.php');



global $USER;
$userId = $USER->id;
$username = $USER->username;

$PAGE->set_url(new moodle_url('/local/helloworld/index.php'));

require_login();
$isGest =  isguestuser();
if($isGest){ print_error('noguest');}

$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'local_helloworld'));
$PAGE->set_heading(get_string('pluginname', 'local_helloworld', $username));
$PAGE->set_pagelayout('standard');

$context = context_system::instance();

// DB info
$table = 'local_helloworld_messages';
$userfields = get_all_user_name_fields(true, 'u');
$sql = "SELECT m.id, m.message, m.timecreated, u.id AS userid, $userfields
          FROM {local_helloworld_messages} m
     LEFT JOIN {user} u ON u.id = m.userid
      ORDER BY timecreated DESC";

echo $OUTPUT->header();


if(has_capability('local/helloworld:postmessages', $context)){
    $mform = new textArea();
    if ($fromform = $mform->get_data()) {
        //In this case you process validated data. $mform->get_data() returns data posted in form.
          require_sesskey();
          $now = time();
          $dataobject = (object) array('message' => $fromform->text, 'timecreated' => $now, 'userid' => $userId);
          require_capability('local/helloworld:postmessages', $context, $userid = $USER->id);
          $DB->insert_record($table, $dataobject, $returnid=true, $bulk=false);
          $mform ->reset(); 
          $mform->display();
      
    } else {
        $mform->display();
    }
}

if (has_capability('local/helloworld:readmessages', $context)) {
    
    $data = $DB->get_records_sql($sql);

    echo '<div class="card-columns">';

    foreach ($data as $key=>$value) {
        $msg = $value->message;
        $secs = $value->timecreated - time();
        $time = format_time($secs,$str=null);
        $userIdMsg = $value->userid;
        $userMsg = $DB->get_record('user', ['id' => $userIdMsg]);
        $nameUser = ($userIdMsg == 0) ? "Anonym" : fullname($userMsg, true);
        $id = $value->id;
        $action = new moodle_url('/local/helloworld/index.php', ['delete' => $id, 'sesskey' => sesskey()]);

        echo '<div class="card">';

        
        if (has_capability('local/helloworld:deleteanymessage', $context) || $USER->id == $userIdMsg) {
            $dform = new delete();
            echo '<div class="card-header text-right">';
            if ($fromform = $dform->get_data()) {
                require_sesskey();
                $data = $DB->get_records_sql($sql);
                $msgs = array_filter($data, fn($msg) => $msg->id == $id);
                $msg = reset($msgs);
                if($msg->id != $id){
                    require_capability('local/helloworld:deleteanymessage', $context, $userid = $USER->id);
                }
                $DB->delete_records($table, array('id'=>$id));
                $dform ->reset(); 
                $dform->display();

            } else {
                $param = new stdClass();
                $param->id = $id;
                $dform->set_data($param);
                $dform->display();
            }
            echo '</div>';
    
    }
        // echo '<button class="btn btn-secondary" name="delete" value="'.$id, $userIdMsg.'">Delete</button>';

        echo '<div class="card-body">
        <p class="card-text">'.$msg.'</p>
        <p class="card-text"><small class="text-muted">'.$time.'</small>
        <br><small class="text-muted">'.$nameUser.'</small></p>
        </div>
        ';

        echo '</div>';
    }
    echo '</div>';
}



// NEW FORMS 



echo $OUTPUT->footer();



