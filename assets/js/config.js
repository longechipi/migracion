/**
 * Config
 * -------------------------------------------------------------------------------------
 * ! IMPORTANT: Make sure you clear the browser local storage In order to see the config changes in the template.
 * ! To clear local storage: (https://www.leadshook.com/help/how-to-clear-local-storage-in-google-chrome-browser/).
 */

'use strict';

// JS global variables
let config = {
  colors: {
    primary: '#696cff',
    secondary: '#8592a3',
    success: '#71dd37',
    info: '#03c3ec',
    warning: '#ffab00',
    danger: '#ff3e1d',
    dark: '#233446',
    black: '#000',
    white: '#fff',
    body: '#f4f5fb',
    headingColor: '#566a7f',
    axisColor: '#a1acb8',
    borderColor: '#eceef1'
  }
};

//-------- FUNCION PARA BLOQUEAR LETRAS ---------//
function numeros(input,event){    
  var keyCode = event.which ? event.which : event.keyCode;
  var lisShiftkeypressed = event.shiftKey;
      if(lisShiftkeypressed && parseInt(keyCode) != 9){
          return false;
      }
  if((parseInt(keyCode)>=48 && parseInt(keyCode)<=57) || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ || keyCode==8/*BCKSPC*/ || keyCode==46/*DEL*/ || keyCode==9/*TAB*/  || keyCode==45/*minus sign*/ || keyCode==43/*plus sign*/){
      return true;
  }     
  alert("SOLO SE PERMITEN NUMEROS"); 
  input.focus();
  return false;           
}

//-------- FUNCION PARA BLOQUEAR NUMEROS ---------//
function letras(input,event){
  var keyCode = event.which ? event.which : event.keyCode;
  //Small Alphabets
  if(parseInt(keyCode)>=97 && parseInt(keyCode)<=122){
      return true;
  }
  //Caps Alphabets
  if(parseInt(keyCode)>=65 && parseInt(keyCode)<=90){
      return true;
  }
  if(parseInt(keyCode)==32 || parseInt(keyCode)==13 || parseInt(keyCode)==46 || keyCode==9/*TAB*/ || keyCode==8/*BCKSPC*/ || keyCode==37/*LFT ARROW*/ || keyCode==39/*RGT ARROW*/ ){
      return true;
  }
  alert("SOLO SE PERMITEN LETRAS"); 
  input.focus();
  return false; 
}
