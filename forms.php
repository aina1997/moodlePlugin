<?php

require_once("$CFG->libdir/formslib.php");

class textArea extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
       
        $mform = $this->_form; // Don't forget the underscore! 
        $mform->addElement('textarea', 'text', get_string("placeholderText", 
        "local_helloworld"), array('wrap="virtual" rows="4" cols="100"', 'placeholder' => get_string("placeholderText", 
        "local_helloworld")));
        $mform->settype('text', PARAM_TEXT);

        // $mform->addElement('hidden', 'returnurl', $this->_customdata['returnurl']);
        // $mform->setType('returnurl', PARAM_URL);

        $this->add_action_buttons(false, get_string('submit'));

    }
    //Custom validation should be added here
    function validation($data, $files) {
        $errors= array();
        if (empty($data['text'])) {
            $errors['text'] = get_string('textRequired', 'local_helloworld');
        }
        return $errors;
    }

    public function reset() {
        redirect(new moodle_url('/local/helloworld'));
    }
}

class delete extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore! 
        $mform->addElement('hidden', 'id', 'yes');
        $mform->settype('id', PARAM_INT);
        $this->add_action_buttons(false, get_string('delete'));

    }
    //Custom validation should be added here
    function validation($data, $files) {
        $errors= array();
        return $errors;
    }

    public function reset() {
        redirect(new moodle_url('/local/helloworld'));
    }
}