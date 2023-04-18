@extends('admin.master.master')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-user-plus"></i>Editar Corretor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-flex justify-content-end">
                    <ol class="breadcrumb  my-auto">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.brokers.index') }}">Corretores</a></li>
                        <li class="breadcrumb-item active">Editar Corretor</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    @if ($errors->all())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" icon="icon-exclamation-triangle" :message="$error" />
        @endforeach
    @endif

    @if (session()->exists('message'))
        <x-alert type="{{ session()->get('type') }}" icon="icon-{{ session()->get('icon') }}"
            message="{{ session()->get('message') }}" />
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
                                        <a href="#management" class="nav_tabs_item_link">Administrativo</a>
                                    </li>
                                </ul>

                                <form class="app_form" action="{{ route('admin.brokers.update', ['broker' => $user->id]) }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="nav_tabs_content">
                                        <div id="data">

                                            <label class="label">
                                                <span class="legend">*Nome:</span>
                                                <input type="text" name="name" placeholder="Nome Completo"
                                                    value="{{ old('name') ?? $user->name }}" />
                                            </label>

                                            <div class="label_g2">
                                                <label class="label">
                                                    <span class="legend">*Genero:</span>
                                                    <select name="genre">
                                                        <option value="male"
                                                            {{ old('genre') == 'male' ? 'selected' : ($user->genre == 'male' ? 'selected' : '') }}>
                                                            Masculino
                                                        </option>
                                                        <option value="female"
                                                            {{ old('genre') == 'female' ? 'selected' : ($user->genre == 'female' ? 'selected' : '') }}>
                                                            Feminino
                                                        </option>
                                                        <option value="other"
                                                            {{ old('genre') == 'other' ? 'selected' : ($user->genre == 'other' ? 'selected' : '') }}>
                                                            Outros
                                                        </option>
                                                    </select>
                                                </label>

                                                <label class="label">
                                                    <span class="legend">*CPF:</span>
                                                    <input type="tel" class="mask-doc" name="document"
                                                        placeholder="CPF do Cliente"
                                                        value="{{ old('document') ?? $user->document }}" />
                                                </label>
                                            </div>

                                            <div class="label_g2">
                                                <label class="label">
                                                    <span class="legend">*RG:</span>
                                                    <input type="text" name="document_secondary"
                                                        placeholder="RG do Cliente"
                                                        value="{{ old('document_secondary') ?? $user->document_secondary }}" />
                                                </label>

                                                <label class="label">
                                                    <span class="legend">Órgão Expedidor:</span>
                                                    <input type="text" name="document_secondary_complement"
                                                        placeholder="Expedição"
                                                        value="{{ old('document_secondary_complement') ?? $user->document_secondary_complement }}" />
                                                </label>
                                            </div>

                                            <div class="label_g2">
                                                <label class="label">
                                                    <span class="legend">*Data de Nascimento:</span>
                                                    <input type="tel" name="date_of_birth" class="mask-date"
                                                        placeholder="Data de Nascimento"
                                                        value="{{ old('date_of_birth') ?? $user->date_of_birth }}" />
                                                </label>

                                                <label class="label">
                                                    <span class="legend">*Naturalidade:</span>
                                                    <input type="text" name="place_of_birth"
                                                        placeholder="Cidade de Nascimento"
                                                        value="{{ old('place_of_birth') ?? $user->place_of_birth }}" />
                                                </label>
                                            </div>

                                            <div class="label_g2">
                                                <label class="label">
                                                    <span class="legend">*Estado Civil:</span>
                                                    <select name="civil_status">
                                                        <optgroup label="Cônjuge não Obrigatório">
                                                            <option value="single"
                                                                {{ old('civil_status') == 'single' ? 'selected' : ($user->civil_status == 'single' ? 'selected' : '') }}>
                                                                Solteiro
                                                            </option>
                                                            <option value="divorced"
                                                                {{ old('civil_status') == 'divorced' ? 'selected' : ($user->civil_status == 'divorced' ? 'selected' : '') }}>
                                                                Divorciado
                                                            </option>
                                                            <option value="widower"
                                                                {{ old('civil_status') == 'widower' ? 'selected' : ($user->civil_status == 'widower' ? 'selected' : '') }}>
                                                                Viúvo
                                                            </option>
                                                        </optgroup>
                                                        <optgroup label="Cônjuge Obrigatório">
                                                            <option value="married"
                                                                {{ old('civil_status') == 'married' ? 'selected' : ($user->civil_status == 'married' ? 'selected' : '') }}>
                                                                Casado
                                                            </option>
                                                            <option value="separated"
                                                                {{ old('civil_status') == 'separated' ? 'selected' : ($user->civil_status == 'separated' ? 'selected' : '') }}>
                                                                Separado
                                                            </option>
                                                        </optgroup>
                                                    </select>
                                                </label>

                                                <label class="label">
                                                    <span class="legend">Foto</span>
                                                    <input type="file" name="cover">
                                                </label>
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
                                                            <input type="tel" name="zipcode"
                                                                class="mask-zipcode zip_code_search"
                                                                placeholder="Digite o CEP"
                                                                value="{{ old('zipcode') ?? $user->zipcode }}" />
                                                        </label>
                                                    </div>

                                                    <label class="label">
                                                        <span class="legend">*Endereço:</span>
                                                        <input type="text" name="street" class="street"
                                                            placeholder="Endereço Completo"
                                                            value="{{ old('street') ?? $user->street }}" />
                                                    </label>

                                                    <div class="label_g2">
                                                        <label class="label">
                                                            <span class="legend">*Número:</span>
                                                            <input type="text" name="number"
                                                                placeholder="Número do Endereço"
                                                                value="{{ old('number') ?? $user->number }}" />
                                                        </label>

                                                        <label class="label">
                                                            <span class="legend">Complemento:</span>
                                                            <input type="text" name="complement"
                                                                placeholder="Completo (Opcional)"
                                                                value="{{ old('complement') ?? $user->complement }}" />
                                                        </label>
                                                    </div>

                                                    <label class="label">
                                                        <span class="legend">*Bairro:</span>
                                                        <input type="text" name="neighborhood" class="neighborhood"
                                                            placeholder="Bairro"
                                                            value="{{ old('neighborhood') ?? $user->neighborhood }}" />
                                                    </label>

                                                    <div class="label_g2">
                                                        <label class="label">
                                                            <span class="legend">*Estado:</span>
                                                            <input type="text" name="state" class="state"
                                                                placeholder="Estado"
                                                                value="{{ old('state') ?? $user->state }}" />
                                                        </label>

                                                        <label class="label">
                                                            <span class="legend">*Cidade:</span>
                                                            <input type="text" name="city" class="city"
                                                                placeholder="Cidade"
                                                                value="{{ old('city') ?? $user->city }}" />
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
                                                                placeholder="Número do Telefonce com DDD"
                                                                value="{{ old('telephone') ?? $user->telephone }}" />
                                                        </label>

                                                        <label class="label">
                                                            <span class="legend">*Celular:</span>
                                                            <input type="tel" name="cell" class="mask-cell"
                                                                placeholder="Número do Telefonce com DDD"
                                                                value="{{ old('cell') ?? $user->cell }}" />
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
                                                            <input type="email" name="email"
                                                                placeholder="Melhor e-mail"
                                                                value="{{ old('email') ?? $user->email }}" />
                                                        </label>

                                                        <label class="label">
                                                            <span class="legend">Senha:</span>
                                                            <input type="password" name="password"
                                                                placeholder="Senha de acesso" value="" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="management" class="d-none">
                                            <div class="label_gc  bg-gradient-lightblue rounded">
                                                <span class="legend">Acesso:</span>
                                                <label class="label">
                                                    <input type="checkbox" name="admin"
                                                        {{ old('admin') == 'on' || old('admin') == true ? 'checked' : ($user->admin == true ? 'checked' : '') }}><span>Administrativo</span>
                                                </label>
                                            </div>

                                            <div class="pt-2 bg-white">
                                                <div class="label_g2">
                                                    <label class="label">
                                                        <span class="legend">CRECI:</span>
                                                        <input type="text" name="creci"
                                                            placeholder="Código do registro"
                                                            value="{{ old('creci') ?? $user->creci }}" />
                                                    </label>

                                                    <label class="label">
                                                        <span class="legend">Comissão:</span>
                                                        <input type="text" name="commission"
                                                            placeholder="Valor da comissão"
                                                            value="{{ old('commission') ?? $user->commission }}" />
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                    <div class="text-right mt-2 ml-auto">
                                        <button class="btn btn-large bg-gradient-green" type="submit"><i
                                                class="icon-check-square-o"></i>Salvar Alterações
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
