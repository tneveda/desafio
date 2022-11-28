<template>
    <div id="titulo">
      
    <h3 id="teste">Ordem de Encomenda</h3>
    <h3 id="cenas2">Nome do Cliente</h3>

    <div id="teste" class="container mx-auto mt-10 px-10">

<div class="mx-auto mt-20">

    <h3 class="text-lg text-center font-bold mb-4">
 <select name="transportadoraID" @change="onchange($event)" class="form-select form-control">
  <option value="">Cenas</option>
  <option value="DHL">DHL</option>
  <option value="CTT">CTT</option>
  <option value="teste">teste</option>
  <option value="ola">ola</option>
  <option value="Amanha">Amanha</option>
  <option value="cara">cara</option>
  <option value="Cenas1">Cenas1</option>
</select>

    </h3>

     <div class="flex justify-center">

        <Dropdown />

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
    onchange(e){
        console.log(e.target.value);
    }
}
}
}
   
</script>

<style>

</style>