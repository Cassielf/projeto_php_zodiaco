<?php include('layouts/header.php'); ?>

<?php
// Recebe a data de nascimento do formulário
$data_nascimento = $_POST['data_nascimento'];

// Carrega o arquivo XML
$signos = simplexml_load_file("signos.xml");

// Extrai o dia e o mês da data de nascimento
list($ano, $mes, $dia) = explode('-', $data_nascimento);

// Converte a data para o formato "dia/mês" para comparação
$data_usuario = sprintf("%02d/%02d", $dia, $mes);

// Variável para armazenar o signo correspondente
$signo_encontrado = null;

// Percorre o XML para encontrar o signo correspondente
foreach ($signos->signo as $signo) {
    $data_inicio = DateTime::createFromFormat('d/m', $signo->dataInicio);
    $data_fim = DateTime::createFromFormat('d/m', $signo->dataFim);

    // Adiciona o ano atual para facilitar a comparação
    $data_inicio->setDate(date('Y'), $data_inicio->format('m'), $data_inicio->format('d'));
    $data_fim->setDate(date('Y'), $data_fim->format('m'), $data_fim->format('d'));

    // Ajusta para os signos que passam pelo ano novo
    if ($data_fim < $data_inicio) {
        $data_fim->modify('+1 year');
    }

    $data_usuario_dt = DateTime::createFromFormat('d/m', $data_usuario)->setDate(date('Y'), $mes, $dia);

    if ($data_usuario_dt >= $data_inicio && $data_usuario_dt <= $data_fim) {
        $signo_encontrado = $signo;
        break;
    }
}
?>

<div class="container mt-5">
    <?php if ($signo_encontrado): ?>
        <div class="card mx-auto" style="width: 18rem;">
            <img src="<?= $signo_encontrado->imagem ?>" class="card-img-top" alt="<?= $signo_encontrado->signoNome ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $signo_encontrado->signoNome ?></h5>
                <p class="card-text"><?= $signo_encontrado->descricao ?></p>
            </div>
        </div>
    <?php else: ?>
        <p class="text-center">Não foi possível determinar o signo. Verifique a data de nascimento.</p>
    <?php endif; ?>
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-dark">Voltar</a>
    </div>
</div>

<?php include('layouts/footer.php'); ?>
