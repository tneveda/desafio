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
                <p>{{ nome }}</p>
              </div>
          </div>

       <div class="row">
      <div :id="ClienteID" class="col-sm-6" ><h6>Email</h6></div>
      <div class="col-sm-6" >
        
        <input v-model="email" placeholder="Inserir email do Cliente">
        <p>{{ email }}</p>
    </div>
       </div>

       <div class="row">
      <div :id="ClienteID" class="col-sm-6" ><h6>Transportadora</h6></div>
      <div :id="boxId" class="col-sm-6" >

                            <select :id="selectId" class=' form-select form-control-md' v-model='transportadora' @change="onchange($event)">
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
    <div :id="adicionarID" class="col-sm-6" ><h6>Adicionar Produto</h6></div>
        <div :id="selectProdutoID" class="row">
            <div :id="optionId" class="col-sm-6" >
                            <select  :id="selectId"  class=' form-select form-control-md' v-model='produto' @change="onchange($event)">
                                <option value='0' >Escolha o produto</option>
                                <option v-for='data in produtos' :value='data.id'>{{ data.nome }} </option>
                            </select>
                        </div>

    <div :id="qtdID" class="col-sm-6" >
        
        <input v-model="quantidade" placeholder="Qtd">
        <p>{{ quantidade }}</p>
    </div>
       </div>
       </div>
       <br>

       
       
       
       </div>
    
    </div>
    <br>




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

    onchange(e){
        console.log(e.target.value);
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
            }
        },
        created() {
            this.getProdutos()
        }


}



    


   
</script>

<style>

#blank{
    padding-top: 150px;
    padding-right: 350px;
    padding-left: 350px;
}

#nomeCliente{
    padding-left: 30px;
}



#titulo{
    background-color: #AAAAAA;
    padding-top: 20px;
    padding-left: 20px;
    padding-bottom: 50px;
  
 }

 #selectID{
  
  padding: 2px 7px;
  border: none;

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
    width: 5px;
 }




</style>