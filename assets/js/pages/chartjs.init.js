!function(i){"use strict";
var r=function(){};r.prototype.respChart=function(r,o,e,a){Chart.defaults.global.defaultFontColor="#98a6ad",Chart.defaults.scale.gridLines.color="rgba(104, 115, 142, 0.1)";

var t=r.get(0).getContext("2d"),n=i(r).parent();

function s(){r.attr("width",i(n).width());switch(o){case"Line":new Chart(t,{type:"line",data:e,options:a});
break;
case"Doughnut":new Chart(t,{type:"doughnut",data:e,options:a});

break;
case"Pie":new Chart(t,{type:"pie",data:e,options:a});

break;
case"Bar":new Chart(t,{type:"bar",data:e,options:a});

break;

case"Radar":new Chart(t,{type:"radar",data:e,options:a});


break;
case"PolarArea":new Chart(t,{data:e,type:"polarArea",options:a})}}i(window).resize(s),s()},r.prototype.init=function(){this.respChart(i("#lineChart"),"Line",{labels:["aJanuary","February","March","April","May","June","July","August","September"],datasets:[{label:"Sales Analytics",fill:!1,lineTension:.05,backgroundColor:"#fff",borderColor:"#297ef6",borderCapStyle:"butt",borderDash:[],borderDashOffset:0,borderJoinStyle:"miter",pointBorderColor:"#297ef6",pointBackgroundColor:"#fff",pointBorderWidth:8,pointHoverRadius:6,pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"#297ef6",pointHoverBorderWidth:3,pointRadius:1,pointHitRadius:10,data:[65,59,80,81,56,55,40,35,30]}]},{scales:{yAxes:[{ticks:{max:100,min:20,stepSize:10}}]}});this.respChart(i("#doughnut"),"Doughnut",{labels:["Desktops","Tablets","Mobiles","Mobiles","Tablets"],datasets:[{data:[80,50,100,121,77],backgroundColor:["#5553ce","#297ef6","#e52b4c","#ffa91c","#32c861"],hoverBackgroundColor:["#5553ce","#297ef6","#e52b4c","#ffa91c","#32c861"],hoverBorderColor:"#fff"}]});this.respChart(i("#pie"),"Pie",{labels:["Desktops","Tablets","Mobiles","Mobiles","Tablets"],datasets:[{data:[80,50,100,121,77],backgroundColor:["#5553ce","#297ef6","#e52b4c","#ffa91c","#32c861"],hoverBackgroundColor:["#5553ce","#297ef6","#e52b4c","#ffa91c","#32c861"],hoverBorderColor:"#fff"}]});this.respChart(i("#bar"),"Bar",{labels:["bJanuary","February","March","April","May","June","July"],datasets:[{label:"Sales Analytics",backgroundColor:"rgba(236, 103, 148, 0.3)",borderColor:"#ec6794",borderWidth:2,hoverBackgroundColor:"rgba(236, 103, 148, 0.6)",hoverBorderColor:"#ec6794",data:[65,59,80,81,56,55,40,20]}]});this.respChart(i("#radar"),"Radar",{labels:["Eating","Drinking","Sleeping","Designing","Coding","Cycling","Running"],datasets:[{label:"Desktops",backgroundColor:"rgba(179,181,198,0.2)",borderColor:"rgba(179,181,198,1)",pointBackgroundColor:"rgba(179,181,198,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"rgba(179,181,198,1)",data:[65,59,90,81,56,55,40]},{label:"Tablets",backgroundColor:"rgba(255,99,132,0.2)",borderColor:"rgba(255,99,132,1)",pointBackgroundColor:"rgba(255,99,132,1)",pointBorderColor:"#fff",pointHoverBackgroundColor:"#fff",pointHoverBorderColor:"rgba(255,99,132,1)",data:[28,48,40,19,96,27,100]}]},{scale:{angleLines:{color:"rgba(104, 115, 142, 0.1)"}}});this.respChart(i("#polarArea"),"PolarArea",{datasets:[{data:[11,16,7,18],backgroundColor:["#297ef6","#45bbe0","#ebeff2","#1ea69a"],label:"My dataset",hoverBorderColor:"#fff"}],labels:["Series 1","Series 2","Series 3","Series 4"]})},i.ChartJs=new r,i.ChartJs.Constructor=r}(window.jQuery),function(r){"use strict";window.jQuery.ChartJs.init()}();