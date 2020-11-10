@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Editar Imóvel</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.properties.index') }}" class="text-orange">Imóveis</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        @include('admin.properties.filter')

        <div class="dash_content_app_box">

            <div class="nav">
                @if($errors->all())
                    @foreach($errors->all() as $error)
                        @message(['color' => 'orange'])
                        <p class="icon-asterisk">{{ $error }}</p>
                        @endmessage
                    @endforeach
                @endif
                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#structure" class="nav_tabs_item_link">Estrutura</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#images" class="nav_tabs_item_link">Imagens</a>
                    </li>
                </ul>

                <form action="{{ route('admin.properties.update', ['property' => $property->id]) }}" method="post"
                      class="app_form"
                      enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="label_gc">
                                <span class="legend">Finalidade:</span>
                                <label class="label">
                                    <input type="checkbox" id="sale"
                                           name="sale" {{ (old('checkSale') == 'on'  ? 'checked' :  (old('checkSale') == 'off' ? '' :  $property->sale == 1 ? 'checked' : ''))  }} ><span>Locador</span>
                                    <input type="hidden" id="checkSale" name="checkSale" value="">
                                </label>

                                <label class="label">
                                    <input type="checkbox" id="rent"
                                           name="rent" {{ (old('checkRent') == 'on'  ? 'checked' :  (old('checkRent') == 'off' ? '' :  $property->rent == 1 ? 'checked' : ''))  }} ><span>Locador</span>
                                    <input type="hidden" id="checkRent" name="checkRent" value="">
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Categoria:</span>
                                    <select name="category" class="select2">
                                        <option value="{{ null }}">Selecione uma opção</option>
                                        <option
                                            value="Imóvel Residencial" {{ (old('category') == 'Imóvel Residencial' ? 'selected' : ($property->category == 'Imóvel Residencial' ? 'selected' : '')) }}>
                                            Imóvel Residencial
                                        </option>
                                        <option
                                            value="Comercial/Industrial" {{ (old('category') == 'Comercial/Industrial' ? 'selected' : ($property->category == 'Comercial/Industrial' ? 'selected' : '')) }}>
                                            Comercial/Industrial
                                        </option>
                                        <option
                                            value="Terreno" {{ (old('category') == 'Terreno' ? 'selected' : ($property->category == 'Terreno' ? 'selected' : '')) }}>
                                            Terreno
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">Tipo:</span>
                                    <select name="type" class="select2">
                                        <option value="{{ null }}">Selecione uma opção</option>
                                        <optgroup label="Imóvel Residencial">
                                            <option
                                                value="Casa" {{ (old('type') == 'Casa' ? 'selected' : ($property->type == 'Casa' ? 'selected' : '')) }}>
                                                Casa
                                            </option>
                                            <option
                                                value="Cobertura" {{ (old('type') == 'Cobertura' ? 'selected' : ($property->type == 'Cobertura' ? 'selected' : '')) }}>
                                                Cobertura
                                            </option>
                                            <option
                                                value="Apartamento" {{ (old('type') == 'Apartamento' ? 'selected' : ($property->type == 'Apartamento' ? 'selected' : '')) }}>
                                                Apartamento
                                            </option>
                                            <option
                                                value="Studio" {{ (old('type') == 'Studio' ? 'selected' : ($property->type == 'Studio' ? 'selected' : '')) }}>
                                                Studio
                                            </option>
                                            <option
                                                value="Kitnet" {{ (old('type') == 'Kitnet' ? 'selected' : ($property->type == 'Kitnet' ? 'selected' : '')) }}>
                                                Kitnet
                                            </option>
                                        </optgroup>
                                        <optgroup label="Comercial/Industrial">
                                            <option
                                                value="Sala Comercial" {{ (old('type') == 'Sala Comercial' ? 'selected' : ($property->type == 'Sala Comercial' ? 'selected' : '')) }}>
                                                Sala Comercial
                                            </option>
                                            <option
                                                value="Depósito/Galpão" {{ (old('type') == 'Depósito/Galpão' ? 'selected' : ($property->type == 'Depósito/Galpão' ? 'selected' : '')) }}>
                                                Depósito/Galpão
                                            </option>
                                            <option
                                                value="Ponto Comercial" {{ (old('type') == 'Ponto Comercial' ? 'selected' : ($property->type == 'Ponto Comercial' ? 'selected' : '')) }}>
                                                Ponto Comercial
                                            </option>
                                        </optgroup>
                                        <optgroup label="Terreno">
                                            <option
                                                value="Terreno" {{ (old('type') == 'Terreno' ? 'selected' : ($property->type == 'Terreno' ? 'selected' : '')) }}>
                                                Terreno
                                            </option>
                                        </optgroup>
                                    </select>
                                </label>
                            </div>
                            <label class="label">
                                <span class="legend">Proprietário:</span>
                                <select name="user" class="select2">
                                    <option value="">Selecione uma opção</option>
                                    @foreach($users as $user)
                                        <option
                                            value="{{ $user->id }}" {{ (old('user') == $user->id ? 'selected' : ($user->id == $property->user && old('user') == null ? 'selected' : '')) }}> {{ $user->name }}
                                            ({{ $user->document }})
                                        </option>
                                    @endforeach
                                </select>
                            </label>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Precificação e Valores</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Valor de Venda:</span>
                                            <input type="tel" name="sale_price" class="mask-money"
                                                   value="{{ old('sale_price') ?? $property->sale_price }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Valor de Locação:</span>
                                            <input type="tel" name="rent_price" class="mask-money"
                                                   value="{{ old('rent_price') ?? $property->rent_price }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">IPTU:</span>
                                            <input type="tel" name="tribute" class="mask-money"
                                                   value="{{ old('tribute') ?? $property->tribute }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Condomínio:</span>
                                            <input type="tel" name="condominium" class="mask-money"
                                                   value="{{ old('condominium') ?? $property->condominium }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Características</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <label class="label">
                                        <span class="legend">Descrição do Imóvel:</span>
                                        <textarea name="description" cols="30" rows="10"
                                                  class="mce">{{ old('description') ?? $property->description }}</textarea>
                                    </label>

                                    <div class="label_g4">
                                        <label class="label">
                                            <span class="legend">Dormitórios:</span>
                                            <input type="tel" name="bedrooms" placeholder="Quantidade de Dormitórios"
                                                   value="{{ old('bedrooms') ?? $property->bedrooms }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Suítes:</span>
                                            <input type="tel" name="suites" placeholder="Quantidade de Suítes"
                                                   value="{{ old('suites') ?? $property->suites }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Banheiros:</span>
                                            <input type="tel" name="bathrooms" placeholder="Quantidade de Banheiros"
                                                   value="{{ old('bathrooms') ?? $property->bathrooms }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Salas:</span>
                                            <input type="tel" name="rooms" placeholder="Quantidade de Salas"
                                                   value="{{ old('rooms') ?? $property->rooms }}"/>
                                        </label>
                                    </div>

                                    <div class="label_g4">
                                        <label class="label">
                                            <span class="legend">Garagem:</span>
                                            <input type="tel" name="garage" placeholder="Quantidade de Garagem"
                                                   value="{{ old('garage') ?? $property->garage }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Garagem Coberta:</span>
                                            <input type="tel" name="garage_covered"
                                                   placeholder="Quantidade de Garagem Coberta"
                                                   value="{{ old('garage_covered') ?? $property->garage_covered }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Área Total:</span>
                                            <input type="tel" name="area_total" placeholder="Quantidade de M&sup2;"
                                                   value="{{ old('area_total') ?? $property->area_total }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Área Útil:</span>
                                            <input type="tel" name="area_util" placeholder="Quantidade de M&sup2;"
                                                   value="{{ old('area_util') ?? $property->area_util }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse">
                                <div class="app_collapse_header mt-2 collapse">
                                    <h3>Endereço</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">CEP:</span>
                                            <input type="tel" name="zipcode" class="mask-zipcode zip_code_search"
                                                   placeholder="Digite o CEP"
                                                   value="{{ old('zipcode') ?? $property->zipcode }}"/>
                                        </label>
                                    </div>

                                    <label class="label">
                                        <span class="legend">Endereço:</span>
                                        <input type="text" name="street" class="street" placeholder="Endereço Completo"
                                               value="{{ old('street') ?? $property->street }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Número:</span>
                                            <input type="text" name="number" placeholder="Número do Endereço"
                                                   value="{{ old('number') ?? $property->number }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Complemento:</span>
                                            <input type="text" name="complement" placeholder="Completo (Opcional)"
                                                   value="{{ old('complement') ?? $property->complement }}"/>
                                        </label>
                                    </div>

                                    <label class="label">
                                        <span class="legend">Bairro:</span>
                                        <input type="text" name="neighborhood" class="neighborhood" placeholder="Bairro"
                                               value="{{ old('neighborhood') ?? $property->neighborhood }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">Estado:</span>
                                            <input type="text" name="state" class="state" placeholder="Estado"
                                                   value="{{ old('state') ?? $property->state }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Cidade:</span>
                                            <input type="text" name="city" class="city" placeholder="Cidade"
                                                   value="{{ old('city') ?? $property->city }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="structure" class="d-none">
                            <h3 class="mb-2">Estrutura</h3>
                            <div class="label_g5">
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="air_conditioning"
                                               name="air_conditioning" {{ (old('checkAirConditioning') == 'on'  ? 'checked' :  (old('checkAirConditioning') == 'off' ? '' :  $property->air_conditioning == 1 ? 'checked' : ''))  }} ><span>Ar Condicionado</span>
                                        <input type="hidden" id="checkAirConditioning" name="checkAirConditioning"
                                               value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="bar"
                                               name="bar" {{ (old('checkBar') == 'on'  ? 'checked' :  (old('checkBar') == 'off' ? '' :  $property->bar == 1 ? 'checked' : ''))  }} ><span>Bar</span>
                                        <input type="hidden" id="checkBar" name="checkBar" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="library"
                                               name="library" {{ (old('checkLibrary') == 'on'  ? 'checked' :  (old('checkLibrary') == 'off' ? '' :  $property->library == 1 ? 'checked' : ''))  }} ><span>Biblioteca</span>
                                        <input type="hidden" id="checkLibrary" name="checkLibrary" value="">
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="barbecue_grill"
                                               name="barbecue_grill" {{ (old('checkBarbecueGrill') == 'on'  ? 'checked' :  (old('checkBarbecueGrill') == 'off' ? '' :  $property->barbecue_grill == 1 ? 'checked' : ''))  }} ><span>Churrasqueira</span>
                                        <input type="hidden" id="checkBarbecueGrill" name="checkBarbecueGrill" value="">
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="american_kitchen"
                                               name="american_kitchen" {{ (old('checkAmericanKitchen') == 'on'  ? 'checked' :  (old('checkAmericanKitchen') == 'off' ? '' :  $property->american_kitchen == 1 ? 'checked' : ''))  }} ><span>Cozinha Americana</span>
                                        <input type="hidden" id="checkAmericanKitchen" name="checkAmericanKitchen"
                                               value="">
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="fitted_kitchen"
                                               name="fitted_kitchen" {{ (old('checkFittedKitchen') == 'on'  ? 'checked' :  (old('checkFittedKitchen') == 'off' ? '' :  $property->fitted_kitchen == 1 ? 'checked' : ''))  }} ><span>Cozinha Planejada</span>
                                        <input type="hidden" id="checkFittedKitchen" name="checkFittedKitchen" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="pantry"
                                               name="pantry" {{ (old('checkPantry') == 'on'  ? 'checked' :  (old('checkPantry') == 'off' ? '' :  $property->pantry == 1 ? 'checked' : ''))  }} ><span>Despensa</span>
                                        <input type="hidden" id="checkPantry" name="checkPantry" value="">
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="edicule"
                                               name="edicule" {{ (old('checkEdicule') == 'on'  ? 'checked' :  (old('checkEdicule') == 'off' ? '' :  $property->edicule == 1 ? 'checked' : ''))  }} ><span>Edícula</span>
                                        <input type="hidden" id="checkEdicule" name="checkEdicule" value="">
                                    </label>
                                </div>

                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="office"
                                               name="office" {{ (old('checkOffice') == 'on'  ? 'checked' :  (old('checkOffice') == 'off' ? '' :  $property->office == 1 ? 'checked' : ''))  }} ><span>Escritório</span>
                                        <input type="hidden" id="checkOffice" name="checkOffice" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="bathtub"
                                               name="bathtub" {{ (old('checkBathtub') == 'on'  ? 'checked' :  (old('checkBathtub') == 'off' ? '' :  $property->bathtub == 1 ? 'checked' : ''))  }} ><span>Banheira</span>
                                        <input type="hidden" id="checkBathtub" name="checkBathtub" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="fireplace"
                                               name="fireplace" {{ (old('checkFireplace') == 'on'  ? 'checked' :  (old('checkFireplace') == 'off' ? '' :  $property->fireplace == 1 ? 'checked' : ''))  }} ><span>Lareira</span>
                                        <input type="hidden" id="checkFireplace" name="checkFireplace" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="lavatory"
                                               name="lavatory" {{ (old('checkLavatory') == 'on'  ? 'checked' :  (old('checkLavatory') == 'off' ? '' :  $property->lavatory == 1 ? 'checked' : ''))  }} ><span>Lavabo</span>
                                        <input type="hidden" id="checkLavatory" name="checkLavatory" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="furnished"
                                               name="furnished" {{ (old('checkFurnished') == 'on'  ? 'checked' :  (old('checkFurnished') == 'off' ? '' :  $property->furnished == 1 ? 'checked' : ''))  }} ><span>Mobiliado</span>
                                        <input type="hidden" id="checkFurnished" name="checkFurnished" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="pool"
                                               name="pool" {{ (old('checkPool') == 'on'  ? 'checked' :  (old('checkPool') == 'off' ? '' :  $property->pool == 1 ? 'checked' : ''))  }} ><span>Piscina</span>
                                        <input type="hidden" id="checkPool" name="checkPool" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="steam_room"
                                               name="steam_room" {{ (old('checkSteamRoom') == 'on'  ? 'checked' :  (old('checkSteamRoom') == 'off' ? '' :  $property->steam_room == 1 ? 'checked' : ''))  }} ><span>Sauna</span>
                                        <input type="hidden" id="checkSteamRoom" name="checkSteamRoom" value="">
                                    </label>
                                </div>
                                <div>
                                    <label class="label">
                                        <input type="checkbox" id="view_of_the_sea"
                                               name="view_of_the_sea" {{ (old('checkViewOfTheSea') == 'on'  ? 'checked' :  (old('checkViewOfTheSea') == 'off' ? '' :  $property->view_of_the_sea == 1 ? 'checked' : ''))  }} ><span>Vista para o Mar</span>
                                        <input type="hidden" id="checkViewOfTheSea" name="checkViewOfTheSea" value="">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="images" class="d-none">
                            <label class="label">
                                <span class="legend">Imagens</span>
                                <input type="file" name="files[]" multiple>
                            </label>

                            <div class="content_image"></div>
                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" id="btnSubmit">Editar Imóvel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(function () {
            $('input[name="files[]"]').change(function (files) {

                $('.content_image').text('');

                $.each(files.target.files, function (key, value) {
                    var reader = new FileReader();
                    reader.onload = function (value) {
                        $('.content_image').append(
                            '<div class="property_image_item">' +
                            '<div class="embed radius" ' +
                            'style="background-image: url(' + value.target.result + '); background-size: cover; background-position: center center;">' +
                            '</div>' +
                            '</div>');
                    };
                    reader.readAsDataURL(value);
                });
            });
        });
    </script>

    <script>
        var chkSale = document.getElementById("sale");
        var chkRent = document.getElementById("rent");
        var chkAirConditioning = document.getElementById("air_conditioning");
        var chkBar = document.getElementById("bar");
        var chkLibrary = document.getElementById("library");
        var chkBarbecueGrill = document.getElementById("barbecue_grill");
        var chkAmericanKitchen = document.getElementById("american_kitchen");
        var chkFittedKitchen = document.getElementById("fitted_kitchen");
        var chkPantry = document.getElementById("pantry");
        var chkEdicule = document.getElementById("edicule");
        var chkOffice = document.getElementById("office");
        var chkBathtub = document.getElementById("bathtub");
        var chkFireplace = document.getElementById("fireplace");
        var chkLavatory = document.getElementById("lavatory");
        var chkFurnished = document.getElementById("furnished");
        var chkPool = document.getElementById("pool");
        var chkSteamRoom = document.getElementById("steam_room");
        var chkViewOfTheSea = document.getElementById("view_of_the_sea");

        document.getElementById("btnSubmit").onclick = function () {
            if (chkSale.checked) {
                document.getElementById("checkSale").value = 'on';
            } else {
                document.getElementById("checkSale").value = 'off';
            }

            if (chkRent.checked) {
                document.getElementById("checkRent").value = 'on';
            } else {
                document.getElementById("checkRent").value = 'off';
            }

            if (chkAirConditioning.checked) {
                document.getElementById("checkAirConditioning").value = 'on';
            } else {
                document.getElementById("checkAirConditioning").value = 'off';
            }

            if (chkBar.checked) {
                document.getElementById("checkBar").value = 'on';
            } else {
                document.getElementById("checkBar").value = 'off';
            }

            if (chkLibrary.checked) {
                document.getElementById("checkLibrary").value = 'on';
            } else {
                document.getElementById("checkLibrary").value = 'off';
            }

            if (chkBarbecueGrill.checked) {
                document.getElementById("checkBarbecueGrill").value = 'on';
            } else {
                document.getElementById("checkBarbecueGrill").value = 'off';
            }

            if (chkAmericanKitchen.checked) {
                document.getElementById("checkAmericanKitchen").value = 'on';
            } else {
                document.getElementById("checkAmericanKitchen").value = 'off';
            }

            if (chkFittedKitchen.checked) {
                document.getElementById("checkFittedKitchen").value = 'on';
            } else {
                document.getElementById("checkFittedKitchen").value = 'off';
            }

            if (chkPantry.checked) {
                document.getElementById("checkPantry").value = 'on';
            } else {
                document.getElementById("checkPantry").value = 'off';
            }

            if (chkEdicule.checked) {
                document.getElementById("checkEdicule").value = 'on';
            } else {
                document.getElementById("checkEdicule").value = 'off';
            }

            if (chkOffice.checked) {
                document.getElementById("checkOffice").value = 'on';
            } else {
                document.getElementById("checkOffice").value = 'off';
            }

            if (chkBathtub.checked) {
                document.getElementById("checkBathtub").value = 'on';
            } else {
                document.getElementById("checkBathtub").value = 'off';
            }

            if (chkFireplace.checked) {
                document.getElementById("checkFireplace").value = 'on';
            } else {
                document.getElementById("checkFireplace").value = 'off';
            }

            if (chkLavatory.checked) {
                document.getElementById("checkLavatory").value = 'on';
            } else {
                document.getElementById("checkLavatory").value = 'off';
            }

            if (chkFurnished.checked) {
                document.getElementById("checkFurnished").value = 'on';
            } else {
                document.getElementById("checkFurnished").value = 'off';
            }

            if (chkPool.checked) {
                document.getElementById("checkPool").value = 'on';
            } else {
                document.getElementById("checkPool").value = 'off';
            }

            if (chkSteamRoom.checked) {
                document.getElementById("checkSteamRoom").value = 'on';
            } else {
                document.getElementById("checkSteamRoom").value = 'off';
            }

            if (chkViewOfTheSea.checked) {
                document.getElementById("ccheckViewOfTheSea").value = 'on';
            } else {
                document.getElementById("checkViewOfTheSeak").value = 'off';
            }
        };
    </script>

@endsection
