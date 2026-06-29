<?php
namespace App\Template\View;

class SlideshowView {
    public static function exibir($slides) {
        ?>
        <section class="slideshow">
            <div class="slides">
                <?php
                if (!is_null($slides)) :
                    foreach ($slides as $slide) : ?>

                        <div class="slide">
                            <img src="./assets/<?= $slide->caminhoImagem ?>" alt="<?= $slide->textoImagem ?>">
                            <div class="texto">
                                <h2> <?= $slide->titulo ?> </h2>
                                <P> <?= $slide->descricao ?> </P>
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