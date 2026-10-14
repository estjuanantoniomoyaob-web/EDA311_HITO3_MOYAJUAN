<?php
require_once __DIR__ . '/nodo.php';

class ListaDoblementeEnlazada {
    public $cabeza = null;
    public $cola = null;

    public function insertar($dato) {
        $nuevo = new Nodo($dato);
        if ($this->cabeza == null) {
            $this->cabeza = $nuevo;
            $this->cola = $nuevo;
        } else {
            $this->cola->siguiente = $nuevo;
            $nuevo->anterior = $this->cola;
            $this->cola = $nuevo;
        }
    }

    public function ordenarBurbuja($campo) {
        if ($this->cabeza == null) return;

        $cambiado = true;
        while ($cambiado) {
            $cambiado = false;
            $actual = $this->cabeza;

            while ($actual->siguiente != null) {
                $siguiente = $actual->siguiente;

                if ($actual->dato[$campo] > $siguiente->dato[$campo]) {
                    $temp = $actual->dato;
                    $actual->dato = $siguiente->dato;
                    $siguiente->dato = $temp;
                    $cambiado = true;
                }
                $actual = $actual->siguiente;
            }
        }
    }

    public function obtenerArreglo() {
        $arreglo = [];
        $actual = $this->cabeza;
        while ($actual != null) {
            $arreglo[] = $actual->dato;
            $actual = $actual->siguiente;
        }
        return $arreglo;
    }
}
?>