// simCommand.js
// Defines "add" buttons, "delete" links.  Generally, "add" button clicks will clone the item to be added, and increment array indices as necessary.  "Delete" link clicks will delete the selected row, and re-number remaining sibling elements.

$(document).ready(function() {

//These indices are used to create unique ids for each set of radio buttons.  Problems occurred when the ids were not unique.  In actuality, element ids are not used much.
  uniqueButtonIndex = 100000;
  uniqueActionIndex = 100000;

//*********************************************************************************************************
  // ADD NEW INPUT BAR BELOW BOTTOM ONE, AND INCLUDE REMOVE BUTTON FOR THAT ROW
  $(".rowWithAddButton").on('click', 'button', function(e){
    var newInputBarName = $(e.currentTarget).attr('data-name');
    var addedRowDivName = $(e.currentTarget).attr('data-newRowDiv');
   $("</br><div class='dataRow'><div class='large-8 small-10 large-offset-2 columns'><input name=" + newInputBarName+ " type='text' /></div><div class='small-1 columns'><a href='#' class='deletefromlist'>Delete</a></div></div>").appendTo("." + addedRowDivName);
  });

//*********************************************************************************************************
  // ADD NEW INPUT BAR BELOW BOTTOM ONE, AND INCLUDE REMOVE AND ADD FILE BUTTONS FOR THAT ROW
  $(".rowWith2Buttons").on('click', 'button', function(e){
    var newInputBarName = $(e.currentTarget).attr('data-name');
    var addedRowDivName = $(e.currentTarget).attr('data-newRowDiv');
   $("</br><div class='dataRow'><div class='small-9 columns'><input name=" + newInputBarName+ " type='text' /></div><div class='small-2 columns'><span>Upload</span><input type='file' class='upload'></div><div class='small-1 columns'><a href='#' class='deletefromlist'>Delete</a></div></div>").appendTo("." + addedRowDivName);
  });



//*********************************************************************************************************
//ADD ASSESSMENT

/* Note: originally the 'add' button was at the top of the page; this makes functional the "add" button moved to the bottom of the page.*/

  $('#footerAssessmentButton').on('click', function(){
    $('#buttonToAddAssessment').click();
    return false;
  });

  $('#buttonToAddAssessment').on('click', function(){
/*This was originally coded to allow for automated generation of state, assessment and action ids (hence the use of data-jsonID, etc.).  This is no longer necessary because the API now assigns ID.  These attributes remain in the code and are still used to create div ids and to hold id data for use in forms. */
    var last_index= parseInt($('.one_assessment_div').last().attr('data-arrayIndex'));
    var new_index = last_index +1;
    var new_index_string = new_index.toString();
    var last_jsonID = parseInt($('.one_assessment_div').last().attr('data-jsonID'));
    var new_jsonID = last_jsonID + 1;
    var newDiv = $(".one_assessment_div").last().clone();

    //Clear values from cloned form and update values.  Because new assessments are cloned from the previous one, the array indices need to be updated.  New assessments will not have an assessment ID yet.
    newDiv.find("[type=text]").val('');
    newDiv.find("[type=radio][value=false]").prop('checked', true);
    newDiv.attr('data-jsonID', new_jsonID);
    newDiv.attr('data-arrayIndex', new_index);
    newDiv.find('input.assessmentName').attr('value', '');
    newDiv.find('h3').text('New Assessment');
    newDiv.find('input.assessmentIDHiddenRow').remove();
    newDiv.addClass("newelement");

    uniqueButtonIndex += 1;
    newDiv.find("input:radio[id]").each(function() {
      var radio_id= $(this).attr('id');
      var new_radio_id = radio_id.replace(/assessment-[0-9]+/g, 'assessment-' + uniqueButtonIndex);
      $(this).attr('id',new_radio_id);
      console.log('new radio id is ', new_radio_id);
    });

    newDiv.find("label[for]").each(function() {
      var radio_id= $(this).attr('for');
      var new_radio_id = radio_id.replace(/assessment-[0-9]+/g, 'assessment-' + uniqueButtonIndex);
       $(this).attr('for',new_radio_id);
    });

    newDiv.find("input[name], select[name]").each(function(){
      var name = $(this).attr('name');
      var new_name = name.replace(/\[[0-9]+\]/g, '['+ new_index+']');
      $(this).attr('name',new_name);
    });

    newDiv.appendTo('.assessmentsDiv');
  });  //end of add assessment


//*********************************************************************************************************
//ADD NEW ACTION
  $('.allStatesDiv').on('click', 'button', function(){

    event.stopPropagation();
    if($(this).hasClass("buttonClassToAddAction")){

      var statejsonID=$(this).attr('data-statejsonID');
      var stateIndex=$(this).attr('data-stateIndex');
      var action_divID = "#ActionsForState_" + statejsonID;
      var action_div = $(action_divID);
      var new_action_index;
      var new_action_jsonID;
      var newDiv;


  //Count number of existing one_action_divs; if zero, need to copy from hidden template and set index and json_ID
      var currentActionCount = action_div.children('.one_action_div').length;
      if (currentActionCount > 0) {
        var last_action = action_div.find('div.one_action_div').last();
        new_action_jsonID = parseInt(last_action.attr('data-actionjsonID')) +1 ;
        new_action_index = parseInt(last_action.attr('data-arrayIndex')) +1;
        newDiv = last_action.clone();

        newDiv.find("input[name], select[name], textarea[name]").each(function(){
          var name = $(this).attr('name');
          var new_name = name.replace(/\[actions\]\[[0-9]+\]/g, '[actions]['+ new_action_index +']');
          $(this).attr('name',new_name);
        });

        //clear values from cloned form
        newDiv.find("[type=text]").val('');
        newDiv.find("[type=radio][value=false]").prop('checked', true);
        newDiv.addClass("newelement");
        newDiv.removeClass("hiddenDiv");
        var deleteTag = newDiv.find("input.hiddenDeleteTag");
        deleteTag.attr('value', '');

        var idHolder = 'radio'+uniqueButtonIndex+'action'+uniqueActionIndex;
        uniqueButtonIndex += 1;
        uniqueActionIndex += 1;
        newDiv.find("input:radio[id]").each(function() {
          var radio_id= $(this).attr('id');
          var new_radio_id = radio_id.replace(/radio[0-9]+action[0-9]+/g, idHolder);
          $(this).attr('id',new_radio_id);
          console.log('new radio id is ', new_radio_id);

        })

        newDiv.find("label[for]").each(function() {
          var radio_id= $(this).attr('for');
          var new_radio_id = radio_id.replace(/radio[0-9]+action[0-9]+/g, idHolder);
           $(this).attr('for',new_radio_id);
        })

      } else {

        /*If no existing actions, use the hidden template to create the first action.  "jsonID's" are legacy values from when state, assessment and action id's were being dynamically generated; now they are assigned by the API, but these jsonID values remain in the code. */
        newDiv = $('.templateForOneActionDiv').find('div.one_action_div').clone();
        newDiv.addClass("newelement");
        new_action_jsonID = 100*(statejsonID-200) + 201;
        new_action_index = 0;

        newDiv.find("input[name], select[name], textarea[name]").each(function(){
          var name = $(this).attr('name');
          var new_name = name.replace(/\[placeholder\]/g, 'states[' + stateIndex + '][actions]['+ new_action_index +']');
          $(this).attr('name',new_name);
        });

        var idHolder = 'radio'+uniqueButtonIndex+'action'+uniqueActionIndex;
        uniqueButtonIndex += 1;
        uniqueActionIndex += 1;
        newDiv.find("input:radio[id]").each(function() {
          var radio_id= $(this).attr('id');
          var new_radio_id = radio_id.replace(/IDholder/g, idHolder);
          console.log(new_radio_id);
          $(this).attr('id',new_radio_id);
        });

        newDiv.find("label[for]").each(function() {
          var radio_id= $(this).attr('for');
          var new_radio_id = radio_id.replace(/IDholder/g, idHolder);
          console.log(new_radio_id);
           $(this).attr('for',new_radio_id);
        });
      } //end of if statement


  /*The following code was added so that tinyMCE editors that were cloned from existing state divs would be functional.  */
      newDiv.find('div.mce-tinymce').each(function(){
        var thistext =  $(this).next('textarea');
        thistext.attr('id', 'tempID');
        thistext.removeAttr('aria-hidden style');
        $(this).remove();
        thistext.removeAttr('id');
      });

      newDiv.attr('id', 'state_' + statejsonID + '_action_' + new_action_jsonID);
      newDiv.attr('data-arrayIndex', new_action_index);
      newDiv.attr('data-actionjsonID', new_action_jsonID);
      newDiv.find('input.actionName').attr('value', '');
      newDiv.find('input.actionIDHiddenRow').remove();
      newDiv.appendTo(action_div);
      loadTinyMCEEditor();
    }  //end of if hasClass buttonClassToAddAction
  }); //end of add action

  //*********************************************************************************************************
  //ADD STATE

  $('#footerAddStateButton').on('click', function(){
    $('#buttonToAddState').click();
    return false;
  });


  $('#buttonToAddState').on('click', function(){

  //GRAB MOST RECENT STATE DIV'S INDEX AND JSON ID, AND INCREMENT FOR NEW DIV
    var last_index_string=$('.one_state_div').last().attr('data-arrayIndex');
    var last_index= parseInt(last_index_string);
    var new_index = last_index +1;
    var new_index_string = new_index.toString();
    var last_jsonID_string = $('.one_state_div').last().attr('data-jsonID');
    var last_jsonID = parseInt(last_jsonID_string);
    var new_jsonID = last_jsonID + 1;
    var new_jsonID_string = new_jsonID.toString();

//CREATE CONTAINER DIV FOR STATE AND ITS ACTIONS
    // var prefix = 'states[' + new_index+ ']';
    $('<div id="" class="dataRow borderDiv one_state_div" data-arrayIndex="" data-jsonID=""></div>').appendTo('.allStatesDiv');
    container_div=$('.one_state_div').last();
    container_div.attr('data-jsonID', new_jsonID);
    container_div.attr('data-arrayIndex', new_index);
    container_div.attr('id', 'state_' + new_jsonID);
    container_div.addClass("newelement");

    var newDiv = $(".stateWithoutActionsSection").last().clone();
    console.log(newDiv);
    newDiv.appendTo(container_div);

//clear form values from clone
    newDiv.find("[type=text]").val('');
    newDiv.find("h3").html('New State');
    newDiv.find('input.hiddenStateJsonID').remove();
    var deleteTag = newDiv.find("input.hiddenDeleteTag");
    deleteTag.attr('value', '');



//MAKE CLONE OF ACTIONS_SECTION_CLASS DIV, APPEND TO CONTAINER_DIV, UPDATE INDICES AND JSON IDS
    $('<div id="section_state_' + new_jsonID +'_actions_div" class="actions_section_class row" data-stateIndex = "' +  new_index + '" datajsonID ="' + new_jsonID + '" ></div>').appendTo(container_div);
    newActionSection = $('.actions_section_class').last();
    newActionButtonSection = $('.DivWithAddActionButton').last().clone();
    newActionButtonSection.appendTo(newActionSection);
    $('<div id="ActionsForState_' + new_jsonID + '" class="divWithStateActions multiInputDiv row">').prependTo(newActionSection);

    newDiv.find('div.mce-tinymce').each(function(){
      var thistext =  $(this).next('textarea');
      thistext.attr('id', 'tempID');
      thistext.removeAttr('aria-hidden style');
      $(this).remove();
      thistext.removeAttr('id');
    });

//commented out display of jsonID and input of jsonID so they won't be sent to API; jsonID is still used to create unique divID
    newDiv.attr('data-jsonID', new_jsonID);
    newDiv.attr('data-arrayIndex', new_index);
    newDiv.find('textarea').text('');



    newDiv.find("input[name], text[name], select[name], textarea[name]").each(function(){
      var name = $(this).attr('name');
      var new_name = name.replace(/states\[[0-9]+\]/g, 'states['+ new_index +']');
      $(this).attr('name',new_name);
      $(this).attr('value','');
    });

    newDiv.find("input[id], text[id], select[id], textarea[id]").each(function(){
      var oldid = $(this).attr('id');
      var newid = oldid.replace(/states\[[0-9]+\]/g, 'states['+ new_index +']');
      $(this).attr('id',newid);
      $(this).attr('value','');
    });


    // newActionSection.find('h3').text('Actions for State ID ' + new_jsonID);
    //grab button
    newButtonID = 'addActionButtonState_' + new_jsonID;
    newActionButtonSection.find('button').attr('id', newButtonID);
    $("#" + newButtonID).attr('data-statejsonID', new_jsonID);
    $("#" + newButtonID).attr('data-stateIndex', new_index);
    loadTinyMCEEditor();
  }); //end of add state

//*********************************************************************************************************

/* DELETE FUNCTIONALITY FOR ASSESSMENTS
INCLUDING RE-NUMBERING OF ARRAY INDICES */

  // DELEGATE LISTENER TO "MULTITEXTBAR" ROWS DIV, WHICH EXIST AT FIRST RENDER, TO REMOVE ROW WHEN "REMOVE" BUTTON FOR THAT ROW IS CLICKED.
  $(".multiInputDiv").on('click', 'a.delete', function(e){
    e.preventDefault();
    var confirmdelete = confirm("Are you sure you want to delete this?");
    if (confirmdelete==true){
      var selectedRow = $(this).closest(".dataRow");
      var endpoint = selectedRow.attr('data-endpoint');

      //count sibling datarows, if total is 1, do not delete and show alert
      var siblingCount = $(selectedRow).siblings().length;
        if (siblingCount == 0) {
          alert("Sorry, cannot delete only instance of this data");
        }
        else {
          // If element to delete is not a newly added element (i.e. it was part of the original GET response), send HTTP DELETE request for that element
          if (!selectedRow.hasClass("newelement")) {
            if(selectedRow.attr("data-jsonid")) {
              var id_to_delete = selectedRow.attr("data-jsonid");
            }
            else if (selectedRow.attr("data-actionjsonid")) {
              var id_to_delete = selectedRow.attr("data-actionjsonid");
            }
            $.ajax({
              url: 'SimCommandDelete.php?endpoint=' + endpoint + '&delete_id=' + id_to_delete,
            }).done(function() {
              alert("completed delete");
            });
          }
          $(selectedRow).remove();
        }


      //loop through elements for a given set of assessments, actions, or states, and update rowIndex

      $('.one_assessment_div').each(function(rowIndex){
        $(this).attr('data-arrayIndex', rowIndex);
        $(this).find("input[name], select[name]").each(function(){
          var name = $(this).attr('name');
          var new_name = name.replace(/\[[0-9]+\]/g, '['+rowIndex+']');
          $(this).attr('name',new_name);
        });
      });

      // $('.one_state_div').each(function(rowIndex){
      //   var statejsonID = $(this).attr('data-jsonid');
      //   // find each input with a name attribute inside each row.  This will change state index for embedded actions too.
      //   $(this).attr('data-arrayIndex', rowIndex);
      //   $(this).find("input[name], select[name], textarea[name]").each(function(){
      //     var name = $(this).attr('name');
      //     var new_name = name.replace(/states\[[0-9]+\]/g, 'states['+rowIndex+']');
      //     // console.log('state regex');
      //     $(this).attr('name',new_name);
      //   });

      //   $(this).find("input[id], select[id], textarea[id]").each(function(){
      //     var oldid = $(this).attr('id');
      //     var newid = oldid.replace(/states\[[0-9]+\]/g, 'states['+rowIndex+']');
      //     // console.log('state regex');
      //     $(this).attr('id',newid);
      //   });


      //     //NEED TO LIMIT RE-NUMBERING TO ACTIONS FOR THE SAME STATE. SO INVOKE WHEN LOOPING THROUGH STATES TO LIMIT SCOPE
      //   var childrenActions = $(this).find('.one_action_div');
      //   console.log(childrenActions.length);
      //   childrenActions.each(function(rowIndex){
      //     console.log('begin re-numbering actions');
      //     var idHolder = 'radio' + statejsonID + 'action' + rowIndex;
      //     $(this).attr('data-arrayIndex', rowIndex);
      //     $(this).find("input[name], select[name], textarea[name]").each(function(){
      //       var name = $(this).attr('name');
      //       var new_name = name.replace(/\[actions\]\[[0-9]+\]/g, '[actions]['+rowIndex+']');
      //       $(this).attr('name',new_name);
      //     });
      //     //UPDATE IDS AND LABELS FOR RADIO BUTTONS
      //     // var idHolder = 'radio' + statejsonID + 'action' + new_action_index;
      //     $(this).find("input:radio[id]").each(function() {
      //       var radio_id= $(this).attr('id');
      //       var new_radio_id = radio_id.replace(/radio[0-9]action[0-9]/g, idHolder);
      //       $(this).attr('id',new_radio_id);
      //     });

      //     $(this).find("label[for]").each(function() {
      //       var radio_id= $(this).attr('for');
      //       var new_radio_id = radio_id.replace(/radio[0-9]action[0-9]/g, idHolder);
      //        $(this).attr('for',new_radio_id);
      //     });
      //   }); // end of children actions update
      // });  //end of state update
    // }); //
    } //end of "if confirmed"
  }); //end of delete function


/****************************************************/

/* DELETE FUNCTIONALITY FOR STATES AND ACTIONS
 */

  // DELEGATE LISTENER TO "MULTITEXTBAR" ROWS DIV, WHICH EXIST AT FIRST RENDER, TO ADD 'HIDDENDIV' CLASS WHEN BUTTON FOR THAT ROW IS CLICKED.
  $(".multiInputDiv").on('click', 'a.deleteState', function(e){
    e.preventDefault();
    var confirmdelete = confirm("Are you sure you want to delete this state?");
    if (confirmdelete==true){
      var selectedRow = $(this).closest(".dataRow");
      var endpoint = selectedRow.attr('data-endpoint');
      //count sibling datarows, if total is 1, do not delete and show alert
      var siblingCount = $(selectedRow).siblings().length;
      if (siblingCount == 0) {
        alert("Sorry, cannot delete only instance of this data");
      }
      else {
        var deleteTag = $(selectedRow).find("input.hiddenDeleteTag");
        deleteTag.attr('value', 'deleted');
        $(selectedRow).addClass("hiddenDiv");
      }
    } //end of "if confirmed"
  }); //end of delete function


  $(".multiInputDiv").on('click', 'a.deleteAction', function(e){
    e.stopPropagation();
    var confirmdelete = confirm("Are you sure you want to delete this action?");
    if (confirmdelete==true){
      var selectedRow = $(this).closest(".dataRow");
      var endpoint = selectedRow.attr('data-endpoint');
      //count sibling datarows, if total is 1, do not delete and show alert
      var siblingCount = $(selectedRow).siblings().length;
      if (siblingCount == 0) {
        alert("Sorry, cannot delete only instance of this data");
      }
      else {
        var deleteTag = $(selectedRow).find("input.hiddenDeleteTag");
        deleteTag.attr('value', 'deleted');
        $(selectedRow).addClass("hiddenDiv");
      }
    } //end of "if confirmed"
  }); //end of delete function


//This handles deletions of non-nested multi-elements, such as author and institution lists.  No re-indexing is required.
  $(".multiInputDiv").on('click', 'a.deletefromlist', function(e){
    e.preventDefault();
    var confirmdelete = confirm("Are you sure you want to delete this?");
    if (confirmdelete==true){
      var selectedRow = $(this).closest(".dataRow");
      //count sibling datarows, if total is 1, do not delete and show alert
      var siblingCount = selectedRow.siblings().length;
      if (siblingCount == 0) {
        alert("Sorry, cannot delete only instance of this data");
      }
      else {
        $(selectedRow).remove();
      }
    }
  });

});