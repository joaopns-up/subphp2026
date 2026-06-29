<?php

namespace App\Template\View;

class PortfolioView {
    public static function exibir($porfolios){
        ?>
        <section id="portfolio">
            <h2>Galeria de Fotos</h2>
            <div class="gallery">
                <?php
                if (!is_null($porfolios)) :
                    foreach ($porfolios as $portfolio) : ?>
                        <img src="./assets/<?= $portfolio->caminhoImagem ?>" alt="<?= $portfolio->textoImagem ?>">
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
