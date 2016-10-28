<?php include 'header.php'; ?>
<div class="container">
  <div class="row">
      <div class="col-sm-12">
        <h1>Adicionar Dado fictício na Tabela</h1>
        <?php
        include 'select-data-prof.php';

        if (is_array($data) || is_object($data)) {
          foreach($data as $row) {
            $dataPoints[] = $row;
          }
        }
        ?>

        <button id="post" class="btn btn-default">Adicionar Informações Fictícia</button>
        <div style="margin-top: 20px"></div>

        <?php var_dump($dataPoints); echo '<pre>' . json_encode($dataPoints, JSON_NUMERIC_CHECK) . '</pre>'; ?>

        <script type="text/javascript">
        var i = 0;
        // window.onbeforeunload = function(e) {
        //   document.cookie = 'var i=; expires=' + d.toGMTString() + ';';
        // };
        // document.cookie = "var i="+i+';';
        var data, hora, dado, cod, dados = [], j;
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
          console.log(j);
          $.ajax({
            url: "insert-data-prof.php",
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
      </div>
  </div>
</div>

<?php include 'footer.php'; ?>