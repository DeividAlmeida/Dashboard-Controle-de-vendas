<template id="cadUsuarios">
    <div class="p-4">
        <link href="./Mods/src/style/empresas.css" rel="stylesheet" >        
        <form  class="row">
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Nome :</label>
                    <input name="nome"  class="form-control inputEmpresa"  required>
                </div>                
                <div class="form-group p-2">
                    <label>Empresa: </label>
                    <select name="empresa_id" class="form-control inputEmpresa custom-select" required  >
                        <option value="" hidden >Empresa</option>
                    <?php if ($valida['privilegio'] == 1) { ?>                    
                        <option v-for="empresa, index of empresas[0]" :value="empresa.id" :data-key="index" >{{empresa.nome}}</option>                    
                    <?php }else{ ?>
                        <option  :value="empresas[0].id" >{{empresas[0].nome}}</option>                    
                    <?php } ?>
                    </select>
                </div>         
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Tipo de Usuário :</label>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" id="tipo1" name="tipo" value="1">
                        <label class="form-check-label" for="tipo1">Supervisor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="tipo2" name="tipo" value="2">
                        <label class="form-check-label" for="tipo2">Vendedor</label>
                    </div>
                </div>
                <div class="form-group p-2 ">
                    <label for="exampleInputEmail1" class="d-block">Status do Vendedor:</label>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" id="inlineCheckbox1" name="status_usuario" value="1" >
                        <label class="form-check-label" for="inlineCheckbox1">Ativo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2" name="status_usuario" value="0" >
                        <label class="form-check-label" for="inlineCheckbox2">Bloqueado</label>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label>Estado: </label>
                    <select name="uf" class="form-control inputEmpresa custom-select" required  >
                        <option value="" hidden >Estado</option>
                        <option value="AC" >Acre</option>
                        <option value="AL" >Alagoas</option>
                        <option value="AP" >Amapá</option>
                        <option value="AM" >Amazonas</option>
                        <option value="BA" >Bahia</option>
                        <option value="CE" >Ceará</option>
                        <option value="DF" >Distrito Federal</option>
                        <option value="ES" >Espírito Santo</option>
                        <option value="GO" >Goiás</option>
                        <option value="MA" >Maranhão</option>
                        <option value="MT" >Mato Grosso</option>
                        <option value="MS" >Mato Grosso do Sul</option>
                        <option value="MG" >Minas Gerais</option>
                        <option value="PA" >Pará</option>
                        <option value="PB" >Paraíba</option>
                        <option value="PR" >Paraná</option>
                        <option value="PE" >Pernambuco</option>
                        <option value="PI" >Piauí</option>
                        <option value="RJ" >Rio de Janeiro</option>
                        <option value="RN" >Rio Grande do Norte</option>
                        <option value="RS" >Rio Grande do Sul</option>
                        <option value="RO" >Rondônia</option>
                        <option value="RR" >Roraima</option>
                        <option value="SC" >Santa Catarina</option>
                        <option value="SP" >São Paulo</option>
                        <option value="SE" >Sergipe</option>
                        <option value="TO" >Tocantins</option>
                    </select>
                </div>

                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Email:</label>
                    <input name="email" class="form-control inputEmpresa"   required type="email">
                </div>

                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Telefone:</label>
                    <input maxlength="15" name="telefone" class="form-control inputEmpresa" id="telefone" required >
                </div>                
            </div>

            <div class="col-md-6">                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">CPF:</label>
                    <input  class="form-control " id="cpf"  required  name="cpf">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Senha:</label>
                    <input name="senha" class="form-control inputEmpresa" value="123" autocomplete="off"  required >
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">UUID:</label>
                    <input class="form-control inputEmpresa" disabled>
                </div>                                 
                <div class="form-group p-2">
                    <label for="exampleInputEmail1"> Versão do APP:</label>
                    <input  class="form-control inputEmpresa" disabled>
                </div>                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Último Acesso:</label>
                    <input  class="form-control inputEmpresa" type="date"  disabled >
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">ID Vendedor:</label>
                    <input name="id_vendedor" type="number" class="form-control inputEmpresa" required >
                </div>                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Data Criação:</label>
                    <input  class="form-control inputEmpresa" disabled type="date">
                </div>
            </div>
            <hr class="mt-5 mb-5">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                        <i class="uil-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<template id="editUsuario">
    <div class="p-4">
        <link href="./Mods/src/style/empresas.css" rel="stylesheet" >
        <form  class="row">
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Nome :</label>
                    <input v-model="usuario[0][3]" name="nome"  class="form-control inputEmpresa"  required>
                </div>                
                <div class="form-group p-2">
                    <label>Empresa: </label>
                    <select v-model="usuario[0][1]" name="empresa_id" class="form-control inputEmpresa custom-select" required  >
                        <option value="" hidden >Empresa</option>
                    <?php if ($valida['privilegio'] == 1) { ?>                    
                        <option v-for="empresa, index of empresas[0]" :value="empresa.id" :data-key="index" >{{empresa.nome}}</option>                    
                    <?php }else{ ?>
                        <option  :value="empresas[0].id" >{{empresas[0].nome}}</option>                    
                    <?php } ?>
                    </select>
                </div>                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Tipo de Usuário :</label>
                    <div class="form-check form-check-inline ">
                        <input v-model="usuario[0][5]" class="form-check-input" type="radio" id="tipo1" name="tipo" value="1">
                        <label class="form-check-label" for="tipo1">Supervisor</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="usuario[0][5]" class="form-check-input" type="radio" id="tipo2" name="tipo" value="2">
                        <label class="form-check-label" for="tipo2">Vendedor</label>
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Status do Vendedor:</label>
                    <div class="form-check form-check-inline ">
                        <input v-model="usuario[0][2]" class="form-check-input" type="radio" id="inlineCheckbox1" name="status_usuario" value="1" >
                        <label class="form-check-label" for="inlineCheckbox1">Ativo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="usuario[0][2]" class="form-check-input" type="radio" id="inlineCheckbox2" name="status_usuario" value="0" >
                        <label class="form-check-label" for="inlineCheckbox2">Bloqueado</label>
                    </div>
                </div>

                <div class="form-group p-2">
                    <label>Estado: </label>
                    <select :value="usuario[0][6]" name="uf" class="form-control inputEmpresa custom-select" required  >
                        <option value="" hidden >Estado</option>
                        <option value="AC" >Acre</option>
                        <option value="AL" >Alagoas</option>
                        <option value="AP" >Amapá</option>
                        <option value="AM" >Amazonas</option>
                        <option value="BA" >Bahia</option>
                        <option value="CE" >Ceará</option>
                        <option value="DF" >Distrito Federal</option>
                        <option value="ES" >Espírito Santo</option>
                        <option value="GO" >Goiás</option>
                        <option value="MA" >Maranhão</option>
                        <option value="MT" >Mato Grosso</option>
                        <option value="MS" >Mato Grosso do Sul</option>
                        <option value="MG" >Minas Gerais</option>
                        <option value="PA" >Pará</option>
                        <option value="PB" >Paraíba</option>
                        <option value="PR" >Paraná</option>
                        <option value="PE" >Pernambuco</option>
                        <option value="PI" >Piauí</option>
                        <option value="RJ" >Rio de Janeiro</option>
                        <option value="RN" >Rio Grande do Norte</option>
                        <option value="RS" >Rio Grande do Sul</option>
                        <option value="RO" >Rondônia</option>
                        <option value="RR" >Roraima</option>
                        <option value="SC" >Santa Catarina</option>
                        <option value="SP" >São Paulo</option>
                        <option value="SE" >Sergipe</option>
                        <option value="TO" >Tocantins</option>
                    </select>
                </div>

                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Email:</label>
                    <input v-model="usuario[0][12]" name="email" class="form-control inputEmpresa"   required type="email">
                </div>

                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Telefone:</label>
                    <input  v-model="usuario[0][8]" name="telefone" class="form-control inputEmpresa" id="telefone" maxlength="15"  required >
                </div>                
            </div>

            <div class="col-md-6">                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">CPF:</label>
                    <input  class="form-control inputEmpresa" id="cpf"  required  name="cpf">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Senha:</label>
                    <input  v-model="usuario[0][4]" name="senha" class="form-control inputEmpresa"  autocomplete="off" >
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">UUID:</label>
                    <input v-model="usuario[0][9]" class="form-control inputEmpresa" name="uuid" >
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Versão do APP:</label>
                    <input v-model="usuario[0][10]"  class="form-control inputEmpresa"   disabled>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Último Acesso:</label>
                    <input v-model="usuario[0][15]" class="form-control inputEmpresa" type="datetime-local" disabled>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">ID Vendedor:</label>
                    <input v-model="usuario[0][13]" name="id_vendedor" class="form-control inputEmpresa"   required >
                </div>                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Data Criação:</label>
                    <input  name="created_at" class="form-control inputEmpresa" type="datetime-local"  disabled>
                </div>
            </div>
            <hr class="mt-5 mb-5">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                        <i class="uil-save"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<template id="usuarios">
    <div class="p-4">
    <table class="table" >
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nome</th>
                <th scope="col">Empresa</th>
                <th scope="col">Tipo</th>
                <th scope="col">Email</th>
                <th scope="col">Telefone</th>
                <th scope="col">Ação</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="usuario, index of usuarios[0]">
                <th scope="row">{{usuario[0]}}</th>                
                <td>{{usuario[3]}}</td>
                <td>{{nome_emp[index]}}</td>
                <td>{{usuario[5] == 1? 'Supervisor':'Vendedor'}}</td>
                <td>{{usuario[12]}}</td>
                <td>{{usuario[8]}}</td>
                <td>
                <div>
                    <b-button-group>                   
                        <b-dropdown right >
                            <b-dropdown-item>
                            <router-link :to="'/Usuario/'+usuario[0]" class="uil-pen p-3"> Editar</router-link>
                            </b-dropdown-item>
                            <b-dropdown-item @click="deleta(index, usuario[0])">
                            <a href="" class="uil-trash p-3">
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
    </div>
</template>
<script>
const  cadUsuarios = { 
      template: '#cadUsuarios', 
      props: { 
        empresas: 
        {
          type: Array, 
          default: () =>  [<?php echo json_encode($empresa); ?>]
        } 
      },
      methods:{
           
      },
      mounted(){        
        var input_cpf = document.getElementById("cpf"),
        telefone = document.getElementById('telefone')

        telefone.addEventListener("keydown", async function(event) {
            telefone.value=telefone.value.replace(/\D/g,"");
             telefone.value = await telefone.value.replace(/^(\d{2})(\d)/g,"($1) $2"); 
            telefone.value = await telefone.value.replace(/(\d)(\d{4})$/,"$1-$2"); 
        })

        input_cpf.addEventListener("focus" , function(event) {
            input_cpf.value = "___.___.___-__"
            setTimeout(function() {
                input_cpf.setSelectionRange(0, 0)
            }, 1)
        })
        
        input_cpf.addEventListener("keydown", function(event) {
            event.preventDefault()
            if("0123456789".indexOf(event.key) !== -1
                && this.value.indexOf("_") !== -1) {
                    this.value = this.value.replace(/_/, event.key)
                    const next_index = this.value.indexOf("_")
                    this.setSelectionRange(next_index, next_index)
            } else if (event.key === "Backspace") {
                this.value = this.value.replace(/(\d$)|(\d(?=\D+$))/, "_")
                const next_index = this.value.indexOf("_")
                this.setSelectionRange(next_index, next_index)
            }
        })
        document.querySelectorAll('form.row')[0].addEventListener('submit', async event=>{
            event.preventDefault()
            if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(document.querySelector('input[type="email"]').value)){
                var formData = new FormData()
                document.querySelectorAll('.inputEmpresa')
                .forEach(
                input=>{
                    formData.append(input.name,input.value)
                }
                )
                document.querySelectorAll('input[type="radio"]')
                .forEach(
                radio=>{
                    if(radio.checked)return formData.append(radio.name,radio.value)
                }
                )
                formData.append('cpf', document.getElementById('cpf').value.replace(/[^\d]/g, ""))
                await fetch('apis/controller.php?createUsuario',{
                        method: "POST",
                        headers: {
                            "Authorization": "Basic <?php echo base64_encode($_SESSION['lojadeaplicativo'][0] . ":" . $_SESSION['lojadeaplicativo'][1]) ?>",                        
                        },
                        body:  formData
                    })
                .then(a=>a.json())
                .then(a=>{
                    if(a!=undefined){
                        swal("Salvo!", "Dados salvos com sucesso!", "success")
                        ctrl.$emit('addUsuario', a)
                        
                    }else{
                        swal("Erro!", "Erro interno!", "error")
                    }
                })
            }else{
                swal("Erro!", "E-mail invalido", "error")
            }
        })
      }
    },
    editUsuario = { 
      template: '#editUsuario', 
      props: { 
        empresas: 
        {
          type: Array, 
          default: () =>  [<?php echo json_encode($empresa); ?>]
        } 
      },
      data(){
          return {
              usuario:[[]], 
              estoque: undefined
          }
      },
      methods:{
            
      },
      mounted(){        
        var input_cpf = document.getElementById("cpf"),
        telefone = document.getElementById('telefone')

        telefone.addEventListener("keydown", async function(event) {
            telefone.value=telefone.value.replace(/\D/g,"");
            telefone.value = await telefone.value.replace(/^(\d{2})(\d)/g,"($1) $2"); 
            telefone.value = await telefone.value.replace(/(\d)(\d{4})$/,"$1-$2"); 
        })

        input_cpf.addEventListener("focus" , function(event) {
            input_cpf.value = "___.___.___-__"
            setTimeout(function() {
                input_cpf.setSelectionRange(0, 0)
            }, 1)
        })

        input_cpf.addEventListener("keydown", function(event) {
            event.preventDefault()
            if("0123456789".indexOf(event.key) !== -1
                && this.value.indexOf("_") !== -1) {
                    this.value = this.value.replace(/_/, event.key)
                    const next_index = this.value.indexOf("_")
                    this.setSelectionRange(next_index, next_index)
            } else if (event.key === "Backspace") {
                this.value = this.value.replace(/(\d$)|(\d(?=\D+$))/, "_")
                const next_index = this.value.indexOf("_")
                this.setSelectionRange(next_index, next_index)
            }
        })
        document.querySelectorAll('form.row')[0].addEventListener('submit', async event=>{
            event.preventDefault()
            if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(document.querySelector('input[type="email"]').value)){
                var formData = new FormData()
                document.querySelectorAll('.inputEmpresa')
                .forEach(
                input=>{
                    formData.append(input.name, input.value)
                }
                )
                document.querySelectorAll('input[type="radio"]')
                .forEach(
                radio=>{
                    if(radio.checked)return formData.append(radio.name,radio.value)
                })
                formData.append('cpf', document.getElementById('cpf').value.replace(/[^\d]/g, ""))
                await fetch(`apis/controller.php?editUsuario=${this.$route.params.id}`,{
                        method: "POST",
                        headers: {
                            "Authorization": "Basic <?php echo base64_encode($_SESSION['lojadeaplicativo'][0] . ":" . $_SESSION['lojadeaplicativo'][1]) ?>",                        
                        },
                        body:  formData
                    })
                .then(a=>a.json())
                .then(a=>{
                    if(a!=undefined){
                        swal("Salvo!", "Dados salvos com sucesso!", "success")
                        ctrl.$emit('addUsuario', a)
                    }else{
                        swal("Erro!", "Erro interno!", "error")
                    }
                })
            }else{
                swal("Erro!", "E-mail invalido", "error")
            }
        })        
        usuariosCad[0].filter(async (a,i)=>{            
            if(a[0] == this.$route.params.id){
                this.usuario=  [a]
                document.getElementById('cpf').value = await a[7].replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4")
                document.querySelectorAll('input[type="datetime-local"]')[0].value = await new Date(a[15]).toISOString().slice(0,-8)
                document.querySelectorAll('input[type="datetime-local"]')[1].value = await new Date(a[14]).toISOString().slice(0,-8)
            }            
        })
      }
    },
    usuarios = { 
        template: '#usuarios', 
        props: { 
            usuarios: 
                {
                    type: Array, 
                    default: () =>  usuariosCad
                } 
        },
        methods:{
            
            deleta: function (index , id) {
                swal({
                    title: "Tem certeza ?!",
                    text: "Você deseja mesmo deletar esse usuário ?",
                    icon: "warning",
                    buttons: true,
                    buttons: ["Não", "Sim"],

                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        fetch(`apis/controller.php?removeUsuario=${id}`,{
                            method: "GET",
                            headers: {
                                "Authorization": "Basic <?php echo base64_encode($_SESSION['lojadeaplicativo'][0] . ":" . $_SESSION['lojadeaplicativo'][1]) ?>",                        
                            },                            
                        })
                        .then(a=>a.text())
                        .then(async a=>{
                            if(a==1){
                                ctrl.$emit('removeUsuario', index) 
                                await this.$forceUpdate()
                                swal("Usuário deletada com sucesso !", {
                                    icon: "success"
                                });
                            }else{
                                swal("Erro interno!", {
                                    icon: "error"
                                })
                            }
                        })
                    } else {
                        swal("Procedimento cancelado !", {
                            icon: "error",
                        });
                    }
                });
            },
        },
        data(){
          return {
            nome_emp:[]
          }
        },
        mounted(){
            usuariosCad[0].forEach((user,i)=>{
                empresasCad.filter(emp=>{
                    if(emp.id == user[1]){
                        this.nome_emp.push(emp.nome)
                    }
                })
            })
        }
    }
</script>
<script src="Mods/src/script/usuarios.js"></script>