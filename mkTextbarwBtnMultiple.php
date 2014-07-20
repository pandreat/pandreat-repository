<!-- text input box with 'add' button.   -->
<div class="row">
  <div id='<?php echo $this->__get('name').'Div'?>' class="large-12 columns">

    <div class="rowWithAddButton">
      <div class="row">
        <div class="small-8 columns">
           <!-- <button type="button" class="small success button" data-name="<#?php echo $this->__get('entity').'['; echo $this->__get('name').'][]'; ?>" data-newRowDiv = '<#?php echo $this->__get('name').'DataRows'?>'><#?php echo $this->__get('btnlabel'); ?></button> --><span data-tooltip class="has-tip [tip-bottom]" title='<?php echo $this->__get('tooltip');?>'><?php echo $this->__get('label');?></span>
        </div>
        <div class="small-1 columns">
          <button type="button" class="small success button" data-name="<?php echo $this->__get('name').'[]'; ?>" data-newRowDiv = '<?php echo $this->__get('name')."DataRows"?>'><?php echo $this->__get('btnlabel'); ?></button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class='multiInputDiv' class='<?php echo $this->__get('name').'DataRows'?>'>
        <?php
          foreach($this->values as $item) {
        ?>
        <div class="dataRow">
          <div class="large-8 small-10 large-offset-2 columns">
              <input name="<?php echo $this->__get('name').'[]'; ?>" type="text" value='<?php echo $item ?>' required />
          </div>
          <!-- <div class='small-1 columns'><button type='button' class='small alert button expand deletebutton' class=>Delete</button> -->
            <div class="small-1 columns"><a href='#' class="deletefromlist">Delete</a>
          </div>
        </div>
        <?php
          }
        ?>
        <div class='<?php echo $this->__get('name').'DataRows'?>'>
        </div>
      </div>
    </div>

  </div>
</div>