<?php
  class Template {
    private $args;
    private $file;

//this function __get is not used much, instead use $this->argname directly
    public function __get($name) {
      return $this->args[$name];
    }

    public function __construct($file, $args = array()) {
      $this->file = $file;
      $this->args = $args;
    }

    public function addvalue($value) {
      //remove the default blank inputs
      if ($this->args['values'][0]=='') {
        $this->args['values'] = array();}
      //add values to array
      $this->args['values'][] = $value;
    }

    public function assmtId($index) {
      return $this->args['values'][$index]['id'];
    }

    public function addselected($name, $value) {
      $this->args['values'][$name] = $value;
    }

    public function addsingletext($value) {
      $this->args['value'] = $value;
    }

    public function addtextarray($values) {
      $this->args['values'] = $values;
    }

    public function render(){
      include $this->file;
    }

    public function renderstate($stateIndex) {
      include $this->file;
    }

    public function renderAssessment($assessmentIndex) {
      include $this->file;
    }

    public function renderaction($actionIndex, $stateIndex, $state_jsonID) {
      include $this->file;
    }

  }


  function render_formarray($form) {
    foreach ($form as $name=>$obj)
      {
        $obj->render();
      }

  }

    function render_allcases($caseArray) {
    foreach ($caseArray as $index=>$case)
      {
        $case->render();
      }

  }
  ?>