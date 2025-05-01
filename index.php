<?php include('layouts/header.php'); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Descubra Seu Signo do Zodíaco</h3>
                </div>
                <div class="card-body">
                    <p class="lead mb-4">Para descobrir qual é o seu signo, preencha sua data de nascimento no campo abaixo.</p>
                    
                    <form id="signo-form" method="POST" action="show_zodiac_sign.php">
                        <div class="mb-4">
                            <label for="data_nascimento" class="form-label fw-bold">Data de Nascimento:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                                <input type="date" class="form-control form-control-lg" 
                                       id="data_nascimento" name="data_nascimento" 
                                       required
                                       max="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="form-text">Selecione a data em que você nasceu para descobrir seu signo.</div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-search me-2"></i>Descobrir Meu Signo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Adiciona Bootstrap Icons e JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="assets/css/style.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Define a data máxima como hoje
    const dataInput = document.getElementById('data_nascimento');
    
    // Define uma data padrão (opcional - 1º de janeiro do ano atual)
    const hoje = new Date();
    const dataDefault = hoje.getFullYear() + '-01-01';
    dataInput.value = dataDefault;
    
    // Validação do formulário
    const form = document.getElementById('signo-form');
    form.addEventListener('submit', function(event) {
        if (!dataInput.value) {
            event.preventDefault();
            alert('Por favor, selecione sua data de nascimento.');
            dataInput.focus();
        }
    });
});
</script>
</body>
</html>