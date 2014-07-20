
<!-- ASSESSMENTS START HERE -->
<div id="section_Assessments" class="row">
  <div class="small-3 columns hiddenDiv">
    <button id="buttonToAddAssessment" type="button" class="small success button expand">Add Assessment</button>
  </div></br>
  <div class="assessmentsDiv multiInputDiv small-12 columns">
    <?php foreach($this->assessmentsArray as $assessmentIndex=>$assessment) {
      $assessment->renderAssessment($assessmentIndex);
    } ?>
  </div>
</div>

<div class="row">
<div class="small-3 columns">
  <input id="footerAssessmentButton" type="button" class="small success button expand" value="Add Assessment"/>
</div>
</div>

<!-- ASSESSMENTS END HERE -->