<?php

$list = '';

if (isset($_GET['status'])) {

   switch ($_GET['status']) {
      case 'success':
         $icon  = 'success';
         $title = 'Parabéns';
         $text = 'Cadastro realizado com Sucesso !!!';
         break;

         case 'del':
            $icon  = 'error';
            $title = 'Parabéns';
            $text = 'Esse usuário foi excluido !!!';
            break;

            case 'edit':
               $icon  = 'warning';
               $title = 'Parabéns';
               $text = 'Cadastro atualizado com sucesso !!!';
               break;
   

      default:
         $icon  = 'error';
         $title = 'Opss !!!';
         $text = 'Algo deu errado entre em contato com admin !!!';
         break;
   }

   function alerta($icon, $title, $text)
   {
      echo "<script type='text/javascript'>
      Swal.fire({
        type:'type',  
        icon: '$icon',
        title: '$title',
        text: '$text'
       
      }) 
      </script>";
   }

   alerta($icon, $title, $text);

}

$resultados = '';

foreach ($listar as $item) {

   $resultados .= '<tr>
                      <td>' . $item->id . '</td>
                      <td>' . $item->nome_cat_prod . '</td>
                    
                      <td style="text-align: center;">
                        
                      
                      <button class="btn btn-outline-primary btn-sm" onclick="listarProdutos('.$item->id.')">Produtos</button>
                      &nbsp;

                       <a href="cargo-delete.php?id=' . $item->id . '">
                       <button type="button" class="btn btn-danger"> <i class="fas fa-trash"></i></button>
                       </a>


                      </td>
                      </tr>

                      ';
}

$resultados = strlen($resultados) ? $resultados : '<tr>
                                                     <td colspan="6" class="text-center" > Nenhuma Vaga Encontrada !!!!! </td>
                                                     </tr>';


unset($_GET['status']);
unset($_GET['pagina']);
$gets = http_build_query($_GET);

//PAGINAÇÂO

$paginacao = '';
$paginas = $pagination->getPages();

foreach ($paginas as $key => $pagina) {
   $class = $pagina['atual'] ? 'btn-primary' : 'btn-secondary';
   $paginacao .= '<a href="?pagina=' . $pagina['pagina'] . '&' . $gets . '">

                  <button type="button" class="btn ' . $class . '">' . $pagina['pagina'] . '</button>
                  </a>';
}

?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card card-purple">
               <div class="card-header">

                  <form method="get">
                     <div class="row ">
                        <div class="col-4">

                           <label>Buscar por Nome</label>
                           <input type="text" class="form-control" name="buscar" value="<?= $buscar ?>">

                        </div>


                        <div class="col d-flex align-items-end">
                           <button type="submit" class="btn btn-warning" name="">
                              <i class="fas fa-search"></i>

                              Pesquisar

                           </button>

                        </div>


                     </div>

                  </form>
               </div>

               <div class="table-responsive">

                  <table class="table table-bordered table-dark table-bordered table-hover table-striped">
                     <thead>
                        <tr>
                           <td colspan="4">
                              <button type="submit" class="btn btn-info" data-toggle="modal" data-target="#modal-default"> <i class="fas fa-plus"></i> &nbsp; Nova</button>
                           </td>
                        </tr>
                        <tr>
                           <th style="text-align: left; width:80px"> CÓDIGO </th>
                           <th> CARGO </th>
                          
                           <th style="text-align: center; width:200px"> AÇÃO </th>
                        </tr>
                     </thead>
                     <tbody>
                        <?= $resultados ?>
                     </tbody>

                  </table>

               </div>


            </div>

         </div>

      </div>

   </div>

</section>

<?= $paginacao ?>


<div class="modal fade" id="modal-default">
   <div class="modal-dialog">
      <div class="modal-content bg-light">
         <form action="./cargo-insert.php" method="post">

            <div class="modal-header">
               <h4 class="modal-title">Novo usuário
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>Cargo</label>
                  <input type="text" class="form-control" name="descricao" required>
               </div>

            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Salvar</button>
            </div>

         </form>

      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>

<!-- EDITAR -->

<div class="modal fade" id="editmodal">
   <div class="modal-dialog">
      <form action="./cargo-edit.php" method="get">
         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Editar
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id" id="id">
               <div class="form-group">
                  <label>Cargo</label>
                  <input type="text" class="form-control" name="descricao" id="descricao" required >
               </div>
       
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>
      </form>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
    
<div class="modal fade" id="listarProdutosModal">
   <div class="modal-dialog">
      
         <div class="modal-content bg-light">
            <div class="modal-header">
               <h4 class="modal-title">Editar
               </h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <label for="">LISTA DE PRODUTOS</label>
           
                    <span class="listar-produtos"></span>
       
            </div>
            <div class="modal-footer justify-content-between">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
               <button type="submit" class="btn btn-primary">Salvar
               </button>
            </div>
         </div>
  
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>