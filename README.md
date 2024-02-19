# Me.Social

Aquí tenemos la API de la red social Me.Social donde tenemos acceso a los perfiles, los mensajes y todas las conexiones del perfil con el resto de usuario.

## Despliegue de la API

Este documento proporciona instrucciones detalladas sobre cómo desplegar y ejecutar la API en diferentes entornos, incluyendo Docker, si es necesario.

### Requisitos Previos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- Docker

### Despliegue con Docker

Para desplegar la API usando Docker, sigue estos pasos:

1. **Construir la Imagen Docker:**

   La imagen Docker deberá de estar basada en `php:apache`, cuando crees tu imagen, asegurate de que te encuentras en el directorio raíz de tu proyecto (donde se encuentra tu `Dockerfile`):

2. **Activar el Módulo Rewrite de Apache:**
   
   Aseguráte de incluir en tu Dockerfile los comandos para habilitar el módulo `rewrite` en Apache:
   ```bash
   RUN <comando para habilitar módulo> rewrite

3. **Copia de ficheros:**

   Los archivos de la API deben estar en `/var/www/html` dentro del contenedor. Asegúrate de que tu `Dockerfile` esté configurado para copiar los archivos del proyecto a esta ubicación.

4. **Nombre del contenedor:**

   Se recomienda que el nombre del docker creado sea `me-social-api`

## Endpoints

La API expone los siguientes endpoints:

- `http://<docker-ip>/profile`: Devuelve un JSON con información del perfil del usuario.
- `http://<docker-ip>/timeline`: Muestra la actividad y mensajes del usuario en un JSON.
- `http://<docker-ip>/friends`: Devuelve un array JSON con imágenes de los amigos del usuario.
- `http://<docker-ip>/photos`: Devuelve un array JSON con imágenes asociadas al perfil del usuario.

## Recomendaciones de despliegue

Recuerda que esta API está enlazada con la aplicación `me.social`. Desde esta aplicación web, se realizan llamadas de tipo GET hasta esta api utilizando una URL de este tipo: 
- `http://api.me.social/profile` 
- `http://api.me.social/timeline`
- `http://api.me.social/friends` 
- `http://api.me.social/photos`

Comprueba que funciona correctamente. Utiliza `POSTMAN` para ello.