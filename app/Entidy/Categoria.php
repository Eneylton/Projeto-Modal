<?php

namespace App\Entidy;

use \App\Db\Database;

use \PDO;

class Categoria
{


    public $id;
    public $nome_cat_prod;

    public function cadastar()
    {


        $obdataBase = new Database('categorias_produtos');

        $this->id = $obdataBase->insert([

            'nome_cat_prod'              => $this->nome_cat_prod

        ]);

        return true;
    }



    public function atualizar()
    {
        return (new Database('categorias_produtos'))->update('id = ' . $this->id, [

            'nome_cat_prod'              => $this->nome_cat_prod
        ]);
    }


    public static function getList($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('categorias_produtos'))->select($fields, $table, $where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }



    public static function getQtd($fields = null, $table = null, $where = null, $order = null, $limit = null)
    {

        return (new Database('categorias_produtos'))->select('COUNT(*) as qtd', 'categorias_produtos', null, null)
            ->fetchObject()
            ->qtd;
    }


    public static function getID($fields, $table, $where, $order, $limit)
    {
        return (new Database('categorias_produtos'))->select($fields, $table, 'id = ' . $where, $order, $limit)
            ->fetchObject(self::class);
    }

  

    public function excluir()
    {
        return (new Database('categorias_produtos'))->delete('id = ' . $this->id);
    }


    public static function getUsuarioPorEmail($email)
    {

        return (new Database('categorias_produtos'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}
