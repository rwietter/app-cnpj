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
      justify-content: center;
      align-items: center;
      flex-flow: column;
      min-height: 100vh;
    }

    .wrapper {
      width: 360px;
      padding: 20px;
      height: 100%;
    }

    form {
      display: flex;
      width: 100%;
      flex-flow: column;
      justify-content: center;
      align-items: center;
    }

    .data {
      height: 100%;
    }

    .atividades {
      height: 100%;
    }
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
  session_start();

  if (isset($_POST['submit'])) {
    $cnpj = $_POST['cnpj'];
    $_SESSION['cnpj'] = $cnpj;
    header("Location: data.php");
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
