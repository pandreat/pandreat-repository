  <?php
      $name_prefix = 'states['.$stateIndex.']';
      $pe_name_prefix = $name_prefix.'[physical_exam]';
      $state_jsonID = $this->state_id;
  ?>

<div id="<?php echo "state_".$state_jsonID; ?>" class="dataRow borderDiv one_state_div" data-endpoint="states" data-jsonID="<?php echo $state_jsonID; ?>" data-arrayIndex="<?php echo $stateIndex; ?>">

  <div class="stateWithoutActionsSection" data-jsonID="<?php echo $state_jsonID; ?>" data-arrayIndex="<?php echo $stateIndex; ?>">

    <div class="row">
      <div class="small-3 columns">
        <h3>State ID: <?php echo $this->state_id; ?> </h3>
      </div>
      <div class="small-3 columns end"><a href="#" data-state_id = "<?php echo $state_jsonID; ?>"class="deleteState">Delete this state</a>
      </div>
    </div>

    <div class="row">

      <input type="hidden" class="hiddenStateJsonID" name="<?php echo $name_prefix.'[id]'; ?>" value="<?php echo $this->state_id; ?>"/>
      <input type="hidden" class="hiddenDeleteTag" name="<?php echo $name_prefix.'[deleteTag]'; ?>" value=""/>

<!-- PHYSICAL EXAM INPUTS -->
<div class="row">
  <h4>Physical Examination</h4>
  <input type="hidden" class="hiddenPEJsonID" name="<?php echo $pe_name_prefix.'[id]'?>" value="<?php echo $this->pe_id; ?>"/>
</div>
    <!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Physical Exam General</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[general]';?>"><?php echo $this->pe_general;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>HEENT</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[heent]'; ?>"><?php echo $this->heent;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Neck</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[neck]';?>"><?php echo $this->neck;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Lungs</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[lungs]';?>"><?php echo $this->lungs;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Heart</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[heart]';?>"><?php echo $this->heart;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Abdomen</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[abdomen]';?>"><?php echo $this->abdomen;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Extremities</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[extremeties]';?>"><?php echo $this->extremeties;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-12 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Neuro</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[neurological]';?>"><?php echo $this->neurological;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>
<!-- text area box -->
<div class="row">
  <div class="large-10 columns">
    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='[add text]'>Other</span>
      </div>
      <div class="small-10 columns">
        <textarea class="textareaMCE" name="<?php echo $pe_name_prefix.'[other]'; ?>"><?php echo $this->pe_other;?></textarea>
      </div>
    </div>
  </div>
</div>
</br>



      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title="add text">Notes</span>
      </div>
      <div class="small-10 columns">
        <div class="MCEDivToRemove"><textarea class="textareaMCE actionNotes" name="<?php echo $name_prefix.'[notes]'; ?>"><?php echo $this->notes;?></textarea></div>
      </div>
    </div>
    </br>

    <div class="row">
      <div class="large-2 small-10 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='add text'>General</span>
      </div>
      <div class="small-10 columns">
        <div class="MCEDivToRemove"><textarea class="textareaMCE actionGeneral" name="<?php echo $name_prefix.'[general]'; ?>"><?php echo $this->general;?></textarea></div>
      </div>
    </div>
    </br>

    <div class="row">
      <div class="small-2 columns">
        <span>Temperature</span>
      </div>
      <div class="small-2 columns">
        <input class="actionTemp" name="<?php echo $name_prefix.'[temp_celcius]'; ?>"type="text" value='<?php echo $this->temp_celcius; ?>'/>
      </div>

      <div class="small-2 columns">
        <span>Respiration Rate</span>
      </div>
      <div class="small-2 columns">
        <input class="actionRespRate" name="<?php echo $name_prefix.'[resp_rate]'; ?>"type="text" value='<?php echo $this->resp_rate; ?>'/>
      </div>

      <div class="small-2 columns">
        <span>Heart Rate</span>
      </div>
      <div class="small-2 columns">
        <input class="actionHeartRate" name="<?php echo $name_prefix.'[heart_rate]'; ?>"type="text" value='<?php echo $this->heart_rate ;?>'/>
      </div>
    </div>

    <div class="row">
      <div class="small-2 columns">
        <span >BP Systolic</span>
      </div>
      <div class="small-2 columns">
        <input class="actionBPSys" name="<?php echo $name_prefix.'[bp_systolic]'; ?>"type="text" value='<?php echo $this->bp_systolic; ?>'/>
      </div>

      <div class="small-2 columns">
        <span >BP Diastolic</span>
      </div>
      <div class="small-2 columns">
        <input class="actionBPDia" name="<?php echo $name_prefix.'[bp_diastolic]'; ?>"type="text" value='<?php echo $this->bp_diastolic; ?>'/>
      </div>

      <div class="small-2 columns">
        <span >SpO2</span>
      </div>
      <div class="small-2 columns">
        <input class="actionSpO2" name="<?php echo $name_prefix.'[spo2]'; ?>"type="text" value='<?php echo $this->spo2; ?>'/>
      </div>
    </div>

    <div class="row">
      <div class="small-2 columns">
        <span >Weight</span>
      </div>
      <div class="small-2 columns">
        <input class="actionWeight" name="<?php echo $name_prefix.'[weight]'; ?>"type="text" value='<?php echo $this->weight; ?>'/>
      </div>

      <div class="small-2 columns">
        <span>Pain Score</span>
      </div>
      <div class="small-2 columns">
        <input class="actionPainScore" name="<?php echo $name_prefix.'[pain_score]'; ?>" type="text" value="<?php echo $this->pain_score; ?>"/>
      </div>

      <div class="small-2 columns">
        <span>Other</span>
      </div>

      <div class="small-2 columns">
        <input class="actionOther"name="<?php echo $name_prefix.'[other]'; ?>" type="text" value="<?php echo $this->other; ?>"/>
      </div>
    </div>

    <div class="row">
      <div class="large-12 columns">
        <div class="row">
          <div class="large-2 small-10 columns">
            <span data-tooltip class="has-tip [tip-bottom]" title='add text'>Discussion Items</span>
          </div>
          <div class="small-10 columns">
            <div class="MCEDivToRemove">
              <textarea class="textareaMCE actionDiscussionItems" name="<?php echo $name_prefix.'[discussion_items]'; ?>"><?php echo $this->discussion_items;?>
              </textarea>
            </br></br>
            </div>
          </div>
        </div>
      </div>
    </div>
          <div class="small-4 columns">
           </br></br>
        <h4 style="color:purple">Actions</h4>
      </div>
  </div> <!--end of StatesWithoutActionsSection -->


  <div id="<?php echo "section_state_".$state_jsonID."_actions_div"?>" class="actions_section_class row" data-stateIndex = "<?php echo $stateIndex; ?>" data-statejsonID ="<?php echo $state_jsonID; ?>" >

      <!-- Actions Section for Given State -->


    <div id="<?php echo "ActionsForState_".$state_jsonID; ?>" class="divWithStateActions multiInputDiv row">



      <?php foreach($this->actions as $actionIndex=>$action) {
        $action->renderaction($actionIndex, $stateIndex, $state_jsonID);
      } ?>
    </div> <!--multiInputDiv-->

    <div class="DivWithAddActionButton row">
      <div class="small-4 small-offset-8 columns">
      </br></br>
        <button id="<?php echo "addActionButtonState_".$state_jsonID ?>" type="button" class="buttonClassToAddAction small success button expand" data-statejsonID="<?php echo $state_jsonID; ?>"  data-stateIndex = "<?php echo $stateIndex; ?>">Add Action
        </button>
      </div>
    </div>


  </div> <!-- End of Actions Section for Given State -->

</div> <!-- End of State -->




