@extends('admin.master.master')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-money"></i>Editar Locação</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-flex justify-content-end">
                    <ol class="breadcrumb  my-auto">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.rents.index') }}">Locações</a></li>
                        <li class="breadcrumb-item active">Editar Locação</li>
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
                            <h5 class="card-title text-white"><i class="icon-pencil-square-o"></i>Dados da Locação</h5>
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

                                <form class="app_form" action="{{ route('admin.rents.update', ['rent' => $rent->id]) }}"
                                    method="post">
                                    @method('PUT')
                                    @csrf

                                    <div class="nav_tabs_content">
                                        <div id="data">

                                            <label class="label">
                                                <span class="legend">Propriedade:</span>
                                                <select name="property" class="select2">
                                                    <option value="">Selecione a Propriedade:</option>
                                                    @foreach ($properties as $property)
                                                        <option value="{{ $property->id }}"
                                                            @if (old('property') == $property->id) {{ 'selected' }} @elseif ($rent->property == $property->id) {{ 'selected' }} @endif>
                                                            #{{ $property->id }}: ({{ $property->title }})
                                                            {{ $property->broker ? ' - Corretor: ' . $property->brokerObject()->name : '' }}
                                                        </option>
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </label>

                                            <div class="label_g4">
                                                <label class="label">
                                                    <span class="legend">*Data de Início:</span>
                                                    <input type="tel" name="init_date" class="mask-date"
                                                        placeholder="Data de Início"
                                                        value="{{ old('init_date') ?? $rent->init_date }}" />
                                                </label>

                                                <label class="label">
                                                    <span class="legend">*Data de Término:</span>
                                                    <input type="tel" name="end_date" class="mask-date"
                                                        placeholder="Data de Término"
                                                        value="{{ old('end_date') ?? $rent->end_date }}" />
                                                </label>

                                                <label class="label">
                                                    <span class="legend">Valor de Locação:</span>
                                                    <input type="tel" name="value" class="mask-money"
                                                        value="{{ old('value') ?? $rent->value }}" />
                                                </label>
                                                <label class="label">
                                                </label>
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
