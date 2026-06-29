<?php
namespace Admin\View;
use Admin\Model\Portfolio;

class PortfolioView {

    public static function formulario(?Portfolio $portfolio, int $id = 0) {
        if(isset($_SESSION["mensageErro"])): ?>
            <div class="sucesso">
                <?=  $_SESSION["mensageErro"]?>
            <span class="close" onclick="this.parentElement.style.display='none'">&times;</span></div>
            <?php 
            unset($_SESSION["mensageErro"]);
        endif; 
        if (isset($id) AND $id> 0): ?>
            <div class="alert">
                Você deseja realmente deletar?
                <a href="?p=delPort&excluir=<?= $id?>">Confirmar</a> | 
                <a href="?p=port">Cancelar</a>
                <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
            <?php
        endif; ?>

        <section id="portfolio">
            <h2>Cadastro de Portfolio</h2>
            <form method="post" action="<?= isset($portfolio)? "./?p=altPort" : "./?p=cadPort" ?>" enctype="multipart/form-data">
                
                <?php if (isset($portfolio)): ?>
                    <label for="id">ID: </label> <input type="text" name="id" id="id" value="<?= $portfolio->id ?? "" ?>" readonly>
                <?php endif; ?>

                <label for="imagem">Carregar Imagem: </label>
                <input type="file" name="imagem" id="imagem" <?= isset($portfolio)? "disabled": "required"?>>

                <label for="textoImagem">Texto da Imagem: </label>
                <input type="text" name="textoImagem" id="textoImagem" value="<?= $portfolio->textoImagem ?? "" ?>" required>

                <button type="reset" onclick="window.location.href='./?p=port'">Cancelar</button>
                <button type="submit" ><?= isset($portfolio)? "Confirmar": "Salvar"?></button>
            </form>
            <?php
    }

    public static function exibir($portfolios) {
        ?>
            <table id="tabPortfolio">
                <thead>
                    <tr>
                        <th>Texto da Imagem</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                    if (!is_null($portfolios)):
                        foreach($portfolios as $port): ?>
                            <tr>
                                <td><?= $port->textoImagem ?></td>
                                <td><img src="../assets/<?= $port->caminhoImagem ?>" alt="<?= $port->textoImagem ?>" style="max-width: 100px;"></td>
                                <td>
                                    <a href="./?p=port&alt=<?= $port->id ?>"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="./?p=port&exc=<?= $port->id ?>"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                    endif;
                    ?>    
                </tbody>
            </table>
        </section>
       <?php
    }
}