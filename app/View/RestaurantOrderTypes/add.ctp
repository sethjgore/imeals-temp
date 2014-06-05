
<div class="restaurantOrderTypes">

<?php echo $this->Form->create('RestaurantOrderType'); ?>
	<fieldset>
		<legend><?php echo __('Add Restaurant Order Type'); ?></legend>
	<?php
		if(isset($restaurant_id)){
		  echo $this->Form->hidden('restaurant_id',array('value'=>$restaurant_id));
		  echo '<div class="input"><label>Restaurant: '. $restaurants[$restaurant_id] .'</label></div>';
		} else{
		  echo $this->Form->input('restaurant_id');
		}
		if(isset($order_type_id)){
		  if(isset($order_type_name)) echo '<div class="input"><label>Order Type: ' . $order_type_name.'</label></div>';
		  echo $this->Form->hidden('order_type_id',array('value'=>$order_type_id));
		} else
		  echo $this->Form->input('order_type_id');
		  ?>
		  
	<div id="restlatlng">
	<?php
		echo $this->Form->input('long');
		echo $this->Form->input('lat');
	?>
	</div>
	<div class="error">
		<?php 
			if($address['lng'] == 'error') 
				echo 'There is an issue with the address configured for this restaurant.  Click
				<a href="../../../../restaurants/edit/'.$restaurant_id.'"> here </a> to fix the issue."';
		
		?>
	</div>
	<legend>Enter a radius or define an area using the map below:</legend>
	<?php
		echo $this->Form->input('radius');?>
		<div id="map" style="width: 800px; height: 500px;"></div><br>
	
	<div id="rest_deliveryarea">
	<?php
		echo $this->Form->input('delivery_area');
	?>
	</div>
	<?php
		if($order_type_id != 1) {
			echo $this->Form->input('delivery_min');
			echo $this->Form->input('delivery_charge');
			
			echo $this->Form->input('delivery_estimate_min',array('label'=>'Delivery Estimate Minimum'));
			echo $this->Form->input('delivery_estimate_max',array('label'=>'Delivery Estimate Maximum'));			
		} else {
			echo $this->Form->input('delivery_estimate_min',array('label'=>'Pickup Estimate Minimum'));
			echo $this->Form->input('delivery_estimate_max',array('label'=>'Pickup Estimate Maximum'));
		}
		echo '<span style="display: none;">';
			echo $this->Form->input('upsell',array('checked'=>true, 'label'=>'Allow Upsell for this Order Type?'));
		echo '</span>';
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<!-- script to get polygon points from delivery area -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php echo $this->Html->script('polygon.js'); ?>
<?php echo $this->Html->script('map.js'); ?>

<script type="text/javascript">
  var poly, map, addresslat, addresslng, polypoints;
  var markers = [];
  var path = new google.maps.MVCArray;
  //Load Delivery Area
  initialize();

  function initialize() {
    var uluru = new google.maps.LatLng(<?php echo $address['lat']; ?>, <?php echo $address['lng']; ?>);

    map = new google.maps.Map(document.getElementById("map"), {
      zoom: 13,
      center: uluru,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    

    poly = new google.maps.Polygon({
      strokeWeight: 3,
      fillColor: '#5555FF'
    });
    
    var presetpoints = document.getElementById('RestaurantOrderTypeDeliveryArea').value;
    debugger;
    if(presetpoints == '') {
    	var rdmpoints = generateRandomPoints(map);
    	document.getElementById('RestaurantOrderTypeDeliveryArea').value = rdmpoints;
    }
    //Sets Delivery Area Polygon
    setPoly();
    
	poly.setMap(map);
    poly.setPaths(new google.maps.MVCArray([path]));
    google.maps.event.addListener(map, 'click', addPoint);
    
    var restaurantMarker = new google.maps.Marker({
       position: uluru,
       map: map
   	});  
   	
      
  }
  
  function generateRandomPoints(map) {
 	var rdmpoints = '';
 	
  	for (var n = 1; n <= 9; n++) {
      var html = 'Opening marker #' + n;

      // Place markers on map randomly.
      var randX = Math.random();
      var randY = Math.random();
      /*randX *= (randX * 1000000) % 2 == 0 ? 1 : -1;
      randY *= (randY * 1000000) % 2 == 0 ? 1 : -1;
       
      var rdmlat = map.center.lat() + (randX * 0.1);
      var rdmlng = map.center.lng() + (randY * 0.1);*/
      
      	//var move = ".0"+<?php //echo $this->request->data['RestaurantOrderType']['radius']; ?>;
      	var move = ".03"
      	if(n == 2) {
    		var rdmlat = map.center.lat() + parseFloat(move);
    		var rdmlng = map.center.lng();
    	} else if(n==3) {
    	    var rdmlat = map.center.lat() + parseFloat(move);
    		var rdmlng = map.center.lng() + parseFloat(move);
    	} else if(n==4) {
    	    var rdmlat = map.center.lat();
    		var rdmlng = map.center.lng() + parseFloat(move);  		
    	} else if(n==5) {
	   	    var rdmlat = map.center.lat() - parseFloat(move);
    		var rdmlng = map.center.lng() + parseFloat(move); 
	   	} else if(n==6) {

    		var rdmlat = map.center.lat() - parseFloat(move);
    		var rdmlng = map.center.lng();
    	} else if(n==7) {
    		var rdmlat = map.center.lat() - parseFloat(move);
    		var rdmlng = map.center.lng() - parseFloat(move); 
    	} else if(n==8) {
    		var rdmlat = map.center.lat();
    		var rdmlng = map.center.lng() - parseFloat(move);  
    	} else if(n==9) {
    	  	var rdmlat = map.center.lat() + parseFloat(move);
    		var rdmlng = map.center.lng() - parseFloat(move);
    	} 
      
      rdmpoints = rdmlat+' '+rdmlng+','+rdmpoints;	
    }
    
    return rdmpoints;
  }

	jQuery('#RestaurantOrderTypeLong').val('<?php echo $address['lng']; ?>');
	jQuery('#RestaurantOrderTypeLat').val('<?php echo $address['lat']; ?>');
	jQuery('#restlatlng').hide();
	jQuery('#rest_deliveryarea').hide();
	
</script>