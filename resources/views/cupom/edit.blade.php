<x-layout tittle="Editar Cupom">
    <form action="{{ route('cupom.update', $cupom->id) }}" class="form-group" method="post">
        @csrf
        @method('PUT')
        <div id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Formulário Cupom Desconto</h5>
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" placeholder="Digite o nome" name="nome" value="{{ $cupom->nome }}">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <label for="localizador">Localizador</label>
                                <input type="text" class="form-control" placeholder="Digite o nome" name="localizador" value="{{ $cupom->localizador }}" disabled>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label for="desconto">Desconto</label>
                                <input type="text" class="form-control" name="desconto" placeholder="Digite o valor (EX:. 59.99)" value="{{ $cupom->desconto }}">
                            </div>
                            <div class="col-lg-6">
                                <h5>Modo Desconto</h5>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modo_desconto" id="inlineRadio1" value="valor" @if($cupom->modo_desconto === 'valor')checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Valor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modo_desconto" id="inlineRadio2" @if($cupom->modo_desconto == 'porc')checked @endif value="porc">
                                    <label class="form-check-label" for="inlineRadio2">porc</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label for="limite">Limite</label>
                                <input type="text" class="form-control" name="limite" placeholder="Digite o valor (EX:. 59.99)" value="{{ $cupom->limite }}">
                            </div>
                            <div class="col-lg-6">
                                <h5>Modo Limite</h5>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modo_limite" id="inlineRadio3" value="valor" @if($cupom->modo_limite == 'valor')checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Valor</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="modo_limite" id="inlineRadio4" value="qtd" @if($cupom->modo_limite == 'qtd')checked @endif>
                                    <label class="form-check-label" for="inlineRadio2">Qtd</label>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <label for="dthr_validade">Validade</label>
                                <input type="datetime-local" class="form-control" name="dthr_validade" value="{{ $cupom->dthr_validade }}">
                            </div>
                            <div class="col-lg-6">
                                <h5>Status <b>Ativo</b></h5>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="inlineRadio5" value="S" @if($cupom->ativo == 'S') checked @endif>
                                    <label class="form-check-label" for="inlineRadio1">Sim</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="ativo" id="inlineRadio6" value="N" @if($cupom->ativo == 'N') checked @endif>
                                    <label class="form-check-label" for="inlineRadio2">Não</label>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        <div class="col">
                            <a href="{{ route('cupom.index') }}" class="btn btn-primary">Cancelar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-layout>