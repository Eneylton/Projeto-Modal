<?php

require __DIR__ . '../../../vendor/autoload.php';

use App\Entidy\Produto;

$dados = "";

$id_cat = filter_input(INPUT_GET, "id_cat", FILTER_SANITIZE_NUMBER_INT);

$listarProdutos = Produto:: getIDProdutos('*','produtos',$id_cat,null,null);

$dados .= "<table class='table'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                        </tr>
                    </thead>
                    <tbody>";

foreach ($listarProdutos as $item) {

    $dados .= "<tr>
                            <td>$item->id</td>
                            <td>$item->nome_produto</td>
                          
                        </tr>";
    
}

$dados .= "</tbody>
                </table>";

                $retorna = ['erro' => false, 'dados' => $dados];

                echo json_encode($retorna);

?>