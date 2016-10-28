<?php include '../header.php'; ?>
<?php include '../sidebar.php'; ?>
<?php include '../content.php'; ?>
<h1>Add Data in Database</h1>
<?php
include 'select-data.php';

if (is_array($data) || is_object($data)) {
  foreach($data as $row) {
    $dataPoints[] = $row;
  }
}
?>

<button id="post" value="Adicionar Informações Aleatórias">Adicionar Informações Aleatórias</button>

<?php
echo '<pre>';
var_dump($dataPoints);
echo '</pre>';
echo json_encode($dataPoints, JSON_NUMERIC_CHECK) . '<br>';
?>

<script type="text/javascript">
var i = 0;
'<%Session["i"] = "' + i + '"; %>';
var id, data, hora, dado, cod, dados = [], j;
function addItem() {
  if (i == 0) {
    dados.push({
      "data" : getData(),
      "hora" : getHora(),
      "dado" : (Math.random()*2.14) + 0.1,
      "cod" : "UL0",
    });
  } else {
    dados.pop();
    dados.push({
      "data" : getData(),
      "hora" : getHora(),
      "dado" : (Math.random()*2.14) + 0.1,
      "cod" : "UL0",
    });
  }
  // console.log(dados);
  // console.log(i);
  j = JSON.stringify(dados);
  // console.log(j);
  i++;
  // return j;
}

function getData() {
  var today = new Date();
  var d = today.getDate();
  var m = today.getMonth()+1; //January is 0!
  var y = today.getFullYear();

  if (d < 10) {
    d = '0' + d;
  } 

  if (m < 10) {
    m = '0' + m;
  } 

  return (y+'-'+m+'-'+d);
}

function getHora() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();

  if (h < 10) {
    h = '0' + h;
  } 

  return (h+':'+m+':'+s);
}

function pegarDados() {
  addItem();
  $.ajax({
    url: "insert-data.php",
    data: {"dados": dados},
    type: "post",
    success: function(data) {
      location.reload();
    }
  });
}

$("#post").click(function() {
 // clearInterval(v);
 pegarDados();
 // profundidade.shift();
});
</script>

<?php include '../footer.php'; ?>