<template>

    <div :id="blankID">

        <div :id="tituloID" class="container">
      <div class="row">
          <div class="col-sm-6" ><h6>Ordem de Encomenda</h6></div>
          <div class="col-sm-6" ><h6>Encomenda</h6></div>
      </div>
       <br>


        <div class="row">
          <div class="col-sm-6" >

            <div class="row">
          <div :id="ClienteID" class="col-sm-6" ><h6>Nome do Cliente</h6></div>
              <div class="col-sm-6" >
        
                <input v-model="nome"  placeholder="Inserir nome do Cliente">
              
              </div>
          </div>

       <div class="row">
      <div :id="ClienteID" class="col-sm-6" ><h6>Email</h6></div>
      <div class="col-sm-6" >
        
        <input :id="boxId" v-model="email" placeholder="Inserir email do Cliente">
    </div>
       </div>

       <div class="row">
      <div :id="ClienteID" class="col-sm-6" ><h6>Transportadora</h6></div>
      <div :id="boxId" class="col-sm-6" >

                            <select :id="selectId" class=' form-select form-control-sm' v-model='transportadora' @change="onchange($event)">
                                <option value="DHL">DHL</option>
                                <option value="CTT Express">CTT Express</option>
                                <option value="DPD">DPD</option>
                                <option value="Envialia">Envialia</option>
                                <option value="FedEx">FedEx</option>
                                <option value="GLS2">GLS2</option>
                                <option value="UPS">UPS</option>
                            </select>
                        
       

     <!-- <h3 class="text-lg text-center font-bold mb-4">

        <select name="transportadoraID" @change="onchange($event)" class="form-select form-control">
  <option value="DHL">DHL</option>
  <option value="CTT Express">CTT Express</option>
  <option value="DPD">DPD</option>
  <option value="Envialia">Envialia</option>
  <option value="FedEx">FedEx</option>
  <option value="GLS2">GLS2</option>
  <option value="UPS">UPS</option>
</select>
</h3>-->

    </div>
    <div class="row">
    <div :id="adicionarID" class="col-sm-9" ><h6>Adicionar Produto</h6></div>
        <div :id="selectProdutoID" class="row">
            <div :id="optionId" class="col-sm-6" >
                            <select  :id="selectId"  class=' form-select form-control-md' v-model='produto' @change="onchangeProduct($event)">
                                <option value='0' >Escolha o produto</option>
                                <option v-for='data in produtos' :value='data.id'>{{ data.nome }} </option>
                            </select>
                        </div>

    <div :id="qtdID" class="col-sm-3" >
        
        <input  v-model="novaCompra.qtd" placeholder="Qtd">
    
    </div>
    <button :disabled="isDisabled" @click="addTable"> Add </button>
       </div>
       </div>
       <br>
       <div>
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
<button :disabled="isDisabled2" @click="sentMail"> Add </button>

       </div>
       {{output}}
       
       
       </div>
    
    </div>
    <br>




          </div>
          </div>
        
  
  

</div>

  
</template>

<script>
import emailjs from 'emailjs-com';

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
    adicionarID:"adicionarId",
    selectProdutoID:"selectProduto",
    optionId:"optionId",
    qtdID:"qtdId",
    boxId:"boxId",
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
                axios.post('/mail-send', {  
                    nome: this.nome,  
                    email: this.email,
                    transportadora: this.transportadora,
                    compras: this.compras 
                }).then(function (response) {  
                    obj.output = response.data;  
                })  
                .catch(function (error) {  
                    obj.output = error;  
                });   
      
               },
        },
        created() {
            this.getProdutos()
            
        },
computed:{

    isDisabled(){
       return !(this.produto && this.novaCompra.qtd)
 },

   isDisabled2(){
       return (this.compras.length===0 || this.nome.length===0 || this.email.length===0)
 }
},
        
       

}



    


   
</script>

<style>

#blank{
    padding-top: 150px;
    padding-right: 250px;
    padding-left: 250px;
}

#nomeCliente{
    padding-left: 30px;
}



#titulo{
    background-color: #AAAAAA;
    padding-top: 20px;
    padding-left: 10px;
    padding-bottom: 50px;
  
 }


 #selectProduto{
  padding-left: 30px;
  

 }

 #adicionarId{
    padding-left: 30px;
    padding-top: 50px;
 }

 #optionId{
    width: 250px;
 }

 #qtdId{
    width: 4px;
 }





</style>