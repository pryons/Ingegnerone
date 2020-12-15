<?php
public static function getWeffOmega($h, $b, $r, $s, $eps) {
        $rm = 1.5*$s;
        $gr = $rm * (1- sqrt(2)/2);
        $bp = $b - $s - 2*$gr;
        $hp = $h - $s - 2*$gr;
        $rp = $r - $s/2 - $gr;
        $psi0 = 1;
        $ksigma0 = 4;
        $lambdap0 = ($bp/$s)/(28.4*$eps*sqrt($ksigma0));
        if ($lambdap0 <= 0.673){
            $ro0 = 1;
        }else{
            $ro0 = ($lambdap0-0.055*(3+$psi0))/pow($lambdap0,2);
        }
        $beff = $bp * $ro0;
        $be1 = 0.5*$beff;
        $be2 = 0.5*$beff;        
        $wxeff_sup_Arr = array();
        $wxeff_inf_Arr = array();
        for ( $oi=0; $oi<6; ++$oi){
            if ($oi == 0) {
                $psi = -1;
            }else{
                $nn = $oi-1;
                $psi = $wxeff_sup_Arr[$nn]/$wxeff_inf_Arr[$nn];
            }
            if (($psi >= -3)&&($psi < -1)){
                $ksigma = 5.98*pow((1-$psi),2);
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi == -1)){
                $ksigma = 23.9;
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi > -1)&&($psi < 0)){
                $ksigma = 7.81-(6.29*$psi)+9.78*pow($psi,2);
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi == 0)){
                $ksigma = 7.81;
                $molt1 = 2/(5-$psi);
                $diveff = 1;
            }elseif (($psi > 0)&&($psi < 1)){
                $ksigma = 8.2+(1.05+$psi);
                $molt1 = 2/(5-$psi);
                $diveff = 1;
            }elseif (($psi == 1)){
                $ksigma = 4;
                $molt1 = 0.5;
                $diveff = 1;
            }
            $lambdap = ($hp/$s)/(28.4*$eps*sqrt($ksigma));
            if ($lambdap <= 0.673){
                $ro = 1;
            }else{
                $ro = ($lambdap-0.055*(3+$psi))/pow($lambdap,2);
            }
            $hc = $hp-($hp/$diveff);
            $heff = ($hp * $ro)/$diveff;
            $he1 = $molt1*$heff;
            $he2 = $heff-$he1;
            $nodi_Arr = array(
                array('ID' => '0','coordY' => (-$bp/2 - $rp),'coordZ' => 0,'spess' => 0),
                array('ID' => '1','coordY' => (-$bp/2),'coordZ' => 0,'spess' => $s),
                array('ID' => '2','coordY' => (-$bp/2),'coordZ' => ($hc),'spess' => $s),
                array('ID' => '3','coordY' => (-$bp/2),'coordZ' => ($hc+$he2),'spess' => $s),
                array('ID' => '4','coordY' => (-$bp/2),'coordZ' => ($hp-$he1),'spess' => 0),
                array('ID' => '5','coordY' => (-$bp/2),'coordZ' => $hp,'spess' => $s),
                array('ID' => '6','coordY' => (-$bp/2+$be1),'coordZ' => $hp,'spess' => $s),
                array('ID' => '7','coordY' => ($bp/2-$be2),'coordZ' => $hp,'spess' => 0),
                array('ID' => '8','coordY' => ($bp/2),'coordZ' => $hp,'spess' => $s),
                array('ID' => '9','coordY' => ($bp/2),'coordZ' => ($hp-$he1),'spess' => $s),
                array('ID' => '10','coordY' => ($bp/2),'coordZ' => ($hc+$he2),'spess' => 0),
                array('ID' => '11','coordY' => ($bp/2),'coordZ' => ($hc),'spess' => $s),
                array('ID' => '12','coordY' => ($bp/2),'coordZ' => 0,'spess' => $s),
                array('ID' => '13','coordY' => ($bp/2 + $rp),'coordZ' => 0,'spess' => $s)
            );
            $hmax = max(array_column($nodi_Arr, 'coordZ'));
            $bmax = 2*max(array_column($nodi_Arr, 'coordY'));
            $aree_Arr = array();
            $Sy_Arr = array();
            $Sz_Arr = array();
            $Jy0_Arr = array();
            $Jz0_Arr = array();
            for ($i=1; $i<=12; ++$i){
                $n = $i-1;
                $Area = $nodi_Arr[$i]['spess']*sqrt( pow(($nodi_Arr[$i]['coordZ']-$nodi_Arr[$n]['coordZ']),2) + pow(($nodi_Arr[$i]['coordY']-$nodi_Arr[$n]['coordY']),2) ) ;
                $aree_Arr[$i] = $Area;
                $Sy = ($nodi_Arr[$i]['coordZ']+$nodi_Arr[$n]['coordZ'])*$Area/2;
                $Sy_Arr[$i] = $Sy;
                $Sz = ($nodi_Arr[$i]['coordY']+$nodi_Arr[$n]['coordY'])*$Area/2;
                $Sz_Arr[$i] = $Sz;
                $Jy0 = (pow($nodi_Arr[$i]['coordZ'],2)+pow($nodi_Arr[$n]['coordZ'],2)+($nodi_Arr[$i]['coordZ']*$nodi_Arr[$n]['coordZ']))*$Area/3;
                $Jy0_Arr[$i] = $Jy0;
                $Jz0 = (pow($nodi_Arr[$i]['coordY'],2)+pow($nodi_Arr[$n]['coordY'],2)+($nodi_Arr[$i]['coordY']*$nodi_Arr[$n]['coordY']))*$Area/3;
                $Jz0_Arr[$i] = $Jz0;
            }
            $areaTot = array_sum($aree_Arr);
            $SyTot = array_sum($Sy_Arr);
            $zgc = $SyTot/$areaTot;
            $SzTot = array_sum($Sz_Arr);
            $ygc = $SzTot/$areaTot;
            $Jy0Tot = array_sum($Jy0_Arr);
            $Jz0Tot = array_sum($Jz0_Arr);
            $Jy = $Jy0Tot-$areaTot*pow($zgc,2);
            $Jz = $Jz0Tot-$areaTot*pow($ygc,2);
            $Wysupeff = $Jy/($hmax-$zgc);
            $Wyinfeff = $Jy/(-$zgc);
            $Wzeff = $Jz/($bmax/2);
            $wxeff_sup_Arr[$oi] = $Wysupeff;
            $wxeff_inf_Arr[$oi] = $Wyinfeff;
        }
        return array(
            'jxeff'=>$Jy,
            'jyeff'=>$Jz,
            'wxeff'=>$Wysupeff,
            'wyeff'=>$Wzeff,
            'AreaTot' => $areaTot,
            'xgc' => $ygc,
            'ygc' => $zgc,
        );
    }
    
    public static function getWeffTubi($h, $b, $s, $eps) {
        $rm = 1.5*$s;
        $gr = $rm * (1- sqrt(2)/2);
        $bp = $b - $s - 2*$gr;
        $hp = $h - $s - 2*$gr;
        $psi0 = 1;
        $ksigma0 = 4;
        $lambdap0 = ($bp/$s)/(28.4*$eps*sqrt($ksigma0));
        if ($lambdap0 <= 0.673){
            $ro0 = 1;
        }else{
            $ro0 = ($lambdap0-0.055*(3+$psi0))/pow($lambdap0,2);
        }
        $beff = $bp * $ro0;
        $be1 = 0.5*$beff;
        $be2 = 0.5*$beff;
        $wxeff_sup_Arr = array();
        $wxeff_inf_Arr = array();
        for ( $oi=0; $oi<6; ++$oi){
            if ($oi == 0) {
                $psi = -1;
            }else{
                $nn = $oi-1;
                $psi = $wxeff_sup_Arr[$nn]/$wxeff_inf_Arr[$nn];
            }
            if (($psi >= -3)&&($psi < -1)){
                $ksigma = 5.98*pow((1-$psi),2);
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi == -1)){
                $ksigma = 23.9;
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi > -1)&&($psi < 0)){
                $ksigma = 7.81-(6.29*$psi)+9.78*pow($psi,2);
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi == 0)){
                $ksigma = 7.81;
                $molt1 = 2/(5-$psi);
                $diveff = 1;
            }elseif (($psi > 0)&&($psi < 1)){
                $ksigma = 8.2+(1.05+$psi);
                $molt1 = 2/(5-$psi);
                $diveff = 1;
            }elseif (($psi == 1)){
                $ksigma = 4;
                $molt1 = 0.5;
                $diveff = 1;
            }
            $lambdap = ($hp/$s)/(28.4*$eps*sqrt($ksigma));
            if ($lambdap <= 0.673){
                $ro = 1;
            }else{
                $ro = ($lambdap-0.055*(3+$psi))/pow($lambdap,2);
            }
            $hc = $hp-($hp/$diveff);
            $heff = ($hp * $ro)/$diveff;
            $he1 = $molt1*$heff;
            $he2 = $heff-$he1;
            $nodi_Arr = array(
                array('ID' => '0','coordY' => (-$bp/2),'coordZ' => 0,'spess' => 0),
                array('ID' => '1','coordY' => (-$bp/2),'coordZ' => $hc,'spess' => $s),
                array('ID' => '2','coordY' => (-$bp/2),'coordZ' => ($hc+$he2),'spess' => $s),
                array('ID' => '3','coordY' => (-$bp/2),'coordZ' => ($hp-$he1),'spess' => 0),
                array('ID' => '4','coordY' => (-$bp/2),'coordZ' => $hp,'spess' => $s),
                array('ID' => '5','coordY' => (-$bp/2+$be1),'coordZ' => $hp,'spess' => $s),
                array('ID' => '6','coordY' => ($bp/2-$be2),'coordZ' => $hp,'spess' => 0),
                array('ID' => '7','coordY' => ($bp/2),'coordZ' => $hp,'spess' => $s),
                array('ID' => '8','coordY' => ($bp/2),'coordZ' => ($hp-$he1),'spess' => $s),
                array('ID' => '9','coordY' => ($bp/2),'coordZ' => ($hc+$he2),'spess' => 0),
                array('ID' => '10','coordY' => ($bp/2),'coordZ' => ($hc),'spess' => $s),
                array('ID' => '11','coordY' => ($bp/2),'coordZ' => 0,'spess' => $s),
                array('ID' => '12','coordY' => (-$bp/2),'coordZ' => 0,'spess' => $s)
            );
            $hmax = max(array_column($nodi_Arr, 'coordZ'));
            $bmax = 2*max(array_column($nodi_Arr, 'coordY'));
            $aree_Arr = array();
            $Sy_Arr = array();
            $Sz_Arr = array();
            $Jy0_Arr = array();
            $Jz0_Arr = array();
            for ($i=1; $i<=12; ++$i){
                $n = $i-1;
                $Area = $nodi_Arr[$i]['spess']*sqrt( pow(($nodi_Arr[$i]['coordZ']-$nodi_Arr[$n]['coordZ']),2) + pow(($nodi_Arr[$i]['coordY']-$nodi_Arr[$n]['coordY']),2) ) ;
                $aree_Arr[$i] = $Area;
                $Sy = ($nodi_Arr[$i]['coordZ']+$nodi_Arr[$n]['coordZ'])*$Area/2;
                $Sy_Arr[$i] = $Sy;
                $Sz = ($nodi_Arr[$i]['coordY']+$nodi_Arr[$n]['coordY'])*$Area/2;
                $Sz_Arr[$i] = $Sz;
                $Jy0 = (pow($nodi_Arr[$i]['coordZ'],2)+pow($nodi_Arr[$n]['coordZ'],2)+($nodi_Arr[$i]['coordZ']*$nodi_Arr[$n]['coordZ']))*$Area/3;
                $Jy0_Arr[$i] = $Jy0;
                $Jz0 = (pow($nodi_Arr[$i]['coordY'],2)+pow($nodi_Arr[$n]['coordY'],2)+($nodi_Arr[$i]['coordY']*$nodi_Arr[$n]['coordY']))*$Area/3;
                $Jz0_Arr[$i] = $Jz0;
            }
            $areaTot = array_sum($aree_Arr);
            $SyTot = array_sum($Sy_Arr);
            $zgc = $SyTot/$areaTot;
            $SzTot = array_sum($Sz_Arr);
            $ygc = $SzTot/$areaTot;
            $Jy0Tot = array_sum($Jy0_Arr);
            $Jz0Tot = array_sum($Jz0_Arr);
            $Jy = $Jy0Tot-$areaTot*pow($zgc,2);
            $Jz = $Jz0Tot-$areaTot*pow($ygc,2);
            $Wysupeff = $Jy/($hmax-$zgc);
            $Wyinfeff = $Jy/(-$zgc);
            $Wzeff = $Jz/($bmax/2);
            $wxeff_sup_Arr[$oi] = $Wysupeff;
            $wxeff_inf_Arr[$oi] = $Wyinfeff;
        }
        return array(
            'jxeff'=>$Jy,
            'jyeff'=>$Jz,
            'wxeff'=>$Wysupeff,
            'wyeff'=>$Wzeff,
            'AreaTot' => $areaTot,
            'xgc' => $ygc,
            'ygc' => $zgc,
        );
    }
    
    public static function getWeffIeH($h, $b, $r, $e, $s, $eps) {
        $bp = ($b - $s - 2*$r)/2;
        $hp = $h - 2*$e - 2*$r;
        //ala sup compressa
        $psiF = 1;
        $ksigmaF = 0.43;
        $lambdapF = ($bp/$s)/(28.4*$eps*sqrt($ksigmaF));
        if ($lambdapF <= 0.748){
            $roF = 1;
        }else{
            $roF = ($lambdapF-0.188)/pow($lambdapF,2);
        }
        $beffF = $bp * $roF;
        //sola flessione retta
        $wxeff_sup_Arr = array();
        $wxeff_inf_Arr = array();
        for ( $oi=0; $oi<6; ++$oi){
            if ($oi == 0) {
                $psi = -1;
            }else{
                $nn = $oi-1;
                $psi = $wxeff_sup_Arr[$nn]/$wxeff_inf_Arr[$nn];
            }
            if (($psi >= -3)&&($psi < -1)){
                $ksigma = 5.98*pow((1-$psi),2);
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi == -1)){
                $ksigma = 23.9;
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi > -1)&&($psi < 0)){
                $ksigma = 7.81-(6.29*$psi)+9.78*pow($psi,2);
                $molt1 = 0.4;
                $diveff = (1-$psi);
            }elseif (($psi == 0)){
                $ksigma = 7.81;
                $molt1 = 2/(5-$psi);
                $diveff = 1;
            }elseif (($psi > 0)&&($psi < 1)){
                $ksigma = 8.2+(1.05+$psi);
                $molt1 = 2/(5-$psi);
                $diveff = 1;
            }elseif (($psi == 1)){
                $ksigma = 4;
                $molt1 = 0.5;
                $diveff = 1;
            }
            $lambdap = ($hp/$s)/(28.4*$eps*sqrt($ksigma));
            if ($lambdap <= 0.673){
                $ro = 1;
            }else{
                $ro = ($lambdap-0.055*(3+$psi))/pow($lambdap,2);
            }
            $hc = $hp-($hp/$diveff);
            $heff = ($hp * $ro)/$diveff;
            $he1 = $molt1*$heff;
            $he2 = $heff-$he1;
            $nodi_Arr = array(
                array('ID' => '0','coordY' => (-$bp),'coordZ' => 0,'spess' => 0),
                array('ID' => '1','coordY' => ($bp),'coordZ' => 0,'spess' => $e),
                array('ID' => '2','coordY' => 0,'coordZ' => 0,'spess' => 0),
                array('ID' => '3','coordY' => 0,'coordZ' => ($hc+$he2),'spess' => $s),
                array('ID' => '4','coordY' => 0,'coordZ' => ($hp-$he1),'spess' => 0),
                array('ID' => '5','coordY' => 0,'coordZ' => $hp,'spess' => $s),
                array('ID' => '6','coordY' => ($beffF),'coordZ' => $hp,'spess' => $e),
                array('ID' => '7','coordY' => ($bp),'coordZ' => $hp,'spess' => 0),
                array('ID' => '8','coordY' => 0,'coordZ' => $hp,'spess' => 0),
                array('ID' => '9','coordY' => (-$beffF),'coordZ' => $hp,'spess' => $e),
                array('ID' => '10','coordY' => (-$bp),'coordZ' => $hp,'spess' => 0),
            );
            $hmax = max(array_column($nodi_Arr, 'coordZ'));
            $bmax = 2*max(array_column($nodi_Arr, 'coordY'));
            $aree_Arr = array();
            $Sy_Arr = array();
            $Sz_Arr = array();
            $Jy0_Arr = array();
            $Jz0_Arr = array();
            for ($i=1; $i<=10; ++$i){
                $n = $i-1;
                $Area = $nodi_Arr[$i]['spess']*sqrt( pow(($nodi_Arr[$i]['coordZ']-$nodi_Arr[$n]['coordZ']),2) + pow(($nodi_Arr[$i]['coordY']-$nodi_Arr[$n]['coordY']),2) ) ;
                $aree_Arr[$i] = $Area;
                $Sy = ($nodi_Arr[$i]['coordZ']+$nodi_Arr[$n]['coordZ'])*$Area/2;
                $Sy_Arr[$i] = $Sy;
                $Sz = ($nodi_Arr[$i]['coordY']+$nodi_Arr[$n]['coordY'])*$Area/2;
                $Sz_Arr[$i] = $Sz;
                $Jy0 = (pow($nodi_Arr[$i]['coordZ'],2)+pow($nodi_Arr[$n]['coordZ'],2)+($nodi_Arr[$i]['coordZ']*$nodi_Arr[$n]['coordZ']))*$Area/3;
                $Jy0_Arr[$i] = $Jy0;
                $Jz0 = (pow($nodi_Arr[$i]['coordY'],2)+pow($nodi_Arr[$n]['coordY'],2)+($nodi_Arr[$i]['coordY']*$nodi_Arr[$n]['coordY']))*$Area/3;
                $Jz0_Arr[$i] = $Jz0;
            }
            $areaTot = array_sum($aree_Arr);
            $SyTot = array_sum($Sy_Arr);
            $zgc = $SyTot/$areaTot;
            $SzTot = array_sum($Sz_Arr);
            $ygc = $SzTot/$areaTot;
            $Jy0Tot = array_sum($Jy0_Arr);
            $Jz0Tot = array_sum($Jz0_Arr);
            $Jy = $Jy0Tot-$areaTot*pow($zgc,2);
            $Jz = $Jz0Tot-$areaTot*pow($ygc,2);
            $Wysupeff = $Jy/($hmax-$zgc);
            $Wyinfeff = $Jy/(-$zgc);
            $Wzeff = $Jz/($bmax/2);
            $wxeff_sup_Arr[$oi] = $Wysupeff;
            $wxeff_inf_Arr[$oi] = $Wyinfeff;
        }
        return array(
            'jxeff'=>$Jy,
            'jyeff'=>$Jz,
            'wxeff'=>$Wysupeff,
            'wyeff'=>$Wzeff,
            'AreaTot' => $areaTot,
            'xgc' => $ygc,
            'ygc' => $zgc,
        );
    }
