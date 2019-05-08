//! moment.js locale configuration

;(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined'
        && typeof require === 'function' ? factory(require('../moment')) :
    typeof define === 'function' && define.amd ? define(['../moment'], factory) :
    factory(global.moment)
 }(this, (function (moment) { 'use strict';


     var ptBr = moment.defineLocale('pt-br', {
         months : 'janeiro_fevereiro_marÃ§o_abril_maio_junho_julho_agosto_setembro_outubro_novembro_dezembro'.split('_'),
         monthsShort : 'jan_fev_mar_abr_mai_jun_jul_ago_set_out_nov_dez'.split('_'),
         weekdays : 'Domingo_Segunda-feira_TerÃ§a-feira_Quarta-feira_Quinta-feira_Sexta-feira_SÃ¡bado'.split('_'),
         weekdaysShort : 'Dom_Seg_Ter_Qua_Qui_Sex_SÃ¡b'.split('_'),
         weekdaysMin : 'Do_2Âª_3Âª_4Âª_5Âª_6Âª_SÃ¡'.split('_'),
         weekdaysParseExact : true,
         longDateFormat : {
             LT : 'HH:mm',
             LTS : 'HH:mm:ss',
             L : 'DD/MM/YYYY',
             LL : 'D [de] MMMM [de] YYYY',
             LLL : 'D [de] MMMM [de] YYYY [Ã s] HH:mm',
             LLLL : 'dddd, D [de] MMMM [de] YYYY [Ã s] HH:mm'
         },
         calendar : {
             sameDay: '[Hoje Ã s] LT',
             nextDay: '[AmanhÃ£ Ã s] LT',
             nextWeek: 'dddd [Ã s] LT',
             lastDay: '[Ontem Ã s] LT',
             lastWeek: function () {
                 return (this.day() === 0 || this.day() === 6) ?
                     '[Ãšltimo] dddd [Ã s] LT' : // Saturday + Sunday
                     '[Ãšltima] dddd [Ã s] LT'; // Monday - Friday
             },
             sameElse: 'L'
         },
         relativeTime : {
             future : 'em %s',
             past : 'hÃ¡ %s',
             s : 'poucos segundos',
             ss : '%d segundos',
             m : 'um minuto',
             mm : '%d minutos',
             h : 'uma hora',
             hh : '%d horas',
             d : 'um dia',
             dd : '%d dias',
             M : 'um mÃªs',
             MM : '%d meses',
             y : 'um ano',
             yy : '%d anos'
         },
         dayOfMonthOrdinalParse: /\d{1,2}Âº/,
         ordinal : '%dÂº'
     });

     return ptBr;

 })));