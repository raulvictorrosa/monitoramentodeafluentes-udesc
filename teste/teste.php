<?php
// Consultar dados
$dados = array();

$pdo = new PDO('mysql:host=127.0.0.1:3306;dbname=monitoramentodeafluentes', 'root', 'root');
$sql = 'SELECT idEvento_dad as id, data, hora, dados as profundidade, Sensor_codSensor as codSensor, COUNT(*) as qtd FROM `monitoramentodeafluentes`.`evento_dados` WHERE Sensor_codSensor = "UL0" ORDER BY data, hora #LIMIT 20';
$stmt = $pdo->query($sql);
while ($obj = $stmt->fetchObject()) {
  // if ($obj->data) { $dados['Data'] = $obj->data; }
  // if ($obj->hora) { $dados['Hora'] = $obj->hora; }
  if ($obj->profundidade) { $dados['Profundidade'] = $obj->profundidade; }
  /*switch ($obj->sexo) {
  case 'M':
    $dados['Homens'] = $obj->quantidade;
    break;
  case 'F':
    $dados['Mulheres'] = $obj->quantidade;
    break;
  }*/
}

// Dados do gráfico
// $dados = array('HTML' => 60,'CSS'  => 40);
$titulo = 'Quantidade de Profundidade';
$tipo = 'bvo';
$largura = 500;
$altura = 100;

// echo gerar_grafico_torta($dados, $titulo, $tipo, $largura, $altura);

/**
 * Imprime um grafico de torta
 * @param array[string => int] $dados: Dados do Grafico
 * @param string $titulo: Titulo do grafico
 * @param int $largura: Largura do grafico
 * @param int $altura: Altura do grafico
 * @return string Tag IMG com o caminho para o grafico
 */

// $url = 'https://chart.googleapis.com/chart?'.http_build_query($grafico, '', '&amp;');
function gerar_grafico_torta($dados, $titulo, $tipo, $largura, $altura) {

    // Gerando a URL dinamicamente
    $labels = array_keys($dados);
    $valores = array_values($dados);

    // Converter valores para porcentagens
    /*$soma = array_sum($valores);
    $percentual = array();
    foreach ($valores as $valor) {
        $percentual[] = round($valor * 100 / $soma);
    }*/

    $grafico = array(
        'cht' => $tipo,
        'chs'  => $largura.'x'.$altura,
        // 'chd'  => 't:'.implode(',', $percentual),
        'chd'  => 't:'.implode(',', $valores),
        'chl'  => implode('|', $labels)
    );
    $url = 'https://chart.googleapis.com/chart?'.http_build_query($grafico, '', '&');
    // echo $url;

    // Imprimindo o gráfico
    return sprintf('<img src="%s" width="%d" height="%d" alt="%s" />',
        $url, $largura, $altura, htmlentities($titulo, ENT_COMPAT, 'UTF-8')
    );
}
?>