<template>
  <div class="container">
       <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Visualização de Produtos</div>
            <div class="card-body">
            	<div class="row">
            		<div class="col-md-6">
			             <img :src="url" width="50%"/>
            		</div>
            		<div class="col-md-6">
            			<p><b>Nome:</b>  {{produto.nome}}</p>
                  <p><b>Preço:</b> R${{produto.preco}},00</p>
                  <p><b>Categoria:</b> {{categoria}}</p>
                  <p><b>Descrição:</b> {{produto.descricao}}</p>
            		</div>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>  
</template>

<script>
export default {
  data() {
    return {
      produto: {},
      url : null,
      categoria: null,
      logado: null
    };
  },
  
  beforeCreate(){
    let url = `http://localhost:8000/api/verifica`;
    this.axios.post(url, {'api_token':localStorage.getItem('user-token')}).then(response => {
    if(response.data)
        return this.logado = true
    else
        this.$router.push({ name: 'login'})
    })
  },  
  
  created() {
    let uri = `http://localhost:8000/api/produtos/visualizar/${this.$route.params.id}`;
    this.axios.get(uri).then(response => {
      this.produto = response.data.produto
      this.categoria = response.data.categoria
      this.url =  response.data.url + this.produto.imagem.replace("public","storage");
    });
  }

};
</script>
