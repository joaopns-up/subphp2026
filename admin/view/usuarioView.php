<?php
namespace Admin\View;
use Admin\Model\Usuario;

class UsuarioView{

    public static function formulario(?Usuario $usuario, int $id = 0) {
        if(isset($_SESSION["mensageErro"])): ?>
            <div class="alert">
                <?=  $_SESSION["mensageErro"]?>
            <span class="close" onclick="this.parentElement.style.display='none'">&times;</span></div>
            <?php 
            unset($_SESSION["mensageErro"]);
        endif; 
        if (isset($id) AND $id> 0): ?>
            <div class="alert">
                Você deseja realmente deletar?
                <a href="?p=delUser&excluir=<?= $id?>">Confirmar</a> | 
                <a href="?p=user">Cancelar</a>
                <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
            <?php
        endif; ?>

        <section id="usuario">
            <h2>Cadastro de Usuário</h2>
            <form method="post" action="<?= isset($usuario)? "./?p=altUser": "./?p=cadUser" ?>" enctype="multipart/form-data">
                
                <?php if (isset($usuario)): ?>
                    <label for="id">ID: </label> <input type="text" name="id" id="id" value="<?= $usuario?->id ?? "" ?>" readonly>
                <?php endif; ?>
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="nome" value="<?= $usuario?->nome ?? "" ?>" required>

                <label for="email">E-mail: </label>
                <input type="email" name="email" id="email" value="<?= $usuario?->email ?? "" ?>" required>

                <label for="senha">Senha: </label>
                <input type="password" name="senha" id="senha" <?= isset($usuario)? "" : "required"?>>

                <label for="confSenha">Confirmar Senha: </label>
                <input type="password" name="confSenha" id="confSenha" <?= isset($usuario)? "" : "required"?>>

                <button type="reset" onclick="window.location.href='./?p=user'">Cancelar</button>
                <button type="submit" ><?= isset($usuario)? "Confirmar": "Salvar"?></button>
            </form>
            <?php
    }

    public static function exibir($usuarios){
        ?>
            <table id="tabUsuario">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php 
                    if (!is_null($usuarios)):
                        foreach($usuarios as $usuario): ?>
                            <tr>
                                <td><?= $usuario?->nome ?></td>
                                <td><?= $usuario?->email ?></td>
                                <td>
                                    <a href="./?p=user&alt=<?= $usuario?->id ?>"><i class="fa-solid fa-user-pen"></i></a>
                                    <a href="./?p=user&exc=<?= $usuario?->id ?>"><i class="fa-solid fa-trash"></i></a>
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