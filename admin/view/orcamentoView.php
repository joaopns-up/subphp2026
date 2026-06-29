<?php
namespace Admin\View;

use Admin\Model\Orcamento as Orcam;

class OrcamentoView {

    public static function detalhes() {
        if(isset($_SESSION["mensageErro"])): ?>
            <div class="alert">
                <?=  $_SESSION["mensageErro"]?>
            <span class="close" onclick="this.parentElement.style.display='none'">&times;</span></div>
            <?php 
            unset($_SESSION["mensageErro"]);
        endif; 
        if (isset($orcam)):
        ?>  
        
        <h2>Detalhes</h2>
        <form>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= $orcam?->nome ?>" disabled>
            
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?= $orcam?->email ?>" disabled>
            
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" value="<?= $orcam?->telefone ?>" disabled>
            
            <label for="duracao">Duração:</label>
            <input type="text" name="duracao" id="duraco" value="<?= $orcam?->duracao ?>" disabled>
            
            <label for="local">Local</label>
            <input type="text" name="local" id="local" value="<?= $orcam?->local ?>" disabled>
            
            <label for="tipo">Tipo do Evento:</label>
            <input type="text" name="tipo" id="tipo" value="<?= $orcam?->tipoEvento ?>" disabled>
            
            <label for="impresso">Fotos Impressas?</label>
            <input type="text" name="impresso" id="impresso" value="<?= ($orcam?->impresso == true)? "Sim": "Não" ?>" disabled>
            
            <label for="qtdeFotos">Quantidedade de Fotos</label>
            <input type="text" name="qtdeFotos" id="qtdeFotos" value="<?= $orcam?->qtdeFotos ?>" disabled>
            
            <label for="Detalhes">Detalhes</label>
            <textarea name="detalhes" id="detalhes" disabled><?= $orcam?->observacoes ?></textarea>

            <button type="reset" onclick="window.location.href='./?p=orcam'">Fechar</button>
        </form>

        <?php
        endif; 

    }

    public static function exibir($orcamentos) {
        ?>
        <section id="orcamentos">
            <h2>Orçamentos</h2>
            <table id="tabOrcamento">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                if (!is_null($orcamentos)):
                    foreach($orcamentos as $orcam): ?>
                        <tr>
                            <td><?= $orcam?->nome ?></td>
                            <td><?= $orcam?->email ?></td>
                            <td><?= $orcam?->telefone ?></td>
                            <td>
                                <a href="./?p=orcam&ver=<?= $orcam?->id ?>"><i class="fa-solid fa-eye"></i></a>
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