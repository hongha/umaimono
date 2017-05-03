<!-- <?php 
					$diem1 = "Vancouver+BC|Seattle";
					$diem2 = "San+Francisco|Victoria+BC";
					$map = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$diem1."&destinations=".$diem2."&key=AIzaSyDCqKwnMxFY9JjhGLb7CPNo0yA4lgriSiY";
					$result = file_get_contents($map);
					$data = json_decode($result, true);
					echo $data['rows'][0]['elements'][0]['duration']['text'];
					echo $data['rows'][0]['elements'][0]['distance']['text'];
				?>
            --> 