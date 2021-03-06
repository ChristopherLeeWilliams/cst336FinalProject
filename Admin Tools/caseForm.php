<!DOCTYPE html>
<html>
    <head>
        <?php
            session_start(); 
            require_once("../connection.php");
            require_once("../Component Selection Data/componentSelectionFunctions.php");
            if (strcmp($_SESSION['username'],"")==0) {
                header("location: ../index.php");
            }
        ?>
        <title></title>
    </head>
    
    <style>
        html {
            padding: 20px 5%;
        }
        .title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 40px;
        }
        
        .wrapper {
          max-height: 400px;
          overflow: auto;
        }
    </style>
    
    <!--Imports-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    
    <link rel="icon" href="/Final Project/Images/favicon.jpg">
    <link rel="stylesheet" href="../CSS/finalProject.css">

    <button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/index.php'">Main Menu</button>

    <h1 class="title">Case Form:</h1>
    
    
    <h3> Delete / Update: </h3></br>
    <div class="wrapper">
        <table class="selectTable">
        <!-- Put column names on top of the table -->
        <tr>
            <td><b>Name</b></td>
            <td><b>Form Factor (Motherboard)</b></td>
            <td><b>Maximum GPU Length (Inches)</b></td>
            <td><b>2.5" Bays</b></td>
            <td><b>3.5" Bays</b></td>
            <td><b>Price</b></td>
            <td></td>
            <td></td>
        </tr>
        
        <?php
            // Print out hardware parts with relevant information
            $case = getCases($dbConn);
            $i = 0;
            for($i; $i < count($case); $i++) {
                echo '<tr>';
                echo '<td>'.$case[$i]["caseName"].'</td>';
                echo '<td>'.$case[$i]["caseFFType"].'</td>';
                echo '<td>'.$case[$i]["maxGPULengthInches"].'</td>';
                echo '<td>'.$case[$i]["caseNum25Bays"].'</td>';
                echo '<td>'.$case[$i]["caseNum35Bays"].'</td>';
                echo '<td>$'.$case[$i]["casePrice"].'</td>';
                echo '<td><a href="caseForm.php?caseId='.$case[$i]["caseId"].'">Select</a></td>';
                // echo '<td><a href="Component Selection Data/caseSelectData.php?caseId='.$case[$i]["caseId"].
                // '&remove=false">Delete</a></td>';
                echo '<td><button type="button" class="btn btn-link" onClick=deleteFromDatabase('.$case[$i]["caseId"].')>Delete</button></td>';
                echo '</tr>';
            }
        ?> 
        </table>
    </div>
    </br></br>
    <?php
        // Print current update target
        $caseS = getCase($dbConn,$_GET['caseId']);
        // echo '<table class="selectTable"><tr>';
        // echo '<td>'.$caseS["caseName"].'</td>';
        // echo '<td>'.$caseS["caseFFType"].'</td>';
        // echo '<td>'.$caseS["maxGPULengthInches"].'</td>';
        // echo '<td>'.$caseS["caseNum25Bays"].'</td>';
        // echo '<td>'.$caseS["caseNum35Bays"].'</td>';
        // echo '<td>$'.$caseS["casePrice"].'</td>';
        // echo '</table>';
    ?>
    
    </br>
    
    <h3> Add New / Update: </h3></br>
    <form id="dataInputForm">
      
    <div class="form-group row" id="caseNameDiv">
      <label for="example-text-input" class="col-1 col-form-label">Case Name</label>
      <div class="col-10">
        <input class="form-control" type="text" value="" id="caseNameInput">
      </div>
    </div>
    
    <div class="form-group row" id="caseFFDiv">
      <label for="example-number-input" class="col-1 col-form-label">Form Factor</label>
      <div class="col-10">
      <select class="form-control" id="caseFFInput">
         <?php
            $formFactors = getMBFormFactors($dbConn);
            $i = 0;
            for($i; $i < count($formFactors); $i++) {
              echo '<option value='.$formFactors[$i]["mbFFId"].'>'.$formFactors[$i]["mbFFType"].'</option>';
            }
        ?>
      </select>
      </div>
    </div>
    
    <div class="form-group row " id="caseMaxGPULengthDiv">
      <label for="example-number-input" class="col-1 col-form-label">Max GPU Length (Inches)</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" min="0" value="" id="caseMaxGPULengthInput">
      </div>
    </div>
    
    <div class="form-group row" id="case25BaysDiv">
      <label for="example-number-input" class="col-1 col-form-label">#2.5' Bays</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="case25BaysInput">
      </div>
    </div>
    
    <div class="form-group row" id="case35BaysDiv">
      <label for="example-number-input" class="col-1 col-form-label">#3.5' Bays</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="case35BaysInput">
      </div>
    </div>
    
    <div class="form-group row" id="casePriceDiv">
      <label for="example-number-input" class="col-1 col-form-label">Price</label>
      <div class="col-10">
        <input class="form-control" type="number" min="0" value="" id="casePriceInput">
      </div>
    </div>
    
    <div class="form-inline">
      </br><button type="reset"  class="btn btn-primary btn-md" value="Reset">Clear</button></br>
      </br><button type="button" class="btn btn-primary btn-md" onClick="location.href='/Final Project/Admin Tools/caseForm.php'">Deselect Update Target</button>
      
      </br><button type="button" class="btn btn-primary btn-md" onClick=addCaseToDatabase()>Add</button>
      </br><button type="button" class="btn btn-primary btn-md" onClick=updateCaseInDatabase()>Update</button>
    </div>
    </form>
    
    <script>
      if ('<?php echo $_GET['caseId']; ?>' != null) {
        $('#caseNameInput').val('<?php echo $caseS["caseName"]; ?>');
        $('#caseFFInput').val('<?php echo $caseS["caseFFId"]; ?>');
        $('#caseMaxGPULengthInput').val('<?php echo $caseS["maxGPULengthInches"]; ?>');
        $('#case25BaysInput').val('<?php echo $caseS["caseNum25Bays"]; ?>');
        $('#case35BaysInput').val('<?php echo $caseS["caseNum35Bays"]; ?>');
        $('#casePriceInput').val('<?php echo $caseS["casePrice"]; ?>');
      }
      
      function addCaseToDatabase() {
        var wasSuccessful = checkFieldsAreSet();
        if (wasSuccessful == true) {
          console.log("All fields are set, ready to add!");
          addToDatabase("add","case");
        } else {
          console.log("One or more fields are incorrect");
        }
      }
      
      function updateCaseInDatabase() {
        var wasSuccessful = checkFieldsAreSet();
        if (wasSuccessful == true) {
          console.log("All fields are set, ready to add!");
          addToDatabase("update","case");
          
        } else {
          console.log("One or more fields are incorrect");
        }
      }

      
      function addToDatabase(action, componentType) {
        var id = '<?php echo $_GET['caseId']; ?>';
        var component = {
          caseId: id,
          caseName:  $('#caseNameInput').val(),
          caseFFId: $('#caseFFInput').val(),
          maxGPULengthInches: $('#caseMaxGPULengthInput').val(),
          caseNum25Bays: $('#case25BaysInput').val(),
          caseNum35Bays: $('#case35BaysInput').val(),
          casePrice: $('#casePriceInput').val(),
        }
        
        var data = {
            componentType: componentType,
            action: action,
            component: component
        };
        
        $.ajax({
            type: "POST",
            data: data,
            url: "databaseModificationFunctions.php",
            success: function(data) {
                console.log(data);
            }
        });
        
      }
      
      function checkFieldsAreSet() {
        var successful = true;
        
        if ($('#caseNameInput').val() === "") {
          $('#caseNameDiv').addClass("has-danger");
          $('#caseNameDiv').removeClass("has-success");
          successful = false;
        } else {
          $('#caseNameDiv').removeClass("has-danger");
          $('#caseNameDiv').addClass("has-success");
        }
        
        if ($('#caseFFInput').val() < 1) {
          $('#caseFFDiv').addClass("has-danger");
          $('#caseFFDiv').removeClass("has-success");
          successful = false;
          
        } else {
          $('#caseFFDiv').removeClass("has-danger");
          $('#caseFFDiv').addClass("has-success");
        }
        
        if ($('#caseMaxGPULengthInput').val() === "") {
          $('#caseMaxGPULengthDiv').addClass("has-danger");
          $('#caseMaxGPULengthDiv').removeClass("has-success");
          successful = false;
        } else {
          $('#caseMaxGPULengthDiv').removeClass("has-danger");
          $('#caseMaxGPULengthDiv').addClass("has-success");
        }
        
        if ($('#case25BaysInput').val() === "") {
          $('#case25BaysDiv').addClass("has-danger");
          $('#case25BaysDiv').removeClass("has-success");
          successful = false;
        } else {
          $('#case25BaysDiv').removeClass("has-danger");
          $('#case25BaysDiv').addClass("has-success");
        }
        
        if ($('#case35BaysInput').val() === "") {
          $('#case35BaysDiv').addClass("has-danger");
          $('#case35BaysDiv').removeClass("has-success");
          successful = false;
        } else {
          $('#case35BaysDiv').removeClass("has-danger");
          $('#case35BaysDiv').addClass("has-success");
        }
        
        if ($('#casePriceInput').val() === "") {
          $('#casePriceDiv').addClass("has-danger");
          $('#casePriceDiv').removeClass("has-success");
          successful = false;
        } else {
          $('#casePriceDiv').removeClass("has-danger");
          $('#casePriceDiv').addClass("has-success");
        }
        
        return successful;
      }
      
      function deleteFromDatabase(id) {
        console.log("Called to delete"+id);
        var component = {
          caseId: id
        };
        
        var componentType = "case";
        var action = "delete";
        
        var data = {
            componentType: componentType,
            action: action,
            component: component
        };
        
         $.ajax({
            type: "POST",
            data: data,
            url: "databaseModificationFunctions.php",
            success: function(data) {
                console.log("Ajax Successful: "+data);
            }
        });
      }
      
      
    </script>
  
</html>