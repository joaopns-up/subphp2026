<?php
namespace Admin\View;

use Admin\Model\Comentario as Coment;

class ComentarioView {

    public static function formulario(?Coment $coment, int $id = 0) {
        vardump($coment);
        die();
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
                <a href="?p=delComent&excluir=<?= $id?>">Confirmar</a> | 
                <a href="?p=coment">Cancelar</a>
                <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
            <?php
        endif; ?>

        <section id="coment">
            <h2>Cadastro de Comentário</h2>
            <form method="post" action="<?= isset($coment)? "./?p=altComent" : "./?p=cadComent" ?>" enctype="multipart/form-data">
            
            <div class="image-selection-container">
                <label class="image-option">
                    <input type="radio" name="imagem" value="pacman_v1.jpg" required>
                    <img src="../assets/img/comentario/pacman_v1.jpg" alt="imagem1">
                </label>
                <label class="image-option">
                    <input type="radio" name="imagem" value="pacman_v2.jpg" required>
                    <img src="../assets/img/comentario/pacman_v2.jpg" alt="imagem2">
                </label>
                <label class="image-option">
                    <input type="radio" name="imagem" value="pacman_v3.jpg" required>
                    <img src="../assets/img/comentario/pacman_v3.jpg" alt="imagem3">
                </label>
                </div>
                
                <?php if (isset($coment)): ?>
                    <label for="id">ID: </label> <input type="text" name="id" id="id" value="<?= $coment->id ?? "" ?>" readonly>
                <?php endif; ?>

                <label for="autor">Autor: </label>
                <input type="text" name="autor" id="autor" value="<?= $coment->autor ?? "" ?>" required>

                <label for="texto">Texto: </label>
                <input type="text" name="texto" id="texto" value="<?= $coment->texto ?? "" ?>" required>

                <button type="reset" onclick="window.location.href='./?p=coment'">Cancelar</button>
                <button type="submit" ><?= isset($coment)? "Confirmar": "Salvar"?></button>
            </form>
            <?php
    }

    public static function exibir($comentarios) {
        ?>
            <table id="tabComentario">
                <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Texto</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                    if (!is_null($comentarios)):
                        foreach($comentarios as $coment): ?>
                            <tr>
                                <td><?= $coment->autor ?></td>
                                <td><?= $coment->texto ?></td>
                                <td><img src="../assets/img/comentario/<?= $coment->nomeImagem ?>" alt="<?= $coment->nomeImagem ?>" style="max-width: 100px;"></td>
                                <td>
                                    <a href="./?p=coment&alt=<?= $coment->id ?>"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="./?p=coment&exc=<?= $coment->id ?>"><i class="fa-solid fa-trash"></i></a>
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