//*******************************************************
//Declaración de variables
//*******************************************************
// Single es array
// Range es el rango de las las cuadricula de excel

Dim tempRango As Range
Dim slots(0 To 20) As Single
Dim acum_slots(0 To 20) As Single
Dim best_slots(0 To 20) As Single
Dim turnos_almuerzo(0 To 20) As Single
Dim ingresosArreglo(1 To 26) As Single
Dim AHTArreglo(1 To 26) As Single
Dim RacsArreglo(1 To 26) As Single
Dim temporalRacs(1 To 26) As Single
Dim tempSLA(1 To 26) As Single
Dim i As Integer, j As Integer, k As Integer, l As Integer
Dim maxSLA As Single, SLA As Single
Dim util As Single
Dim TempLunch(1 To 20) As Single
Dim franjas As Integer, RACS As Integer
Dim Hora_Primer_Almuerzo As Single


function find_slots(slots, acum_slots, index, q, RACS){
    while(slots(index) < RACS - acum_slots(index - 1) - (q - index)){
           slots(index) = slots(index) + 1;
           acum_slots(index) = acum_slots(index - 1) + slots(index);
           
           if(index + 1 <= q){
               slots(index + 1) = -1;
               find_slots(slots, acum_slots, index + 1, q, RACS);
           }
    }

    if (Valid(slots(), q, RACS) {
        for (var i = 1; i <= q + 1; i++) {
            TempLunch(k) = slots(k) + slots(k - 1);
        };

        restar_almuerzos(temporalRacs, RacsArreglo, TempLunch, Hora_Primer_Almuerzo);

        Calcular_SLA(tempSLA, temporalRacs, ingresosArreglo, AHTArreglo, 15, util);
        SLA = pond_Ing(tempSLA, ingresosArreglo, j);
        if (SLA > maxSLA Then){
            maxSLA = SLA;
            for(var u = 1; u <= q + 1; u++){
                best_slots(u) = TempLunch(u);
                turnos_almuerzo(u) = slots(u);
            }
        }

    }    
}


Sub Generar_Almuerzo()

    Dim slots() As Single, acum_slots() As Single
    
    util = 0.985
    
    //Cargar los Datos de AHT, Ingresos, RACs y días con Almuerzo
    Set tempRango = Worksheets("PRONOSTICO").Range("H10:H36") //Atendidos R
    Cargar_Ingresos ingresosArreglo, tempRango //Carga los datosRango y los pasa a un array datosArreglo() multiplicado por 2
    
    Set tempRango = Worksheets("PRONOSTICO").Range("I10:I36") //Datos de AHT
    Cargar_Datos AHTArreglo, tempRango //Carga los datosRango y los pasa a un array datosArreglo()
    
    Set tempRango = Worksheets("PRONOSTICO").Range("C10:C36") //Datos de asesores
    Cargar_Datos RacsArreglo, tempRango
    
    Set tempRango = Worksheets("PRONOSTICO").Range("D10:D36") //Datos de Alumuezo
    Set turnosAlmuerzo = Worksheets("PRONOSTICO").Range("L10:L36") //Datos de //Turnos Almuerzo
    
    Worksheets("PRONOSTICO").Range("D10:D36").ClearContents
    Worksheets("PRONOSTICO").Range("L10:L36").ClearContents
    
    RACS = Worksheets("PRONOSTICO").Range("C38") //Asesores almorzando
    franjas = Worksheets("PRONOSTICO").Range("C39")
    Hora_Primer_Almuerzo = Worksheets("PRONOSTICO").Range("C40") //Hora Inicio
    
        
        maxSLA = 0
        ReDim slots(0 To 20)
        ReDim acum_slots(0 To 20)
        slots(1) = -1
        find_slots slots(), acum_slots(), 1, franjas, RACS
        For i = 1 To franjas + 1
                tempRango.Cells((Hora_Primer_Almuerzo - 8) * 2 + i).Value = best_slots(i)
                turnosAlmuerzo.Cells((Hora_Primer_Almuerzo - 8) * 2 + i).Value = turnos_almuerzo(i)
        Next i
     
    
        
    
    //Hora_Primer_Almuerzo = Hora_Primer_Almuerzo + 1
    
    
    //Loop


End Sub

function Valid(slots() As Single, q As Integer, RACS As Integer){
    s = 0;
    for(var i = 1 To q){
        If (slots(i) + slots(i + 1) > (RACS / 3)) Then s = -100;
    }
    if (s = 0){
        Valid = true;
    }else{
        Valid = false;
    }
}
//********************************************************************************
//Subrutina para Cargar Datos de un Rango a un Array
//********************************************************************************
function Cargar_Datos(datosArreglo, datosRango){
    Dim i As Integer, j As Integer, filas As Integer, columnas As Integer

    filas = datosRango.Rows.count;
        for (var i = 1;  i <= filas - 1; i++){
                if(datosRango.Cells(i) = ""){
                    datosArreglo(i) = 0;
                }else{
                    datosArreglo(i) = datosRango.Cells(i);
                }
        }
}
//-----------------------------------------------------------------
//********************************************************************************
//Subrutina para Cargar Ingresos, double up
//Carga los datosRango y los pasa a un array datosArreglo() multiplicado por 2
//********************************************************************************
function Cargar_Ingresos(datosArreglo, datosRango)
    Dim i As Integer, j As Integer, filas As Integer, columnas As Integer

    filas = datosRango.Rows.count;
        for (var i = 1; i <= filas - 1){
                if (datosRango.Cells(i) = ""){
                    datosArreglo(i) = 0;
                }else{
                    datosArreglo(i) = datosRango.Cells(i) * 2;
                }
        }
}
//-----------------------------------------------------------------

//*****************************************************************
//Subrutina para Cargar el Array de RACs
//*****************************************************************
Sub Cargar_Racs(vectorRacs() As Single, arrayRacs() As Single, arrayIngresos() As Single)
Dim i As Integer, j As Integer
For i = 1 To 14
    For j = 1 To days
        If arrayIngresos(i, j) = 0 Then
            arrayRacs(i, j) = 0
        Else
            arrayRacs(i, j) = vectorRacs(j)
        End If
    Next j
Next i
End Sub

//******************************************************************
//Función que devuelve la suma de los elementos de un array
//******************************************************************
function Suma_Array(Arreglo){
    var i;
    var j;
    var suma = 0;
    for (var i = LBound(Arreglo, 1) To UBound(Arreglo, 1)){
        For j = LBound(Arreglo, 2) To UBound(Arreglo, 2)
            suma = suma + Arreglo(i, j)
        Next j
    }
    Suma_Array = suma;
}

//******************************************************************
//Función que pondera por los ingresos
//******************************************************************
Function pond_Ing(SLA() As Single, Ing() As Single, j As Integer) As Single
Dim i As Integer
Dim x As Single
x = 0
suma = 0
For i = 1 To 26
        x = x + SLA(i) * Ing(i)
        suma = suma + Ing(i)
Next i
x = x / suma
pond_Ing = x
End Function
//-------------------------------------------------------------------

//********************************************************************
//Procedure para calcular el SLA por rangos de horas
//********************************************************************
Sub Calcular_SLA(SLA() As Single, RacArray() As Single, IngArray() As Single, AHTArray() As Single, SLAEsperado As Single, util As Single)
Dim i As Integer
For i = 1 To 26
        If RacArray(i) = 0 Then
            SLA(i) = 0
        Else
            SLA(i) = ServiceLevel(RacArray(i), redondeo(IngArray(i)), AHTArray(i), SLAEsperado)
        End If
Next i
End Sub
//--------------------------------------------------------------------

//********************************************************************
//Cargar días con Almuerzos
//********************************************************************
Sub Cargar_Dias_Almuerzo(vector() As Boolean, Rango As Range)
    For i = 1 To days
        If Rango.Cells(1, i) = "No" Then
            vector(i) = False
        Else
            vector(i) = True
        End If
    Next i
End Sub

//********************************************************************
//Un elemento se encuentra en un array
//********************************************************************
Function esta_en_array(elemento As Single, Arreglo() As Single)
    Dim sw As Boolean
    Dim i As Integer, j As Integer
    sw = False
    i = LBound(Arreglo, 1)
    j = UBound(Arreglo, 1)
    Do While i <= j And sw = False
        If elemento = Arreglo(i) Then
            sw = True
        End If
        i = i + 1
    Loop
    esta_en_array = sw
End Function

//********************************************************************
//Buscar el menor de los elementos de un array
//********************************************************************
Function menor_elemento(vector() As Single, lunch() As Boolean) As Single
Dim i As Integer, menor As Single, es_primera As Boolean
es_primera = True
For i = LBound(vector, 1) To UBound(vector, 1)
    If lunch(i) = True Then
        If es_primera = True Then
            menor = vector(i)
            es_primera = False
        Else
            If vector(i) < menor Then
                menor = vector(i)
            End If
        End If
    End If
Next i
menor_elemento = menor
End Function

//********************************************************************
//Procedure para Restar Racs almorzando
//********************************************************************
Sub restar_almuerzos(racsTemporal() As Single, racsOriginal() As Single, racsAlmuerzo() As Single, horaAlmuerzo As Single)
    Dim i As Integer
    copiar_array racsOriginal, racsTemporal, j
    For i = 1 To franjas + 1
            //racsTemporal(horaAlmuerzo - 8 + i) = 0 // Limpia cálculos anteriores
            racsTemporal((horaAlmuerzo - 8) * 2 + i) = racsOriginal((horaAlmuerzo - 8) * 2 + i) - racsAlmuerzo(i)
    Next i
End Sub

//********************************************************************
//Procedure para duplicar un array en otro
//Los arrays deben ser Single y del mismo tamaño (no valida)
//********************************************************************
Sub copiar_array(origen() As Single, destino() As Single, j As Integer)
    Dim i As Integer
    For i = LBound(origen, 1) To UBound(origen, 1)
            destino(i) = origen(i)
    Next i
End Sub

function max(x, y){
    var max;
    if (x > y){
        max = x;
    }else
        max = y;
    }
    return max;
}

function redondeo(x, Factor= 1){

    var temp;
    temp = Int(x * Factor);
    redondeo = (temp + IIf(x = temp, 0, 1)) / Factor;
}







