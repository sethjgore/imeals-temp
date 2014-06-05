<?php 

    $i=0;
    
    //Loop through array and calculate metrics
    foreach($restaurants as $restaurant):
      //Initiate Variables
      $totalOrders = 0;
      $subtotal = 0;
      $tip = 0;
      $tax = 0;
      $del_charges = 0;
      $first_time_discount = 0;
      $commission = 0;
      $cc_fees = 0;
      $gross_sales = 0;
      $amt_deduction_addition = 0;
      $check_total = 0;
      
      if(isset($restaurant['Order'])):
        $orderTypes = array();
        foreach($restaurant['Order'] as $order):
          //Count Order Types
          if(isset($orderTypes[$order['order_type_id']])){
            $orderTypes[$order['order_type_id']]['count'] = floatval($orderTypes[$order['order_type_id']]['count']) + 1;
          } else {
            $orderTypes[$order['order_type_id']]['name'] = $order['OrderType']['name'];
            $orderTypes[$order['order_type_id']]['count'] = 1;
          }
          
          //Get Subtotal
          $subtotal = $subtotal + floatval($order['sub_total']);
          
          //Get Tip
          $tip = $tip + floatval($order['tip']);
          
          //Get Tax
          $tax = $tax + floatval($order['tax']);
          
          //Get Delivery Charges
          $del_charges = $del_charges + floatval($order['delivery_charge']);
          
          //First Time Discount
          $first_time_discount = $first_time_discount + floatval($order['first_time_discount']);
          
          $totalOrders++;
        endforeach; //Orders loop
        
        //Commission
        $commission = floatval($subtotal) * floatval($restaurant['Restaurant']['commission'] / 100);
        
        //Gross Sales
        $gross_sales = number_format($subtotal + $tip + $tax + $del_charges + $first_time_discount,2);
        
        //Credit Card Fees
        $cc_fees = (floatval($restaurant['Restaurant']['cc_flat_fee']) * intval($totalOrders)) + (floatval($restaurant['Restaurant']['cc_percent'] / 100) * floatval($gross_sales));
        
        //Mailing Charge 
        if($restaurant['Restaurant']['mailing_fee'])
          $mailing_charge = 0.50;
        else
          $mailing_charge = 0;
        
        
        //Deductions / Additions
      
        if(isset($restaurant['DeductionAddition'])):
          foreach($restaurant['DeductionAddition'] as $ded_add):
            if($ded_add['type']=='Addition'){
              $amt_deduction_addition = $amt_deduction_addition + floatval($ded_add['amount']);
            } else {
              $amt_deduction_addition = $amt_deduction_addition - floatval($ded_add['amount']);
            }
          endforeach;
        endif;
        
        //Check Total
        // = subtotal + tip + tax + delivery - 1st discount - commission - credit card fees - mailing fees + ded/Add
        $check_total = $subtotal + $tip + $tax + $del_charges - $first_time_discount - $commission - $cc_fees - $mailing_charge +  $amt_deduction_addition;
              
        //Set values per restaurant for pdf
        $restaurants[$i]['Values']['total_orders'] = $totalOrders;
        $restaurants[$i]['Values']['subtotal'] = $subtotal;
        $restaurants[$i]['Values']['tip'] = $tip;
        $restaurants[$i]['Values']['tax'] = $tax;
        $restaurants[$i]['Values']['delivery_charges'] = $del_charges;
        $restaurants[$i]['Values']['first_time_discount'] = $first_time_discount;
        $restaurants[$i]['Values']['commission'] = $commission;
        $restaurants[$i]['Values']['gross_sales'] = $gross_sales;
        $restaurants[$i]['Values']['cc_fees'] = $cc_fees;
        $restaurants[$i]['Values']['mailing_charge'] = $mailing_charge;
        $restaurants[$i]['Values']['check_total'] = $check_total;
        
        $restaurants[$i]['OrderTypes'] = $orderTypes;
        
        //Final Total
        // = subtotal + tip + tax + delivery - 1st discount - commission - credit card fees - mailing fees + ded/Add
        
        $i++;
      endif;
    endforeach;
    
    //debug($restaurants);  
      
    foreach($restaurants as $restaurant):
      $fpdf->SetTopMargin('0.35');
      $fpdf->AddPage();
      $fpdf->SetFont('Times','',11);
      
      //Cell(width,height,text,border,ln,align,fill,link)
      
      //Print Date
      $fpdf->Cell(180,18,date("m/d/Y"),0,1,'R',false);
      $fpdf->Cell(10);
      
      //Print Restaurant Name
      $fpdf->Cell(82,10,$restaurant['Restaurant']['name'],0,0,'L',false);
      
      list($whole, $decimal) = explode('.', number_format($restaurant['Values']['check_total'],2));
      
      if(intval($whole) > 0 && intval($decimal) > 0){
        //Print Check Amount (Number)
        $fpdf->Cell(103,10,'**'.number_format($restaurant['Values']['check_total'],2),0,1,'R',false);
        
        //Print Check Amount (Text)
        $fpdf->Cell(120,15,numberToWord($whole).' and '.$decimal.'/100 *******************************',0,1,'L',false);        
      } else {
        //Print Check Amount (Number)
        $fpdf->Cell(103,10,'**0.00',0,1,'R',false);
        
        //Print Check Amount (Text)
        $fpdf->Cell(120,15, 'Zero Dollars and 00/100****************************',0,1,'L',false);
      }
      $x = $fpdf->GetX();
      $y = $fpdf->GetY();
      $fpdf->SetXY($x,$y+5);
      
      //Print Restaurant Address
      $fpdf->Cell(10);
      $fpdf->Cell(70,4,$restaurant['Restaurant']['name'],0,1,'L',false);
      $fpdf->Cell(10);
      $fpdf->Cell(70,4,$restaurant['Restaurant']['address'],0,1,'L',false);
      $fpdf->Cell(10);
      $fpdf->Cell(70,4,$restaurant['City']['name'] . ', ' . $restaurant['City']['State']['abbreviation'] . ' ' .$restaurant['Restaurant']['zip'] ,0,0,'L',false);
      
      //Print Restaurant Details twice
      for($j=0; $j<2; $j++){
        $fpdf->SetFont('Times','',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        if($j==0){$fpdf->SetXY($x,49);}
        else{$fpdf->SetXY($x,155);}
        //Print Restaurant Statement Details
        $fpdf->Cell(1,40,"",0,1,"L",false);
        $fpdf->Cell(1,10,date("m/d/Y") . " " . $restaurant['Restaurant']['name'] ."  Period: ".$start_date. ' - ' .$end_date,0,1,"L",false);
      
        //Print Order Type and Deductions & Additons Title
        $fpdf->SetFont('Times','BU',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(70,5,"Order Type:",0,"L");
        $fpdf->SetXY($x +75,$y+2);
        $fpdf->MultiCell(100,5,"Deductions/Additions:",0,"L");
        
        $fpdf->SetFont('');
        $start_x = $fpdf->GetX();
        $start_y = $fpdf->GetY();
        
        //Print Order Types and Order Type Counts
        if(isset($restaurant['OrderTypes'])):
          foreach($restaurant['OrderTypes'] as $orderType):
            $x = $fpdf->GetX();
            $y = $fpdf->GetY();
            $fpdf->MultiCell(50,4,$orderType['name'],0,"L");
            $fpdf->SetXY($x +50,$y);
            $fpdf->MultiCell(20,4,$orderType['count'],0,"L");
          endforeach;
        endif;
  
        //Print Total Orders
        $fpdf->SetFont('Times','B',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,5,"Total Orders:",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,5,$restaurant['Values']['total_orders'],0,"L");
        
        //Print Cost Totals
        
        //SubTotal
        $fpdf->SetFont('Times','',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->SetXY($x,$y+4);
        $fpdf->MultiCell(50,4,"SubTotal:",0,"L");
        $fpdf->SetXY($x +50,$y+4);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['subtotal'],2),0,"L");
        
        //Tip
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,4,"Tip:",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['tip'],2),0,"L");
        
        //Delivery
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,4,"Delivery:",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['delivery_charges'],2),0,"L");
        
        //Tax
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,4,"Tax(".$restaurant['Restaurant']['sales_tax']."%):",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['tax'],2),0,"L");
        
        //Tax
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,4,"1st Time Discount(??):",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['first_time_discount'],2),0,"L");
        
        //Gross Sales
        $fpdf->SetFont('Times','B',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,5,"Gross Sales:",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,5,'$'.number_format($restaurant['Values']['gross_sales'],2),0,"L");
        
        //Print Debits
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->SetXY($x,$y+4);
        $fpdf->MultiCell(50,5,"Debits:",0,"L");
        
        //Commission
        $fpdf->SetFont('Times','',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,4,"Commission(".$restaurant['Restaurant']['commission']."%):",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['commission'],2),0,"L");
        
        //Credit Card Fees
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->SetFont('Times','',9);
        $fpdf->MultiCell(50,4,"Credit Card Fees($".$restaurant['Restaurant']['cc_flat_fee']." + ".$restaurant['Restaurant']['cc_percent']."%):",0,"L");
        $fpdf->SetFont('Times','',10);
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,'$'.number_format($restaurant['Values']['cc_fees'],2),0,"L");
        
        //Mailing Charge
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        $fpdf->MultiCell(50,4,"Mailing Charge",0,"L");
        $fpdf->SetXY($x +50,$y);
        $fpdf->MultiCell(20,4,"$".number_format($restaurant['Values']['mailing_charge'],2),0,"L");
        
        //Print Deductions and Additions 
        $fpdf->SetFont('Times','',10);
        $fpdf->SetXY($start_x,$start_y);
        $amt_deduction_addition = 0;
        
        if(isset($restaurant['DeductionAddition'])):
          foreach($restaurant['DeductionAddition'] as $ded_add):
            $x = $fpdf->GetX();
            $y = $fpdf->GetY();
            //Print Amount First
            $fpdf->SetXY($x +75 + 80,$y+1);
            if($ded_add['type']=='Addition'){
              $amt='+$'.$ded_add['amount'];
              $amt_deduction_addition = $amt_deduction_addition + floatval($ded_add['amount']);
            } else {
              $amt='-$'.$ded_add['amount'];
              $amt_deduction_addition = $amt_deduction_addition - floatval($ded_add['amount']);
            }
            $fpdf->MultiCell(20,5,$amt,0,"L");
            //Print Reason and get y value because reason text can be long
            $fpdf->SetXY($x +75,$y+1);
            $fpdf->MultiCell(80,5,date("m.d.Y",strtotime($ded_add['date'])) . ' - '.$ded_add['reason'],0,"L");
          
          endforeach;
        endif;
       
        //Print Total for this check
        $fpdf->SetFont('Times','B',10);
        $x = $fpdf->GetX();
        $y = $fpdf->GetY();
        //Print Amount First
        $fpdf->SetXY($x +75 ,$y+3);
        $fpdf->MultiCell(50,4,"Total for this check:",0,"L");
        $fpdf->SetXY($x +75 +40,$y+3);
        $mailing_charge = .5;
        $fpdf->MultiCell(20,4,"$".number_format($restaurant['Values']['check_total'],2),0,"L");
                
      
    } //end for loop to print details twice
      
    endforeach;
    
    $fpdf->Output();
    
    
    //Number To Word Functions
    function singledigit($number){
    switch($number){
        case 0:$word = "Zero";break;
        case 1:$word = "One";break;
        case 2:$word = "Two";break;
        case 3:$word = "Three";break;
        case 4:$word = "Four";break;
        case 5:$word = "Five";break;
        case 6:$word = "Six";break;
        case 7:$word = "Seven";break;
        case 8:$word = "Eight";break;
        case 9:$word = "Nine";break;
    }
    return $word;
    }
    
    function doubledigitnumber($number){
        if($number == 0){
            $word = "";
        }
        else{
            $word = "-".singledigit($number);
        }       
        return $word;
    }
    
    function doubledigit($number){
        switch($number[0]){
            case 0:$word = doubledigitnumber($number[1]);break;
            case 1:
                switch($number[1]){
                    case 0:$word = "Ten";break;
                    case 1:$word = "Eleven";break;
                    case 2:$word = "Twelve";break;
                    case 3:$word = "Thirteen";break;
                    case 4:$word = "Fourteen";break;
                    case 5:$word = "Fifteen";break;
                    case 6:$word = "Sixteen";break;
                    case 7:$word = "Seventeen";break;
                    case 8:$word = "Eighteen";break;
                    case 9:$word = "Ninteen";break;
                }break;
            case 2:$word = "Twenty".doubledigitnumber($number[1]);break;                
            case 3:$word = "Thirty".doubledigitnumber($number[1]);break;
            case 4:$word = "Forty".doubledigitnumber($number[1]);break;
            case 5:$word = "Fifty".doubledigitnumber($number[1]);break;
            case 6:$word = "Sixty".doubledigitnumber($number[1]);break;
            case 7:$word = "Seventy".doubledigitnumber($number[1]);break;
            case 8:$word = "Eighty".doubledigitnumber($number[1]);break;
            case 9:$word = "Ninety".doubledigitnumber($number[1]);break;
    
        }
        return $word;
    }
    
    function unitdigit($numberlen,$number){
        switch($numberlen){         
            case 3:case 6:case 9:case 12:$word = "Hundred";break;
            case 4:case 5:$word = "Thousand";break;
            case 7:case 8:$word = "Million";break;
            case 10:case 11:$word = "Billion";break;
        }
        return $word;
    }
    
    function numberToWord($number){
    
        $numberlength = strlen($number);
        if ($numberlength == 1) { 
            return singledigit($number);
        }elseif ($numberlength == 2) {
            return doubledigit($number);
        }
        else {
    
            $word = "";
            $wordin = "";
            switch ($numberlength ) {
            case 5:case 8:  case 11:
                if($number[0] >0){
                    $unitdigit = unitdigit($numberlength,$number[0]);
                    $word = doubledigit($number[0].$number[1]) ." ".$unitdigit." ";
                    return $word." ".numberToWord(substr($number,2));
                }
                else{
                    return $word." ".numberToWord(substr($number,1));
                }
            break;
            default:
                if($number[0] >0){
                    $unitdigit = unitdigit($numberlength,$number[0]);
                    $word = singledigit($number[0]) ." ".$unitdigit." ";
                }               
                return $word." ".numberToWord(substr($number,1));
            }
        }
    }
?>