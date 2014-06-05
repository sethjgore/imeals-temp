<?php
	$fpdf->AddPage('P', 'Letter', 'in');
	$fpdf->SetTopMargin('0.35');
	$fpdf->SetLeftMargin('0.25');
	$fpdf->SetRightMargin('0.25');
	$fpdf->SetFont('Times','',11);
	
	//Cell(width,height,text,border,ln,align,fill,link)
	//MultiCell(width, height, text ,border ,align, fill)
	
    //Print Logo
   	$fpdf->Image('http://imealsdev.com/img/logo.png',10,10,-300);
   	//Print Line
   	$fpdf->Line(10, 15, 205, 15);
	//Get cursor position and reset position
   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();
	$fpdf->SetXY($x,$y+5);
   	//Print Restaurant Name and Order Number
   	$fpdf->Cell(100,10,$restaurantname,0,0,'L',false);
   	$fpdf->Cell(10,10,'Order #: '.$ordernumber,0,1,'L',false); 	
   	
   	//Print resturant number and order at date
   	$fpdf->Cell(10);
   	$fpdf->Cell(100,10,$restaurantphone,0,0,'L',false);
   	$fpdf->Cell(50,10,'Ordered: '.date('l, F jS, Y g:i A', strtotime($orderdate)),0,1,'L',false);   	

	//Print Estimated Pickup or Delivery Time
	$fpdf->Cell(10);
	$fpdf->SetFillColor(248, 248, 130);
	$fpdf->Cell(97.5,10,'Estimated Delivery Time:',0,0,'R',true);	
	$fpdf->SetTextColor(255, 4, 4);
	$fpdf->Cell(97.5,10,$deliverytime,0,1,'L',true);

   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();
	$fpdf->SetXY($x,$y+5);
	
   	//Print Line
   	$fpdf->Line(10, $y, 205, $y);
   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();
	$fpdf->SetXY($x+10,$y+1);
	
   	//Print To
   	$fpdf->SetFillColor(255, 255, 255);
   	$fpdf->SetTextColor(0, 0, 0);
	$fpdf->SetFont('Times','b',11);
   	$fpdf->Cell(97.5,2,'Deliver To:',0,0,'L',true);

   	//Print Instructions   	
   	$fpdf->Cell(97.5,2,'Deliver Instructions:',0,1,'L',true);
   	
   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();
	$topy = $fpdf->GetY();
	$fpdf->SetFont('Times','',11);
   	//Print To Details
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
	$fpdf->SetXY($x+10,$y+5);   	
   	$fpdf->Cell(97.5,2,$delivertoname,0,1,'L');
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
	$fpdf->SetXY($x+10,$y+5);
   	$fpdf->Cell(97.5,2,$delivertoaddress,0,1,'L');
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
	$fpdf->SetXY($x+10,$y+5);
   	$fpdf->Cell(97.5,2,'',0,1,'L');
   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();   	
	$fpdf->SetXY($x+10,$y+5);
   	$fpdf->Cell(97.5,2,'City, State:'.$delivertocitystate,0,1,'L');
   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();   	
	$fpdf->SetXY($x+10,$y+5);
   	$fpdf->Cell(97.5,2,'Apt/Flat/Suite #:'.$delivertoapt,0,1,'L');
   	$x = $fpdf->GetX();
	$y = $fpdf->GetY();   	
	$fpdf->SetXY($x+10,$y+5);
   	$fpdf->Cell(97.5,2,$delivertophone,0,1,'L');
   	   	   	   	   	
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
	$fpdf->SetXY($x+107.5,$topy);
   	
   	//Print Instruction Details
   	$deliverpickupinstructions = $deliverinstructions;
   	$fpdf->MultiCell(97.5,10,$deliverpickupinstructions,0,'L');
   	
   	
   	//Print Line
   	$fpdf->Line(10, $y+3, 205, $y+3);
   	$x = $fpdf->GetX();
	$fpdf->SetXY($x,$y+5);
   	
   	//Print Order Details
   	if(isset($orderdetails['TempItem'])) {
	   	foreach($orderdetails['TempItem'] as $orderitem):
	   	   	if(isset($newitemy))
	   			$memy = $newitemy;
	   		else
	   			$memy = $fpdf->GetY();
	   		
	   		$x = $fpdf->GetX();
	   		$fpdf->SetXY($x+10,$memy);
	   		   	
	   		//Quanity
	   		$fpdf->SetTextColor(255, 4, 4);
	   		$fpdf->Cell(5,2,$orderitem['quantity'],0,0,'L');
	   		
	   		//Item and Details
	   		$fpdf->SetTextColor(0, 0, 0);
	   		$x = $fpdf->GetX();
			$fpdf->SetXY($x+5,$memy);   		
	   		$fpdf->Cell(110,5,$orderitem['Item']['name'],0,1,'L');
	   		$fpdf->SetXY($x+15,$memy+5);
	   		foreach($orderitem['TempVariation'] as $orderitemvariation):
					$fpdf->Cell(110,5,$orderitemvariation['Variation']['name'],0,1,'L');
	   				$fpdf->SetXY($x+15,$memy+10);
			endforeach;
	   		$newitemy = $fpdf->GetY();
	   		
	   		//Item Costs
	   		$x = $fpdf->GetX();
	   		$fpdf->SetXY($x+130,$memy);
	   		$fpdf->Cell(25,2,$orderitem['Item']['price'].' x '.$orderitem['quantity'],0,0,'L');
	   		
	   		//Item Total Cost
	   		$fpdf->SetXY($x+160,$memy);
	   		$fpdf->Cell(15,2,money_format('%i', $orderitem['quantity']*$orderitem['Item']['price']),0,1,'L'); 
		endforeach;
	}
	
   		$i=0;
   		while ($i <= 3) {
   		if(isset($newitemy))
   			$memy = $newitemy;
   		else
   			$memy = $fpdf->GetY();
   			
   		$x = $fpdf->GetX();
   		$fpdf->SetXY($x+10,$memy);
   		
   		//Quanity
   		$fpdf->SetTextColor(255, 4, 4);
   		$fpdf->Cell(5,2,'1',0,0,'L');
   		
   		//Item and Details
   		$fpdf->SetTextColor(0, 0, 0);
   		$x = $fpdf->GetX();
		$fpdf->SetXY($x+5,$memy);   		
   		$fpdf->Cell(110,5,"Angelina's Pannini",0,1,'L');
   		$fpdf->SetXY($x+15,$memy+5);
   		$fpdf->Cell(110,5,"Toasted",0,1,'L');
   		$fpdf->SetXY($x+15,$memy+10);
   		$fpdf->Cell(110,5,"White Bread",0,1,'L');
   		$fpdf->SetXY($x+15,$memy+15);
   		$fpdf->Cell(110,5,"No Tomatoes",0,1,'L');   		   		
   		$newitemy = $fpdf->GetY();
   		
   		//Item Costs
   		$x = $fpdf->GetX();
   		$fpdf->SetXY($x+130,$memy);
   		$fpdf->Cell(25,2,'$25.00 x 1',0,0,'L');
   		
   		//Item Total Cost
   		$fpdf->SetXY($x+160,$memy);
   		$fpdf->Cell(15,2,'$25.00',0,1,'L'); 
   		
   		$i++;  		
   	}
   	
   	
   	//Cost Breakdown
   	$x = $fpdf->GetX();
   	$y = $newitemy + 5;
	$fpdf->SetXY($x+10,$y);
   	$fpdf->Line(10, $y, 205, $y);
   	
   	//Product Total
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+155,$y+5);
   	$fpdf->Cell(15,2,'Product Total = $'.$producttotal,0,1,'R');
   	
   	//Sales Tax
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+165,$y+5);
   	$fpdf->Cell(15,2,'Sales Tax = $'.$salestax,0,1,'R');
   	
   	//Tip Amount   	
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+165,$y+5);
   	$fpdf->Cell(15,2,'Tip Amount = $'.$tipamount,0,1,'R');
   	
   	
	$fpdf->SetTextColor(255, 4, 4);
   	//Grand Total
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+165,$y+5);   	
   	$fpdf->Cell(15,2,'Grand Total = $'.$ordertotal,0,1,'R');
   	   	   	
   	//Print Line
   	$fpdf->Line(10, $y+10, 205, $y+10);
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
	$fpdf->SetXY($x+10,$y+5);
	
   	//Order Place By Heading
   	$fpdf->SetTextColor(0, 0, 0);
   	$fpdf->SetFont('Times','b',11);
   	$fpdf->Cell(150,2,'Order Place By:',0,0,'L');
   	
   	//Amount Heading
   	$fpdf->Cell(150,2,'Amount:',0,1,'L');
   	
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+10,$y+3);  
   	
   	//Order Place By
   	$fpdf->SetTextColor(0, 0, 0);
   	$fpdf->SetFont('Times','',11);
   	$fpdf->Cell(150,2,$orderplacedby,0,0,'L');
   	
   	//Amount
   	$fpdf->Cell(150,2,'$'.$ordertotal,0,1,'L');   	
   	
   	//Print Line 	
   	$fpdf->Line(10, $y+8, 205, $y+8);  
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+10,$y+5);    	
   	
   	//Payment Information
   	$fpdf->SetTextColor(0, 0, 0);
   	$fpdf->SetFont('Times','b',11);
   	$fpdf->Cell(100,2,'Payment Information',0,0,'L');
   	
   	//Amount
   	$fpdf->Cell(50,2,'Amount:',0,0,'L');

   	//Order Type
   	$fpdf->Cell(30,2,'Order Type:',0,1,'L');   	
   	
   	$x = $fpdf->GetX();
   	$y = $fpdf->GetY();
   	$fpdf->SetXY($x+10,$y+5);  
   	
   	//Payment Information
   	$fpdf->SetTextColor(0, 0, 0);
   	$fpdf->SetFont('Times','',11);
   	$fpdf->Cell(100,2,$paymentinfo,0,0,'L');
   	
   	//Amount
   	$fpdf->Cell(50,2,'$'.$ordertotal,0,0,'L');

   	//Order Type
   	$fpdf->Cell(30,2,strtoupper($ordertype),0,0,'L');    	
   	
	   	 
   	//Print Instructions
    $fpdf->Output('/order.pdf', 'F');
?>
