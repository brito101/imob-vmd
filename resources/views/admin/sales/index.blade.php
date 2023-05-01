@extends('admin.master.master')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><i class="icon-money"></i>Vendas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6 d-flex justify-content-end">
                    <ol class="breadcrumb  my-auto">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Vendas</li>
                    </ol>
                    <a href="{{ route('admin.sales.create') }}" class="btn btn bg-gradient-lightblue icon-plus ml-1">Criar
                        Venda</a>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @if ($errors->all())
        @foreach ($errors->all() as $error)
            <x-alert type="danger" icon="icon-exclamation-triangle" :message="$error" />
        @endforeach
    @endif

    @if (session()->exists('message'))
        <x-alert type="{{ session()->get('type') }}" icon="icon-{{ session()->get('icon') }}"
            message="{{ session()->get('message') }}" />
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-gradient-dark">
                            <h5 class="card-title text-white"><i class="icon-money"></i>Vendas Cadastradas</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool text-white" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dash_content_app_box">
                                        <div class="dash_content_app_box_stage">
                                            <table id="dataTable" class="nowrap stripe" width="100"
                                                style="width: 100% !important;">
                                                <thead class="text-lightblue">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Propriedade</th>
                                                        <th>Corretor</th>
                                                        <th>Data da Venda</th>
                                                        <th>Valor</th>
                                                        <th class="text-center">Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sales as $sale)
                                                        <tr>
                                                            <td><span
                                                                    class="badge bg-gradient-lightblue px-2">{{ $sale->id }}</span>
                                                            </td>
                                                            <td class="text-muted">
                                                                {{ '#' . $sale->propertyObject()->id . ' ' . $sale->propertyObject()->title }}
                                                            </td>
                                                            <td class="text-muted">
                                                                {{ $sale->propertyObject()->broker ? $sale->propertyObject()->brokerObject()->name : '' }}
                                                            </td>
                                                            <td class="text-muted">{{ $sale->date_of_sale }}</td>
                                                            <td class="text-muted">{{ $sale->value }}</td>
                                                            <td class="text-center d-flex flex-wrap justify-content-center">
                                                                <a href="{{ route('admin.sales.edit', ['sale' => $sale->id]) }}"
                                                                    class="btn btn-sm bg-gradient-lightblue text-sm">Editar</a>
                                                                <form
                                                                    action="{{ route('admin.sales.destroy', ['sale' => $sale->id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <input class="btn btn-sm bg-gradient-danger text-sm"
                                                                        type="submit" value="Remover">
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
    </section>
@endsection
