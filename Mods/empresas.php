<template id="cadEmpresas">
    <div class="p-4">
        <link href="./Mods/src/style/empresas.css" rel="stylesheet" >
        <form action="/lugar.php" class="row" enctype="multipart/form-data">
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Nome da Empresa:</label>
                    <input  class="form-control inputEmpresa"  required name="nome">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">CNPJ:</label>
                    <input maxlength="14" class="form-control inputEmpresa" @blur="maskcnpj" required name="cnpj_cpf">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">URL:</label>
                    <input  class="form-control inputEmpresa"  required name="url">
                </div>
                <div class="form-group p-2 row">
                    <div class="col-6">
                        <label for="exampleInputEmail1">ID Empresa: </label>
                        <input  class="form-control inputEmpresa"  required name="id_empresa">
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail1"> &nbsp;&nbsp; ID Filial:</label>
                        <input  class="form-control inputEmpresa"  required name="id_filial">
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Estoque Negativo:</label>
                    <div class="form-check form-check-inline ">
                        <input class="form-check-input" type="radio" id="inlineCheckbox1" name="estoque_negativo" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox2" name="estoque_negativo" value="0">
                        <label class="form-check-label" for="inlineCheckbox2">Não</label>
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Política de Desconto:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox3" name="tipo_politica_desconto" value="1">
                        <label class="form-check-label" for="inlineCheckbox3">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="inlineCheckbox4" name="tipo_politica_desconto" value="0">
                        <label class="form-check-label" for="inlineCheckbox4">Não</label>
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Endereço:</label>
                    <textarea  class="form-control inputEmpresa"  required name="endereco"></textarea>
                </div>
                <div class="form-group p-2">
                    <label>Estado: </label>
                    <select name="estado" class="form-control custom-select inputEmpresa" required   name="estado">
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
                    <label for="exampleInputEmail1">Cidade:</label>
                    <input  type="text" class="form-control inputEmpresa"   required name="cidade">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Telefone:</label>
                    <input id="telefone" maxlength="15" type="text" class="form-control inputEmpresa"   required name="telefone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Site:</label>
                    <input type="text" class="form-control inputEmpresa"   required name="site">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Email:</label>
                    <input type="email" class="form-control inputEmpresa"   required type="email" name="email">
                </div>
                <div class="m-2">
                    <label for="">Carregar Logo:</label>
                    <label for="formFile" class="form-label d-flex justify-content-center" id="preview">
                        <i class="uil-image-upload iconeUpload" ></i>
                    </label>
                    <input @change="capa()" class="form-control d-none" type="file" id="formFile" name="logo" accept='image/*'>
                    <small>Recomendamos que utilize imagem com altura e largura de mesmo tamanho, Ex.: 800x800</small>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Login:</label>
                    <input class="form-control inputEmpresa"   required name="usuario">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Senha:</label>
                    <input  class="form-control inputEmpresa" autocomplete="off"  required type="text" name="senha">
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

<template id="editEmpresa">
    <div class="p-4">
        <link href="./Mods/src/style/empresas.css" rel="stylesheet" >
        <form class="row" enctype="multipart/form-data" autocomplete="off">
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Nome da Empresa:</label>
                    <input :value="empresa[0].nome" class="form-control inputEmpresa"  required name="nome">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">CNPJ:</label>
                    <input maxlength="14" :value="empresa[0].cnpj_cpf"  class="form-control inputEmpresa" @blur="maskcnpj"  required name="cnpj_cpf">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">URL:</label>
                    <input  :value="empresa[0].url" class="form-control inputEmpresa"  required name="url">
                </div>
                <div class="form-group p-2 row">
                    <div class="col-6">
                        <label for="exampleInputEmail1">ID Empresa: </label>
                        <input  :value="empresa[0].id_empresa" class="form-control inputEmpresa"  required name="id_empresa">
                    </div>
                    <div class="col-6">
                        <label for="exampleInputEmail1"> &nbsp;&nbsp; ID Filial:</label>
                        <input :value="empresa[0].id_filial"  class="form-control inputEmpresa"  required name="id_filial">
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Estoque Negativo:</label>
                    <div class="form-check form-check-inline ">
                        <input v-model="empresa[0].estoque_negativo" class="form-check-input" type="radio" id="inlineCheckbox1" name="estoque_negativo" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="empresa[0].estoque_negativo" class="form-check-input" type="radio" id="inlineCheckbox2" name="estoque_negativo" value="0">
                        <label class="form-check-label" for="inlineCheckbox2">Não</label>
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1" class="d-block">Política de Desconto:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" v-model="empresa[0].tipo_politica_desconto" type="radio" id="inlineCheckbox3" name="tipo_politica_desconto" value="1">
                        <label class="form-check-label" for="inlineCheckbox3">Sim</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" v-model="empresa[0].tipo_politica_desconto" type="radio" id="inlineCheckbox4" name="tipo_politica_desconto" value="0">
                        <label class="form-check-label" for="inlineCheckbox4">Não</label>
                    </div>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Endereço:</label>
                    <textarea :value="empresa[0].endereco"  class="form-control inputEmpresa"  required name="endereco"></textarea>
                </div>
                <div class="form-group p-2">
                    <label>Estado: </label>
                    <select :value="empresa[0].estado" name="estado" class="form-control custom-select inputEmpresa" required   name="estado">
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
                    <label for="exampleInputEmail1">Cidade:</label>
                    <input :value="empresa[0].cidade" type="text" class="form-control inputEmpresa"   required name="cidade">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Telefone:</label>
                    <input id="telefone" maxlength="15" :value="empresa[0].telefone" type="text" class="form-control inputEmpresa"   required name="telefone">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Email:</label>
                    <input :value="empresa[0].email" type="email" class="form-control inputEmpresa"   required type="email" name="email">
                </div>                
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Site:</label>
                    <input :value="empresa[0].site" type="text" class="form-control inputEmpresa"   required name="site">
                </div>
                <div class="">
                    <label for="">Carregar Logo:</label>
                    <label for="formFile" class="form-label d-flex justify-content-center" id="preview">
                        <img src="" :alt="empresa[0].logo" class="m-5" style="cursor:pointer" :srcset="'uploads/'+empresa[0].logo" width="300">
                    </label>
                    <input @change="capa()" class="form-control d-none" type="file" id="formFile" name="logo" accept='image/*'>
                    <small>Recomendamos que utilize imagem com altura e largura de mesmo tamanho, Ex.: 800x800</small>
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Login:</label>
                    <input :value="empresa[0].usuario" class="form-control inputEmpresa"   required name="usuario">
                </div>
                <div class="form-group p-2">
                    <label for="exampleInputEmail1">Senha:</label>
                    <input  class="form-control inputEmpresa" autocomplete="off" type="text" name="senha">
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

<template id="empresas" >
    <div class="p-4">
        <table class="table" >
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Logo</th>
                <th scope="col">Empresa</th>
                <th scope="col">Email</th>
                <th scope="col">Ação</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="empresa, index of empresas">
                <th scope="row">{{empresa.id}}</th>
                <td>
                    <img height="50"  :alt="empresa.nome" :srcset="'uploads/'+empresa.logo">    
                </td>
                <td>{{empresa.nome}}</td>
                <td>{{empresa.email}}</td>
                <td>
                <div>
                    <b-button-group>                   
                        <b-dropdown right >
                            <b-dropdown-item >
                                <router-link :to="'/Empresa/'+empresa.id" class="uil-pen p-3"> Editar</router-link>
                            </b-dropdown-item>
                        <?php if ($valida['privilegio'] == 1) { ?> 
                            <b-dropdown-item @click="deleta(index, empresa.id)">
                                <a href="" class="uil-trash p-3">
                                    Deletar
                                </a>
                            </b-dropdown-item>
                        <?php } ?>
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
const  cadEmpresas = { 
      template: '#cadEmpresas', 
      props: { 
        empresas: 
        {
          type: Array, 
          default: () =>  []
        } 
      },
      methods:{        
        capa: function(){
            let input = event.target,
            reader = new FileReader(),
            partner =  document.getElementById('preview'),
            img = document.createElement("img")
                reader.onload = (e) => {
                   img.setAttribute('src',e.target.result)
                   img.setAttribute('width','300')
                   img.setAttribute('style','cursor:pointer')
                   img.setAttribute('class','m-5')
                }
            reader.readAsDataURL(input.files[0])
            partner.children[0].remove()
            partner.appendChild(img)
        },
        maskcnpj: function (e) {
            e.target.value =   e.target.value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
        }
      },
      mounted(){
        var telefone = document.getElementById('telefone')
            

        telefone.addEventListener("keydown", async function(event) {
            telefone.value=telefone.value.replace(/\D/g,"");
             telefone.value = await telefone.value.replace(/^(\d{2})(\d)/g,"($1) $2"); 
            telefone.value = await telefone.value.replace(/(\d)(\d{4})$/,"$1-$2"); 
        })
        document.querySelectorAll('form.row')[0].addEventListener('submit', async event=>{
            event.preventDefault()
            if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(document.querySelector('input[type="email"]').value)){
                var formData = new FormData()
                formData.append('logo', document.querySelector('input[type="file"]').files[0])
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
                await fetch('apis/controller.php?createEmpresa',{
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
                        ctrl.$emit('addEmpresa', a)
                    }else{
                        swal("Erro!", "Erro interno!", "error")
                    }
                })
                .catch(e=> {
                    swal("Erro!", "Erro interno!", "error")
                })
            }else{
                swal("Erro!", "E-mail invalido", "error")
            }
        })
      }
    },
    editEmpresa = { 
      template: '#editEmpresa', 
      data() {
          return{
              empresa: [[]]
          }
      },
      methods:{        
        capa: function(){
            let input = event.target,
            reader = new FileReader(),
            partner =  document.getElementById('preview'),
            img = document.createElement("img")
                reader.onload = (e) => {
                   img.setAttribute('src',e.target.result)
                   img.setAttribute('width','300')
                   img.setAttribute('style','cursor:pointer')
                   img.setAttribute('class','m-5')
                }
            reader.readAsDataURL(input.files[0])
            partner.children[0].remove()
            partner.appendChild(img)
        },
        maskcnpj: function (e) {
            e.target.value =   e.target.value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
        }
      },
      mounted(){
        var telefone = document.getElementById('telefone')
            

        telefone.addEventListener("keydown", async function(event) {
            telefone.value=telefone.value.replace(/\D/g,"");
            telefone.value = await telefone.value.replace(/^(\d{2})(\d)/g,"($1) $2"); 
            telefone.value = await telefone.value.replace(/(\d)(\d{4})$/,"$1-$2"); 
        })
        document.querySelectorAll('form.row')[0].addEventListener('submit', async event=>{
            event.preventDefault()
            if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(document.querySelector('input[type="email"]').value)){
                var formData = new FormData()
                formData.append('logo', document.querySelector('input[type="file"]').files[0])
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
                await fetch(`apis/controller.php?editEmpresa=${this.$route.params.id}`,{
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
                        ctrl.$emit('addEmpresa', a)
                    }else{
                        swal("Erro!", "Erro interno!", "error")
                    }
                })
            }else{
                swal("Erro!", "E-mail invalido", "error")
            }
        })
        this.empresa = empresasCad.filter(a=>{
            return a.id == this.$route.params.id                
        })
      }
    },
    empresas = { 
        template: '#empresas', 
        props: { 
            empresas: 
                {
                    type: Array, 
                    default: () =>  empresasCad
                } 
        },
        methods:{
        <?php if ($valida['privilegio'] == 1) { ?> 
            deleta: function (index , id) {
                swal({
                    title: "Tem certeza ?!",
                    text: "Você deseja mesmo deletar essa empresa ?",
                    icon: "warning",
                    buttons: true,
                    buttons: ["Não", "Sim"],

                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        fetch(`apis/controller.php?removeEmpresa=${id}`,{
                            method: "GET",
                            headers: {
                                "Authorization": "Basic <?php echo base64_encode($_SESSION['lojadeaplicativo'][0] . ":" . $_SESSION['lojadeaplicativo'][1]) ?>",                        
                            },                            
                        })
                        .then(a=>a.text())
                        .then(async a=>{
                            if(a==1){
                                ctrl.$emit('removeEmpresa', index) 
                                await this.$forceUpdate()
                                swal("Empresa deletada com sucesso !", {
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
        <?php } ?>
        }
    }
</script>
<script src="Mods/src/script/empresas.js"></script>
