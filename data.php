<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dados da empresa</title>
</head>

<body>
  <?php
  session_start();
  $cnpj = $_SESSION['cnpj'];
  $data_string = json_encode([$cnpj]);

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
  $tipo = $data->tipo;
  $nome = $data->nome;
  $uf = $data->uf;
  $telefone = $data->telefone;
  $email = $data->email;
  $situacao = $data->situacao;
  $bairro = $data->bairro;
  $logradouro = $data->logradouro;
  $numero = $data->numero;
  $cep = $data->cep;
  $municipio = $data->municipio;
  $abertura = $data->abertura;
  $natureza_juridica = $data->natureza_juridica;
  $fantasia = $data->fantasia;
  $cnpj = $data->cnpj;
  $status = $data->status;
  $atividades_secundarias = $data->atividades_secundarias;

  echo "
      <div class='data'>
        <br><hr><br>
        <strong>Data de abertura:</strong> <span>$data_situacao</span><p></p>
        <strong>Atividade principal descrição:</strong> <span>$atividade_principal_descrição</span><p></p>
        <strong>Código atividade principal:</strong> <span>$atividade_principal_code</span><p></p>
        <strong>Tipo:</strong><span>$tipo</span><p></p>
        <strong>CNPJ:</strong><span>$cnpj</span><p></p>
        <strong>Natureza Juridica:</strong><span>$natureza_juridica</span><p></p>
        <strong>Status:</strong><span>$status</span><p></p>
        <strong>Nome Empresarial:</strong><span>$nome</span><p></p>
        <strong>Nome Fantasia:</strong><span>$fantasia</span><p></p>
        <strong>Telefone:</strong><span>$telefone</span><p></p>
        <strong>Email:</strong><span>$email</span><p></p>
        <strong>Logradouro:</strong><span>$logradouro</span><p></p>
        <strong>Número:</strong><span>$numero</span><p></p>
        <strong>Bairro:</strong><span>$bairro</span><p></p>
        <strong>Municipio:</strong><span>$municipio</span><p></p>
        <strong>CEP:</strong><span>$cep</span><p></p>
        <strong>UF:</strong><span>$uf</span><p></p>
        <strong>Situacao:</strong><span>$situacao</span><p></p>
        
      </div>
    ";
  foreach ($atividades_secundarias as $atividade_secundaria) {
    $atividade_secundaria_descrição = $atividade_secundaria->text;
    $atividade_secundaria_code = $atividade_secundaria->code;
    echo "
        <div class='atividades'>
          <strong>Atividade secundaria descrição:</strong> <span>$atividade_secundaria_descrição</span><p></p>
          <strong>Atividade secundaria código:</strong> <span>$atividade_secundaria_code</span><p></p>
        </div>
      ";
  }
  curl_close($ch);
  ?>
</body>

</html>
