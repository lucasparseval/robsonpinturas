<?php

function open_database()
{
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $erro) {
        throw $erro; // Retorne o erro para ser tratado onde a função for chamada
    }
}

function close_database($conn)
{
    try {
        $conn = null;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

function find($table = null, $id = null)
{
    $found = null;
    $database = open_database(); // Conexão

    try {
        if ($id) {
            $sql = "SELECT * FROM " . $table . " WHERE id = ?";
            $stmt = $database->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
        } else {
            $sql = "SELECT * FROM " . $table;
            $stmt = $database->prepare($sql);
        }

        $stmt->execute(); // Executa a consulta

        $found = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca todos os resultados
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    }
    return $found;
}


// Insere um registro no BD

function save($table = null, $data = null)
{
    $database = open_database();

    $columns = null;
    $values = null;

    foreach ($data as $key => $value) {
        $columns .= trim($key, "'") . ",";
        $values .= "'$value',";
    }

    $columns = rtrim($columns, ',');
    $values = rtrim($values, ',');

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    try {
        $stmt = $database->prepare($sql);
        $stmt->execute();

        $_SESSION['message'] = "Registro cadastrado com sucesso.";
        $_SESSION['type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

// Exemplo de uso da função save()
$data = [
    'nome' => 'Nome do Usuário',
    'email' => 'email@exemplo.com',
    'mensagem' => 'Mensagem de feedback aqui.'
];

// Chame a função save em um contexto apropriado
save('feedback', $data);


// Pesquisa Todos os Registros de uma Tabela

function find_all($table)
{
    return find($table);
}

function filter($table = null, $p = null)
{
    $found = null;
    $database = open_database(); // Conexão

    try {
        if ($p) {
            $stmt = $database->prepare("SELECT * FROM $table WHERE $p");
            $stmt->execute(); // Execute a consulta

            $found = $stmt->fetchAll(PDO::FETCH_ASSOC); // Busca todos os resultados

            if (empty($found)) {
                throw new Exception("Não foram encontrados registros de dados!");
            }
        }
    } catch (Exception $e) {
        $_SESSION["message"] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION["type"] = "danger";
    }

    return $found;
}

// Excluir Mensagem

function clear_messages()
{
    $_SESSION['message'] = null;
    $_SESSION['type'] = null;
}

// Criptografia 

function criptografia($senha)
{
    $custo = "08";
    $salt = "Cf1f11ePArKlBJomM0F6aJ";

    // Gera um hash baseado em bcrypt
    $hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");

    return $hash;
}

// Formata as datas do projeto

function formatadata($date, $formato)
{
    $dt = new DateTime($date, new DateTimeZone("America/Sao_Paulo"));
    return $dt->format($formato);
}

// Formata CEP
function formatacep($cep)
{
    $cp = substr($cep, 0, 5) . "-" . substr($cep, 5);
    return $cp;
}


