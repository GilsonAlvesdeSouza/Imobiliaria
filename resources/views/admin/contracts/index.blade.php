@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Filtro</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.contracts.index') }}">Contratos</a></li>
                    </ul>
                </nav>

                <a href="{{ route('admin.contracts.create') }}" class="btn btn-orange icon-file-text ml-1">Criar
                    Contrato</a>
                <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
            </div>
        </header>

        @include('admin.contracts.filter')

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Locador</th>
                        <th>Locatário</th>
                        <th>Negócio</th>
                        <th>Início</th>
                        <th>Vigência</th>
                        <th>Opções</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contracts as $contract)
                        <tr>
                            <td><a href="{{ route('admin.contracts.edit', ['contract' => $contract->id]) }}"
                                   class="text-orange">{{ $contract->id }}</a></td>
                            <td><a href="{{ route('admin.users.edit', ['user' => $contract->ownerObject->id]) }}"
                                   class="text-orange">{{ $contract->ownerObject->name }}</a></td>
                            <td><a href="{{ route('admin.users.edit', ['user' => $contract->acquirerObject->id]) }}"
                                   class="text-orange">{{ $contract->acquirerObject->name }}</a></td>
                            <td>{{ $contract->purpose == 'sale' ? 'Venda' : 'Locação' }}</td>
                            <td>{{ $contract->start_at }}</td>
                            <td>{{ $contract->deadline }} meses</td>
                            <td style="width: 100px">
                                <button id="route_delete" class="icon-trash btn btn-orange btn-route"
                                        value="{{ $contract->id }}" title="Excluir">Excluir
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-route').click(function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').find(this).val();

                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'DELETE',
                            url: '/imobiliaria/public/admin/contracts/' + id,
                            success: function (response) {
                                if (response.status) {
                                    Swal.fire(
                                        'Excluído!',
                                        'O item  foi excluído..',
                                        'success'
                                    )
                                        .then((result) => {
                                            location.reload();
                                        });
                                }
                            }
                        });
                    }

                });
            });
        });

    </script>
@endsection


