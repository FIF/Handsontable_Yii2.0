<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/handsontable.full.min.js"></script>
	<link rel="stylesheet" media="screen" href="<?php echo Yii::app()->request->baseUrl; ?>/css/handsontable.full.min.css">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<style>
	.pad {
	    margin: auto;
	    width: 80%;
	    border:3px solid #8AC007;
	    padding: 10px;
	}
	</style>
</head>

<body>

<div id='content'>

    <div class="pad" data-jsfiddle="example1">
      <h2>PHP example</h2>

      <p>
        <button name="load">Load</button>
        <button name="save">Save</button>
        <button name="reset">Reset</button>
        <label><input type="checkbox" name="autosave" checked="checked" autocomplete="off"> Autosave</label>
      </p>

      <div id="exampleConsole" class="console">Click "Load" to load data from server</div>

      <div id="example1" class="hot"></div>

      <p>
        <button name="dump" data-dump="#example1" data-instance="hot" title="Prints current data source to Firebug/Chrome Dev Tools">
          Dump data to console
        </button>
      </p>
  </div>
</div>

<script type="text/javascript" charset="utf-8">

$(document).ready(function () {

// $.ajax({
//   url: "<?= Yii::app()->request->baseUrl?>/product/load",
//   dataType: 'json',
//   type: 'GET',
//   data: '', // 
//   success: function (res) {
//       console.log(res.data);

//   },
//   error: function(err) {
//       console.log(err);
//       alert(err);
//   }
// });

var
  $container = $("#example1"),
  $console = $("#exampleConsole"),
  $parent = $container.parent(),
  autosaveNotification,
  hot,
  settings1,
  ipValidatorRegexp,
  emailValidator;
  ;

  ipValidatorRegexp = /^(?:\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b|null)$/;
  emailValidator = function (value, callback) {
    setTimeout(function(){
      if (/.+@.+/.test(value)) {
        callback(true);
      }
      else {
        callback(false);
      }
    }, 1000);
  };



hot = new Handsontable($container[0], {
  // columnSorting: true,
  columnSorting: {
    column: 0
  },
  startRows: 8,
  startCols: 7,
  rowHeaders: true,
  colHeaders: ['Id', 'Product','VN Price', 'Year', 'Manufacturer', 'Import Price', 'Note', 'Available'],
  manualColumnResize: true,
  manualRowResize: true,
  fixedRowsTop: 2,
  fixedColumnsLeft: 2,
  stretchH: 'last',
  manualColumnFreeze: true,
  manualColumnMove: true,
  manualRowMove: true,
  currentRowClassName: 'currentRow',
  currentColClassName: 'currentCol',
  mergeCells: true,
  columns: [
    {
      readOnly: true
    },
    {},
    {},
    {},
    {},
    {},
    {},
    {
      // data: 'Available',
      type: 'checkbox',
      checkedTemplate: 1,
      uncheckedTemplate: 0
    },

  ],
  // groups: [
  //     {
  //       cols: [0, 2]
  //     },
  //     {
  //       cols: [3, 6]
  //     },
  //     {
  //       rows: [0, 4]
  //     },
  //     {
  //       rows: [2, 4]
  //     }
  // ],
  minSpareCols: 0,
  minSpareRows: 1,
  contextMenu: true,
  afterChange: function (change, source) {
    var data;

    if (source === 'loadData' || !$parent.find('input[name=autosave]').is(':checked')) {
      return;
    }

    if(source === '') {  // TODO is this logic ok
      return;
    }
    // console.log(source);
    console.log(change);

    data = change[0];

    // transform sorted row to original row
    data[0] = hot.sortIndex[data[0]] ? hot.sortIndex[data[0]][0] : data[0];

    clearTimeout(autosaveNotification);
    $.ajax({
      url: "<?= Yii::app()->request->baseUrl?>/product/update",
      dataType: 'json',
      type: 'POST',
      data: {changes: change}, // contains changed cells' data
      // TODO handling this auto save
      success: function (res) {
        console.log(res);
        $console.text('Autosaved (' + change.length + ' cell' + (change.length > 1 ? 's' : '') + ')');

        autosaveNotification = setTimeout(function () {
          $console.text('Changes will be autosaved');
        }, 1000);
      },
      error: function(err) {
        console.log(err);
      }
    });
  }
});

$parent.find('button[name=load]').click(function () {
  $.ajax({
    url: "<?= Yii::app()->request->baseUrl?>/product/load",
    dataType: 'json',
    type: 'GET',
    success: function (res) {
      // var data = [], row;
/*      console.log(res.cars);*/

      $console.text('Data loaded');
      hot.loadData(res.data);
    }
  });
}).click(); // execute immediately

$parent.find('button[name=save]').click(function () {
  $.ajax({
    url: "<?= Yii::app()->request->baseUrl?>/product/save",
    data: {data: hot.getData()}, // returns all cells' data
    dataType: 'json',
    type: 'POST',
    success: function (res) {
      console.log(res);
      if (res.result === 'ok') {
        $console.text('Data saved');
      }
      else {
        $console.text('Save error');
      }
    },
    error: function () {
      $console.text('Save error');
    }
  });
});

$parent.find('input[name=autosave]').click(function () {
  if ($(this).is(':checked')) {
    $console.text('Changes will be autosaved');
  }
  else {
    $console.text('Changes will not be autosaved');
  }
});



});



  // handson validator
 // settings1 = {
 //    data: people,
 //    beforeChange: function (changes, source) {
 //      for (var i = changes.length - 1; i >= 0; i--) {
 //        // gently don't accept the word "foo" (remove the change at index i)
 //        if (changes[i][3] === 'foo') {
 //          changes.splice(i, 1);
 //        }
 //        // if any of pasted cells contains the word "nuke", reject the whole paste
 //        else if (changes[i][3] === 'nuke') {
 //          return false;
 //        }
 //        // capitalise first letter in column 1 and 2
 //        else if ((changes[i][1] === 'name.first' || changes[i][1] === 'name.last') && changes[i][3].charAt(0)) {
 //          changes[i][3] = changes[i][3].charAt(0).toUpperCase() + changes[i][3].slice(1);
 //        }
 //      }
 //    },
 //    afterChange: function (changes, source) {
 //      if (source !== 'loadData') {
 //        example1console.innerText = JSON.stringify(changes);
 //      }
 //    },
 //    colHeaders: ['ID', 'First name', 'Last name', 'IP', 'E-mail'],
 //    columns: [
 //      {data: 'id', type: 'numeric'},
 //      {data: 'name.first'},
 //      {data: 'name.last'},
 //      {data: 'ip', validator: ipValidatorRegexp, allowInvalid: true},
 //      {data: 'email', validator: emailValidator, allowInvalid: false}
 //    ]
 //  };
 //  var hot = new Handsontable(example1, settings1);
</script>

</body>
</html>
