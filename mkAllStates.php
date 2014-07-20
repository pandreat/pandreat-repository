

<!-- mkAllStates -->
<div class="states_section row">
  <div class="small-12 columns hiddenDiv end">
    <button id="buttonToAddState" type="button" class="small success button expand" data-nameprefix='states' data-newRowDiv ='addStates_Div'>Add State</button>
  </div>
</div>
</br>

<div class="allStatesDiv multiInputDiv">


<?php foreach($this->statesArray as $stateIndex=>$state) {
  //$stateIndex should be defined one-level up
  $state->renderstate($stateIndex);
  // echo "</br>";
} ?>

</div> <!--multiInputDiv-->
<!-- Beginning of hidden single action -->

  <div class="templateForOneActionDiv hiddenDiv">
    <div id="" class="one_action_div newelement borderDiv dataRow row" data-endpoint="actions" class="" data-arrayIndex ="0" data-statejsonID = "" data-actionjsonID="">



      <div class="small-12 columns">
        <span class="actionTitle" >Name</span>
        <input class="actionName" name="[placeholder][name]" type="text" value="" />
      </div>

      </br>

      <div class="row">
        <div class="actionTextArea small-12 columns">
          <span>Results</span>
          <div class="MCEDivToRemove"><textarea class="textareaMCE actionResult" name="[placeholder][results]"></textarea>
          </div>
        </div>
      </div>

      </br>

      <div class="row">
        <div class="small-1 columns">
          <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->critical_item_tooltip;?>">Critical Item?</span>
        </div>

        <div class="small-3 columns">
          <input type="radio"  id="IDholder-ct" name="[placeholder][is_critical_item]" value="true" /><label for="IDholder-ct">Yes</label>
          <input type="radio" checked id="IDholder-cf"  name= "[placeholder][is_critical_item]" value="false" /><label for="IDholder-cf">No</label>
        </div>



        <div class="small-1 columns">
          <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->timer_tooltip;?>"><?php echo $this->timer_label;?></span>
        </div>

        <div class="small-2 columns">
          <input type="radio" id="IDholder-tt" name="[placeholder][is_timeable]" value="true" /><label for="IDholder-tt">Yes</label>
          <input type="radio" checked id="IDholder-tf"  name= "[placeholder][is_timeable]"  value="false" /><label for="IDholder-tf">No</label>
        </div>

        <div class="small-1 columns" ><a href="#"  class="deleteAction" >Delete this action</a>
        </div>
      </div>

    </div>
  </div>

<!-- End of hidden single action -->
</br>
<div class="row">
  <input id="footerAddStateButton" type="button" class="small success button expand" value="Add State"/>
</div>

  <!-- COMMENT BELOW TO REMOVE SAVE BUTTON FROM STATE TAB, AND UNCOMMENT MKHEADERCONTENT.PHP AND MKHEADERCONTENTEDITFORM.PHP TO SHOW AT BOTTOM OF EACH TAB -->
<!--
<div class="row">
  <input type="submit" class="large primary button expand" value="Save this Case">

</div>
-->
