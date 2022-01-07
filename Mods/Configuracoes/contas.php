<template id="contas" >
  <div class="p-4">
    <table class="table" >
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Usuário</th>
            <th scope="col">Privilégio</th>
            <th scope="col">Ação</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="usuario of users">
            <th scope="row">{{usuario.id}}</th>
            <td>{{usuario.usuario}}</td>
            <td>{{usuario.privilegio == 1? 'ADM':'Limitado'}}</td>
            <td>
            <div>
                <b-button-group>                   
                    <b-dropdown left >
                        <b-dropdown-item>
                        <router-link to="/foo" class="uil-pen"> Editar</router-link>
                        </b-dropdown-item>
                        <b-dropdown-item>
                          <a href="" class="uil-trash">
                            Deletar
                          </a>
                        </b-dropdown-item>
                    </b-dropdown>                   
                </b-button-group>
            </div>
            </td>
        </tr>
        </tbody>
    </table>
    <script type="application/javascript">

    </script>
  </div>
</template>


