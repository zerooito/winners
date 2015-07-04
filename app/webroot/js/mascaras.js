$(function(){
  console.log('fui iniciado');

  jQuery(function($){
     $(".moeda").maskMoney();
     $(".peso").mask('9.999');
     $('.cep').mask('99999-999');
  });
});
