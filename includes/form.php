<div class="jumbotron bg-white text-dark">
    <h2>Esconder mensagem</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem" class="form-control">
        </div>

        <div class="form-group">
            <label>Mensagem</label>
            <input type="text" name="texto" class="form-control">
        </div>

        <div class="form-group">
            <button name="esconder" class="btn btn-success">Esconder mensagem</button>
        </div>
    </form>
</div>

<hr class="border-light">

<div class="jumbotron bg-white text-dark">
    <h2>Ler mensagem</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Imagem</label>
            <input type="file" name="imagem" class="form-control">
        </div>

        <div class="form-group">
            <button name="let" class="btn btn-success">Ler mensagem</button>
        </div>
    </form>
</div>