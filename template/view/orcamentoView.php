<?php
namespace App\Template\View;

class orcamentoView {
    public static function formulario() {
        ?>
        <section id="orcamento">
            <h2>Orçamento</h2>
            <form action="?env" method="post">
                <input type="text" id="nome" name="nome" placeholder="Seu Nome" required>           
                <input type="email" id="email" name="email" placeholder="Seu E-mail" required>           
                <input type="text" id="telefone" name="telefone" placeholder="Seu Telefone" required>           
                <input type="number" id="duracao" name="duracao" placeholder="Duração do Evento (em horas)">           
                <input type="text" id="local" name="local" placeholder="Local do Evento">

                <select id="tipo" name="tipo" class="flex-300" required>
                    <option selected disabled>Tipo do Evento</option>
                    <option value="interno">Interno</option>
                    <option value="externo">Externo</option>
                    <option value="externo">Interno e Externo</option>
                </select>
                <select id="impressoes" name="impressoes" class="flex-300" required>
                    <option selected disabled>Fotos Impressas</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                <input type="number" id="qtdeFotos" name="qtdeFotos" placeholder="Quantidade de Fotos Impressas" required>       
            
                <textarea id="observacoes" name="observacoes" placeholder="Detalhes Adicionais" required></textarea>
                
                <button type="submit">Enviar Solicitação</button>
            </form>
        </section>
        <?php
    }
}
?>
