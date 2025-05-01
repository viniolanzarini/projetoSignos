<?php include('layouts/header.php'); ?>

<?php
// Verificar se o formulário foi enviado
if (!isset($_POST['data_nascimento']) || empty($_POST['data_nascimento'])) {
    header('Location: index.php');
    exit;
}

// Obter e processar a data de nascimento
$data_nascimento = $_POST['data_nascimento'];
$timestamp = strtotime($data_nascimento);
$dia = date('d', $timestamp);
$mes = date('m', $timestamp);

// Carregar o arquivo XML
$signos = simplexml_load_file("signos.xml");
if ($signos === false) {
    die("Erro ao carregar o arquivo XML dos signos.");
}

// Inicializar variável para armazenar o signo encontrado
$signo_encontrado = null;

// Debug info
$debug_info = [];
$debug_info[] = "Data de Nascimento: $dia/$mes";

// Verificar cada signo
foreach ($signos->signo as $signo) {
    // Extrair dia e mês das datas de início e fim
    list($dia_inicio, $mes_inicio) = explode('/', (string)$signo->dataInicio);
    list($dia_fim, $mes_fim) = explode('/', (string)$signo->dataFim);
    
    // Converter para valores numéricos
    $dia_inicio = (int)$dia_inicio;
    $mes_inicio = (int)$mes_inicio;
    $dia_fim = (int)$dia_fim;
    $mes_fim = (int)$mes_fim;
    $dia_nascimento = (int)$dia;
    $mes_nascimento = (int)$mes;
    
    $debug_info[] = "Verificando " . $signo->signoNome . ": $dia_inicio/$mes_inicio até $dia_fim/$mes_fim";
    
    // Caso especial: signo que cruza o ano (Capricórnio por exemplo)
    if ($mes_inicio > $mes_fim || ($mes_inicio == $mes_fim && $dia_inicio > $dia_fim)) {
        // Se a data de nascimento for depois da data inicial OU antes da data final
        if (($mes_nascimento > $mes_inicio || ($mes_nascimento == $mes_inicio && $dia_nascimento >= $dia_inicio)) || 
            ($mes_nascimento < $mes_fim || ($mes_nascimento == $mes_fim && $dia_nascimento <= $dia_fim))) {
            
            $signo_encontrado = $signo;
            $debug_info[] = "✓ Encontrado (signo que cruza o ano)";
            break;
        }
    } else {
        // Caso normal: signo dentro do mesmo ano
        if (($mes_nascimento > $mes_inicio || ($mes_nascimento == $mes_inicio && $dia_nascimento >= $dia_inicio)) && 
            ($mes_nascimento < $mes_fim || ($mes_nascimento == $mes_fim && $dia_nascimento <= $dia_fim))) {
            
            $signo_encontrado = $signo;
            $debug_info[] = "✓ Encontrado (signo normal)";
            break;
        }
    }
}

// Formato de data para exibição
$data_formatada = date('d/m/Y', $timestamp);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Resultado da Consulta</h3>
                </div>
                <div class="card-body">
                    <p class="lead">Data de Nascimento: <strong><?= $data_formatada; ?></strong></p>
                    
                    <?php if ($signo_encontrado): ?>
                        <div class="text-center mb-4">
                            <h2 class="display-4"><?= $signo_encontrado->signoNome; ?></h2>
                            <p class="text-muted">
                                <?= $signo_encontrado->dataInicio; ?> a <?= $signo_encontrado->dataFim; ?>
                            </p>
                        </div>
                        
                        <div class="alert alert-info">
                            <h4 class="alert-heading">Características:</h4>
                            <p class="mb-0"><?= $signo_encontrado->descricao; ?></p>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <h4 class="alert-heading">Ops!</h4>
                            <p>Não foi possível identificar seu signo.</p>
                        </div>
                        
                        <!-- Informações de debug para facilitar a solução de problemas -->
                        <div class="card mt-3">
                            <div class="card-header">Informações de Debug</div>
                            <div class="card-body">
                                <pre><?= implode("\n", $debug_info); ?></pre>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-grid gap-2 mt-4">
                        <a href="index.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS e Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</body>
</html>