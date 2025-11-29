Ejecución del Proyecto

-----------------------------------------------------------------------------------------------

Este proyecto está desarrollado en PHP puro, sin utilizar un framework específico. Para ejecutarlo, seguimos estos pasos:

Iniciamos XAMPP:
Activamos los servicios de Apache y MySQL desde el panel de control de XAMPP. Así nos aseguramos de tener el servidor web local y los servicios de base de datos funcionando.

Ubicamos el proyecto:
Colocamos la carpeta del proyecto dentro del directorio htdocs, que se encuentra en la ruta donde instalamos XAMPP. Por ejemplo:
C:\xampp\htdocs\nombre_del_proyecto.

Configuramos la base de datos:

Nos aseguramos de que el servicio de MySQL esté activo.

Restauramos la copia de seguridad de la base de datos desde la carpeta Data_base, usando un gestor de bases de datos de preferencia (como phpMyAdmin).

Verificamos la configuración:
Revisamos y ajustamos si es necesario el puerto y las credenciales de conexión en el archivo Database.php, ubicado en /Core/.

¡Listo! Con estos pasos, el proyecto debería estar funcionando correctamente.

