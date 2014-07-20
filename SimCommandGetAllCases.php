
<?php
include_once('SimCommandTemplates.php');
include_once('SimCommandConstants.php');


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$urlroot/cases");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaderArray);
$httpresponse = curl_exec($ch);
curl_close($ch);


$json = json_decode($httpresponse, true);
$response=$json["body"];

//Iterate through each key:value pair in the json response object.  Iterate to grab the corresponding template object from the form, and add case-specific data in that template object's attributes.  So, these attributes will be associated with the template object when it is rendered.

  $caseArray = [];
  $caseArray[] = $allCasesHeader;

  foreach($response as $caseIndex=>$case) {
    // create a new assessment, and then add to assessment array
    $oneCase = new Template('mkShowAllCases.php', array(

      'caseID'=>$case['id'],
      'number'=>$case['number'],
      'title'=>$case['title'],
      'authors'=>$case['authors'],
      'institutions'=>$case['institutions'],
      'instructionalGoals'=>$case['instructional_goals'],
      'categories'=>$case['categories'],
      'published'=>$case['published_date'],
      'overview'=>$case['overview']
    ));
    $caseArray[] = $oneCase;
  };

  $caseArray[] = $allCasesClosing;


// Finally, render case summary.
render_allcases($caseArray);




?>