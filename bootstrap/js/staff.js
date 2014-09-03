
// By Joannes Vermorel, 2008-05-04

//Modified By Jaison Gonzalez, 2013-08-17
//Modified By Lennin Suescun, 2014-07-22


// Return Power(u, k) / Factorial(k) in a numeric-safe manner.
function PowerFact(m, x ){
    var s = 0;
    for (var k = 1; k <= m; k++) {
        s = s + Math.log(x / k);
    }

    return Math.exp(s);
}

// Returns the probability a call waits.
// m is the agent count
// u is the traffic intensity
// m As Integer, u As Double
function ErlangC(m, u){
    
    var d = PowerFact(m, u);
    var s = 1;

    for (var k = 1; k < m; k++) {
        s = s + PowerFact(k, u);
    }
    return d / (d + (1 - u / m) * s);
}

// Returns the probability a call waits.
// m is the agent count
// u is the traffic intensity
// tt is the target wait time
// tc is the average call time
//ByVal m As Integer, ByVal u As Double, ByVal tc As Double, ByVal tt As Double
function ErlangCsrv(m, u, tc, tt){
    return 1 - ErlangC(m, u) * Math.exp(-(m - u) * (tt / tc));
}

// Returns the average speed of answer (ASA)
// m is the agent counts.
// u is the traffic intensity
// tc is the average call time
// ByVal m As Integer, ByVal u As Double, ByVal tc As Double
function ASA(m, u, tc){
    return ErlangC(m, u) * tc / (m - u);
}

// m is the agent count
// n is the Incoming calls
// tc is the Average Time Call (AHT)
// tt is the Target Wait Time
// ByVal m As Integer, ByVal n As Integer, ByVal tc As Double, ByVal tt As Double
function ServiceLevel(m, n, tc, tt){
    
    //u is traffic intensy    
    var u; 
    var util; 
    var SLtemp; 
    var serviceLevel;
    //Como Eliminar errores del ServiceLevel
    util = 0.9375;

    if (m <= 0 || n <= 0 || tc <= 0 || tt <= 0) {
        return 0;
    }else{
        // El tamaño maximo del brack son 30 mins, resultados con AHT mayor a ese tiempo se consideran atipicos, la formula de
        // ErlangC suele aplicarse a rangos de tiempo menores de 30 mins
        if (tc > 30) {tc = 30};

        // tt/tc Es una forma de representar la puntualidad de los turnos
        serviceLevel = (tt / tc) * m / n;

        u = tc * n / (util * 30); //tc representa el AHT, n la cantidad de ingresos y m es la cantidad de servidores
        SLtemp = ErlangCsrv(m, u, tc, tt);

        if (serviceLevel > 1 || SLtemp > serviceLevel) {
            serviceLevel = SLtemp;
        };

        if (m >= n) {
            serviceLevel = 1;
        };
    };

    return serviceLevel;
}

function suma(obj, key){

    var suma = 0;
    for (var i = 0; i < obj.length; i++) {
        suma += obj[i][key];
    };
    return suma;
}

// Realiza la sumaproducto de un arreglo de objetos con dos keys
function sumaProducto(obj, key1, key2){
    var sumaProducto = 0;
    for (var i = 0; i < obj.length; i++) {
        sumaProducto += obj[i][key1]*obj[i][key2];
    };
    return sumaProducto;
}


//================================================================================
//================================================================================
//================================================================================
//================================================================================
//================================================================================

