
<?php
include_once('SimCommandTemplates.php');
include_once('SimCommandConstants.php');

if(isset($_GET["case_id"])){
  $specificCaseID = $_GET["case_id"];
}

$url = "$urlroot/cases/$specificCaseID";
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
$httpresponse = curl_exec($ch);
curl_close($ch);


$json = json_decode($httpresponse, true);
$case=$json["body"];




// //Iterate through each key:value pair in the json response object for a particular case ID.  All keys should exist in the form, but I use an if statement to be safe.  Iterate to grab the corresponding template object from the form, and add case-specific data in that template object's attributes.  So, these attributes will be associated with the template object when it is rendered.


//CREATE FORM ARRAY

$form = array();
$form['header'] = $editCaseHeader;
$editCaseHeader->caseID = $specificCaseID;

//CASE INFO TAB
$form['startTab'] = $caseInfoTab;
$form['title'] = $title;
$form['id']=$caseID;
$form['number'] = $caseNumber;
$form['published_date']=$publishedDate;
$form['categories'] = $library_categories;
$form['addCategory']= $addAnotherCategory;
$form['overview'] = $overview;
$form['participants'] = $participants;
$form['addParticipant']=$addAnotherParticipant;
$form['institutions'] = $institutions;
$form['authors'] = $authors;
$form['resources'] = $resources;
$form['action_scale']=$actionScale;
$form['global_rating_scale'] = $globalRatingScale;
$form['assessment_item_scale'] = $assessmentItemScale;

//INSTRUCTIONAL FOUNDATION TAB
$form['instTab'] = $instructionalTab;
$form['instructional_goals'] = $instGoals;
$form['obj1_medical_knowledge'] = $obj1;
$form['obj2_patient_care'] = $obj2;
$form['obj3_safety_risk_management'] = $obj3;
$form['obj4_interpersonal'] = $obj4;
$form['obj5_professionalism'] = $obj5;
$form['obj6_systems_based_practice'] = $obj6;
$form['study_questions'] = $studyQs;
$form['briefing'] = $briefing;
$form['debriefing'] = $debriefing;

//ASSESSMENT TAB
$form['assessmentTab'] = $assessmentTab;
$form['assessment_items'] = $allAssessments;

// PREPARATION TAB
$form['prepTab'] = $preparationTab;
$form['simulators'] = $simulators;
$form['simulator_programs'] = $simulatorPrograms;
$form['medical_equipment'] = $medEqmt;
$form['medications'] = $medications;
$form['moulage'] = $moulage;
$form['supplies'] = $supplies;
$form ['actionsTab'] = $expectedActionsTab;

//CASE DETAILS TAB
$form['caseDetailsTab'] = $caseDetailsTab;
$form['background']=$background;
$form['gender']=$gender;
$form['age']=$age;
$form['states'] = $allStates;
$form['end tab'] = $endTabs;
$form['closing'] = $closing;


//Iterate through each key:value pair in the json response object for a particular case ID.  Iterate to grab the corresponding template object from the form, and add case-specific data in that template object's attributes.  So, these attributes will be associated with the template object when it is rendered.

foreach($case as $jkey => $jvalue) {

  if (array_key_exists($jkey, $form)) {
    $spec_form_template = $form[$jkey];

    switch ($spec_form_template->type) {
      case "checkbox":
        foreach($jvalue as $isacheckedvalue) {
          $spec_form_template->addselected($isacheckedvalue, 'checked');
        };
      break;

      case "textarray":
        $spec_form_template->addtextarray($jvalue);
      break;
        // need to check that only one value specified for the parameters below

      case "singletext":
        $spec_form_template->addsingletext($jvalue);
      break;
      case "dropdown":
        $spec_form_template->addselected($jvalue, 'selected');
      break;


      case "allStates":
        $statesArray = [];
        //$jvalue is an array of states, so loop through all states in json response
        foreach($jvalue as $stateIndex=>$state) {
          $actions = array();
          //loop though actions and add to the state's "actions" array
          foreach($state['actions'] as $actionIndex=>$action) {
            $actions[] = new Template('mkOneAction.php', array(
              'action_id'=>$action['id'],
              'is_critical_item'=>$action['is_critical_item'],
              'is_timeable'=>$action['is_timeable'],
              'name'=>$action['name'],
              'results'=>$action['results'],
              'critical_item_label'=>'Critical Item?',
              'critical_item_tooltip'=>'',
              'critical_item_values'=>array('True'=>'','False'=>''),
              'timer_tooltip'=>'',
              'timer_label'=>'Include Timer?',
              'timer_values'=>array('True'=>'','False'=>'')
            ));
          }
          //create state object
          $oneState = new Template('mkOneStateObject.php', array(
            'state_id'=>$state['id'],
            'notes'=>$state['notes'],
            'general'=>$state['general'],
            'temp_celcius'=>$state['temp_celcius'],
            'resp_rate'=>$state['resp_rate'],
            'heart_rate'=>$state['heart_rate'],
            'bp_systolic'=>$state['bp_systolic'],
            'bp_diastolic'=>$state['bp_diastolic'],
            'spo2'=>$state['spo2'],
            'weight'=>$state['weight'],
            'pain_score'=>$state['pain_score'],
            'other'=>$state['other'],
            'discussion_items'=>$state['discussion_items'],
            'type'=>'oneState',
            'actions'=>$actions,
            'pe_id'=>$state['physical_exam']['id'],
            'pe_general'=>$state['physical_exam']['general'],
            'heent'=>$state['physical_exam']['heent'],
            'neck'=>$state['physical_exam']['neck'],
            'lungs' =>$state['physical_exam']['lungs'],
            'heart'=>$state['physical_exam']['heart'],
            'abdomen'=>$state['physical_exam']['abdomen'],
            'extremeties'=>$state['physical_exam']['extremeties'],
            'neurological'=>$state['physical_exam']['neurological'],
            'pe_other'=>$state['physical_exam']['other']
          ));

          //add states to array of states
          $statesArray[] = $oneState;
        }

        //update the form's $allStates 'statesArray' array

        $allStates = new Template('mkAllStates.php', array('type'=>'allStates','statesArray'=>$statesArray,'is_critical_item'=>'','critical_item_label'=>'','critical_item_tooltip'=>'','critical_item_values'=>array('True'=>'','False'=>''),'timer_tooltip'=>'','timer_label'=>'Include Timer?','timer_values'=>array('True'=>'','False'=>'')));
        $form['states'] = $allStates;
      break;

      case "allAssessments":
      $assessmentsArray = [];
        foreach($jvalue as $assessmentIndex=>$assessment) {
          // create a new assessment, and then add to assessment array
          $newAssessment = new Template('mkOneAssessmentObject.php', array(
            'assessment_id'=>$assessment['id'],
            'name'=>$assessment['name'],
            'is_critical_item'=>$assessment['is_critical_item'],
            'state'=>$assessment['state'],
            'type'=>'oneAssessment',
            'name_tooltip'=>'',
            'scale_tooltip'=>'',
            'scale_label'=>'Scale',
            'namePrefix'=>'assessment_items',
            'critical_tooltip'=>'',
            'critical_label'=>'Critical Item?',
            'label'=>'Scale',
            'values'=> array('2'=>'', '3'=>'', '4'=>'', '5'=>'', '6'=>''),
            'critical_values'=> array('True'=>'','False'=>'')
          ));
          $newAssessment->addselected($assessment['scale'], 'selected');
          $assessmentsArray[] = $newAssessment;
        };

      $allAssessments = new Template('mkAllAssessments.php', array('type'=>'allAssessments','assessmentsArray'=>$assessmentsArray));
      $form['assessment_items'] = $allAssessments;
      break;
    }
  }
};

// Finally, render form with case-specific data pre-loaded in fields.
render_formarray($form);

?>
