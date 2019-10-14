<template>
    <div class="container">
        <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form  @submit.prevent="login">
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Usuário</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" v-model="user.email" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" v-model="user.password" >                            
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
</template>

<script>
import { extend } from "vee-validate";
import { required , max } from "vee-validate/dist/rules";
extend("required", required);
extend("max", max);
extend("required", {
  message: "Este campo deve ser preenchido"
});
extend("max", {
  message: "O campo deve ter menos de 64 caracteres!" 
});
export default {
  data() {
    return {
      user: {}, 
    };
  },

  methods: {
    login() {   
        let url = 'http://localhost:8000/api/logar';
        this.axios.post(url, this.user).then((response) => {
            if(response.data){
                let api_token = response.data.api_token
                localStorage.setItem('user-token', api_token) 
                this.$router.push({   name: 'produtos' })
            }else{
                this.$router.push({ name: 'login' })
                console.log('Algo deu errado')
            }  
        });
    }
  }
}
</script>

