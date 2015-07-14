<?php /* @var $this Controller */ 
// die('hard');
?>
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
  .pad2 {
      margin: auto;
      width: 80%;
      border:3px solid #8AC007;
      padding: 10px;
  }
  </style>
</head>

<body>

<div id='content2'>

    <div class="pad2" data-jsfiddle="example2">
      <h2>PHP example</h2>

      <p>
        <button name="load">Load</button>
        <button name="save">Save</button>
        <button name="reset">Reset</button>
        <label><input type="checkbox" name="autosave" checked="checked" autocomplete="off"> Autosave</label>
      </p>

      <div id="exampleConsole" class="console">Click "Load" to load data from server</div>

      <div id="example2" class="hot"></div>

      <p>
        <button name="dump" data-dump="#example2" data-instance="hot" title="Prints current data source to Firebug/Chrome Dev Tools">
          Dump data to console
        </button>
      </p>
  </div>
</div>

<script type="text/javascript" charset="utf-8">

 var people = [
      {id: 1, name: {first: 'Joe', last: 'Fabiano'}, ip: '0.0.0.1', email: 'Joe.Fabiano@ex.com'},
      {id: 2, name: {first: 'Fred', last: 'Wecler'}, ip: '0.0.0.1', email: 'Fred.Wecler@ex.com'},
      {id: 3, name: {first: 'Steve', last: 'Wilson'}, ip: '0.0.0.1', email: 'Steve.Wilson@ex.com'},
      {id: 4, name: {first: 'Maria', last: 'Fernandez'}, ip: '0.0.0.1', email: 'M.Fernandez@ex.com'},
      {id: 5, name: {first: 'Pierre', last: 'Barbault'}, ip: '0.0.0.1', email: 'Pierre.Barbault@ex.com'},
      {id: 6, name: {first: 'Nancy', last: 'Moore'}, ip: '0.0.0.1', email: 'Nancy.Moore@ex.com'},
      {id: 7, name: {first: 'Barbara', last: 'MacDonald'}, ip: '0.0.0.1', email: 'B.MacDonald@ex.com'},
      {id: 8, name: {first: 'Wilma', last: 'Williams'}, ip: '0.0.0.1', email: 'Wilma.Williams@ex.com'},
      {id: 9, name: {first: 'Sasha', last: 'Silver'}, ip: '0.0.0.1', email: 'Sasha.Silver@ex.com'},
      {id: 10, name: {first: 'Don', last: 'Pérignon'}, ip: '0.0.0.1', email: 'Don.Pérignon@ex.com'},
      {id: 11, name: {first: 'Aaron', last: 'Kinley'}, ip: '0.0.0.1', email: 'Aaron.Kinley@ex.com'}
    ],
    example2 = document.getElementById('example2'),
    example2console = document.getElementById('example2console'),
    settings1,
    ipValidatorRegexp,
    emailValidator;

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

  settings1 = {
    data: people,
    beforeChange: function (changes, source) {
      for (var i = changes.length - 1; i >= 0; i--) {
        // gently don't accept the word "foo" (remove the change at index i)
        if (changes[i][3] === 'foo') {
          changes.splice(i, 1);
        }
        // if any of pasted cells contains the word "nuke", reject the whole paste
        else if (changes[i][3] === 'nuke') {
          return false;
        }
        // capitalise first letter in column 1 and 2
        else if ((changes[i][1] === 'name.first' || changes[i][1] === 'name.last') && changes[i][3].charAt(0)) {
          changes[i][3] = changes[i][3].charAt(0).toUpperCase() + changes[i][3].slice(1);
        }
      }
    },
    afterChange: function (changes, source) {
      if (source !== 'loadData') {
        example2console.innerText = JSON.stringify(changes);
      }
    },
    colHeaders: ['ID', 'First name', 'Last name', 'IP', 'E-mail'],
    columns: [
      {data: 'id', type: 'numeric'},
      {data: 'name.first'},
      {data: 'name.last'},
      {data: 'ip', validator: ipValidatorRegexp, allowInvalid: true},
      {data: 'email', validator: emailValidator, allowInvalid: false}
    ]
  };
  var hot = new Handsontable(example2, settings1);

</script>

</body>
</html>

