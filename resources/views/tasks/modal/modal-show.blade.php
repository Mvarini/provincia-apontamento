@foreach($tasks as $task)
    <div class="modal fade" id="formShow{{ $task->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel{{ $task->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Apontamento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid px-4">
                        <dl class="row">
                            <dt class="col-md-3">Lote:</dt>
                            <dd class="col-md-9">{{ $task->batch_number }}</dd>

                            <dt class="col-md-3">Data:</dt>
                            <dd class="col-md-9">{{  \Carbon\Carbon::createFromFormat('Y-m-d', $task->date)->format('d/m/Y') }}</dd>

                            <dt class="col-md-3">Máquina:</dt>
                            <dd class="col-md-9">{{ $task->machine->name }}</dd>

                            <dt class="col-md-3">Produto:</dt>
                            <dd class="col-md-9">{{ $task->product?->name }}</dd>

                            <dt class="col-md-3">Operador:</dt>
                            <dd class="col-md-9">{{ $task->employee->name }}</dd>

                            <dt class="col-md-3">Produção/minuto:</dt>
                            <dd class="col-md-9">{{ $task->production_minute }}</dd>

                            <dt class="col-md-3">Peças/segundo:</dt>
                            <dd class="col-md-9">{{ $task->piece_second }}</dd>

                            <dt class="col-md-3">Qtde realizada:</dt>
                            <dd class="col-md-9 number">{{ $task->amount_carried }}</dd>

                            <dt class="col-md-3">Qtde prevista:</dt>
                            <dd class="col-md-9 number">{{ $task->expected_quantity }}</dd>

                            <dt class="col-md-3">% Produtividade:</dt>
                            <dd class="col-md-9 money">{{ $task->productivity }} </dd>

                            <dt class="col-md-3">Descarte:</dt>
                            <dd class="col-md-9 number">{{ $task->discard_quantity }} </dd>

                            <dt class="col-md-3"> Terminar o lote:</dt>
                            <dd class="col-md-9 number">{{ $task->missing_quantity }} </dd>

                            <dt class="col-md-3">Tempo de roteiro:</dt>
                            <dd class="col-md-9 second">{{ $task->script_time }} </dd>

                            <dt class="col-md-3">Tempo real:</dt>
                            <dd class="col-md-9 second">{{ $task->real_time }} </dd>

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
