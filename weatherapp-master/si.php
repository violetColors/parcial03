<script>
"use strict";
//  Facebook App ID
var facebookAppID="mi ID";
// -------------------------------------------------------
//  Facebook User Data
var facebookUser = {};
//  Child objects:
//      facebookUser.id
//      facebookUser.name
//      facebookUser.first_name
//      facebookUser.last_name
//      facebookUser.link
//      facebookUser.gender
//      facebookUser.locale
//      facebookUser.timezone
//      facebookUser.updated_time
//      facebookUser.verified
// -------------------------------------------------------
// *******************************************************
//      Callbacks
// *******************************************************
//  Función a llamar cuando el login se realiza correctamente
var Facebook_correctLogin   = function () {
    //  Obtener los datos del usuario
    FB.api('/me', function(response) {
        // Guardar los datos en una variable global
        facebookUser = response;
        // Esconder el boton de login
        document.getElementById('facebook-login-button').style.display = "none";
        // Saludar al usuario
        if (document.getElementById('fbStatus')){
            document.getElementById('fbStatus').innerHTML = '¡Datos' + (JSON.stringify(facebookUser)) + '!';
        }
        // Mostrar los datos en la consola
        console.log('____________________');
        console.log('Bienvenido ' + facebookUser.name);
        console.log('Tus datos:');
        console.log(facebookUser.id);//Si aparece
        console.log(facebookUser.name);//Si aparece
        console.log(facebookUser.first_name);// No aparece
        console.log(facebookUser.last_name);// No aparece
        console.log(facebookUser.link);// No aparece
        console.log(facebookUser.gender);// No aparece
        console.log(facebookUser.locale);// No aparece
        console.log(facebookUser.timezone);// No aparece
        console.log(facebookUser.updated_time);// No aparece
        console.log(facebookUser.verified);// No aparece
        console.log(facebookUser.birthday);// No aparece
        console.log('Tus datos:');
        console.log(JSON.stringify(response));//Solo aparece nombre e ID
    })
};
//  Función a llamar cuando la persona esta conectada a Facebook, pero no a tu aplicación
var Facebook_notAuthorized  = function () {
    if (document.getElementById('fbStatus')){
        document.getElementById('fbStatus').innerHTML = 'Es necesario conectarse a la aplicación.'
    }
};
//  Función a llamar si la persona no esta conectada a Facebook
var Facebook_notConnected   = function () {
    if (document.getElementById('fbStatus')){
        document.getElementById('fbStatus').innerHTML = 'Es necesario estar conectado a Facebook.'
    }
};
//  Iniciada de forma asíncrona por FB.getLoginStatus()
var statusChangeCallback    = function (response) {
    console.log('____________________');
    console.log('statusChangeCallback');
    console.log(response);
    console.log('____________________');
    //  Login y autorización correctas
    if (response.status === 'connected') {
        Facebook_correctLogin();
    //  Login correcto, sin autorización
    } else if (response.status === 'not_authorized') {
        Facebook_notAuthorized();
    } else {
    //  Usuario no conectado a Facebook
        Facebook_notConnected();
    }
};
// *******************************************************
//      Iniciar la SDK de Facebook de forma asíncrona
// *******************************************************
window.fbAsyncInit  = function() {
    //  Ajuste de opciones
    FB.init({
        appId      : "mi ID",
        xfbml      : true,
        version    : 'v2.4'
    });
    //  Llamar statusChangeCallback() al iniciar sesión
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    }) 
};
 
// *******************************************************
//      Cargar la SDK de Facebook de foma asíncrona
// *******************************************************
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs)
}(document, 'script', 'facebook-jssdk'))
// *******************************************************
</script>