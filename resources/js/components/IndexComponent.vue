<template>
  <div class="container">
       <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Listagem de Produtos</div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-9">
                      <form @submit.prevent="pesquisar" class="form-inline">
                        <input
                          v-model="pesquisa.nome"
                          class="form-control mr-sm-2"
                          type="search"
                          placeholder="Pesquisar"
                          aria-label="Pesquisar"
                        />
                        <button class="btn btn-secondary" type="submit">Pesquisar</button>
                      </form>   
                    </div>
                        
                    <div class="col-md-3 text-right">
                      <router-link to="/create" class="btn btn-success">Novo</router-link>
                      <router-link to="/upload" class="btn btn-info text-white">Upload arquivo CSV</router-link>
                    </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class="thead">
                        <tr>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Categoria</th>
                            <th colspan="5" class="min">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="produto in produtos" :key="produto.id">
                            <td>{{ produto.nome }}</td>
                            <td>{{ produto.preco }}</td>
                            <td>{{ produto.categorias.nome }}</td>
                            <td><router-link :to="{name: 'view', params: { id: produto.id }}" class="btn btn-info text-white">Visualizar</router-link></td>
                            <td><router-link :to="{name: 'edit', params: { id: produto.id }}" class="btn btn-warning text-white">Editar</router-link></td>
                            <td><button class="btn btn-danger" @click.prevent="deleteProduto(produto.id)">Deletar</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              <nav aria-label="Paginas">
              <ul class="pagination ">
                <li
                  class="page-item"
                  v-for="page in pages"
                  :key="page"
                  :class="{active: source.current_page == page}"
                >
                  <a class="page-link" v-on:click="navegar(page)">{{page}}</a>
                </li>
              </ul>
              </nav>
            </div>
        </div>
    </div>
</div>
  </div>
</template>

<script>
import { range } from "lodash"
export default {
  data(){
    return {
      produtos: [],
        pages: [],
        source: [],
        pesquisa: {},
        logado: null,
      }
    },
    
    beforeCreate(){
      let url = `http://localhost:8000/api/verifica`
        this.axios.post(url, {'api_token':localStorage.getItem('user-token')}).then(response => {
          if(response.data)
            return this.logado = true
          else
            this.$router.push({ name: 'login'})
        })
    },
    
    created() {
      let uri = `http://localhost:8000/api/produtos?page=1`
      this.axios.get(uri).then(response => {
        this.produtos = response.data.data
        this.source = response.data.meta
        this.pages = range(1, this.source.last_page + 1)
      })
    },
    
    methods: {
      navegar(page) {
        let uri = `http://localhost:8000/api/produtos?page=${page}`
        this.axios.get(uri).then(response => {
          this.produtos = response.data.data
        })
        this.source.current_page = page
      },

      deleteProduto(id){
        if(confirm('Tem certeza que deseja excluir este produto?'))
        this.axios.delete(`http://localhost:8000/api/produtos/delete/${id}`).then(response => {
          this.produtos.splice(this.produtos.indexOf(id), 1)
        })
      },

      pesquisar() {
        let uri = `http://localhost:8000/api/produtos/pesquisa/${this.pesquisa.nome}`
        this.axios.get(uri).then(response => {
         this.produtos = response.data.data
         this.source = response.data.meta
        this.pages = range(1, this.source.last_page + 1)
        })
      },
    }

}
</script>