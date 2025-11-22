<?php
require_once 'Conn.php'; //arquivo de conexão

$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = getDbConnection();


    $full_name = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'] ?? '';


    $required_fields = ['nome', 'mae', 'cpf', 'bairro', 'cidade', 'estado', 'password'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $mensagem = '<div style="color: red;">Erro: O campo ' . $field . ' é obrigatório.</div>';
            goto end_form;
        }
    }

    if (!$email) {
        $mensagem = '<div style="color: red;">Erro: E-mail inválido.</div>';
        goto end_form;
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // 2. Preparação dos dados para Inserção
    // **************************************
    $data = [
        'nome'        => $full_name,
        'nascimento'  => $_POST['nascimento'] ?? null,
        'genero'      => $_POST['genero'] ?? null,
        'mae'         => $_POST['mae'],
        'cpf'         => $_POST['cpf'],
        'email'       => $email,
        'celular'     => $_POST['celular'] ?? null,
        'fixo'        => $_POST['fixo'] ?? null,
        'rua'         => $_POST['rua'] ?? null,
        'numero'      => $_POST['numero'] ?? null,
        'complemento' => $_POST['complemento'] ?? null,
        'cep'         => $_POST['cep'] ?? null,
        'bairro'      => $_POST['bairro'],
        'cidade'      => $_POST['cidade'],
        'estado'       => $_POST['estado'],
        'login'       => $login,
        'password'    => $hashed_password,
        'user_type'   => 'C'
    ];


    // 3. Inserção no Banco de Dados
    // *******************************
    $sql = "INSERT INTO users (nome, nascimento, genero, mae, cpf, email, celular, fixo, rua, numero, complemento, cep, bairro, cidade, estado, login, password, user_type)
            VALUES (:nome, :nascimento, :genero, :mae, :cpf, :email, :celular, :fixo, :rua, :numero, :complemento, :cep, :bairro, :cidade, :estado, :login, :password, :user_type)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        $mensagem = '<div style="color: green;">Usuário cadastrado com sucesso! <a href="login.php">Faça login</a>.</div>';
    } catch (PDOException $e) {
        // 1062 é o código de erro para chave duplicada (UNIQUE)
        if ($e->getCode() == '23000' && strpos($e->getMessage(), '1062') !== false) {
            $mensagem = '<div style="color: red;">Erro: Login, CPF ou E-mail já cadastrado.</div>';
        } else {
            // Outros erros
            $mensagem = '<div style="color: red;">Erro ao cadastrar: ' . $e->getMessage() . '</div>';
        }
    }
}

end_form:
?>

<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="website icon" type="png" href="../utils/imgProject.png">

    <link rel="stylesheet" href="../css/cadastro.css">

    <!-- Importando Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="../utils/gamepad.png" type="image/x-icon">

    <title>Cadastro - Responsivo</title>
</head>

<body>
    <div class="wrap" role="region" aria-label="Formulário de cadastro">
        <div class="info">
            <h2 style="text-align: center;">Criar conta</h2>
            <p style="text-align: center; color: wheat;">Preencha os dados ao lado e crie sua conta para aproveitar
                todos os nossos recursos..</p>
            <img src="../utils/img/imgProject-Photoroom.png" width="500px" alt="logo"
                style="filter: drop-shadow(30px 10px 4px #be44dd96); animation: fadein ease-in-out 4s;">
        </div>

        <form action="Cadastro.php" method="post" id="form">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <h3 style="margin:0; color: rgba(240, 248, 255, 0.582);">Cadastro</h3>
                <div class="small">Já tem conta? <a href="login.php" class="link">Entrar</a>
                </div>
            </div>

            <div class="grid">
                <div class="field full input-box">
                    <input id="nome" name="nome" type="text" placeholder=" " />
                    <label for="nome">Nome completo *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="nascimento" name="nascimento" type="date" placeholder=" " />
                    <label for="nascimento">Data de nascimento *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <select id="genero" name="genero">
                        <option value="" selected hidden></option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                        
                    </select>
                    <label for="genero">Gênero *</label>
                    <span class="error"></span>
                </div>

                <div class="field full input-box">
                    <input id="NomeMae" name="mae" type="text" placeholder=" " />
                    <label for="mae">Nome da mãe *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="cpf" name="cpf" type="text" placeholder=" " inputmode="numeric" maxlength="14" />
                    <label for="cpf">CPF *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="email" name="email" type="email" placeholder=" " />
                    <label for="email">E-mail *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="celular" name="celular" type="tel" placeholder=" " inputmode="tel" maxlength="15" />
                    <label for="celular">Telefone celular *</label>
                    <span class="error"></span>
                </div>

                <div class="field">
                    <input id="fixo" name="fixo" type="tel" placeholder=" " inputmode="tel" maxlength="14" />
                    <label for="fixo">Telefone fixo</label>
                </div>

                <div class="field">
                    <input id="cep" name="cep" type="text" placeholder=" " maxlength="9" inputmode="numeric" />
                    <label for="cep">CEP</label>
                </div>

                <div class="field input-box">
                    <input id="bairro" name="bairro" type="text" placeholder=" " />
                    <label for="bairro">Bairro *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="cidade" name="cidade" type="text" placeholder=" " />
                    <label for="cidade">Cidade *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="estado" name="estado" type="text" placeholder=" " />
                    <label for="estado">UF *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="rua" name="rua" type="text" placeholder=" " />
                    <label for="rua">Endereço *</label>
                    <span class="error"></span>
                </div>

                <div class="field input-box">
                    <input id="numero" name="numero" type="text" placeholder=" " />
                    <label for="numero">Número *</label>
                    <span class="error"></span>                    
                </div>

                <div class="field">
                    <input id="complemento" name="complemento" type="text" placeholder=" " />
                    <label for="complemento">Complemento</label>
                </div>

                <div class="field full input-box">
                    <input id="login" name="login" type="text" placeholder=" " />
                    <label for="login">Login *</label>
                    <span class="error"></span>
                </div>

                <div class="field full input-box">
                    <input id="password" name="password" type="password" placeholder=" " minlength="6" />
                    <label for="password">password *</label>
                    <span class="error"></span>
                </div>

            </div>

            <div style="font-size:13px;color:var(--muted);">* Campos obrigatórios</div>
            <div class="actions">
                <button type="submit" class="btn">Criar conta</button>
                <button type="reset" class="ghost">Limpar</button>
            </div>
            <?php echo $mensagem; ?>
        </form>
    </div>

    <script>
    /*
    function maskCEP(v){
      v = onlyDigits(v).slice(0,8);
      return v.replace(/(\d{5})(\d{0,3})/, (_,a,b)=> a + (b?'-'+b:''));
    }

    const cpfEl = document.getElementById('cpf');
    if(cpfEl) cpfEl.addEventListener('input', e=>{ const s = cpfEl.selectionStart; cpfEl.value = maskCPF(cpfEl.value); cpfEl.setSelectionRange(s,s); });
*/

    const cepEl = document.getElementById('cep');
    if (cepEl) cepEl.addEventListener('input', e => {
        const s = cepEl.selectionStart;
        cepEl.value = maskCEP(cepEl.value);
        cepEl.setSelectionRange(s, s);
    });


    cepEl.addEventListener('blur', async () => {
        const cep = onlyDigits(cepEl.value);
        if (cep.length !== 8) return;
        try {
            const res = await fetch('https://viacep.com.br/ws/' + cep + '/json/');
            const data = await res.json();
            if (!data.erro) {
                document.getElementById('rua').value = data.logradouro || '';
                document.getElementById('bairro').value = data.bairro || '';
                document.getElementById('cidade').value = data.localidade || '';
            }
        } catch (err) {
            console.warn('Erro ao consultar CEP', err)
        }
    });
    </script>

</body>

</html>