<template>
<div class="container">
    <div class="card">
        <div class="card-header">Cadastro produtos</div>
        <div class="card-body">
            <form enctype="multipart/form-data" @submit.prevent="addProduto">
                <div class="form-row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div id="preview">
                                    <img  :src="urlImage" class="w-100" id="preview">
                                </div> 
                                 <span class="btn btn-primary btn-block" id="select-image">Selecione uma imagem</span>
                                 <input type="file" id="file" ref="imagem" class="custom-file-input" @change="handleFileUpload" accept="image/jpeg, image/png"/>
                            </div>
                            <div class="col-md-9">
                                <div class="form-row">
                                    <div class="form-group col-md-9">
                                        <ValidationProvider mode="aggressive" rules="required|max:64"  v-slot="{ errors }">
                                            <label>Nome:</label>
                                            <input type="text" class="form-control"  v-model="produto.nome" />
                                            <span class="alert-danger">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Preço</label>
                                        <input type="number" step=0.01 min="0" class="form-control" v-model="produto.preco" />     
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <ValidationProvider mode="aggressive" rules="required" v-slot="{ errors }">
                                            <label>Categoria</label>
                                            <select name="categorias_id" v-model="produto.categoria_id" class="form-control">
                                                <option :value="categoria.id" v-for="categoria in categorias" v-bind:key="categoria.id">{{categoria.nome}}</option>
                                            </select>
                                            <span class="alert-danger">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <ValidationProvider mode="aggressive" rules="required" v-slot="{ errors }">
                                            <label>Descrição:</label>
                                            <textarea class="form-control" v-model="produto.descricao" rows="5"></textarea>
                                            <span class="alert-danger">{{ errors[0] }}</span>
                                        </ValidationProvider>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="float-right btn btn-success">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</template>
<script>

import { extend } from "vee-validate"
import { required , max } from "vee-validate/dist/rules"
extend("required", required)
extend("max", max)
extend("required", {
  message: "Este campo deve ser preenchido"
})
extend("max", {
  message: "O campo deve ter menos de 64 caracteres!" 
})

export default{
    data() {
        return {
            produto: {},
            categorias: [],
            selectedFile: null,
            urlImage: "https://i0.wp.com/www.aklimper.com.br/wp-content/uploads/2018/11/sem_foto-500x538.jpg",
            logado: null,
            api_token: localStorage.getItem('user-token')
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
        let uri = `http://localhost:8000/api/produtos/categorias`
        this.axios.get(uri).then(response => {
            this.categorias = response.data
        })
    },

    methods: {
        handleFileUpload(e){
            this.selectedFile = event.target.files[0]
            this.urlImage = URL.createObjectURL(this.selectedFile)
        },

        updateProduto(){
            let uri = `http://localhost:8000/api/produtos/update/${this.$route.params.id}`
            let data = new FormData()
            if(this.selectedFile){
                data.append("imagem", this.selectedFile, this.selectedFile.name)    
                data.append("nome", this.produto.nome)
                data.append("descricao", this.produto.descricao)
                data.append("categoria_id", this.produto.categoria_id)
                data.append("preco", this.produto.preco)
                this.axios.post(uri, data, { headers: { "Content-Type": "multipart/form-data" } }).then((response) => {
                    this.$router.push({ name: 'produtos' })
                })
            }else{
                data.append("imagem", this.urlImage )    
                data.append("nome", this.produto.nome)
                data.append("descricao", this.produto.descricao)
                data.append("categoria_id", this.produto.categoria_id)
                data.append("preco", this.produto.preco)
                this.axios.post(uri, data, { headers: { "Content-Type": "multipart/form-data" } }).then((response) => {
                    this.$router.push({ name: 'produtos' })
                })
            }        
        },
    }
}
</script>