@php
    $linea = '';
    if($item->total > 1){
        if($item->numero == 0)
            $linea = 'izquierda';
        elseif($item->numero + 1 == $item->total)
            $linea = 'derecha';
        else
            $linea = 'centro';
    }        
@endphp
<div class="paso {{ $linea }}">    
    <div class="primero">
        <div class="cv_linea"></div>
        <div class="card s_box">  
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        @if($item->estado == 0)
                        <span class="bg-yellow-lt avatar" title="PENDIENTE DE RECEPCIÓN">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><polyline points="12 7 12 12 15 15" /></svg>
                        </span>
                        @elseif($item->estado == 1)
                        <span class="bg-blue-lt avatar" title="RECIBIDO">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h11a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-11a1 1 0 0 1 -1 -1v-14a1 1 0 0 1 1 -1m3 0v18" /><line x1="13" y1="8" x2="15" y2="8" /><line x1="13" y1="12" x2="15" y2="12" /></svg>
                        </span>
                        @else
                        <span class="bg-green-lt avatar" title="FINALIZADO / ARCHIVADO">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="4" width="18" height="4" rx="2" /><path d="M5 8v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-10" /><line x1="10" y1="12" x2="14" y2="12" /></svg>
                        </span>
                        @endif
                    </div>
                    <div class="col">
                        <div class="font-weight-medium lh-1 text-truncate" title="{{ $item->nombre }}">{{ $item->nombre }} </div> 
                        <small class="text-muted text-truncate" title="{{ $item->detalle }}">{{ $item->detalle }}</small>
                    </div>
                </div>                
            </div>   
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">                   
                        <small class="d-block text-muted lh-1">Enviado</small>
                        <div class="text-body lh-1">{{ $item->enviado->format('d/m/Y') }}h</div>                    
                    </div> 
                </div>
            </div> 
        </div>
    </div>    
    @if(count($item->despues)>0)
    <div class="siguientes">    
        <div class="cv_linea"></div>
        @each('tramite.rec_item', $item->despues, 'item')
    </div>
    @endif    
</div>