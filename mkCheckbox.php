<!-- mkCheckbox.php creates a set of checkboxes. It shows checked and unchecked boxes -->
<div class="row">
  <div class="large-12 medium-12 columns" id="<?php echo $this->__get('name').'_div'; ?>">
    <span data-tooltip class="has-tip [tip-bottom]" title='<?php echo $this->__get('tooltip');?>'><?php echo $this->__get('label'); ?></span></br></br>
    <ul class="checkbox-grid">
      <?php
        foreach($this->values as $item=>$checked){
      ?>

      <li><input  id='<?php echo $this->__get('name').'_'.$counter; ?>' type="checkbox" name="<?php echo $this->__get('name').'[]'; ?>" value='<?php echo $item;?>' <?php echo $checked;?>>
      <label for='<?php echo $this->__get('name').'_'.$counter; ?>'><?php echo $item; ?></label></li>


      <?php
        $counter++;
        };
      ?>
    </ul>
  </div>
</div>
