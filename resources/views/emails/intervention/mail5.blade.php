@php
    $sta = "";
    if($status == "attente"){
        $sta = "mise en attente";
    }elseif($status == "rejete"){
        $sta = "rejeté";
    }
@endphp

<h3> Le chef de SIH  a {{ $sta }} la fiche d'intervention n°{{ $fiche }}  . </h3>

<h4> Pour voir  la fiche cliquer <a href="http://stock.test/intervention/fiche/{{ $fiche }}">ici.</a></h4>