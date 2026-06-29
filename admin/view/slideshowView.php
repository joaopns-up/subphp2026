<?php
namespace Admin\View;
use Admin\Model\Slideshow;

class SlideshowView {

    public static function formulario(?Slideshow $slide, int $id = 0) {
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
                <a href="?p=delSlide&excluir=<?= $id?>">Confirmar</a> | 
                <a href="?p=slide">Cancelar</a>
                <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
            <?php
        endif; ?>
        <section id="slideshow">
            <h2>Cadastro de Slideshow</h2>
            <form method="post" action="<?= isset($slide)? "./?p=altSlide" : "./?p=cadSlide" ?>" enctype="multipart/form-data">
                
                <?php if (isset($slide)): ?>
                    <label for="id">ID: </label> <input type="text" name="id" id="id" value="<?= $slide->id ?? "" ?>" readonly>
                <?php endif; ?>

                <label for="imagem">Carregar Imagem: </label>
                <input type="file" name="imagem" id="imagem" <?= isset($slide)? "disabled": "required"?>>

                <label for="textoImagem">Texto da Imagem: </label>
                <input type="text" name="textoImagem" id="textoImagem" value="<?= $slide->textoImagem ?? "" ?>" required>

                <label for="titulo">Título: </label>
                <input type="text" name="titulo" id="titulo" value="<?= $slide->titulo ?? "" ?>" required>

                <label for="descricao">Descricao: </label>
                <textarea name="descricao" id="descricao" required><?= $slide->descricao ?? "" ?></textarea>

                <button type="reset" onclick="window.location.href='./?p=slide'">Cancelar</button>
                <button type="submit" ><?= isset($slide)? "Confirmar": "Salvar"?></button>
            </form>
            <?php
    }

    public static function exibir($slides) {
        ?>
            <table id="tabSlideshow">
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Descricao</th>
                        <th>Texto da Imagem</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                    if (!is_null($slides)):
                        foreach($slides as $slide): ?>
                            <tr>
                                <td><?= $slide->textoImagem ?></td>
                                <td><?= $slide->descricao ?></td>
                                <td><?= $slide->titulo ?></td>
                                <td><img src="../assets/<?= $slide->caminhoImagem ?>" alt="<?= $slide->textoImagem ?>" style="max-width: 100px;"></td>
                                <td>
                                    <a href="./?p=slide&alt=<?= $slide->id ?>"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="./?p=slide&exc=<?= $slide->id ?>"><i class="fa-solid fa-trash"></i></a>
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