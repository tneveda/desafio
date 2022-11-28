<template>

    <div :id="blankID">

        
    <div :id="tituloID" class="container">
        <div class="row">
      <div class="col-sm-6" ><h6>Ordem de Encomenda</h6></div>
      <div class="col-sm-6" ><h6>Encomenda</h6></div>
       </div>
       <br>
       <div class="row">
      <div :id="ClienteID" class="col-sm-3" ><h6>Nome do Cliente</h6></div>
      <div class="col-sm-3" >
        
        <input v-model="nome"  placeholder="Inserir nome do Cliente">
        <p>{{ nome }}</p>
    </div>
       </div>
       <div class="row">
      <div :id="ClienteID" class="col-sm-3" ><h6>Email</h6></div>
      <div class="col-sm-3" >
        
        <input v-model="email" placeholder="Inserir email do Cliente">
        <p>{{ email }}</p>
    </div>
       </div>

       <div class="row">
      <div :id="ClienteID" class="col-sm-3" ><h6>Transportadora</h6></div>
      <div class="col-sm-3" >
        
        <select name="transportadoraID" @change="onchange($event)" class="form-select form-control">
  <option value="">Transportadora</option>
  <option value="DHL">DHL</option>
  <option value="CTT Express">CTT Express</option>
  <option value="DPD">DPD</option>
  <option value="Envialia">Envialia</option>
  <option value="FedEx">FedEx</option>
  <option value="GLS2">GLS2</option>
  <option value="UPS">UPS</option>
</select>
    </div>
       </div>


    </div>
    <br>

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

    onchange(e){
        console.log(e.target.value);
    }
}
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
   
    
 }
</style>