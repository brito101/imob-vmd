@extends('admin.master.master')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"><i class="icon-user-plus"></i>Novo Usuário</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 d-flex justify-content-end">
                <ol class="breadcrumb  my-auto">
                    <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Usuários</a></li>
                    <li class="breadcrumb-item active">Novo Usuário</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

@if($errors->all())
@foreach($errors->all() as $error)
<x-alert type="danger" icon="icon-exclamation-triangle" :message="$error"/>
@endforeach
@endif

@if(session()->exists('message'))
<x-alert type="{{ session()->get('type') }}" icon="icon-{{ session()->get('icon') }}" message="{{ session()->get('message') }}"/>
@endif

<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-gradient-dark">
                        <h5 class="card-title text-white"><i class="icon-pencil-square-o"></i>Dados do Usuário</h5>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <div class="dash_content_app_box ">
                        <div class="nav m-2">
                            <ul class="nav_tabs mb-0">
                                <li class="nav_tabs_item">
                                    <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                                </li>
                                <li class="nav_tabs_item">
                                    <a href="#complementary" class="nav_tabs_item_link">Dados Complementares</a>
                                </li>
                                <li class="nav_tabs_item">
                                    <a href="#management" class="nav_tabs_item_link">Administrativo</a>
                                </li>
                            </ul>

                            <form class="app_form" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="nav_tabs_content">
                                    <div id="data">
                                        <div class="label_gc bg-gradient-lightblue">
                                            <span class="legend">Perfil:</span>
                                            <label class="label">
                                                <input type="checkbox" name="lessee" {{ (old('lessee') == 'on' || old('lessee') == true ? 'checked' : '') }}><span>Vendedor/Locatário</span>
                                            </label>

                                            <label class="label">
                                                <input type="checkbox" name="lessor" {{ (old('lessor') == 'on' || old('lessor') == true ? 'checked' : '') }}><span>Comprador/Locador</span>
                                            </label>
                                        </div>

                                        <label class="label">
                                            <span class="legend">*Nome:</span>
                                            <input type="text" name="name" placeholder="Nome Completo" value="{{ old('name') }}"/>
                                        </label>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*Genero:</span>
                                                <select name="genre">
                                                    <option value="male" {{ (old('genre') == 'male' ? 'selected' : '') }}>Masculino</option>
                                                    <option value="female" {{ (old('genre') == 'female' ? 'selected' : '') }}>Feminino</option>
                                                    <option value="other" {{ (old('genre') == 'other' ? 'selected' : '') }}>Outros</option>
                                                </select>
                                            </label>

                                            <label class="label">
                                                <span class="legend">*CPF:</span>
                                                <input type="tel" class="mask-doc" name="document" placeholder="CPF do Cliente"
                                                       value="{{ old('document') }}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*RG:</span>
                                                <input type="text" name="document_secondary" placeholder="RG do Cliente"
                                                       value="{{ old('document_secondary') }}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Órgão Expedidor:</span>
                                                <input type="text" name="document_secondary_complement" placeholder="Expedição"
                                                       value="{{ old('document_secondary_complement') }}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*Data de Nascimento:</span>
                                                <input type="tel" name="date_of_birth" class="mask-date"
                                                       placeholder="Data de Nascimento" value="{{ old('date_of_birth') }}"/>
                                            </label>

                                            <label class="label">
                                                <span class="legend">*Naturalidade:</span>
                                                <input type="text" name="place_of_birth" placeholder="Cidade de Nascimento"
                                                       value="{{ old('place_of_birth') }}"/>
                                            </label>
                                        </div>

                                        <div class="label_g2">
                                            <label class="label">
                                                <span class="legend">*Estado Civil:</span>
                                                <select name="civil_status">
                                                    <optgroup label="Cônjuge Obrigatório">
                                                        <option value="married" {{ (old('civil_status') == 'married' ? 'selected' : '') }}>Casado</option>
                                                        <option value="separated" {{ (old('civil_status') == 'separated' ? 'selected' : '') }}>Separado</option>
                                                    </optgroup>
                                                    <optgroup label="Cônjuge não Obrigatório">
                                                        <option value="single" {{ (old('civil_status') == 'single' ? 'selected' : '') }}>Solteiro</option>
                                                        <option value="divorced" {{ (old('civil_status') == 'divorced' ? 'selected' : '') }}>Divorciado</option>
                                                        <option value="widower" {{ (old('civil_status') == 'widower' ? 'selected' : '') }}>Viúvo</option>
                                                    </optgroup>
                                                </select>
                                            </label>

                                            <label class="label">
                                                <span class="legend">Foto</span>
                                                <input type="file" name="cover">
                                            </label>
                                        </div>

                                        <div class="app_collapse mt-2">
                                            <div class="app_collapse_header collapse text-muted">
                                                <h3>Renda</h3>
                                                <span class="icon-plus-circle icon-notext"></span>
                                            </div>

                                            <div class="app_collapse_content d-none">
                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">*Profissão:</span>
                                                        <input type="text" name="occupation" placeholder="Profissão do Cliente"
                                                               value="{{ old('occupation') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">*Renda:</span>
                                                        <input type="tel" name="income" class="mask-money"
                                                               placeholder="Valores em Reais" value="{{ old('income') }}"/>
                                                    </label>
                                                </div>

                                                <label class="label  text-muted">
                                                    <span class="legend">*Empresa:</span>
                                                    <input type="text" name="company_work" placeholder="Contratante"
                                                           value="{{ old('company_work') }}"/>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="app_collapse mt-2">
                                            <div class="app_collapse_header collapse  text-muted">
                                                <h3>Endereço</h3>
                                                <span class="icon-plus-circle icon-notext"></span>
                                            </div>

                                            <div class="app_collapse_content d-none">
                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">*CEP:</span>
                                                        <input type="tel" name="zipcode" class="mask-zipcode zip_code_search"
                                                               placeholder="Digite o CEP" value="{{ old('zipcode') }}"/>
                                                    </label>
                                                </div>

                                                <label class="label">
                                                    <span class="legend">*Endereço:</span>
                                                    <input type="text" name="street" class="street"
                                                           placeholder="Endereço Completo" value="{{ old('street') }}"/>
                                                </label>

                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">*Número:</span>
                                                        <input type="text" name="number" placeholder="Número do Endereço"
                                                               value="{{ old('number') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">Complemento:</span>
                                                        <input type="text" name="complement" placeholder="Completo (Opcional)"
                                                               value="{{ old('complement') }}"/>
                                                    </label>
                                                </div>

                                                <label class="label">
                                                    <span class="legend">*Bairro:</span>
                                                    <input type="text" name="neighborhood" class="neighborhood"
                                                           placeholder="Bairro" value="{{ old('neighborhood') }}"/>
                                                </label>

                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">*Estado:</span>
                                                        <input type="text" name="state" class="state" placeholder="Estado"
                                                               value="{{ old('state') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">*Cidade:</span>
                                                        <input type="text" name="city" class="city" placeholder="Cidade"
                                                               value="{{ old('city') }}"/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="app_collapse mt-2">
                                            <div class="app_collapse_header collapse  text-muted">
                                                <h3>Contato</h3>
                                                <span class="icon-plus-circle icon-notext"></span>
                                            </div>

                                            <div class="app_collapse_content d-none">
                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">Residencial:</span>
                                                        <input type="tel" name="telephone" class="mask-phone"
                                                               placeholder="Número do Telefonce com DDD" value="{{ old('telephone') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">*Celular:</span>
                                                        <input type="tel" name="cell" class="mask-cell"
                                                               placeholder="Número do Telefonce com DDD" value="{{ old('cell') }}"/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="app_collapse mt-2">
                                            <div class="app_collapse_header collapse  text-muted">
                                                <h3>Acesso</h3>
                                                <span class="icon-plus-circle icon-notext"></span>
                                            </div>

                                            <div class="app_collapse_content d-none">
                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">*E-mail:</span>
                                                        <input type="email" name="email" placeholder="Melhor e-mail"
                                                               value="{{ old('email') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">Senha:</span>
                                                        <input type="password" name="password" placeholder="Senha de acesso"
                                                               value=""/>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="complementary" class="d-none">
                                        <div class="app_collapse">
                                            <div class="app_collapse_header collapse  text-muted">
                                                <h3>Cônjuge</h3>
                                                <span class="icon-plus-circle icon-notext"></span>
                                            </div>

                                            <div class="app_collapse_content d-none content_spouse">

                                                <label class="label">
                                                    <span class="legend">Tipo de Comunhão:</span>
                                                    <select name="type_of_communion" class="select2">
                                                        <option value="Comunhão Universal de Bens" {{ (old('type_of_communion') == 'Comunhão Universal de Bens' ? 'selected' : '') }}>Comunhão Universal de Bens</option>
                                                        <option value="Comunhão Parcial de Bens" {{ (old('type_of_communion') == 'Comunhão Parcial de Bens' ? 'selected' : '') }}>Comunhão Parcial de Bens</option>
                                                        <option value="Separação Total de Bens" {{ (old('type_of_communion') == 'Separação Total de Bens' ? 'selected' : '') }}>Separação Total de Bens</option>
                                                        <option value="Participação Final de Aquestos" {{ (old('type_of_communion') == 'Participação Final de Aquestos' ? 'selected' : '') }}>Participação Final de Aquestos</option>
                                                    </select>
                                                </label>

                                                <label class="label">
                                                    <span class="legend">Nome:</span>
                                                    <input type="text" name="spouse_name" placeholder="Nome do Cônjuge"
                                                           value="{{ old('spouse_name') }}"/>
                                                </label>

                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">Genero:</span>
                                                        <select name="spouse_genre">
                                                            <option value="male" {{ (old('spouse_genre') == 'male' ? 'selected' : '') }}>Masculino</option>
                                                            <option value="female" {{ (old('spouse_genre') == 'female' ? 'selected' : '') }}>Feminino</option>
                                                            <option value="other" {{ (old('spouse_genre') == 'other' ? 'selected' : '') }}>Outros</option>
                                                        </select>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">CPF:</span>
                                                        <input type="text" class="mask-doc" name="spouse_document"
                                                               placeholder="CPF do Cliente" value="{{ old('spouse_document') }}"/>
                                                    </label>
                                                </div>

                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">RG:</span>
                                                        <input type="text" name="spouse_document_secondary"
                                                               placeholder="RG do Cliente" value="{{ old('spouse_document_secondary') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">Órgão Expedidor:</span>
                                                        <input type="text" name="spouse_document_secondary_complement"
                                                               placeholder="Expedição" value="{{ old('spouse_document_secondary_complement') }}"/>
                                                    </label>
                                                </div>

                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">Data de Nascimento:</span>
                                                        <input type="tel" class="mask-date" name="spouse_date_of_birth"
                                                               placeholder="Data de Nascimento" value="{{ old('spouse_date_of_birth') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">Naturalidade:</span>
                                                        <input type="text" name="spouse_place_of_birth"
                                                               placeholder="Cidade de Nascimento" value="{{ old('spouse_place_of_birth') }}"/>
                                                    </label>
                                                </div>

                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">Profissão:</span>
                                                        <input type="text" name="spouse_occupation"
                                                               placeholder="Profissão do Cliente" value="{{ old('spouse_occupation') }}"/>
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">Renda:</span>
                                                        <input type="text" class="mask-money" name="spouse_income"
                                                               placeholder="Valores em Reais" value="{{ old('spouse_income') }}"/>
                                                    </label>
                                                </div>

                                                <label class="label  text-muted">
                                                    <span class="legend">Empresa:</span>
                                                    <input type="text" name="spouse_company_work" placeholder="Contratante"
                                                           value="{{ old('spouse_company_work') }}"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="management" class="d-none bg-gradient-lightblue rounded">
                                        <div class="label_gc">
                                            <span class="legend">Acesso:</span>
                                            <label class="label">
                                                <input type="checkbox" name="admin"  {{ (old('admin') == 'on' || old('admin') == true ? 'checked' : '') }}><span>Administrativo</span>
                                            </label>

                                            <label class="label">
                                                <input type="checkbox" name="client"  {{ (old('client') == 'on' || old('client') == true ? 'checked' : '') }}><span>Cliente</span>
                                            </label>
                                        </div>
                                        @can('Atribuir Permissões')
                                        <div class="pt-2 bg-white">
                                <label class="label m-2 text-muted">
                                    <label class="d-block font-weight-normal text-sm">Concessão de Perfil:</label>
                                    @foreach($roles as $role)
                                    <label class="label">
                                        <input type="checkbox"
                                               name="acl_{{ $role->id }}" {{ ($role->can == 1 ? 'checked' : '') }}>
                                        <span>{{ $role->name }}</span>
                                    </label>
                                    @endforeach
                                </label>
                                </div>
                                @endcan
                                    </div>
                                </div>



                                <div class="text-right mt-2 ml-auto">
                                    <button class="btn btn-large bg-gradient-green" type="submit"><i class="icon-check-square-o"></i>Salvar Alterações
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
