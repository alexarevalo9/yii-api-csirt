<?php

use yii\helpers\Html;

$this->title = 'Documentación';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layout">
    <div class="container-fluid no-gutter">
        <div class="row content-container">
            <div class="col-xs-12 info no-gutter">
                <div id="doc-body" class="">
                    <div class="row row-no-padding row-eq-height" id="intro">
                        <div class="col-md-6 col-xs-12 section">
                            <div class="api-information">
                                <div class="collection-name">
                                    <p>CSIRT API</p>
                                </div>
                                <div class="collection-description"><p>CSIRT API le permite acceder a la información de un CSIRT registrado. </p>
                                    <h1 id="informacion-general">Información General</h1>
                                    <ol>
                                        <li>
                                            <p>Necesita un token de autenticación válido para enviar peticiones a la CSIRT API. Para obtener un token de autenticación debe ingresar a la pagina <a href="https://csirt.ec/">CSIRT</a> y registrarse.</p>
                                        </li>
                                        <li>
                                            <p>La respuesta a cada <b>petición</b> se envía en formato JSON. En caso de que la solicitud de API produzca un <b>error</b>, se representa mediante una clave <code>"error": {}</code> en la respuesta JSON.</p>
                                            <pre class=" language-undefined"><code class="is-highlighted language-undefined">
{
  "error": {
    "name": "AuthenticationError",
    "message": "API Key missing. Every request requires an API Key to be sent."
  }
}
</code></pre>
                                        </li>
                                        <li>
                                            <p>El método de <b>petición</b> determina la naturaleza de la acción que pretende realizar. Una solicitud realizada utilizando el método <b>GET</b> implica que desea obtener algo de CSIRT API, <b>POST</b> implica que desea crear algo nuevo en CSIRT API y <b>UPDATE</b> implica que desea actualizar un recurso en CSIRT API.</p>
                                        </li>
                                        <li>
                                            <p>Las llamadas a la API responderán con los códigos de estado HTTP apropiados para todas las solicitudes. En CSIRT API, cuando se recibe una respuesta, el código de estado se resalta y se acompaña de un texto de ayuda que indica el posible significado del código de respuesta. Un 200 OK indica que todo salió bien, mientras que los códigos de respuesta 4XX o 5XX indican un error del cliente solicitante o de nuestros servidores API, respectivamente.</p>
                                        </li>
                                    </ol>

                                    <h1 id="autenticacion">Autenticación</h1>
                                    <p>Se requiere que se envíe un token de autenticación como parte de cada solicitud a la CSIRT API, en forma de encabezado  <b>Authorization</b>. El tipo de autenticación utilizado en CSIRT API es <b>Bearer Authentication</b>.</p>

                                    <p><code> Authorization: Bearer {{auth_token}} <code></code></code></p>
                                    <p>Un token de autenticación le dice a nuestro servidor API que la solicitud que recibió vino de usted. Toda la informacion de la CSIRT API es accesible con un token de autenticación que se genera al momento que usted inicia sesión con sus credenciales.</p>
                                </div>
                            </div>
                        </div>
                        <div class="examples">
                            <div class="hidden-xs hidden-sm sidebar-error">
                                <p class="heading">Could not load examples for this collection</p>
                                <button class="btn btn-default retry-button retryLoadingExamples">Retry</button>
                            </div>
                            <div class="hidden-xs hidden-sm sidebar-loader spinner"></div></div>
                    </div>
                    <div class="row row-no-padding row-eq-height" id="86a317cd-117f-45df-9e09-8ecab9c793ba">
                        <div class="col-md-6 col-xs-12 section">
                            <div class="api-information">
                                <div class="heading">
                                    <div class="name">
                                        <span class="POST method" title="POST">POST</span>
                                        Autenticación CSIRT API
                                    </div>
                                </div>
                                <div class="url">http://csirt-api.test/user/login</div>
                                <div class="description request-description"><p>Autenticación utilizando correo y contraseña.</p>

                                    <p>La respuesta contiene el token de Autenticación que utilizará para cada una de sus peticiones a la CSIRT API.</p>

                                    <blockquote>Requiere <code>email</code> y <code>password</code> en el cuerpo de la petición.</blockquote></div>
                                <div class="headers">
                                    <div class="heading">HEADERS</div>
                                    <hr>
                                    <div class="param row">
                                        <div class="name col-md-3 col-xs-12">Content-Type</div>
                                        <div class="value col-md-9 col-xs-12">application/json</div>
                                    </div>
                                </div>



                                <div class="request-body">
                                    <div class="body-heading">BODY <span class="body-type">raw</span></div>
                                    <hr>
                                    <div class="raw-body code-snippet">
    <pre class="body-block click-to-expand-wrapper is-snippet-wrapper" data-id="86a317cd-117f-45df-9e09-8ecab9c793ba" data-title="BODY Raw"><code class="body-block language-javascript">{
	"email" : "user@email.com",
	"password" : "user_password"
}</code></pre>
                                    </div>
                                </div>

                            </div>
                            <br><br>
                        </div>


                        <div class="col-md-6 col-xs-12 examples">

                            <div class="sample-request">
                                <div class="heading"><span>Example Request</span></div>

                                <div class="responses-index">
                                    <div class="response-name"><span>LOGIN</span></div>
                                </div></div>


                            <div class="request code-snippet">
                                <div class="formatted-requests is-default" data-lang="curl" data-id="86a317cd-117f-45df-9e09-8ecab9c793ba_0">
    <pre class="click-to-expand-wrapper is-snippet-wrapper  language-javascript" data-title="Example Request" data-content-type="example-request" data-id="86a317cd-117f-45df-9e09-8ecab9c793ba_0" data-clipboard-target="#curl_0_86a317cd-117f-45df-9e09-8ecab9c793ba" data-before-copy="Copy to Clipboard" data-after-copy="Copied"><code class="is-highlighted language-javascript" id="curl_0_86a317cd-117f-45df-9e09-8ecab9c793ba">curl <span class="token operator">--</span>location <span class="token operator">--</span>request POST <span class="token string">'http://csirt-api.test/user/login'</span> \
<span class="token operator">--</span>header <span class="token string">'Content-Type: application/json'</span> \
<span class="token operator">--</span>data<span class="token operator">-</span>raw '<span class="token punctuation">{</span>
<span class="token string">"email"</span> <span class="token punctuation">:</span> <span class="token string">"usertest@email.com"</span><span class="token punctuation">,</span>
<span class="token string">"password"</span> <span class="token punctuation">:</span> <span class="token string">"test12345"</span>
<span class="token punctuation">}</span>'</code></pre>
                                </div>
                            </div>

                            <div class="sample-response">
                                <div class="heading">
                                    <span>Example Response</span>
                                </div>

                                <div class="responses-index">
                                    <div class="response-status is-default" data-id="86a317cd-117f-45df-9e09-8ecab9c793ba_0">
                                        <span>200 － OK</span>
                                    </div>
                                </div>
                                <div class="responses code-snippet">
                                    <div class="formatted-responses is-default" data-id="86a317cd-117f-45df-9e09-8ecab9c793ba_0" data-lang="json">
        <pre class="click-to-expand-wrapper is-snippet-wrapper is-example  language-javascript" data-id="86a317cd-117f-45df-9e09-8ecab9c793ba_0" data-lang="json" data-content-type="example-response" data-title="Example Response"><code class=" is-highlighted language-javascript"><span class="token punctuation">{</span>
<span class="token string">"Su token de autenticacion es"</span><span class="token punctuation">:</span> <span class="token string">"004a7f731e940943717af532caf92fd1bea44858183365d02b"</span>
<span class="token punctuation">}</span></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-no-padding row-eq-height" id="b2ea0d29-1151-42a6-9c65-c179e507e330">
                        <div class="col-md-6 col-xs-12 section">
                            <div class="api-information">
                                <div class="heading">
                                    <div class="name">
                                        <span class="GET method" title="GET">GET</span>
                                        Obtener información del CSIRT
                                    </div>
                                </div>
                                <div class="url">http://csirt-api.test/v1/csirt/getcsirt?token={{csirt_token}}</div>
                                <div class="description request-description"><p>Accede a la información del CSIRT.</p>

                                    <p>La respuesta contiene todos los datos del CSIRT en formato JSON.</p>

                                    <blockquote>Requiere <code>token</code> como parametro y  <code>Authorization</code> como encabezado de la petición.</blockquote></div>
                                <div class="headers">
                                    <div class="heading">HEADERS</div>
                                    <hr>
                                    <div class="param row">
                                        <div class="name col-md-3 col-xs-12">Authorization</div>
                                        <div class="value col-md-9 col-xs-12">Bearer {{auth_token}}</div>
                                    </div>
                                </div>

                                <div class="query-params">
                                    <div class="heading">PARAMS</div>
                                    <hr>
                                    <div class="param row">
                                        <div class="name col-md-3 col-xs-12">token</div>
                                        <div class="value col-md-9 col-xs-12">{{csirt_token}}</div>
                                    </div>
                                </div>



                            </div>
                            <br><br>
                        </div>


                        <div class="col-md-6 col-xs-12 examples">

                            <div class="sample-request">
                                <div class="heading"><span>Example Request</span></div>

                                <div class="responses-index">
                                    <div class="response-name"><span>GET CSIRT</span></div>
                                </div>
                            </div>

                            <div class="request code-snippet">
                                <div class="formatted-requests is-default" data-lang="curl" data-id="b2ea0d29-1151-42a6-9c65-c179e507e330_0">
    <pre class="click-to-expand-wrapper is-snippet-wrapper  language-javascript" data-title="Example Request" data-content-type="example-request" data-id="b2ea0d29-1151-42a6-9c65-c179e507e330_0" data-clipboard-target="#curl_0_b2ea0d29-1151-42a6-9c65-c179e507e330" data-before-copy="Copy to Clipboard" data-after-copy="Copied"><code class=" is-highlighted language-javascript" id="curl_0_b2ea0d29-1151-42a6-9c65-c179e507e330">curl <span class="token operator">--</span>location <span class="token operator">--</span>request GET <span class="token string">'http://csirt-api.test/v1/csirt/getcsirt?token=1e1f2beb1c71747a884efbb4b1086dc566754bc1'</span> \
<span class="token operator">--</span>header <span class="token string">'Authorization: Bearer 004a7f731e940943717af532caf92fd1bea44858183365d02b'</span></code></pre>
                                </div>
                            </div>

                            <div class="sample-response">
                                <div class="heading">
                                    <span>Example Response</span>
                                </div>

                                <div class="responses-index">
                                    <div class="response-status is-default" data-id="b2ea0d29-1151-42a6-9c65-c179e507e330_0">
                                        <span>200 － OK</span>
                                    </div>
                                </div>
                                <div class="responses code-snippet">
                                    <div class="formatted-responses is-default" data-id="b2ea0d29-1151-42a6-9c65-c179e507e330_0" data-lang="json">
      <pre class="click-to-expand-wrapper is-example is-expandable  language-javascript" data-id="b2ea0d29-1151-42a6-9c65-c179e507e330_0" data-lang="json" data-content-type="example-response" data-title="Example Response"><code class=" is-highlighted language-javascript"><span class="token punctuation">{</span>
<span class="token string">"token"</span><span class="token punctuation">:</span> <span class="token string">"1e1f2beb1c71747a884efbb4b1086dc566754bc1"</span><span class="token punctuation">,</span>
<span class="token string">"nombreCsirt"</span><span class="token punctuation">:</span> <span class="token string">"CSIRT TEST"</span><span class="token punctuation">,</span>
<span class="token string">"direccion"</span><span class="token punctuation">:</span> <span class="token string">"csirt test"</span><span class="token punctuation">,</span>
<span class="token string">"telefono"</span><span class="token punctuation">:</span> <span class="token string">"099999999"</span><span class="token punctuation">,</span>
<span class="token string">"email"</span><span class="token punctuation">:</span> <span class="token string">"csirt@test.com"</span><span class="token punctuation">,</span>
<span class="token string">"gpgEmail"</span><span class="token punctuation">:</span> <span class="token string">"0x12345678"</span><span class="token punctuation">,</span>
<span class="token string">"comunidadObj"</span><span class="token punctuation">:</span> <span class="token string">"test"</span><span class="token punctuation">,</span>
<span class="token string">"sitioWeb"</span><span class="token punctuation">:</span> <span class="token string">"https://www.test.com"</span><span class="token punctuation">,</span>
<span class="token string">"horario"</span><span class="token punctuation">:</span> <span class="token string">"07:00 - 16:00"</span><span class="token punctuation">,</span>
<span class="token string">"nombreReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"test csirt"</span><span class="token punctuation">,</span>
<span class="token string">"telefonoReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"09999999"</span><span class="token punctuation">,</span>
<span class="token string">"correoReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"test@csirt.com"</span><span class="token punctuation">,</span>
<span class="token string">"GPGReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"0x09876543"</span><span class="token punctuation">,</span>
<span class="token string">"nombreRepreAlterno"</span><span class="token punctuation">:</span> <span class="token string">"test csirt"</span><span class="token punctuation">,</span></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row row-no-padding row-eq-height" id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88">
                        <div class="col-md-6 col-xs-12 section">
                            <div class="api-information">
                                <div class="heading">
                                    <div class="name">
                                        <span class="PUT method" title="PUT">PUT</span>
                                        Actualizar información del CSIRT
                                    </div>
                                </div>
                                <div class="url">http://csirt-api.test/v1/csirt/updatecsirt?token={{csirt_token}}</div>
                                <div class="description request-description"><p>Actualiza la información del CSIRT.</p>

                                    <p>La respuesta contiene todos los datos actualizados del CSIRT en formato JSON.</p>

                                    <blockquote>Requiere <code>token</code> como parametro, <code>Authorization</code> como encabezado y <code>raw (application/json)</code> con todos los datos que se quieren actualizar en el cuerpo de la petición.</blockquote></div>
                                <div class="headers">
                                    <div class="heading">HEADERS</div>
                                    <hr>
                                    <div class="param row">
                                        <div class="name col-md-3 col-xs-12">Authorization</div>
                                        <div class="value col-md-9 col-xs-12">Bearer {{auth_token}}</div>
                                    </div>
                                    <div class="param row">
                                        <div class="name col-md-3 col-xs-12">Content-Type</div>
                                        <div class="value col-md-9 col-xs-12">application/json</div>
                                    </div>
                                </div>

                                <div class="query-params">
                                    <div class="heading">PARAMS</div>
                                    <hr>
                                    <div class="param row">
                                        <div class="name col-md-3 col-xs-12">token</div>
                                        <div class="value col-md-9 col-xs-12">{{csirt_token}}</div>
                                    </div>
                                </div>


                                <div class="request-body">
                                    <div class="body-heading">BODY <span class="body-type">raw</span></div>
                                    <hr>
                                    <div class="raw-body code-snippet">
    <pre class="body-block click-to-expand-wrapper is-snippet-wrapper" data-id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88" data-title="BODY Raw"><code class="body-block language-javascript">{
    "attribute_csirt1" : "new_value",
    "attribute_csirt2" : "new_value",
    "attribute_csirt3" : "new_value"
}</code></pre>
                                    </div>
                                </div>

                            </div>
                            <br><br>
                        </div>


                        <div class="col-md-6 col-xs-12 examples">

                            <div class="sample-request">
                                <div class="heading"><span>Example Request</span></div>

                                <div class="responses-index">
                                    <div class="response-name"><span>UPDATE CSIRT</span></div>
                                </div></div>

                            <div class="request code-snippet">
                                <div class="formatted-requests is-default" data-lang="curl" data-id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88_0">
    <pre class="click-to-expand-wrapper is-snippet-wrapper  language-javascript" data-title="Example Request" data-content-type="example-request" data-id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88_0" data-clipboard-target="#curl_0_edb55f1f-312e-4dfc-8d6b-cb69db39bf88" data-before-copy="Copy to Clipboard" data-after-copy="Copied"><code class=" is-highlighted language-javascript" id="curl_0_edb55f1f-312e-4dfc-8d6b-cb69db39bf88">curl <span class="token operator">--</span>location <span class="token operator">--</span>request PUT <span class="token string">'http://csirt-api.test/v1/csirt/updatecsirt?token=1e1f2beb1c71747a884efbb4b1086dc566754bc1'</span> \
<span class="token operator">--</span>header <span class="token string">'Authorization: Bearer 004a7f731e940943717af532caf92fd1bea44858183365d02b'</span> \
<span class="token operator">--</span>header <span class="token string">'Content-Type: application/json'</span> \
<span class="token operator">--</span>data<span class="token operator">-</span>raw '<span class="token punctuation">{</span>
<span class="token string">"nombreCsirt"</span> <span class="token punctuation">:</span> <span class="token string">"CSIRT TEST UPDATE"</span><span class="token punctuation">,</span>
<span class="token string">"direccion"</span> <span class="token punctuation">:</span> <span class="token string">"Direccion TEST UPDATE"</span><span class="token punctuation">,</span>
<span class="token string">"telefono"</span> <span class="token punctuation">:</span> <span class="token string">"09123456789"</span>
<span class="token punctuation">}</span>'</code></pre>
                                </div>
                            </div>

                            <div class="sample-response">
                                <div class="heading">
                                    <span>Example Response</span>
                                </div>

                                <div class="responses-index">
                                    <div class="response-status is-default" data-id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88_0">
                                        <span>200 － OK</span>
                                    </div>
                                </div>
                                <div class="responses code-snippet">
                                    <div class="formatted-responses is-default" data-id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88_0" data-lang="json">
      <pre class="click-to-expand-wrapper is-example is-expandable  language-javascript" data-id="edb55f1f-312e-4dfc-8d6b-cb69db39bf88_0" data-lang="json" data-content-type="example-response" data-title="Example Response"><code class=" language-javascript"><span class="token punctuation">[</span>
  <span class="token punctuation">{</span>
    <span class="token string">"token"</span><span class="token punctuation">:</span> <span class="token string">"1e1f2beb1c71747a884efbb4b1086dc566754bc1"</span><span class="token punctuation">,</span>
    <span class="token string">"nombreCsirt"</span><span class="token punctuation">:</span> <span class="token string">"CSIRT TEST UPDATE"</span><span class="token punctuation">,</span>
    <span class="token string">"direccion"</span><span class="token punctuation">:</span> <span class="token string">"Direccion TEST UPDATE"</span><span class="token punctuation">,</span>
    <span class="token string">"telefono"</span><span class="token punctuation">:</span> <span class="token string">"09123456789"</span><span class="token punctuation">,</span>
    <span class="token string">"email"</span><span class="token punctuation">:</span> <span class="token string">"csirt@test.com"</span><span class="token punctuation">,</span>
    <span class="token string">"gpgEmail"</span><span class="token punctuation">:</span> <span class="token string">"0x12345678"</span><span class="token punctuation">,</span>
    <span class="token string">"comunidadObj"</span><span class="token punctuation">:</span> <span class="token string">"test"</span><span class="token punctuation">,</span>
    <span class="token string">"sitioWeb"</span><span class="token punctuation">:</span> <span class="token string">"https://www.test.com"</span><span class="token punctuation">,</span>
    <span class="token string">"horario"</span><span class="token punctuation">:</span> <span class="token string">"07:00 - 16:00"</span><span class="token punctuation">,</span>
    <span class="token string">"nombreReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"test csirt"</span><span class="token punctuation">,</span>
    <span class="token string">"telefonoReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"09999999"</span><span class="token punctuation">,</span>
    <span class="token string">"correoReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"test@csirt.com"</span><span class="token punctuation">,</span>
    <span class="token string">"GPGReprePrincipal"</span><span class="token punctuation">:</span> <span class="token string">"0x09876543"</span><span class="token punctuation">,</span>
    <span class="token string">"nombreRepreAlterno"</span><span class="token punctuation">:</span> <span class="token string">"test csirt"</span><span class="token punctuation">,</span>
    <span class="token string">"telefonoRepreAlterno"</span><span class="token punctuation">:</span> <span class="token string">"09999999"</span><span class="token punctuation">,</span>
    <span class="token string">"correoRepreAlterno"</span><span class="token punctuation">:</span> <span class="token string">"test@email.com"</span><span class="token punctuation">,</span>
    <span class="token string">"GPGRepreAlterno"</span><span class="token punctuation">:</span> <span class="token string">"0xABCDE123"</span><span class="token punctuation">,</span>
    <span class="token string">"mensajeOpc"</span><span class="token punctuation">:</span> <span class="token string">"test"</span><span class="token punctuation">,</span>
    <span class="token string">"latitud"</span><span class="token punctuation">:</span> <span class="token string">"-1.2303741774326018"</span><span class="token punctuation">,</span>
    <span class="token string">"longitud"</span><span class="token punctuation">:</span> <span class="token string">"-78.61816406250001"</span>
  <span class="token punctuation">}</span>
<span class="token punctuation">]</span></code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <div class="no-gutter phantom-sidebar"></div>
            <div class="no-gutter sidebar" id="nav-sidebar"><div class="collection-heading">
                    <p class="heading">CSIRT API</p>
                </div>
                <ul class="nav navbar-nav" id="navbar-example">
                    <li class="toc">
                        <ul>
                    <li class="request intro">
                        <a class="nav-link dropdown-item" href="documentation#intro">
                            <div class="request-name">Introduction</div>
                        </a>
                    </li>
                    <li class="request heading">
                                <a class="nav-link dropdown-item" href="documentation#informacion-general">
                                    <div class="request-name">Información General</div>
                                </a>
                            </li><li class="request heading">
                                <a class="nav-link dropdown-item" href="documentation#autenticacion">
                                    <div class="request-name">Autenticación</div>
                                </a>
                            </li></ul>
                    </li>
                    <li class="request">
                        <div class="POST method" title="POST">
                            <span>POST</span>
                        </div>
                        <div class="request-name" title=" Autenticación CSIRT API">
                            <a class="nav-link dropdown-item" href="documentation#86a317cd-117f-45df-9e09-8ecab9c793ba">
                                <span> Autenticación CSIRT API</span>
                            </a>
                        </div>
                    </li>
                    <li class="request">
                        <div class="GET method" title="GET">
                            <span>GET</span>
                        </div>
                        <div class="request-name" title="Obtener información del CSIRT">
                            <a class="nav-link dropdown-item" href="documentation#b2ea0d29-1151-42a6-9c65-c179e507e330">
                                <span>Obtener información del CSIRT</span>
                            </a>
                        </div>
                    </li>
                    <li class="request">
                        <div class="PUT method" title="PUT">
                            <span>PUT</span>
                        </div>
                        <div class="request-name" title="Actualizar información del CSIRT">
                            <a class="nav-link dropdown-item" href="documentation#edb55f1f-312e-4dfc-8d6b-cb69db39bf88">
                                <span>Actualizar información del CSIRT</span>
                            </a>
                        </div>
                    </li>
                </ul></div>
        </div>
    </div>
</div>
