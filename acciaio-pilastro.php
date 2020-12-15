<?php
    public static function defaultData($data) {
        return [
            'note' => '',
            'NTC' => '',
            'livCon' => '',
            'FC' => '',
            'sigla' => '',
            'tipo' => '',
            'acciaio' => '',
            'gammaM' => '',
            'jx' => '',
            'wx' => '',
            'wxp' => '',
            'ix' => '',
            'jy' => '',
            'wy' => '',
            'wyp' => '',
            'iy' => '',
            'A' => '',
            'h_prof' => '',
            'b_prof' => '',
            's_prof' => '',
            'e_prof' => '',
            'r_prof' => '',
            'g_prof' => '',
            'jt' => '',
            'jw' => '',
            'E' => '',
            'fyk' => '',
            'lung' => '',
            'snellezza' => '',
            'alfax' => '',
            'alfay' => '',
            'Ned' => '',
            'Vsdx' => '',
            'Vsdy' => '',
            'Msdx' => '',
            'Msdy' => '',
            'Meqx' => '',
            'Meqy' => '',
            'MxA' => '',
            'MyA' => '',
            'MxB' => '',
            'MyB' => '',
        ];
    }

    public static function prepareDataForSave($data)
    {
        return [
            'note' => $data["note"],
            'NTC' => $data["NTC"],
            'livCon' => $data["livCon"],
            'FC' => $data["FC"],
            'sigla' => $data["sigla"],
            'tipoprof' => $data["tipoprof"],
            'acciaio' => $data["acciaio"],
            'gammaM' => $data["gammaM"],
            'jx' => $data["jx"],
            'wx' => $data["wx"],
            'wxp' => $data["wxp"],
            'ix' => $data["ix"],
            'jy' => $data["jy"],
            'wy' => $data["wy"],
            'wyp' => $data["wyp"],
            'iy' => $data["iy"],
            'Atot' => $data["Atot"],
            'h_prof' => $data["h_prof"],
            'b_prof' => $data["b_prof"],
            's_prof' => $data["s_prof"],
            'e_prof' => $data["e_prof"],
            'r_prof' => $data["r_prof"],
            'g_prof' => $data["g_prof"],
            'jt' => $data["jt"],
            'jw' => $data["jw"],
            'E' => $data["E"],
            'fyk' => $data["fyk"],
            'lunghezza' => $data["lunghezza"],
            'snellezza' => $data["snellezza"],
            'alfax' => $data["alfax"],
            'alfay' => $data["alfay"],
            'Ned' => $data["Ned"],
            'Vsdx' => $data["Vsdx"],
            'Vsdy' => $data["Vsdy"],
            'Msdx' => $data["Msdx"],
            'Msdy' => $data["Msdy"],
            'Meqx' => $data["Meqx"],
            'Meqy' => $data["Meqy"],
            'MxA' => $data["MxA"],
            'MyA' => $data["MyA"],
            'MxB' => $data["MxB"],
            'MyB' => $data["MyB"],
        ];
    }

    public static function prepareDataForRender($project)
    {
        $data = unserialize($project[0]->data);
    
        $NTC=$data['NTC'];
        
        $tipoprofilato = substr($data["tipoprof"], 0, 2);
        switch ($tipoprofilato) {
            case 'IP':
            case 'HE':
                $AreaVy = $data["Atot"]-(2*$data["b_prof"]/10*$data["e_prof"]/10)+($data["s_prof"]/10+2*$data["r_prof"]/10)*$data["e_prof"]/10;
                $AreaVx = $data["Atot"]-(($data["h_prof"]-(2*$data["e_prof"])-(2*$data["r_prof"]))/10*($data["s_prof"])/10);
                $AreaWx = ($data["h_prof"]-(2*$data["e_prof"])-(2*$data["r_prof"]))*$data["s_prof"]/100;
                $AreaWy = 2*$data["b_prof"]*$data["e_prof"]/100;
                $C1 = ($data["h_prof"] - ( 2 * $data["e_prof"] ) - ( 2 * $data["r_prof"] ) );
                $T1 = $data["s_prof"];
                $C2 = ($data["b_prof"] - $data["s_prof"] - ( 2 * $data["r_prof"] ) )/2;
                $T2 = $data["e_prof"];
                $verCL1 = $C1 / $T1;
                $verCL2 = $C2 / $T2;
                break;
            case 'UP':
                $AreaVy = $data["Atot"]-(2*$data["b_prof"]/10*$data["e_prof"]/10)+($data["s_prof"]/10+$data["r_prof"]/10)*$data["e_prof"]/10;
                $AreaVx = $data["Atot"]-(($data["h_prof"]-(2*$data["e_prof"])-(2*$data["r_prof"]))/10*($data["s_prof"])/10);
                $AreaWx = ($data["h_prof"]-(2*$data["e_prof"])-(2*$data["r_prof"]))*$data["s_prof"]/100;
                $AreaWy = 2*$data["b_prof"]*$data["e_prof"]/100;
                $C1 = ($data["h_prof"] - ( 2 * $data["e_prof"] ) - ( 2 * $data["r_prof"] ) );
                $T1 = $data["s_prof"];
                $C2 = ($data["b_prof"] - $data["s_prof"] - ( 2 * $data["r_prof"] ) );
                $T2 = $data["e_prof"];
                $verCL1 = $C1 / $T1;
                $verCL2 = $C2 / $T2;
                break;
            case 'PR':
            case 'PQ':
                $AreaVy = $data["Atot"]*$data["h_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $AreaWy = $data["Atot"]*$data["h_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $AreaVx = $data["Atot"]*$data["b_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $AreaWx = $data["Atot"]*$data["b_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $C1 = ($data["h_prof"] - (4 * $data["s_prof"]) );
                $T1 = $data["s_prof"];
                $C2 = ($data["b_prof"] - (4 * $data["s_prof"]) );
                $T2 = $data["s_prof"];
                $verCL1 = $C1 / $T1; //
                $verCL2 = $C2 / $T2; //
                break;
            case 'TR':
            case 'TQ':
                $AreaVy = $data["Atot"]*$data["h_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $AreaWy = $data["Atot"]*$data["h_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $AreaVx = $data["Atot"]*$data["b_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $AreaWx = $data["Atot"]*$data["b_prof"]/10/($data["b_prof"]/10*$data["h_prof"]/10);
                $C1 = ($data["h_prof"] - (4 * $data["s_prof"]) + (3/2*$data["s_prof"]*sqrt(2)/2) );
                $T1 = $data["s_prof"];
                $C2 = ($data["b_prof"] - (4 * $data["s_prof"]) + (3/2*$data["s_prof"]*sqrt(2)/2) );
                $T2 = $data["s_prof"];
                $verCL1 = $C1 / $T1;
                $verCL2 = $C2 / $T2;
                break;
            case 'PC':
            case 'TT':
                $AreaVy = 2*$data["Atot"]/pi();
                $AreaWy = 2*$data["Atot"]/pi();
                $AreaVx = $AreaVy;
                $AreaWx = $AreaVy;
                $C = $data["h_prof"];
                $T = $data["s_prof"];
                $verCL = $C / $T;
                break;
            case 'OM':
                $AreaVy = 2*($data["h_prof"] - $data["s_prof"])*$data["s_prof"]/100;
                $AreaWy = 2*$data["h_prof"]*$data["s_prof"]/100;
                $AreaVx = ($data["b_prof"] - $data["s_prof"])*$data["s_prof"]/100;
                $AreaWx = $data["b_prof"]*$data["s_prof"]/100;
                $C1 = $data["h_prof"] - (4 * $data["s_prof"]) + (3/2*$data["s_prof"]*sqrt(2)/2) ;
                $T1 = $data["s_prof"];
                $C2 = $data["r_prof"];
                $T2 = $data["s_prof"];
                $verCL1 = $C1 / $T1; //anima inflessa
                $verCL2 = $C2 / $T2; //piattabanda compressa interna
                break;
            case 'L-':
            case 'Lu':
                $AreaVy = ($data["h_prof"]-$data["s_prof"])*$data["s_prof"];
                $AreaWy = ($data["h_prof"]-$data["s_prof"])*$data["s_prof"];
                $AreaVx = ($data["b_prof"]-$data["s_prof"])*$data["s_prof"];
                $AreaWx = ($data["b_prof"]-$data["s_prof"])*$data["s_prof"];
                $C1 = max($data["h_prof"],$data["b_prof"]);
                $T1 = $data["s_prof"];
                $C2 = ($data["h_prof"] + $data["b_prof"]);
                $T2 = 2*$data["s_prof"];
                $verCL1 = $C1 / $T1;
                $verCL2 = $C2 / $T2;
                break;
            case 'T-':
                $AreaVy = 0.9*($data["Atot"]-($data["b_prof"]*$data["s_prof"]/100));
                $AreaWy = 0.9*($data["Atot"]-($data["b_prof"]*$data["s_prof"]/100));
                $AreaVx = ($data["b_prof"])*$data["s_prof"]/100;
                $AreaWx = ($data["b_prof"])*$data["s_prof"]/100;
                break;
        }
        
        $eps = sqrt ( 235 / $data['fyk'] );
        //flessione intorno a x
        $psiClasse = (( $data["Ned"] / $data["Atot"] )-( $data['Msdx'] / $data['wx'] )) / (( $data["Ned"] / $data["Atot"] ) + ( $data['Msdx'] / $data['wx'] ));
        if ( $psiClasse > 0 ){
            $alfaClasse = 1;
        }else{
            $alfaClasse = 1 / ( - $psiClasse + 1 );
        }
        if ( $alfaClasse > 0.5 ) {
            $limiteCL1 = (396*$eps)/(13*$alfaClasse - 1);
            $limiteCL2 = (456*$eps)/(13*$alfaClasse - 1);
        }else{
            $limiteCL1 = (36*$eps)/$alfaClasse;
            $limiteCL2 = (41.5*$eps)/$alfaClasse;
        }
        if ( $psiClasse > -1 ) {
            $limiteCL3 = (42*$eps)/(0.67+(0.33*$psiClasse));
        }else{
            $limiteCL3 = (62*$eps)*(1-$psiClasse)*sqrt(-$psiClasse);
        }
        //flessione intorno a y
        $psiClassex = (( $data["Ned"] / $data["Atot"] )-( $data['Msdy'] / $data['wy'] )) / (( $data["Ned"] / $data["Atot"] ) + ( $data['Msdy'] / $data['wy'] ));
        if ( $psiClassex > 0 ){
            $alfaClassex = 1;
        }else{
            $alfaClassex = 1 / ( - $psiClassex + 1 );
        }
        if ( $alfaClassex > 0.5 ) {
            $limiteCL1x = (396*$eps)/(13*$alfaClassex - 1);
            $limiteCL2x = (456*$eps)/(13*$alfaClassex - 1);
        }else{
            $limiteCL1x = (36*$eps)/$alfaClassex;
            $limiteCL2x = (41.5*$eps)/$alfaClassex;
        }
        if ( $psiClassex > -1 ) {
            $limiteCL3x = (42*$eps)/(0.67+(0.33*$psiClassex));
        }else{
            $limiteCL3x = (62*$eps)*(1-$psiClassex)*sqrt(-$psiClassex);
        }
        
        if (($tipoprofilato == 'TT') OR ($tipoprofilato == 'PC')) {  //tubolari tondi a freddo o caldo
            if ( $verCL <= (50*pow($eps,2)) ) {
                $classesez = '1';
            }elseif ( $verCL <= (70*pow($eps,2)) ) {
                $classesez = '2';
            }elseif ( $verCL <= (90*pow($eps,2)) ) {
                $classesez = '3';
            }else{
                $classesez = '4';
            }
        }elseif (($tipoprofilato == 'L-') OR ($tipoprofilato == 'Lu')) {    //profilati a L lati uguali o disuguali
            if ($verCL1 <= (15 * $eps)) {
                $classesez1 = '3';
            } else {
                $classesez1 = '4';
            }
            if ($verCL2 <= (11.5 * $eps)) {
                $classesez2 = '3';
            } else {
                $classesez2 = '4';
            }
            $classesez = max ( $classesez1, $classesez2 );
        }elseif (($tipoprofilato == 'TR')OR($tipoprofilato == 'TQ') OR ($tipoprofilato == 'PQ') OR ($tipoprofilato == 'PR')) {       //tubolari rettangolari o quadrati a freddo o caldo
            if ( $verCL1 <= ($limiteCL1) ) {  
                $classesez1 = '1';
            }elseif ( $verCL1 <= ($limiteCL2) ) {
                $classesez1 = '2';
            }elseif ( $verCL1 <= ($limiteCL3) ) {
                $classesez1 = '3';
            }else{
                $classesez1 = '4';
            }            
            if ( $verCL2 <= ($limiteCL1x) ) {
                $classesez2 = '1';
            }elseif ( $verCL2 <= ($limiteCL2x) ) {
                $classesez2 = '2';
            }elseif ( $verCL2 <= ($limiteCL3x) ) {
                $classesez2 = '3';
            }else{
                $classesez2 = '4';
            }
            $classesez = max($classesez1, $classesez2);
        } elseif ($tipoprofilato == 'OM') {     //profilati omega NON UTILIZZATI PER I PILASTRI
            if ($verCL1 <= (72 * $eps)) {
                $classesez1 = '1';
            } elseif ($verCL1 <= (83 * $eps)) {
                $classesez1 = '2';
            } elseif ($verCL1 <= (124 * $eps)) {
                $classesez1 = '3';
            } else {
                $classesez1 = '4';
            }
            if ($verCL2 <= (33 * $eps)) {
                $classesez2 = '1';
            } elseif ($verCL2 <= (38 * $eps)) {
                $classesez2 = '2';
            } elseif ($verCL2 <= (42 * $eps)) {
                $classesez2 = '3';
            } else {
                $classesez2 = '4';
            }
            $classesez = max($classesez1, $classesez2);
        } elseif ($tipoprofilato == 'T-') {
            $classesez = '3';
        }else{                                  //profilati IPE IPN HEA HEB UPN
            if ( $verCL1 <= ($limiteCL1) ) {
                $classesez1 = '1';
            }elseif ( $verCL1 <= ($limiteCL2) ) {
                $classesez1 = '2';
            }elseif ( $verCL1 <= ($limiteCL3) ) {
                $classesez1 = '3';
            }else{
                $classesez1 = '4';
            }            
            if ( $verCL2 <= (9 * $eps ) ) {
                $classesez2 = '1';
            }elseif ( $verCL2 <= (10 * $eps ) ) {
                $classesez2 = '2';
            }elseif ( $verCL2 <= (14 * $eps ) ) {
                $classesez2 = '3';
            }else{
                $classesez2 = '4';
            }
            $classesez = max ( $classesez1, $classesez2 );
        }    
        
        $Vrdx = $AreaVx*($data['fyk']/10)/(sqrt(3)*$data['gammaM']);
        $Vrdy = $AreaVy*($data['fyk']/10)/(sqrt(3)*$data['gammaM']);
        if ($data['Vsdx'] / $Vrdx <= 0.5) {
            $roMx = 0.00;
        }else{
            $roMx = pow((($data['Vsdx']/$Vrdx)-1),2);
        }
        if ($data['Vsdy'] / $Vrdy <= 0.5) {
            $roMy = 0.00;
        }else{
            $roMy = pow((($data['Vsdy']/$Vrdy)-1),2);
        }
        if ($data["e_prof"]==0){$data["e_prof"]=$data["s_prof"];}
        if ($NTC == '2008'){
            $areaRidx = $AreaVx;
            $areaRidy = $AreaVy;
        }elseif ($NTC == '2018'){
            $areaRidx = $AreaWx;
            $areaRidy = $AreaWy;
        }
        $classesezCase = $classesez;
        if ( (($tipoprofilato == 'TR') OR ($tipoprofilato == 'TQ') OR ($tipoprofilato == 'TT') OR ($tipoprofilato == 'OM')) AND ($classesez<=3) ) {
            $classesezCase = 3;
        }
        switch ($classesezCase) {
            case '1':
            case '2':
                $Aclasse = $data["Atot"];
                $wxclasse = $data["wxp"];
                $wyclasse = $data["wyp"];
                $ridTagliox = ($roMx*pow($AreaVx/10000,2)/(4*$data["s_prof"]/1000));
                $ridTaglioy = ($roMy*pow($AreaVy/10000,2)/(4*$data["e_prof"]/1000));
                if (($tipoprofilato=='IP')OR($tipoprofilato=='HE')) {
                    $ridTagliox = ($roMx*pow($areaRidx/10000,2)/(4*$data["s_prof"]/1000));
                    $ridTaglioy = ($roMy*pow($areaRidy/10000,2)/(4*$data["e_prof"]/1000));
                }
                break;
            case '3':
                $Aclasse = $data["Atot"];
                $wxclasse = $data["wx"];
                $wyclasse = $data["wy"];
                $ridTagliox = ($roMx*pow($AreaVx/10000,2)/(6*$data["s_prof"]/1000));
                $ridTaglioy = ($roMy*pow($AreaVy/10000,2)/(6*$data["e_prof"]/1000));
                if (($tipoprofilato=='IP')OR($tipoprofilato=='HE')) {
                    $ridTagliox = ($roMx*pow($areaRidx/10000,2)/(6*$data["s_prof"]/1000));
                    $ridTaglioy = ($roMy*pow($areaRidy/10000,2)/(6*$data["e_prof"]/1000));
                }
                break;
            case '4':
                if ($tipoprofilato=='OM') {
                    $wxclasse = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['wxeff']/1000;
                    $wyclasse = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['wyeff']/1000;
                    $Aclasse = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['AreaTot']/100;
                    $jxclasse = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['jxeff'];
                    $jyclasse = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['jyeff'];
                    $eY = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['ygc']/1000; //in m
                    $eX = Inge_Function::getWeffOmega($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["s_prof"], $eps)['xgc']/1000; //in m
                }elseif (($tipoprofilato=='TQ')OR($tipoprofilato=='TR')OR($tipoprofilato=='PQ')OR($tipoprofilato=='PR')) {
                    $wxclasse = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['wxeff']/1000;
                    $wyclasse = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['wyeff']/1000;
                    $Aclasse = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['AreaTot']/100;
                    $jxclasse = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['jxeff'];
                    $jyclasse = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['jyeff'];
                    $eY = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['ygc']/1000; //in m
                    $eX = Inge_Function::getWeffTubi($data["h_prof"], $data["b_prof"], $data["s_prof"], $eps)['xgc']/1000; //in m
                }elseif (($tipoprofilato=='IP')OR($tipoprofilato=='HE')) {
                    $wxclasse = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['wxeff']/1000;
                    $wyclasse = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['wyeff']/1000;
                    $Aclasse = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['AreaTot']/100;
                    $jxclasse = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['jxeff'];
                    $jyclasse = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['jyeff'];
                    $eY = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['ygc']/1000; //in m
                    $eX = Inge_Function::getWeffIeH($data["h_prof"], $data["b_prof"], $data["r_prof"], $data["e_prof"], $data["s_prof"], $eps)['xgc']/1000; //in m
                }else{
                    $data['alert']='ERRsezione4';
                    $wxclasse = '';
                    $wyclasse = '';
                    $Aclasse = '';
                    $jxclasse = '';
                    $jyclasse = '';
                }
                $ridTagliox = ($roMx*pow($Aclasse/10000,2)/(6*$data["s_prof"]/1000));
                $ridTaglioy = ($roMy*pow($Aclasse/10000,2)/(6*$data["e_prof"]/1000));
                break;
        }
        $Nrd = round($Aclasse*($data['fyk']/10)/1.05,3);
        $Mrdx = ($wxclasse/1000000-$ridTagliox)*$data['fyk']*1000/$data['gammaM'];
        $Mrdy = ($wyclasse/1000000-$ridTaglioy)*$data['fyk']*1000/$data['gammaM'];
        
        //verifica taglio
        $maggminVx = '<';
        $classVx = 'success';
        $risVx = '';
        $verTagx = ($data['Vsdx']/$Vrdx);
        if ($verTagx > 1){
            $maggminVx = '>';
            $classVx = 'danger';
            $risVx = 'NON';
        }
        if ($data['Vsdx']<(0.5*$Vrdx)){
            $interazioneVx = "Il taglio sollecitante &egrave; minore di 0.5*Vrd, quindi si trascura l'influenza del taglio sulla resistenza a flessione";
        }else{
            $interazioneVx = "Il taglio sollecitante &egrave; maggiore di 0.5*Vrd, quindi si ha influenza del taglio sulla resistenza a flessione";
        }
        $maggminVy = '<';
        $classVy = 'success';
        $risVy = '';
        $verTagy = ($data['Vsdy']/$Vrdy);
        if ($verTagy > 1){
            $maggminVy = '>';
            $classVy = 'danger';
            $risVy = 'NON';
        }
        if ($data['Vsdy']<(0.5*$Vrdy)){
            $interazioneVy = "Il taglio sollecitante &egrave; minore di 0.5*Vrd, quindi si trascura l'influenza del taglio sulla resistenza a flessione";
        }else{
            $interazioneVy = "Il taglio sollecitante &egrave; maggiore di 0.5*Vrd, quindi si ha influenza del taglio sulla resistenza a flessione";
        }
        
        //verifica pressoflessione
        $caricoCRx=round((pow(pi(),2)*$data['E']/10*$data["jx"]/(pow(100*$data["lunghezza"],2))),3);
        $caricoCRy=round((pow(pi(),2)*$data['E']/10*$data["jy"]/(pow(100*$data["lunghezza"],2))),3);
        $lambdax=round((sqrt($data["Atot"]*$data['fyk']/10/$caricoCRx)),3);
        $lambday=round((sqrt($data["Atot"]*$data['fyk']/10/$caricoCRy)),3);
        $fix=0.5*(1+($data["alfax"]*($lambdax-0.2))+($lambdax*$lambdax));
        $fiy=0.5*(1+($data["alfay"]*($lambday-0.2))+($lambday*$lambday));
        $chix=1/($fix+(sqrt(($fix*$fix)-($lambdax*$lambdax))));
        $chiy=1/($fiy+(sqrt(($fiy*$fiy)-($lambday*$lambday))));
        if ($chix<1) {
            $chix;
        }else {
            $chix=1;
        }
        if ($chiy<1) {
            $chiy;
        }else {
            $chiy=1;
        }
        $chimin=min($chix,$chiy);
        $nMN = $data["Ned"]/$Nrd;        
        if (($tipoprofilato == 'IP')OR($tipoprofilato == 'HE')){
            $alfaEXP = 2;
            $betaEXP = min(1,5*$nMN);
            if ($data["h_prof"]/$data["b_prof"] > 2) $curva = 'c';
            else $curva = 'b';
            $datajy = $data['jy']; 
            $datajt = $data['jt']; 
            $datajw = $data['jw'];   
            $aMN = min( ($data["Atot"]-2*$data["b_prof"]/10*$data["e_prof"]/10)/$data["Atot"], 0.5);
            $Mnrdx = min( $Mrdx*((1-$nMN)/(1-(0.5*$aMN))), $Mrdx);
            if ( $nMN <= $aMN ){
                $Mnrdy = $Mrdy;
            }else{
                $Mnrdy = $Mrdy*(1-pow(($nMN-$aMN)/(1-$aMN),2));
            }            
        }elseif(($tipoprofilato == 'TT')OR($tipoprofilato == 'PC')){
            $alfaEXP = 2;
            $betaEXP = 2;
            $curva = 'd';
            $datajy = $data['jy']; 
            $datajt = pi()*( pow($data['b_prof'],4)-pow(($data['b_prof']-2*$data['s_prof']),4) )/32; 
            $datajw = 0;
            $Mnrdx = $Mrdx*(1-pow($nMN,1.7));
            $Mnrdy = $Mnrdx;
        }elseif(($tipoprofilato == 'TQ')OR($tipoprofilato == 'PQ')OR($tipoprofilato == 'TR')OR($tipoprofilato == 'PR')){
            $alfaEXP = min((1.66/(1-(1.13*pow($nMN,2)))),6);
            $betaEXP = $alfaEXP;
            $curva = 'd';
            $datajy = $data['jy']; 
            $datajt = 4*pow( ($data['b_prof']-$data['s_prof'])*($data['h_prof']-$data['s_prof']) ,2)*$data['s_prof'] / ( 2*($data['b_prof']-$data['s_prof'])+2*($data['h_prof']-$data['s_prof'])); 
            $datajw = 0;
            $aMNs = ($data["Atot"]-2*$data["b_prof"]/10*$data["s_prof"]/10)/$data["Atot"];
            $aMNe = ($data["Atot"]-2*$data["h_prof"]/10*$data["s_prof"]/10)/$data["Atot"];
            $Mnrdx = ($Mrdx*(1-$nMN)/(1-0.5*$axMNs));
            $Mnrdy = ($Mrdx*(1-$nMN)/(1-0.5*$axMNe));
        }elseif($tipoprofilato == 'UP'){          // PROFILATO UPN - nessun riferimento normativo - ipotesi da formulare
            $curva = 'c';
            $datajy = $data['jy'];
            $datajt = $data['jt'];
            $datajw = $data['jw']; 
            $Mnrdy = $Mrdy;
            $Mnrdx = $Mrdx;
        }
        
        $alfa = array(
            'a' => 0.21,
            'b' => 0.34,
            'c' => 0.49,
            'd' => 0.76,
        );        
        $G = $data['E'] / (2*(1+0.3));
        $alfaLT = $alfa[$curva];
        $rigFly = $data['E']*($datajy*10000)/1000000000; //in KNm^2
        $rigTor = $G*($datajt*10000)/1000000000; //in KNm^2
        $rigSec = $data['E']*($datajw*1000)/1000000000000000; // in KNm^4
        $psi = 1;
        $momcritico = $psi*(pi()/($data['lunghezza']))*(sqrt($rigFly*$rigTor))*(sqrt(1+pow((pi()/($data['lunghezza'])),2)*($rigSec/$rigTor)));
        $lambdaLT = sqrt(($wxclasse/ 1000000)*$data['fyk']*1000/$momcritico);
        $lambdaLT0 = 0.2;
        $kc = 1;
        $f = 1 - 0.5*(1-$kc)*(1-2*(pow(($lambdaLT-0.8),2)));
        $beta = 1;
        $kappachi = min(1,(1/($f*pow($lambdaLT,2))));
        $psiLT = 0.5*(1+$alfaLT*($lambdaLT-$lambdaLT0)+$beta*pow($lambdaLT,2));
        $chiLT = (1/$f)*(1 / ($psiLT+sqrt(pow($psiLT,2)-($beta*pow($lambdaLT,2)))));
        $chiLT = min ($chiLT,$kappachi);
        //per classe 4
        if ( abs($data['MxA']) >= abs($data['MxB']) ){
            $Mxmag = $data['MxA'];
            $Mxmin = $data['MxB'];
        }else{
            $Mxmag = $data['MxB'];
            $Mxmin = $data['MxA'];            
        }
        if ( abs($data['MyA']) >= abs($data['MyB']) ){
            $Mymag = $data['MyA'];
            $Mymin = $data['MyB'];
        }else{
            $Mymag = $data['MyB'];
            $Mymin = $data['MyA'];
        }
        $psiX = $Mxmin/$Mxmag;
        $psiY = $Mymin/$Mymag;
        $alfaMX = max(0.6+0.4*$psiX,0.4*$psiX);
        $alfaMY = max(0.6+0.4*$psiY,0.4*$psiY);
        $alfaMLT = $alfaMY;
        if ($classesez == 4){
            $kXX = min( $alfaMX*(1+(0.6*$lambdax*$data['Ned']*$data['gammaM']/($chix*$Aclasse*$data['fyk']))),$alfaMX*(1+(0.6*$data['Ned']*$data['gammaM']/($chix*$Aclasse*$data['fyk']))) );
            $kYY = min( $alfaMY*(1+(0.6*$lambday*$data['Ned']*$data['gammaM']/($chiy*$Aclasse*$data['fyk']))),$alfaMY*(1+(0.6*$data['Ned']*$data['gammaM']/($chiy*$Aclasse*$data['fyk']))) );
            $kXY = $kYY;
            if ( $tipoprofilato != 'UP' ){
                $kYX = ($data['Msdy'] == 0) ? 0 : 0.8*$kXX;
            }else{
                $kYX = max( 1-((0.05*$lambday/($alfaMLT-0.25))*($data['Ned']*$data['gammaM']/($chiy*$Aclasse*$data['fyk']))),1-((0.05/($alfaMLT-0.25))*($data['Ned']*$data['gammaM']/($chiy*$Aclasse*$data['fyk']))) );
            }
        }
        //verifica resistenza
        $maggminR = '<';
        $classR = 'success';
        $risR = '';
        if ( $classesez < 3 ){
            if ( ($tipoprofilato != 'UP')AND($nMN >= 0.2) ){
                $verRes = pow(($data['Msdx']/$Mnrdx),$alfaEXP)+pow(($data['Msdy']/$Mnrdy),$betaEXP);
            }else{
                $verRes = ($data['Msdx']/$Mnrdx)+($data['Msdy']/$Mnrdy);
            }
        }elseif ( $classesez == 3 ){
            $verRes = ($data["Ned"]/$Nrd)+($data['Msdx']/$Mrdx)+($data['Msdy']/$Mrdy);
        }elseif ( $classesez = 4 ){
            $verRes = ($data["Ned"]/$Nrd)+(($data['Msdx']+($data["Ned"]*$eY))/$Mrdx)+(($data['Msdy']+($data["Ned"]*$eX))/$Mrdy);
        }
        if ($verRes > 1){
            $maggminR = '>';
            $classR = 'danger';
            $risR = 'NON';
        }
        //verifica stabilita
        $maggminS = '<';
        $classS = 'success';
        $risS = '';
        $risS0 = '<b><i class="fa fa-check-circle"></i></b>';
        if ( $classesez < 4 ){
            $verStab = ($data["Ned"]*$data['gammaM']/($chimin*$Aclasse*$data['fyk']/10))+($data["Meqx"]*100*$data['gammaM']/($chiLT*$data['fyk']/10*$wxclasse*(1-($data["Ned"]/$caricoCRx))))+($data["Meqy"]*100*$data['gammaM']/($data['fyk']/10*$wyclasse*(1-($data["Ned"]/$caricoCRy))));
            if ($verStab > 1){
                $maggminS = '>';
                $classS = 'danger';
                $risS = 'NON';
                $risS0 = '<b><i class="fa fa-times-circle"></i></b>';
            }
        }else{
            $verStab1 = ($data["Ned"]*$data['gammaM']/($chix*$Aclasse*$data['fyk']/10))+$kXX*(($data['Msdx']+($data["Ned"]*$eY))*100*$data['gammaM']/($chiLT*$data['fyk']/10*$wxclasse))+$kXY*(($data['Msdy']+($data["Ned"]*$eX))*100*$data['gammaM']/($data['fyk']/10*$wyclasse));
            $verStab2 = ($data["Ned"]*$data['gammaM']/($chiy*$Aclasse*$data['fyk']/10))+$kYX*(($data['Msdx']+($data["Ned"]*$eY))*100*$data['gammaM']/($chiLT*$data['fyk']/10*$wxclasse))+$kYY*(($data['Msdy']+($data["Ned"]*$eX))*100*$data['gammaM']/($data['fyk']/10*$wyclasse)); 
            if ( ($verStab1 > 1) OR ($verStab2 > 1) ){
                $maggminS = '>';
                $classS = 'danger';
                $risS = 'NON';
                $risS0 = '<b><i class="fa fa-times-circle"></i></b>';
            }
        }
        
        $data['wxclasse'] = round($wxclasse, 0);
        $data['wyclasse'] = round($wyclasse, 0);
        $data['jxclasse'] = round($jxclasse, 0);
        $data['jyclasse'] = round($jyclasse, 0);
        $data['Aclasse'] = round($Aclasse, 0);
        $data['NTC'] = $NTC;
        $data['classesez'] = $classesez;
        $data['Nrd'] = round($Nrd, 3);
        $data['Mrdx'] = round($Mrdx, 3);
        $data['Mrdy'] = round($Mrdy, 3);
        $data['Ncrx'] = round($caricoCRx, 3);
        $data['Ncry'] = round($caricoCRy, 3);
        $data['Mnrdx'] = round($Mnrdx, 3);
        $data['Mnrdy'] = round($Mnrdy, 3);
        $data['Vrdx'] = round($Vrdx, 3);
        $data['Vrdy'] = round($Vrdy, 3);
        $data['classVx'] = $classVx;
        $data['maggminVx'] = $maggminVx;
        $data['risVx'] = $risVx;
        $data['interazioneVx'] = $interazioneVx;
        $data['classVy'] = $classVy;
        $data['maggminVy'] = $maggminVy;
        $data['risVy'] = $risVy;
        $data['interazioneVy'] = $interazioneVy;
        $data['classR'] = $classR;
        $data['maggminR'] = $maggminR;
        $data['risR'] = $risR;
        $data['verTagx'] = $verTagx;
        $data['verTagy'] = $verTagy;
        $data['verRes'] = $verRes;
        $data['verStab'] = $verStab;
        $data['classS'] = $classS;
        $data['maggminS'] = $maggminS;
        $data['risS'] = $risS;

        return $data;
    }
?>
