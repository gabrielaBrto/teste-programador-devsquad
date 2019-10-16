<template>
<div class="container">
    <div class="card">
        <div class="card-header">Cadastro de produtos por CSV</div>
        <div class="card-body">
            <form enctype="multipart/form-data" @submit.prevent="addFile">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="custom-file">
                            <input ref="arquivo" type="file" class="custom-file-input" @change="handleFileUpload" id="validatedCustomFile" accept=".csv" required>
                            <label class="custom-file-label" for="validatedCustomFile">Selecione um arquivo...</label>
                        </div>    
                    </div>
                </div>        
                <div class="form-group">
                    <button class="btn btn-success">Enviar</button>
                </div>  
            </form>
        </div>
    </div>
</div>
</template>
<script>
export default {
     data() {
        return {
            file: {},
            selectedFile: null,
            logado: null 
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
  
    methods: {
        handleFileUpload(e){
            this.selectedFile = event.target.files[0]
        },
  
        addFile() {        
            let uri = 'http://localhost:8000/api/produtos/upload'   
            let data = new FormData()
            data.append("arquivo", this.selectedFile, this.selectedFile.name)
            this.axios.post(uri, data, { headers: { "Content-Type": "multipart/form-data" } }).then((response) => {
                if(response.data){
                    this.$router.push({ name: 'produtos' });
                }
            })
        }
    }
}
</script>