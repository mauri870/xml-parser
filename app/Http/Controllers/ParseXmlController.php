<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ParseXmlController extends Controller
{
    public $parser;

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
        $this->parser = simplexml_load_file('img/cozinha.xml');


        //Loop in categories
        $i = 0;
        foreach($this->parser->AMBIENTS->AMBIENT->CATEGORIES->CATEGORY as $category){
            //Loop items
            foreach($category->ITEMS->ITEM as $item){
                if ($item->attributes()->COMPONENT == "Y"){

                    //Set item description
                    $this->setDescricao(
                        $this->getItemDescription($item))

                        //Set Client name
                        ->setCliente($this->getClientName())

                        //Set the material
                        ->setMaterial($this->getMaterialName($item))

                        //Set the sizes
                        ->setComprimento($this->getItemSizes($item,'WIDTH'))
                        ->setLargura($this->getItemSizes($item,'DEPTH'))
                        ->setEspessura($this->getItemSizes($item,'THICKNESS'))

                        //Set Bordas
                        ->setBordaInferior($this->getBordaInferiorItem($item))
                        ->setBordaSuperior($this->getBordaSuperiorItem($item))
                        ->setBordaEsquerda($this->getBordaEsquerdaItem($item))
                        ->setBordaDireita($this->getBordaDireitaItem($item));

                    $total_items[$i] = [
                        'Codigo'=>$i,
                        'Descricao'=>$this->getDescricao(),
                        'Cliente'=>$this->getCliente(),
                        'Material'=>$this->getMaterial(),
                        'Comprimento'=>$this->getComprimento(),
                        'Largura'=>$this->getLargura(),
                        'Espessura'=>$this->getEspessura(),
                        'BordaInferior'=>$this->getBordaInferior(),
                        'BordaSuperior'=>$this->getBordaSuperior(),
                        'BordaEsquerda'=>$this->getBordaEsquerda(),
                        'BordaDireita'=>$this->getBordaDireita()
                    ];

                    $i++;
                }
            }
        }

        dd($total_items);

        Excel::create('Teste', function($excel) use($total_items) {
            $excel->sheet('Sheet1', function($sheet) use($total_items) {
                $sheet->cells('A:Z', function($cells) {
                    $cells->setAlignment('center');
                });

                $sheet->fromArray($total_items);

            });
        })->export('xls');

        /*$i = 0;
        foreach($this->parser->AMBIENTS->AMBIENT->CATEGORIES->CATEGORY as $category){
            if($category->attributes()->DESCRIPTION == "Cozinhas"){
                foreach($category->ITEMS->ITEM as $item){
                    $this->setDescricao($this->getItemDescription($item));
                    $this->setCliente($this->getClientName());
                    $total_items[$i] = ['descricao'=>$this->getDescricao(),'cliente'=>$this->getCliente()];
                    $i++;
                }
            }
        }*/
        //Get the itens array()
        /*echo "<pre>";
            print_r()  ;
        echo "<pre>";*/


        /*return view('welcome');*/
    }


    /**
     * Get the description for an item
     *
     * @param $item
     * @return mixed
     */
    public function getItemDescription($item){
        return str_replace(' ','_',$item->attributes()->DESCRIPTION[0]);
    }

    /**
     * Get the client name for an item
     * @return mixed
     */
    public function getClientName(){
        return (string)$this->parser->CUSTOMERSDATA->DATA[4]->attributes()->VALUE;
    }

    /**
     * Get the Material for an item
     * @return mixed
     */
    public function getMaterialName($item){
        return (string)$item->REFERENCES->MATERIAL->attributes()->REFERENCE;
    }


    /**
     * Get Borda Inferior from Item
     *
     * @param $item
     * @return string
     */
    public function getBordaInferiorItem($item){
        return (string)$item->REFERENCES->FITA_BORDA_1->attributes()->REFERENCE;
    }

    /**
     * Get Borda Superior from Item
     *
     * @param $item
     * @return string
     */
    public function getBordaSuperiorItem($item){
        return (string)$item->REFERENCES->FITA_BORDA_2->attributes()->REFERENCE;
    }

    /**
     * Get Borda Esquerda from Item
     *
     * @param $item
     * @return string
     */
    public function getBordaEsquerdaItem($item){
        return (string)$item->REFERENCES->FITA_BORDA_3->attributes()->REFERENCE;
    }

    /**
     * Get Borda Direita from Item
     *
     * @param $item
     * @return string
     */
    public function getBordaDireitaItem($item){
        return (string)$item->REFERENCES->FITA_BORDA_4->attributes()->REFERENCE;
    }

    /**
     * Get the item sizes
     *
     * @param $item
     * @param $measure string WIDTH, HEIGHT or THICKNESS
     * @return string
     */
    public function getItemSizes($item,$measure){
        if($measure == 'THICKNESS'){
            return (string)$item->REFERENCES->THICKNESS->attributes()->REFERENCE;
        }else{
            return $item->attributes()->$measure;
        }
    }

    /**
     * Get the Ambient description
     * @return mixed
     */
    public function getAmbientDescription(){
        return (string)$this->parser->AMBIENTS->AMBIENT->attributes()->DESCRIPTION;
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
