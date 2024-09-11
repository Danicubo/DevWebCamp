<?php

namespace Classes;

class Paginacion { 
    public $pagina_actual;
    public $registro_por_pagina;
    public $total_registro;

    public function __construct($pagina_actual = 1, $registro_por_pagina = 10, $total_registro = 0) {
        $this->pagina_actual = (int) $pagina_actual;
        $this->registro_por_pagina = (int) $registro_por_pagina;
        $this->total_registro = (int) $total_registro;
    }

    public function offset(){
        return $this->registro_por_pagina * ($this->pagina_actual - 1);
    }

    public function totalPaginas(){
        return ceil($this->total_registro / $this->registro_por_pagina );
    }

    public function paginaAnterior() {
        $anterior = $this->pagina_actual - 1;
        return ($anterior > 0) ? $anterior : false;
    }
    public function paginaSiguiente() {
        $siguiente = $this->pagina_actual + 1;
        return ($siguiente <= $this->totalPaginas()) ? $siguiente : false;
    }
    public function enlaceAnterior(){
        $html = '';
        if($this->paginaAnterior()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->paginaAnterior()}\">&laquo; Anterior</a>";
        }
        return $html;
    }
    public function enlaceSiguiente(){
        $html = '';
        if($this->paginaSiguiente()){
            $html .= "<a class=\"paginacion__enlace paginacion__enlace--texto\" href=\"?page={$this->paginaSiguiente()}\">Siguiente &raquo;</a>";
        }
        return $html;
    }

    public function numerosPaginas(){
        $html = '';
        for($i = 1; $i <= $this->totalPaginas(); $i++){
            if($i === $this->pagina_actual){
                $html .= "<span class=\"paginacion__enlace paginacion__enlace--actual \">{$i}</span>";
            } else {
                $html .= "<a href=\"?page={$i} \" class=\"paginacion__enlace paginacion__enlace--numero\">{$i}</a>";
            }

        }
        return $html;

    }
    public function paginacion(){
        $html = '';

        if($this->total_registro > 1){
            $html .= '<div class="paginacion">'; 
            $html .= $this->enlaceAnterior(); 
            $html .= $this->numerosPaginas(); 
            $html .= $this->enlaceSiguiente(); 
            $html .= '</div>'; 
        }
        return $html;
    }
}