<html>
 <head>
  <title>PHP Test</title>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="styles.css">
 </head>
 <body>

 <div class="container" id="calculator">

	<section class="top">
		<div class="row">
			<span  id="clear" class="clear col-md-2">C</span>
			<div id="screen" class="screen col-md-10">0</div>
		</div>

	</section>
	
	<section class="key">
		<div class="row">
			<span class="num col-md-3">7</span>
			<span class="num  col-md-3">8</span>
			<span class="num  col-md-3">9</span>
			<span class="operator  col-md-3">+</span>
		</div>
		<div class="row">
			<span class="num  col-md-3">4</span>
			<span class="num  col-md-3">5</span>
			<span class="num  col-md-3">6</span>
			<span class="operator  col-md-3">-</span>
		</div>
		<div class="row">
			<span class="num  col-md-3">1</span>
			<span class="num  col-md-3">2</span>
			<span class="num  col-md-3">3</span>
			<span class="operator  col-md-3">/</span>
		</div>
		<div class="row">
			<span class="num  col-md-3">0</span>
			<span  class="col-md-3">.</span>
			<span class="eval col-md-3">=</span>
			<span class="operator col-md-3">x</span>
		</div>
	</section>
	 <span>made by gab.y</span>
</div>
<script>
const request = {
  first_val: false,
  second_val: false,
  operator: false,
  screen:'',
  ops:['+', '-', 'x', '/'],
  getJson: function() {
    if(this.first_val && this.second_val && this.operator  ){
		return {
			fv : this.first_val,
			sv : this.second_val,
			op : this.operator,
		};
	}
  },
  setVal(v){
	   if(v == "="){
		   this.getResult();
		   return;
	   }else if(v == "C"){
		   this.reset();
		   this.setScreen();
		   return;
	   }
	   if(this.ops.indexOf(v) > -1) {
		   if(v=='-' && !this.operator && !this.first_val){
			   this.first_val=v;
		   }else if(v=='-' && this.operator && !this.second_val){
			   this.second_val=v;
		   }else if(!this.operator && !this.second_val && this.first_val ){
			   this.operator = v;
		   }
		   
	   }else if(v=="."){
		   if(this.operator && this.second_val && !this.second_val.includes('.')){
			   this.second_val +=v;
		   }else if(this.first_val && !this.first_val.includes('.')){
			   this.first_val +=v;
		   }
	   }
	   if(isNaN(v)){
		  return;
	  }
	  if(this.operator){
		  if(this.second_val  ){
			  this.second_val+=v;
		  }else{
			this.second_val=v;  
		  }
		  
	  }else{
		  if(this.first_val ){
			  this.first_val+=v;
		  }else{
			this.first_val=v;  
		  }
		  
	  }
  },
  reset(){
	  this.first_val= false;
	  this.second_val= false;
	  this.operator= false;
  },
  setScreen(){
	  //console.log(this.first_val);
	  this.screen = (this.first_val) ? this.first_val:0;
	  if(this.screen){
		  var o = (this.operator) ? this.operator:0;
		  if(o){
			  this.screen += o;
			  var s = (this.second_val) ? this.second_val:0;
			  if(s){
				  this.screen += s;
			  }
		  }
	  }
	  //console.log(this.screen);
	   document.getElementById("screen").innerHTML=this.screen;
  },
  getOp(){
	  if(this.operator=='+'){
		  return 'p';
	  }else if(this.operator=='-'){
		  return 'm';
	  }else if(this.operator=='x'){
		  return 'x';
	  }else if(this.operator=='/'){
		  return 'd';
	  }
  },
  getResult(){
	  if(this.first_val && this.second_val && this.operator  ){
		/*var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
		  if (this.readyState == 4 && this.status == 200) {
			//document.getElementById("screen").innerHTML = this.responseText;
			window['req'].reset();
			window['req'].setVal(this.responseText);
			req.setScreen();
		  }
		}
		xmlhttp.open("GET", "calc.php?o="+this.getOp()+"&fv="+this.first_val+"&sv="+this.second_val, true);
		xmlhttp.send();*/
	    $.ajax({
		  url: "calc.php?o="+this.getOp()+"&fv="+this.first_val+"&sv="+this.second_val,
		  success: function(data){
			window['req'].reset();
			window['req'].setVal(data);
			window['req'].setScreen(); 
		  }
	    });
	  }
  }
};

const req = Object.create(request);
window['req'] = req;
 $('.key span').on('click',function(){
	 req.setVal(this.innerHTML);
	 req.setScreen();
	 
 });
 $('#clear').on('click',function(){
	 req.setVal(this.innerHTML);
 });
</script>
 </body>
</html>
