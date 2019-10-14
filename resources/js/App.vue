<template>
  <div>
    <!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-4">
       <div class="text-white"> 
         <router-link to="/produtos" class="nav-link">CRUD Produtos DevSquad</router-link>
        <ul class="navbar-nav">
          <li class="nav-item active">CRUD Produos DevSquad</li>
        </ul>
        
      </div>
    </nav> -->
     <nav class="navbar navbar-expand-sm bg-dark navbar-dark mb-4">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto text-white">
              CRUD Produtos DevSquad
          </ul>
          <ul class="navbar-nav ml-auto">
              <li class="nav-item text-white">
                  <a v-if="nome" @click.prevent="logout()" role="button"><span>Sair</span></a>
              </li>
              
          </ul>
      </div>
     </nav>
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>
<script>
import { range } from "lodash";
  export default {
    data(){
        return {
          api_token: localStorage.getItem('user-token'),
          nome: ''
        }
    },

    created() {
      let url = `http://localhost:8000/api/verifica`;
      this.axios.post(url, {'api_token':this.api_token}).then(response => {
        if(response.data){
          this.nome = response.data.nome
        }
      })
    },

    methods: {
        logout(){
          localStorage.clear();
          this.api_token = null,
          this.nome = null,
          this.$router.push({ name: 'login' })
        }
    }

  }
</script>