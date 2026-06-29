<?php
namespace App\Template\View;

class comentarioView {
    public static function exibir($comentarios) {
        ?>
        <section id="comentarios">
        <h2>Comentarios</h2>
                <?php
                if (!is_null($comentarios)) :
                    foreach ($comentarios as $comentario) : ?>
                        <div class="comentario">
                            <img src="./assets/img/comentario/<?= $comentario->nomeImagem ?>" alt="<?= $comentario->nomeImagem ?>">
                            <div class="textoComentario">
                                <h3><?= $comentario->autor ?></h3>
                                <p><?= $comentario->texto ?></p>
                            </div>
                        </div>
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </section>
    <?php
    }
}
?>
