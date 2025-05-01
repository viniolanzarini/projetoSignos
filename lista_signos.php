<?php include('layouts/header.php'); ?>

<?php
// Carregar o arquivo XML
$signos = simplexml_load_file("signos.xml");
if ($signos === false) {
    die("Erro ao carregar o arquivo XML dos signos.");
}

// Mapear elementos para classes CSS
$elemento_classes = [
    'Fogo' => 'elemento-fogo',
    'Terra' => 'elemento-terra',
    'Ar' => 'elemento-ar',
    'Água' => 'elemento-agua'
];
?>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-center mb-4">Conheça Todos os Signos do Zodíaco</h2>
            <p class="lead text-center">Explore as características e peculiaridades de cada signo.</p>
        </div>
    </div>
    
    <div class="row">
        <?php foreach ($signos->signo as $signo): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 signo-card">
                    <div class="card-header bg-primary text-white text-center">
                        <?php if(isset($signo->simbolo) && !empty($signo->simbolo)): ?>
                            <span class="signo-simbolo"><?= $signo->simbolo; ?></span>
                        <?php endif; ?>
                        <h3 class="card-title mb-0"><?= $signo->signoNome; ?></h3>
                    </div>
                    
                    <div class="card-body">
                        <?php if(isset($signo->imagemURL) && !empty($signo->imagemURL)): ?>
                            <img src="<?= $signo->imagemURL; ?>" alt="Símbolo de <?= $signo->signoNome; ?>" class="signo-image">
                        <?php endif; ?>
                        
                        <div class="mb-3 text-center">
                            <span class="badge bg-light text-dark"><?= $signo->dataInicio; ?> a <?= $signo->dataFim; ?></span>
                            
                            <?php if(isset($signo->elemento) && !empty($signo->elemento)): ?>
                                <span class="badge <?= $elemento_classes[(string)$signo->elemento] ?? 'bg-secondary'; ?>">
                                    <?= $signo->elemento; ?>
                                </span>
                            <?php endif; ?>
                            
                            <?php if(isset($signo->planeta) && !empty($signo->planeta)): ?>
                                <span class="badge bg-info text-dark">
                                    <?= $signo->planeta; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <p class="card-text">
                            <?= substr($signo->descricao, 0, 150); ?>...
                        </p>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm" 
                                data-bs-toggle="modal" data-bs-target="#signoModal<?= str_replace(' ', '', $signo->signoNome); ?>">
                            Ler mais
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Modal para cada signo -->
            <div class="modal fade" id="signoModal<?= str_replace(' ', '', $signo->signoNome); ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <?php if(isset($signo->simbolo) && !empty($signo->simbolo)): ?>
                                    <?= $signo->simbolo; ?>
                                <?php endif; ?>
                                <?= $signo->signoNome; ?>
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if(isset($signo->imagemURL) && !empty($signo->imagemURL)): ?>
                                <img src="<?= $signo->imagemURL; ?>" alt="Símbolo de <?= $signo->signoNome; ?>" class="signo-image">
                            <?php endif; ?>
                            
                            <div class="text-center mb-3">
                                <span class="badge bg-light text-dark"><?= $signo->dataInicio; ?> a <?= $signo->dataFim; ?></span>
                                
                                <?php if(isset($signo->elemento) && !empty($signo->elemento)): ?>
                                    <span class="badge <?= $elemento_classes[(string)$signo->elemento] ?? 'bg-secondary'; ?>">
                                        <?= $signo->elemento; ?>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if(isset($signo->planeta) && !empty($signo->planeta)): ?>
                                    <span class="badge bg-info text-dark">
                                        <?= $signo->planeta; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <p><?= $signo->descricao; ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <div class="row mt-4">
        <div class="col-12 text-center">
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-search me-2"></i>Descobrir Meu Signo
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS e Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</body>
</html>