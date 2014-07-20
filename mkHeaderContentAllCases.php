<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $this->tabTitle; ?></title>
    <link rel="stylesheet" href="<?php echo $this->stylesheet; ?>" />

    <?php foreach($this->javascript as $script) {?>
    <script src="<?php echo $script; ?>"></script>
    <?php } ?>

  </head>

  <body>

    <div class="row">

<!-- NAV -->
<div class="row">
  <div class="large-12 columns">
    <div class="sticky">
      <!-- <div class="contain-to-grid"> -->
      <nav class="top-bar" data-topbar>
        <ul class="title-area">
          <!-- Title Area -->
          <li class="name">
            <h1><a href="#">SimCommand Summary of Cases</a></h1>
          </li>
        </ul>
      </nav>
      <div class="row">
        <div class="small-2 columns end">
          <a class="alwaysShow success button small" href="SimCommandNewCaseForm.php">Create New Case</a>
        </div>
      </div>
<!-- </div> -->
    </div>
  </div>
</div>

