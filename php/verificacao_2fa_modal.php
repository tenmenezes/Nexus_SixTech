<?php

// Array com as opções de coluna
$opcoes_coluna = ['cpf', 'nascimento', 'mae'];
$opcoes_pergunta = [
    'cpf' => "Qual o seu CPF?",
    'nascimento' => "Qual a sua data de nascimento (AAAA-MM-DD)?", // Adicionei formato
    'mae' => "Qual o nome da sua mãe?"
];

// Gera um índice aleatório: 0, 1 ou 2
$indice_aleatorio = rand(0, 2);

// Seleciona o nome da coluna no banco
$coluna_escolhida = $opcoes_coluna[$indice_aleatorio];

// Define a pergunta a ser exibida
$pergunta_a_exibir = $opcoes_pergunta[$coluna_escolhida];

// 🚨 SEGURANÇA: Armazena a coluna escolhida na sessão. 
// O script de processamento usará isso para saber qual campo buscar no DB.
$_SESSION['2fa_column'] = $coluna_escolhida;
