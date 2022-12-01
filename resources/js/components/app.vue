<template>

  <div :id="tituloID" class="container">
   <div class="row">
     <div :id="FormularioID" class="col">
         <div  class="col-sm-6" font-size:14px ><h6><strong>Ordem de Encomenda</strong></h6>
      
           <div class="form-group">
             <div class="row">
                  <div :id="ClienteID" class="col-sm-6" ><strong>Nome Cliente</strong></div>
                  <div class="col-sm-6" >
                     <input :id="selectId" type="text"  v-model="nome"  placeholder="Inserir nome do Cliente">
                  </div>
                  
             </div>
             <br>
 
             <div class="row">
                  <div :id="ClienteID" class="col-sm-6" ><strong>Mail</strong></div>
                  <div class="col-sm-6" >
                     <input :id="selectId"  type="text"  v-model="email"  placeholder="Inserir mail do Cliente">
                  </div>
             </div>
             <br>
              <div class="row">
                   <div :id="ClienteID" class="col-sm-6"><strong>Transportadora</strong></div>
                   <div  class="col-sm-6" >
 
                             <select :id="selectId"  style="font-weight: bold;" v-model='transportadora' @change="onchange($event)">
                                 <option style="font-weight: bold;" value selected="DHL" >DHL</option>
                                 <option style="font-weight: bold;" value="CTT Express">CTT Express</option>
                                 <option style="font-weight: bold;" value="DPD">DPD</option>
                                 <option style="font-weight: bold;" value="Envialia">Envialia</option>
                                 <option style="font-weight: bold;" value="FedEx">FedEx</option>
                                 <option style="font-weight: bold;" value="GLS2">GLS2</option>
                                 <option style="font-weight: bold;" value="UPS">UPS</option>
                             </select>
                  </div>
              </div>
           </div>
                 <br>
                 <br>
                    <div class="col-sm-9" font-size:14px ><h6><strong>Adicionar Produto</strong></h6></div>
                    <br>
 
                    <div :id="selectProdutoID" class="row">
                     <div class="col-sm-8">
 
                       <select  :id="dropdownProdutoID" style="font-weight: bold;" v-model='produto' @change="onchangeProduct($event)">
                                 <option value='0' >Escolha o produto</option>
                                 <option v-for='data in produtos' :value='data.id'>{{ data.nome }} - {{ data.preco }} €</option>
                             </select>
                     </div>
                     <div class="col-sm-4">
 
                       <input :id="qtdID" class="pull-right" type="number"  v-model="novaCompra.qtd" placeholder="Qtd.">
                     </div>
 
                    </div>
                    
               
                       <br>
                      <button :id="addTableID" :disabled="isDisabled" @click="addTable" ><strong> Adicionar à Encomenda </strong></button>
                            
         </div>
              
           
     </div>
     <div class="col">
       <div class="col-sm-6" ><h6><strong>Encomenda</strong></h6></div>
       <div :id="tableContainer" class ="container">    
         <table class="table">
   <thead>
     <tr>
     
       <th><strong>Produto</strong></th>
       <th><strong>Qtd.</strong></th>
       <th><strong>Total (€)</strong> </th>
     </tr>
   </thead>
   <tbody>
     <tr v-for="c in compras">
       
       <td><strong>{{c.nome}}</strong></td>
       <td><strong>{{c.qtd}}</strong></td>
       <td><strong>{{c.valor}}</strong></td>
     </tr>
   </tbody>
 </table>
 
 <br>
 <div :id="divSubmit">
 <button :id="submit" :disabled="isDisabled2" @click="sentMail"> Submeter Encomenda ({{soma}}€) </button>
 </div>
      </div>
     </div>
 
   </div>
 
 
   </div>
 </template>
 
 <script>
 
 export default{
 name:"app",
 components: {
 
 },
 
 
 data() {
   return{
     singleProduct :{
               },
     tituloID:"titulo",
     ClienteID:"nomeCliente",
     selectId:"selectID",
     dropdownProdutoID:"dropdownProdutoId",
     adicionarID:"adicionarId",
     selectProdutoID:"selectProduto",
     optionId:"optionId",
     qtdID:"qtdId",
     addTableID:"addTableId",
     submit:"submit",
     tableContainer:"tableContainer",
     divSubmit:"divSubmit",
     FormularioID:"formularioId",
     produto: 0,
     produtos: [],
     produtoID:"",
     choosed: "",
     compras:[],
     novaCompra: {nome:"", qtd:"", valor:""},
     nome:"",
     email:"",
     transportadora:"",
     output:"",
     soma: "0",
     
 
   
 
     onchange(e){
         console.log(e.target.value);
          
     },
 
     onchangeProduct(event){
         this.choosed = event.target.value;
          
     }
 }
 },
 
 
 
 methods: {
   // Método que recebe a lista de todos os produtos, oriundos do backend
             getProdutos(){
                 var vm = this
                 axios.get('/get_produtos')
                      .then((response)=>{
                        vm.produtos = response.data
                      })
             },
 
   // Método que recebe os dados de um produto, por ID (conforme o selecionado no Select), e adiciona
   //esses dados num novo array para os objetos compras
             addTable(){
                 var single = this
 
                 axios.get('/get_produtos/'+ single.choosed)
                      .then((response)=>{
                        single.compras.push({nome:response.data.nome,qtd:single.novaCompra.qtd,valor:(+(single.novaCompra.qtd*response.data.preco).toFixed(2))});
                      single.novaCompra = {nome:"",qtd:"",valor:""};
                      
                     
                      })
 
 // funções, através da biblioteca Jquery, que permitem fazer a soma de todos os valores (da propriedade
 //valor), existentes no array de objetos, a cada 1000 milisegundos. Isto foi feito, porque quando se tentava somar todos os valores
 // no mesmo momento que um novo objeto era adicionado ao array, este mesmo objeto era ignorado da contagem
 // Desta forma, o valor total a ser pago, estará sempre atual.
  
 function random_no(){
      var ran=Math.random();
      jQuery('#random_no_container').html(ran);
 }
            
 window.setInterval(function(){
   single.soma= single.compras.reduce((accumulator, object) => {
   return accumulator + object.valor;
 }, 0);
       random_no();
 }, 1000);  
 
 
 
 
             },
 
     //método que envia os dados para o backend (na parte do Laravel), de modo a estes serem enviados por 
     //email
             sentMail(e) {
                 e.preventDefault();
                 var obj = this;
                 
              

                  console.log(this.soma)
                 alert("Concretizou a compra. Veja o seu email");
           // foi necessário o stringify do array/Proxy compras, de modo a prepara-lo para ser acedido na
           // parte do laravel
                 axios.post('mail-send', {  
                     nome: this.nome,  
                     email: this.email,
                     transportadora: this.transportadora,
                     compras: JSON.stringify(this.compras),
                     soma: this.soma,
                     
                    
                 }).then(function (response) {  
                     obj.output = response.data;  
                 })  
                 .catch(function (error) {  
                     obj.output = error.response.data;  
                 });   
                 this.compras=[];
                
                },

              
 
            
         },
         created() {
             this.getProdutos()
             
         },
 computed:{
 // Os dois botões encontram-se desligados (o azul, quando o utilizador não preencher um valor numerico
 //positivo, para a quantidade, nem escolher um produto, eo  vermelho enquanto não houver produtos adicionados
 // assim como não ter escrito um nome, ou um email válido)
     isDisabled(){
       
       return (this.produto.length===0 || this.novaCompra.qtd.length===0 || this.novaCompra.qtd <=0)
  },
 
    isDisabled2(){
        return (this.compras.length===0 || this.nome.length===0 || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)===false)
  }
 },
         
        
 
 }
 
 
 
     
 
 
    
 </script>
 
 <style>
 
 .body{
     padding-top: 150px;
    
    
 }
 
 #selectID{
   width:240px;
   height:25px;
   font-size:14px;
   margin-left: 50%;

  
 
 }
 #nomeCliente{


     width: 50%;
     font-size:14px;
 }

 #formularioId{
  width: 50%;
 }
 
 
 #titulo{
     background-color: #AAAAAA;
     margin-top: 150px;
     margin-right:350px;
     padding-top: 30px;
     padding-left: 70px;
     padding-right: 30px;
     padding-bottom: 70px;
     width: 65%;
     display:center
     
     
    
   
  }
 
  #dropdownProdutoId{
  width:240px;
  height:25px;
  font-size:14px;
  }
 

 
  #optionId{
     width: 250px;
     font-size:14px;
  }
 
  #qtdId{
   width: 110px;
    margin-left: 130px;
    height:25px;
    font-size:14px;
   
  }
  #addTableId{
   background-color: #09afe7;
   color: white;

   width: 400px;
   height:25px;
   font-size: 14px;
   
  }
 
  table {
     border-collapse: collapse;
     border-style: hidden;
     border-bottom: 1px solid grey;
     font-size: 14px;
 }
 
 table td, table th {
     border: 1px solid grey;
     border-bottom: 1px solid grey;
 }
 
 #submit{
   background-color: #4CAF50;
   color: white;
   margin-left: 5px;
   margin-bottom: 98px;
   width: 400px;
   height:25px;
   font-size: 14px;
   
   
   
 }
 
 #divSubmit{
   position:absolute; 
    margin-right:20%;
    
    bottom:145px;
   
 }
 
 #tableContainer{
   background-color: white;
   height: 98%;
   display: table;
    text-align: center;
 }
 
 button:disabled {
   opacity: 0.6;
   cursor: not-allowed;
 }
 
 
 
 
 
 
 </style>