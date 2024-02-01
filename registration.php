<?php
$pdo = new PDO('mysql:host=localhost;dbname=projeto', 'root', 'nova_senha');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['firstName'])) {
  $foto_base64 = null;

  if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] === UPLOAD_ERR_OK) {
    $foto_base64 = base64_encode(file_get_contents($_FILES['profilePicture']['tmp_name']));
  }

  $sql = $pdo->prepare("INSERT INTO registro (firstName, rg, cpf, email, dob, zip, city, state, street, foto_base64) VALUES (?,?,?,?,?,?,?,?,?,?)");

  $sql->execute(array(
    $_POST['firstName'],
    $_POST['rg'],
    $_POST['cpf'],
    $_POST['email'],
    $_POST['dob'],
    $_POST['zip'],
    $_POST['city'],
    $_POST['state'],
    $_POST['street'],
    $foto_base64,
  ));
  echo 'Inserido com sucesso!';
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Registro</title>
  <link rel="stylesheet" href="./style.css">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
</head>

<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Controle de Acesso Turotest</h5>
          </div>
          <div class="card-body">
            <form method="post" class="needs-validation">
              <div class="mb-3">
                <label for="firstName" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Seu nome" required>
                <div class="invalid-feedback">
                  Por favor, insira seu nome.
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="rg" class="form-label">RG</label>
                  <input type="text" class="form-control" id="rg" name="rg" placeholder="RG" required>
                  <div class="invalid-feedback">
                    Por favor, insira seu CPF.
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cpf" class="form-label">CPF</label>
                  <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                </div>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Endereço de Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="seuemail@example.com" required>
                <div class="invalid-feedback">
                  Por favor, insira um endereço de email válido.
                </div>
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
                <div class="invalid-feedback">
                  Por favor, insira sua data de nascimento.
                </div>
              </div>
              <hr class="mb-4">

              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="zip" class="form-label">CEP</label>
                  <input type="text" class="form-control" id="zip" name="zip" placeholder="Seu CEP">
                  <div class="invalid-feedback">
                    Por favor, insira seu CEP.
                  </div>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="city" class="form-label">Cidade</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Sua cidade">
                </div>
                <div class="col-md-4 mb-3">
                  <label for="state" class="form-label">Estado</label>
                  <select class="form-select" id="state" name="state" required>
                    <option value="">Selecione...</option>
                    <option value="AC">Acre</option>
                    <option value="AL">Alagoas</option>
                    <option value="AP">Amapá</option>
                    <option value="AM">Amazonas</option>
                    <option value="BA">Bahia</option>
                    <option value="CE">Ceará</option>
                    <option value="DF">Distrito Federal</option>
                    <option value="ES">Espírito Santo</option>
                    <option value="GO">Goiás</option>
                    <option value="MA">Maranhão</option>
                    <option value="MT">Mato Grosso</option>
                    <option value="MS">Mato Grosso do Sul</option>
                    <option value="MG">Minas Gerais</option>
                    <option value="PA">Pará</option>
                    <option value="PB">Paraíba</option>
                    <option value="PR">Paraná</option>
                    <option value="PE">Pernambuco</option>
                    <option value="PI">Piauí</option>
                    <option value="RJ">Rio de Janeiro</option>
                    <option value="RN">Rio Grande do Norte</option>
                    <option value="RS">Rio Grande do Sul</option>
                    <option value="RO">Rondônia</option>
                    <option value="RR">Roraima</option>
                    <option value="SC">Santa Catarina</option>
                    <option value="SP">São Paulo</option>
                    <option value="SE">Sergipe</option>
                    <option value="TO">Tocantins</option>
                  </select>
                  <div class="invalid-feedback">
                    Por favor, selecione um estado.
                  </div>
                </div>

                <div class="mb-3">
                  <label for="street" class="form-label">Endereço</label>
                  <input type="text" class="form-control" id="street" name="street" placeholder="Sua rua e número">
                </div>
              </div>
              <hr class="mb-4">
              <div class="mb-3">
                <label for="profilePicture" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="profilePicture" name="profilePicture" accept="image/*" onchange="convertToBase64(this)">
                <input type="hidden" id="base64Image" name="base64Image">
                <div id="profilePictureHelp" class="form-text">Selecione uma imagem do seu dispositivo.</div>
              </div>

              <hr class="mb-4">

              <div class="d-grid">
                <button class="btn btn-primary btn-lg" type="submit">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
  <script>
    (function() {
      'use strict'

      var forms = document.querySelectorAll('.needs-validation')

      Array.prototype.slice.call(forms)
        .forEach(function(form) {
          form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()

    function convertToBase64(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('base64Image').value = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>