<!-- Beginning of single action -->
  <?php
      $name_prefix = 'states['.$stateIndex.'][actions]['.$actionIndex.']';
      $id_prefix = 'radio'.$state_jsonID.'action'.$actionIndex.'-';
  ?>

<!-- <div id="<#?php echo "state_".$state_jsonID."_action_".$this->id; ?>" class="one_action_div borderDiv dataRow row" class="<#?php echo "rowForState_".$state_jsonID;?>" data-arrayIndex ="<#?php echo $actionIndex; ?>" data-statejsonID = "<#?php echo $state_jsonID; ?>" data-actionjsonID="<#?php echo $this->id; ?>"> -->

  <div class="one_action_div borderDiv newelement dataRow row" class="<?php echo "rowForState_".$state_jsonID;?>" data-arrayIndex ="<?php echo $actionIndex; ?>" data-endpoint="actions" data-statejsonID = "<?php echo $state_jsonID; ?>" data-actionjsonID="99999">

    <input type="hidden" class="hiddenDeleteTag" name="<?php echo $name_prefix.'[deleteTag]'; ?>" value=""/>
    <div class="small-12 columns">
      <!-- <span class="actionTitle" style="color:purple">State ID: <#?php echo $state_jsonID; ?> Action <#?php echo $this->id; ?></span> -->
        <span>Name</span><input class="actionName" name="<?php echo $name_prefix.'[name]'; ?>" type="text" value="<?php echo $this->name ?>" />
    </div>
    </br>

    <div class="row">
      <div class="actionTextArea small-12 columns">
        <span>Results</span>
        <div class="MCEDivToRemove"><textarea class="textareaMCE actionResult" name="<?php echo $name_prefix.'[results]'; ?>"><?php echo $this->results;?></textarea>
        </div>
      </div>
    </div>
    </br>

    <div class="row">

      <div class="small-1 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->critical_item_tooltip;?>"><?php echo $this->critical_item_label;?></span>
      </div>

      <?php if ($this->is_critical_item  =="true") { ?>
      <div class="small-3 columns">
        <input type="radio" checked id="<?php echo $id_prefix.'ct'; ?>" name="<?php echo $name_prefix.'[is_critical_item]'; ?>" value="true" /><label for="<?php echo $id_prefix.'ct'; ?>">Yes</label>
        <input type="radio" id="<?php echo $id_prefix.'cf'; ?>"  name= "<?php echo $name_prefix.'[is_critical_item]'; ?>" value="false" /><label for="<?php echo $id_prefix.'cf'; ?>">No</label>
      </div>
      <?php } else { ?>
      <div class="small-3 columns">
        <input type="radio"  id="<?php echo $id_prefix.'ct'; ?>" name="<?php echo $name_prefix.'[is_critical_item]'; ?>" value="true" /><label for="<?php echo $id_prefix.'ct'; ?>">Yes</label>
        <input type="radio" id="<?php echo $id_prefix.'cf'; ?>" checked name= "<?php echo $name_prefix.'[is_critical_item]'; ?>" value="false" /><label for="<?php echo $id_prefix.'cf'; ?>">No</label>
      </div>
      <?php } ?>


      <div class="small-1 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->timer_tooltip;?>"><?php echo $this->timer_label;?></span>
      </div>

       <!-- Display radio buttons based on is_timeable value -->
    <?php if ($this->is_timeable =="true") { ?>
      <div class="small-2 columns">
        <input type="radio" checked id="<?php echo $id_prefix.'tt'; ?>" name="<?php echo $name_prefix.'[is_timeable]'; ?>" value="true" /><label for="<?php echo $id_prefix.'tt'; ?>">Yes</label>
        <input type="radio" id="<?php echo $id_prefix.'tf'; ?>"  name= "<?php echo $name_prefix.'[is_timeable]'; ?>" value="false" /><label for="<?php echo $id_prefix.'tf'; ?>">No</label>
      </div>
      <?php } else { ?>
      <div class="small-2 columns">
        <input type="radio"  id="<?php echo $id_prefix.'tt'; ?>" name="<?php echo $name_prefix.'[is_timeable]'; ?>" value="true" /><label for="<?php echo $id_prefix.'tt'; ?>">Yes</label>
        <input type="radio" id="<?php echo $id_prefix.'tf'; ?>" checked name= "<?php echo $name_prefix.'[is_timeable]'; ?>" value="false" /><label for="<?php echo $id_prefix.'tf'; ?>">No</label>
      </div>
      <?php } ?>

      <div class="small-1 columns" ><a href="#"  class="deleteAction" >Delete this action</a>
      </div>
    </div>


</div>
<!-- End of single action -->



