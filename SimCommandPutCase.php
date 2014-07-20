<!doctype html>
<?php

include('SimCommandConstants.php');
$case = $_POST;

$case_id = $_POST["id"];

$states = $_POST['states'];

$assessment_items = $_POST['assessment_items'];

//REMOVE nested objects from case
unset($case['states']);
unset($case['assessment_items']);

// cleanup empty data for categories
remove_empty_strings($case, 'categories');
remove_empty_strings($case, 'participants');

$jsoncase = json_encode($case);


//IF AN ID IS ASSIGNED TO AN ELEMENT, A PUT REQUEST IS SENT.  IF THERE IS NO ID, THEN THE ELEMENT IS NEW, AND A POST REQUEST IS SENT.

//PUT STATES

foreach($states as $state){

  unset($state['actions']);
  unset($state['physical_exam']);

  $state['case_id'] = $case_id;
    //if this involves an existing element, need to PUT or DELETE
  if (!empty($state['id']))
  {
    $state_id = $state['id'];
    $url = "$urlroot/states/$state_id";
   // unset($state['id']);

       //if has deleteTag = deleted, need to send DELETE request, otherwise move deleteTag and send PUT request.
    if($state['deleteTag'] == "deleted"){
//      print_r('start delete');
//      print_r($url);
     $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
      curl_exec($ch);
      curl_close($ch);
    } else {
        unset($state["deleteTag"]);
        $jsonstate = json_encode($state);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonstate);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
        $putStateResponseJson = curl_exec($ch);
        $putStateResponse = json_decode($putStateResponseJson, true);
        curl_close($ch);
    }

  }
  //if this is a new element, need to POST
  else
  {
    $url = "$urlroot/states";
    $jsonstate = json_encode($state);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonstate);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
    $putStateResponseJson = curl_exec($ch);
    $putStateResponse = json_decode($putStateResponseJson, true);
    $states[$state_counter]['id'] = '' . $putStateResponse['body']['id'];
    curl_close($ch);
   }
$state_counter++;
}

//PUT ASSESSMENTS

foreach($assessment_items as $assessment){

  $assessment['is_critical_item'] = filter_var($assessment['is_critical_item'], FILTER_VALIDATE_BOOLEAN);
  $assessment['case_id'] = $case_id;

  if (!empty($assessment['id'])){
    $assessment_id = $assessment['id'];
    $url = "$urlroot/assessmentitems/$assessment_id";
    unset($assessment['id']);
    $jsonassessment = json_encode($assessment);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonassessment);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
    $putAsmtResponseJson = curl_exec($ch);
    $putAsmtResponse = json_decode($putAsmtResponseJson, true);
    curl_close($ch);
  } else {
      $url = "$urlroot/assessmentitems";
      $jsonassessment = json_encode($assessment);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonassessment);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
      $putAsmtResponseJson = curl_exec($ch);
      $putAsmtResponse = json_decode($putAsmtResponseJson, true);
      curl_close($ch);
    }
}



// PUT CASE EDITS

$putCaseUrl = "$urlroot/cases/$case_id";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $putCaseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsoncase);
curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
$putCaseResponseJson = curl_exec($ch);
$putCaseResponse = json_decode($putCaseResponseJson, true);
curl_close($ch);



// PUT PHYSICAL EXAM EDITS
foreach($states as $state){
  $physical_exam = $state['physical_exam'];
  $physical_exam['state_id'] = $state['id'];

  if (!empty($physical_exam['id'])) {
      $pe_id = $physical_exam['id'];
      $url = "$urlroot/physicalexams/$pe_id";
      unset($physical_exam['id']);
      $jsonphysical_exam = json_encode($physical_exam);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonphysical_exam);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
      $putPhysResponseJson = curl_exec($ch);
      $putPhysResponse = json_decode($putPhysResponseJson, true);
      curl_close($ch);

  } else {
      $url = "$urlroot/physicalexams";
      $jsonphysical_exam = json_encode($physical_exam);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonphysical_exam);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
      $putPhysResponseJson = curl_exec($ch);
      $putPhysResponse = json_decode($putPhysResponseJson, true);
      curl_close($ch);

  }
}


//PUT ACTIONS
foreach($states as $state)
{
  $state_id = $state['id'];
  $actions = $state['actions'];
  foreach($actions as $action)
  {
    $action['state_id'] = $state_id;
    $action['is_critical_item'] = filter_var($action['is_critical_item'], FILTER_VALIDATE_BOOLEAN);
    $action['is_timeable'] = filter_var($action['is_timeable'], FILTER_VALIDATE_BOOLEAN);

    //if this involves an existing element, need to PUT or DELETE
    if (!empty($action['id']))
    {
      $action_id = $action['id'];
      $url = "$urlroot/actions/$action_id";
      unset($action['id']);

       //if has deleteTag = deleted, need to send DELETE request, otherwise move deleteTag and send PUT request.
      if($action['deleteTag'] == "deleted"){
        unset($action["deleteTag"]);
       $jsonaction = json_encode($action);
       $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
        curl_exec($ch);
        curl_close($ch);
      } else {
        unset($action["deleteTag"]);
        $jsonaction = json_encode($action);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonaction);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
        $putActionResponseJson = curl_exec($ch);
        $putActionResponse = json_decode($putActionResponseJson, true);
        curl_close($ch);
      }
//if this is a new element, need to POST
    } else
    {
      $url = "$urlroot/actions";
      $jsonaction = json_encode($action);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);
      curl_setopt($ch, CURLOPT_POST, TRUE);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonaction);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
      $putActionResponseJson = curl_exec($ch);
      $putActionResponse = json_decode($putActionResponseJson, true);
      curl_close($ch);
    }
  }
}




function remove_empty_strings(&$case, $key) {

 $elements = $case[$key];
 $cleanElements = array();
 foreach($elements as $string) {
   if ($string != '') {
    $cleanElements[] = $string;
   }
 }
 $case[$key] = $cleanElements;
}


?>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <link rel="stylesheet" href="foundationSimCommand.css" />
    <script src="modernizrSimCommand.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="simCommand.js"></script>
    <script src="http://cdn.foundation5.zurb.com/foundation.js"></script>
  </head>

  <body>
    <div class="row">
      <div class="small-12 columns">
        <div class="sticky">
          <nav class="top-bar" data-topbar>
            <ul class="title-area">
              <li class="name">
                <h1><a class="alwaysShow" href="#">Success! <!-- SimCommand HTTP Response: PUT Case --></a></h1>
              </li>
            </ul>
          </nav>

        </div>
      </div>
    </div>

<!--
    <div class="row responsebox">
      <h3>Response to PUT request</h3>

      <p>Case: <?php print_r($putCaseResponse['result']); ?></p>
      <p>Assessments: <?php print_r($putAsmtResponse['result']); ?></p>
      <p>States: <?php print_r($putStateResponse['result']); ?></p>
      <p>Actions: <?php print_r($putActionResponse['result']); ?></p>
      <p>Physical Exam: <?php print_r($putPhysResponse['result']); ?></p>
    </div>
-->
    <div class="row">
      <a class="alwaysShow button tiny" href="SimCommandGetAllCases.php">Back to All Cases</a>
      <a class="alwaysShow button tiny" href="SimCommandNewCaseForm.php">Create New Case</a>
      <a class="alwaysShow button tiny" href="SimCommandEditOneCaseForm.php?case_id=<?php echo $case_id; ?>">Continue to Edit this Case</a>

    </div>

  </body>
</html>
