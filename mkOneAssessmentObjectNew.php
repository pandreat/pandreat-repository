<?php
$name_prefix = "$this->namePrefix[$assessmentIndex]";
$id_prefix = 'assessment-'.$this->startcounter;
?>
<div class="one_assessment_div newelement dataRow row" data-endpoint="assessmentitems" data-jsonID="<?php echo $this->startcounter; ?>" data-arrayIndex="<?php echo $assessmentIndex; ?>">
  <fieldset>
  <h3>New</h3>



  <div class="small-1 columns">
    <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->name_tooltip;?>">Name</span>
  </div>
  <div class="small-5 columns">
    <input class="assessmentName" name="<?php echo $name_prefix.'[name]';?>" type="text" value="<?php echo $this->name; ?>"/>
  </div>

  <div class="small-1 columns">
    <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->scale_tooltip;?>"><?php echo $this->scale_label;?></span>
  </div>

  <div class="small-2 columns">
    <select class="scale" name="<?php echo $name_prefix.'[scale]';?>">
      <?php
        foreach($this->values as $item=>$selected){
      ?>
      <option value="<?php echo $item; ?>" <?php echo $selected;?>><?php echo $item; ?></br>
        <?php
          };
        ?>
      </option>
    </select>
  </div>

  <div class="small-1 columns">
    <span data-tooltip class="has-tip [tip-bottom]" title="<?php echo $this->critical_tooltip;?>"><?php echo $this->critical_label;?></span>
  </div>

<!-- Render radio buttons based on value of is_critical_item -->
  <?php if ($this->is_critical_item_item  =="true") { ?>
  <div class="small-3 columns">
    <input type="radio" checked id="<?php echo $id_prefix.'sct'; ?>" name="<?php echo $name_prefix.'[is_critical_item]'; ?>" value="true" /><label for="<?php echo $id_prefix.'sct'; ?>">Yes</label>
    <input type="radio" id="<?php echo $id_prefix.'scf'; ?>"  name= "<?php echo $name_prefix.'[is_critical_item]'; ?>" value="false" /><label for="<?php echo $id_prefix.'scf'; ?>">No</label>
  </div>
  <?php } else { ?>
  <div class="small-3 columns">
    <input type="radio"  id="<?php echo $id_prefix.'sct'; ?>" name="<?php echo $name_prefix.'[is_critical_item]'; ?>" value="true" /><label for="<?php echo $id_prefix.'sct'; ?>">Yes</label>
    <input type="radio" id="<?php echo $id_prefix.'scf'; ?>" checked name= "<?php echo $name_prefix.'[is_critical_item]'; ?>" value="false" /><label for="<?php echo $id_prefix.'scf'; ?>">No</label>
  </div>
  <?php } ?>

  <div class="row">
    <div class="small-2 small-offset-10 columns" ><a href="#" class="delete">Delete this assessment</a>
    </div>
  </div>

  </fieldset>
</div> <!--end of this assessment-->



