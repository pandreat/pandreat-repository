<!-- mkDropdown.php generates a dropdown selection form element -->
<div class="row">
  <div class="large-12 columns">

    <div class="row">
      <div class="small-2 columns">
        <span data-tooltip class="has-tip [tip-bottom]" title='<?php echo $this->__get('tooltip');?>'><?php echo $this->__get('label');?></span>
      </div>

      <div class="small-10 columns">
        <select name="<?php echo $this->__get('name'); ?>">
          <?php
            foreach($this->values as $item=>$selected){
          ?>
          <option value='<?php echo $item; ?>' <?php echo $selected;?>><?php echo $item; ?></br>
            <?php
              $counter++;
              };
            ?>
          </option>
        </select>
      </div>
    </div>

  </div>
</div>