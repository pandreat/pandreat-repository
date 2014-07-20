<!-- text input box -->
<!-- text input box with 'add' button.   -->
<div class="row">
  <div id='<?php echo $this->__get('name').'Div'?>' class="large-12 columns">

    <div class="row">
      <div class="small-8 columns">
     <span data-tooltip class="has-tip [tip-bottom]" title='<?php echo $this->__get('tooltip');?>'><?php echo $this->__get('label');?></span>
      </div>

      <div class="large-8 small-10 large-offset-2 columns">
          <input name="<?php echo $this->__get('name'); ?>" type="text" value="<?php echo $this->__get('value'); ?>" <?php echo $this->__get('readonly'); ?> />
      </div>
    </div>

  </div>
</div>


