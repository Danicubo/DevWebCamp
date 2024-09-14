<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Categoria;
use Model\Dia;
use Model\Evento;
use Model\Hora;
use Model\Ponente;
use MVC\Router;

class EventosController {
    public static function index(Router $router) {
        if(!isAdmin()) {
            header('Location: /login');
        }
        $paginaActual = $_GET['page'];
        $paginaActual = filter_var($paginaActual, FILTER_SANITIZE_NUMBER_INT);

        if(!$paginaActual || $paginaActual < 1){
            header('Location: /admin/eventos?page=1');
        }

        $por_pagina = 10;
        $total = Evento::total();
        $paginacion = new Paginacion($paginaActual, $por_pagina, $total);

        $eventos = Evento::paginar($por_pagina, $paginacion->offset());

        foreach($eventos as $evento) {
            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);
        }
        //debuguear($evento);

        $router->render('admin/eventos/index', [
            'titulo' => 'Conferencias y Workshops',
            'eventos' => $eventos,
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {
        if(!isAdmin()) {
            header('Location: /login');
        }
        $alertas = [];

        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        $evento = new Evento;
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();

            if(empty($alertas)){
                $resultado = $evento->guardar();

                if($resultado){
                    header('Location: /admin/eventos');
                }
            }

        }

        $router->render('admin/eventos/crear', [
            'titulo' => 'Registrar Eventos',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
    public static function editar(Router $router) {
        if(!isAdmin()) {
            header('Location: /login');
        }
        $alertas = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if(!$id){
            header('Location: /admin/eventos');
        }

        $categorias = Categoria::all('ASC');
        $dias = Dia::all('ASC');
        $horas = Hora::all('ASC');
        $evento = Evento::find($id);

        if(!$evento){
            header('Location: /admin/eventos');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $evento->sincronizar($_POST);
            $alertas = $evento->validar();

            if(empty($alertas)){
                $resultado = $evento->guardar();

                if($resultado){
                    header('Location: /admin/eventos');
                }
            }

        }

        $router->render('admin/eventos/editar', [
            'titulo' => 'Editar Evento',
            'alertas' => $alertas,
            'categorias' => $categorias,
            'dias' => $dias,
            'horas' => $horas,
            'evento' => $evento
        ]);
    }
    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            if(!isAdmin()) {
                header('Location: /login');
            }
        
            $id = $_POST['id'];
            $eventos = Evento::find($id);
            if(!isset($eventos)) {
                header('Location: /admin/eventos');
            }
            $resultado = $eventos->eliminar();
            if($resultado){
                header('Location: /admin/eventos');
            }
        }
    }
}