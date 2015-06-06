$(function(){
  console.log('fui iniciado');

  jQuery(function($){
     $(".moeda").maskMoney();
     $(".peso").mask('9.999');
  });
});
