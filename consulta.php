<!DOCTYPE html>
<html lang="pt-br">

<head>

  <title>Consulta CNPJ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      font: 14px sans-serif;
      display: flex;
      width: 100vw;
      height: 100vh;
      justify-content: center;
      align-items: center;
      flex-flow: column;
    }

    .wrapper {
      width: 360px;
      padding: 20px;
    }

    form {
      display: flex;
      width: 100%;
      flex-flow: column;
      justify-content: center;
      align-items: center;
    }

    .data {}
  </style>
</head>

<body>
  <form method="post">
    <h3>Por favor preencha o campo para consultar o CNPJ.</h3>
    <div class="form-group">
      <label>CNPJ: </label>
      <input type="text" name="cnpj" maxlength="14" />
    </div>

    <div class="form-group">
      <button name="submit" type="submit" class="btn btn-primary">Consultar</button>
      <input type="reset" class="btn btn-secondary ml-2" value="Limpar">
      <button class="btn btn-secondary ml-2" class="reload">Atualizar página</button>
    </div>
  </form>
  <?php
  if (isset($_POST['submit'])) {
    $data = $_POST['cnpj'];
    $data_string = json_encode([$data]);

    $ch = curl_init('http://localhost:3333/receita');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
      $ch,
      CURLOPT_HTTPHEADER,
      array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string)
      )
    );

    $data_cnpj = curl_exec($ch) . "\n";
    $dados = json_decode($data_cnpj);
    $data = $dados->result;
    $data_situacao = $data->data_situacao;
    $atividade_principal_descrição = $data->atividade_principal[0]->text;
    $atividade_principal_code = $data->atividade_principal[0]->code;
    echo "
      <div class='data'>
        <br><hr><br>
        <strong>Data de situação:</strong> <span>$data_situacao</span><p></p>
        <strong>Atividade principal descrição:</strong> <span>$atividade_principal_descrição</span><p></p>
        <strong>Atividade principal código:</strong> <span>$atividade_principal_code</span><p></p>
      </div>
    ";
    curl_close($ch);
  }
  ?>
</body>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
  const target = document.querySelector('.reload')
  target.addEventListener('click', () => {
    document.location.reload(true);
  })
</script>

</html>
