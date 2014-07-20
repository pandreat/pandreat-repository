<!-- UNCOMMENT CODE BELOW TO SHOW SAVE BUTTON AT BOTTOM OF EACH TAB.  ALSO NEED TO COMMENT OUT THE SAVE BUTTON IN MKALLSTATES.PHP -->

<div class="row">
  <input type="submit" class="large primary button expand" value="Save this Case">

</div>

    <p>Shortcut to:
    <a href="#caseInfo">Case Info</a> |
    <a href="#instructionalFoundation">Instructions</a> |
    <a href="#assessment">Assessment</a> |
    <a href="#preparation">Preparation</a> |
    <a href="#caseDetails">Case Details</a></p>
    </form>
    <?php foreach($this->javascript as $script) { ?>
    <script src='<?php echo $script; ?>'></script>
    <?php } ?>

    <script>
      $(document).foundation();
    </script>
  </body>
</html>
