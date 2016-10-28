<?php
//execute query
try {
  $data->execute();
  $data->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
  if ($e->getCode() == '42S02') {
    die('<div class="alert alert-danger" style="margin:1%;">'
      . 'Base table or view not found.<br><br>'
      . 'ERROR: ' . $e->getMessage()
    . '</div>');
  }
  if ($e->getCode() == '42S22') {
    die('<div class="alert alert-danger" style="margin:1%;">'
      . 'Column not found.<br><br>'
      . 'ERROR: ' . $e->getMessage()
    . '</div>');
  }
}
