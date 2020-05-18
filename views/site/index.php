<?php

/* @var $this yii\web\View */

$this->title = 'CSIRT API';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>CSIRT API</h1>
        <p class="lead">CSIRT API le permite consultar y editar la información de un CSIRT registrado.</p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Registro</h2>

                <p>Necesita un token de autenticación válido para enviar peticiones a CSIRT API.
                    Para obtener un token debe ingresar a la pagina <a href="/site/register" rel="noopener noreferrer">CSIRT</a>
                    y registrarse.</p>

                <p><a class="btn btn-default" href="/site/register">Registro&raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Peticiones</h2>

                <p>El método de petición determina la naturaleza de la acción que pretende realizar.
                    Una solicitud realizada utilizando el método GET implica que desea obtener algo de CSIRT API,
                    y POST implica que desea guardar algo nuevo en API CSIRT.</p>

            </div>
            <div class="col-lg-4">
                <h2>Respuestas</h2>

                <p>La respuesta a cada petición se envía en formato JSON. En caso de que la solicitud de API produzca un
                    error, se representa mediante una clave <code>"error": {}</code> en la respuesta JSON.</p>
            </div>
        </div>

    </div>
</div>
