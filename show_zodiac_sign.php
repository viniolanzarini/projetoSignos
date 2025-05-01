<?php include('layouts/header.php'); ?>

<?php
$data_nascimento = $_POST['data_nascimento'];
$data_formatada = date("d/m", strtotime($data_nascimento));
$signos = simplexml_load_file("signos.xml");

$signo_encontrado = null;
foreach ($signos->signo as $signo) {
    $inicio = DateTime::createFromFormat('d/m', $signo->dataInicio);
    $fim = DateTime::createFromFormat('d/m', $signo->dataFim);
    $nascimento = DateTime::createFromFormat('d/m', $data_formatada);

    if ($nascimento >= $inicio && $nascimento <= $fim) {
        $signo_encontrado = $signo;
        break;
    }
}
?>

<div class="container mt-5">
    <?php if ($signo_encontrado): ?>
        <h2>Seu Signo é: <?= $signo_encontrado->signoNome; ?></h2>
        <p><?= $signo_encontrado->descricao; ?></p>
    <?php else: ?>
        <p>Não foi possível identificar seu signo.</p>
    <?php endif; ?>
    <a href="index.php" class="btn btn-secondary">Voltar</a>
</div>

</body>
</html>
