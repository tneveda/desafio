<template>

 <div :id="tituloID" class="container">
  <div class="row">
    <div class="col">
        <div class="col-sm-6" ><h6><strong>Ordem de Encomenda</strong></h6>
          <br>
          <div class="form-group">
            <div class="row">
                 <div :id="ClienteID" class="col-sm-6" ><h6><strong>Nome do Cliente</strong> </h6></div>
                 <div class="col-sm-6" >
                    <input :id="selectId" type="text"  v-model="nome"  placeholder="Inserir nome do Cliente">
                 </div>
                 
            </div>
            <br>

            <div class="row">
                 <div :id="ClienteID" class="col-sm-6" ><h6><strong>Mail</strong></h6></div>
                 <div class="col-sm-6" >
                    <input :id="selectId"  type="text"  v-model="email"  placeholder="Inserir mail do Cliente">
                 </div>
            </div>
            <br>
             <div class="row">
                  <div :id="ClienteID" class="col-sm-6"><h6><strong>Transportadora</strong></h6></div>
                  <div :id="boxId" class="col-sm-6" >

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
                   <div :id="adicionarID" class="col-sm-9" ><h6><strong>Adicionar Produto</strong></h6></div>
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
      <div class="col-sm-6" ><h6>Encomenda</h6></div>
      <div :id="tableContainer">    
        <table class="table">
  <thead>
    <tr>
    
      <th>Produto</th>
      <th>Quantidade</th>
      <th>Valor</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="c in compras">
      
      <td>{{c.nome}}</td>
      <td>{{c.qtd}}</td>
      <td>{{c.valor}}</td>
    </tr>
  </tbody>
</table>

<br>
<button :disabled="isDisabled2" @click="sentMail"> Add </button>
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
    blankID:"blank",
    tituloID:"titulo",
    ClienteID:"nomeCliente",
    selectId:"selectID",
    dropID:"drop",
    dropdownProdutoID:"dropdownProdutoId",
    adicionarID:"adicionarId",
    selectProdutoID:"selectProduto",
    optionId:"optionId",
    qtdID:"qtdId",
    boxId:"boxId",
    addTableID:"addTableId",
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
    

  

    onchange(e){
        console.log(e.target.value);
         
    },

    onchangeProduct(event){
        this.choosed = event.target.value;
         
    }
}
},



methods: {
            getProdutos(){
                var vm = this
                axios.get('/get_produtos')
                     .then((response)=>{
                       vm.produtos = response.data
                     })
            },
            addTable(){
                var single = this
                axios.get('/get_produtos/'+ single.choosed)
                     .then((response)=>{
                       single.compras.push({nome:response.data.nome,qtd:single.novaCompra.qtd,valor:(+(single.novaCompra.qtd*response.data.preco).toFixed(2))});
                     single.novaCompra = {nome:"",qtd:"",valor:""};
                     console.log(single.compras)
                    
                     })
            },

            sentMail(e) {
                e.preventDefault();
                var obj = this;

          
                axios.post('mail-send', {  
                    nome: this.nome,  
                    email: this.email,
                    transportadora: this.transportadora,
                    compras: this.compras 
                }).then(function (response) {  
                    obj.output = response.data;  
                })  
                .catch(function (error) {  
                    obj.output = error.response.data;  
                });   
              
               },

           
        },
        created() {
            this.getProdutos()
            
        },
computed:{

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
    padding-right: 250px;
    padding-left: 250px;
}

#selectID{
  width:300px;
  height:40px;
  font-size:15px;
 


}
#nomeCliente{
    padding-left: 25px;
    padding-top: 5px;
}


#titulo{
    background-color: #AAAAAA;
    margin-top: 150px;
    margin-left:150px;
    margin-right: 200px;
    padding-top: 30px;
    padding-left: 30px;
    padding-right: 30px;
    padding-bottom: 30px;
   
  
 }


 #selectProduto{
  padding-left: 15px;
  

 }
 #dropdownProdutoId{
 width: 350px;
 height:40px;
 }

 #adicionarId{
    padding-left: 15px;
 
 }

 #optionId{
    width: 250px;
 }

 #qtdId{
  width: 90px;
 margin-left: 150px;
  height:40px;
  
 }
 #addTableId{
  background-color: #09afe7;
  color: white;
  margin-left: 15px;
  width: 455px;
 }





</style>