<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Nathanmac\Utilities\Parser\Facades\Parser;

class ParseXmlController extends Controller
{
    private $codigo,
        $descricao,
        $cliente,
        $material,
        $comprimento,
        $largura,
        $espessura,
        $bordaInferior,
        $bordaSuperior,
        $bordaEsquerda,
        $bordaDireita,
        $quantidade,
        $veio,
        $moduloId,
        $modulo,
        $pecaId;

    public function __construct()
    {

    }

    public function index()
    {
        $parser = simplexml_load_file('img/cozinha.xml');
        foreach($parser->AMBIENTS->AMBIENT->CATEGORIES->CATEGORY->ITEMS->ITEM as $item){
            echo "<pre>";
            print_r(str_replace(' ','_',$item->attributes()->DESCRIPTION[0]));
            echo "<pre>";

            break;
        }

        //Get the itens array()
        /*echo "<pre>";
        print_r($parser->AMBIENTS->AMBIENT->CATEGORIES->CATEGORY->ITEMS);
        echo "<pre>";*/


        /*return view('welcome');*/
    }


    //Getters and Setters
    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     * @return ParseXmlController
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     * @return ParseXmlController
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * @param mixed $cliente
     * @return ParseXmlController
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     * @return ParseXmlController
     */
    public function setMaterial($material)
    {
        $this->material = $material;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComprimento()
    {
        return $this->comprimento;
    }

    /**
     * @param mixed $comprimento
     * @return ParseXmlController
     */
    public function setComprimento($comprimento)
    {
        $this->comprimento = $comprimento;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLargura()
    {
        return $this->largura;
    }

    /**
     * @param mixed $largura
     * @return ParseXmlController
     */
    public function setLargura($largura)
    {
        $this->largura = $largura;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEspessura()
    {
        return $this->espessura;
    }

    /**
     * @param mixed $espessura
     * @return ParseXmlController
     */
    public function setEspessura($espessura)
    {
        $this->espessura = $espessura;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBordaInferior()
    {
        return $this->bordaInferior;
    }

    /**
     * @param mixed $bordaInferior
     * @return ParseXmlController
     */
    public function setBordaInferior($bordaInferior)
    {
        $this->bordaInferior = $bordaInferior;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBordaSuperior()
    {
        return $this->bordaSuperior;
    }

    /**
     * @param mixed $bordaSuperior
     * @return ParseXmlController
     */
    public function setBordaSuperior($bordaSuperior)
    {
        $this->bordaSuperior = $bordaSuperior;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBordaEsquerda()
    {
        return $this->bordaEsquerda;
    }

    /**
     * @param mixed $bordaEsquerda
     * @return ParseXmlController
     */
    public function setBordaEsquerda($bordaEsquerda)
    {
        $this->bordaEsquerda = $bordaEsquerda;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBordaDireita()
    {
        return $this->bordaDireita;
    }

    /**
     * @param mixed $bordaDireita
     * @return ParseXmlController
     */
    public function setBordaDireita($bordaDireita)
    {
        $this->bordaDireita = $bordaDireita;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * @param mixed $quantidade
     * @return ParseXmlController
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVeio()
    {
        return $this->veio;
    }

    /**
     * @param mixed $veio
     * @return ParseXmlController
     */
    public function setVeio($veio)
    {
        $this->veio = $veio;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModuloId()
    {
        return $this->moduloId;
    }

    /**
     * @param mixed $moduloId
     * @return ParseXmlController
     */
    public function setModuloId($moduloId)
    {
        $this->moduloId = $moduloId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * @param mixed $modulo
     * @return ParseXmlController
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPecaId()
    {
        return $this->pecaId;
    }

    /**
     * @param mixed $pecaId
     * @return ParseXmlController
     */
    public function setPecaId($pecaId)
    {
        $this->pecaId = $pecaId;
        return $this;
    }



}
