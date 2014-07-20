
    <fieldset>
      <div class="row">
        <div class="small-3 columns">
       <h4>Case Title:</h4>
        </div>
        <div class="title small-7 columns">
        <!-- <h3><a href=<#?php echo "http://private-1c15-scapi.apiary-mock.com/cases/$this->caseID.html" ?>><#?php echo $this->title; ?></a></h3> -->
        <h4><a href='SimCommandEditOneCaseForm.php?case_id=<?php echo $this->caseID; ?>'><?php echo $this->title; ?></a></h4>
        </div>
        <div class="small-2 columns">
        <a class="button tiny" href='SimCommandEditOneCaseForm.php?case_id=<?php echo $this->caseID; ?>'>View/Edit Case</a>
      </div>
      </div>

      <div class="row">
        <div class="small-2 columns">
          <span>Case ID:</span>
        </div>
        <div class="caseID small-3 columns">
          <p><?php echo $this->caseID; ?></p>
        </div>

        <div class="small-2 columns">
          <span>Number:</span>
        </div>
        <div class="number small-3 columns">
          <p><?php echo $this->number; ?></p>
        </div>
      </div>

      <div class="row">
        <div class="large-2 small-10 columns">
          <span>Case Overview:</span>
        </div>
        <div class="overview small-10 columns">
          <p><?php echo $this->overview; ?></p>
        </div>
      </div>

      <div class="row">
        <div class="small-8 columns">
       <span>Last Published:</span>
        </div>
        <div class="published large-8 small-10 large-offset-2 columns">
          <p><?php echo $this->published; ?></p>
        </div>
      </div>

      <div class="row">
        <div class="small-8 columns">
          <span>Authors:</span></br></br>
          <ul class="authorList">
            <?php foreach($this->authors as $author) { ?>
            <li><?php echo $author; ?></li>
            <?php } ?>
          </ul>
        </div>
      </div>


      <div class="row">
        <div class="small-8 columns">
          <span>Institutions:</span></br></br>
          <ul class="institutionList">
            <?php foreach($this->institutions as $institution) { ?>
            <li><?php echo $institution; ?></li></br></br>
            <?php } ?>
          </ul>
        </div>
      </div>


      <div class="row">
        <div class="small-8 columns">
          <span>Instructional Goals:</span></br></br>

          <?php echo $this->instructionalGoals; ?>
        </div>
      </div>

      <div class="row">
        <div class="small-8 columns">
          <span>Clinical Area(s):</span></br></br>
          <ul class="categoriesList">
            <?php foreach($this->categories as $cat) { ?>
            <li><?php echo $cat; ?></li></br></br>
            <?php } ?>
          </ul>
        </div>
      </div>

    </fieldset>



