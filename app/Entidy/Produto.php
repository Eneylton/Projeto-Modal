<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Produto
{

    public $id;
    public $nome_produto;
    public $categorias_produto_id;

    public function cadastar()
    {


        $obdataBase = new Database('produtos');

        $this->id = $obdataBase->insert([

            'nome_produto'                       => $this->nome_produto,
            'categorias_produto_id'              => $this->categorias_produto_id

        ]);

        return true;
    }



    public function atualizar()
    {
        return (new Database('produtos'))->update('id = ' . $this->id, [

            'nome_cat_prod'              => $this->nome_cat_prod
        ]);
    }


    public static function getList($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('produtos'))->select($fields, $table, $where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }



    public static function getQtd($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('produtos'))->select('COUNT(*) as qtd', 'produtos', null, null)
            ->fetchObject()
            ->qtd;
    }


    public static function getID($fields, $table, $where, $order, $limit)
    {
        return (new Database('produtos'))->select($fields, $table, 'id = ' . $where, $order, $limit)
            ->fetchObject(self::class);
    }
    public static function getIDProdutos($fields, $table, $where, $order, $limit)
    {
        return (new Database('produtos'))->select($fields, $table, 'categorias_produto_id = ' . $where, $order, $limit)
        ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

  

    public function excluir()
    {
        return (new Database('produtos'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('produtos'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
