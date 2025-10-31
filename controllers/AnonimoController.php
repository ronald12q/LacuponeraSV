<?php

class AnonimoController {

    public function index() {
      
        //prueba temporal luego de aqui se enviara ala pagina cliente sin alguinas opciones activas 
        //teniendo que hacer login para poder usarlas 
        echo "<h1>Bienvenido Usuario Anónimo</h1>";
        echo "<p>Esta será la página principal para usuarios sin una cuenta.</p>";
        echo '<a href="?url=home">Volver al inicio</a>';
        
      
    }
}
