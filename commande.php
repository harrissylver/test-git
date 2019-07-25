<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8"); 
      include "library/config.php";
		$postjson = json_decode(file_get_contents('php://input'), true);
		if ($postjson['aksi'] == 'add_command'){
			$data = array();
			$query = mysqli_query($mysqli,"INSERT INTO commande SET NumCommand='$postjson[NumCommand]',
				NumCli='$postjson[NumCli]',NumProd='$postjson[NumProd]',Qte='$postjson[Qte]'");

				

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}





		elseif ($postjson['aksi'] == 'get_command'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM commande ORDER BY NumCommand DESC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCommand'=> $row['NumCommand'],
						'NumCli'=> $row['NumCli'],
						'NumProd'=> $row['NumProd'],
						'Qte'=> $row['Qte'],
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}


		elseif ($postjson['aksi'] == 'update_command'){
			$query = mysqli_query($mysqli,"UPDATE commande SET 
				NumCli='$postjson[NumCli]',NumProd='$postjson[NumProd]',Qte='$postjson[Qte]' WHERE NumCommand='$postjson[NumCommand]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}

		elseif ($postjson['aksi'] == 'delete_command'){
			$query = mysqli_query($mysqli,"DELETE FROM commande WHERE NumCommand='$postjson[NumCommand]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}

		
		elseif ($postjson['aksi'] == 'get_cli'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM client ORDER BY NumCli DESC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCli'=> $row['NumCli'],
						'Nom'=> $row['Nom']
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}

		elseif ($postjson['aksi'] == 'get_prod'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM produit ORDER BY NumProd DESC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumProd'=> $row['NumProd'],
						'Design'=> $row['Design']
						
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}


