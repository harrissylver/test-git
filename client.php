<?php
	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8"); 
      
		include "library/config.php";
		$postjson = json_decode(file_get_contents('php://input'), true);
		if ($postjson['aksi'] == 'add_cli'){
			$data = array();
			$query = mysqli_query($mysqli,"INSERT INTO client SET NumCli='$postjson[NumCli]',Nom='$postjson[Nom]'");
				//$numadd=mysqli_insert_num($mysqli);

				if($query) $result=json_encode(array('success'=>true));
				else $result=json_encode(array('success'=>false));
				echo $result;

        }

		elseif ($postjson['aksi'] == 'get_cli'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM client ORDER BY NumCli DESC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCli'=> $row['NumCli'],
						'Nom'=> $row['Nom'],
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}


		elseif ($postjson['aksi'] == 'update_cli'){
			$query = mysqli_query($mysqli,"UPDATE client SET 
				Nom='$postjson[Nom]' WHERE NumCli='$postjson[NumCli]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}

		elseif ($postjson['aksi'] == 'delete_cli'){
			$query = mysqli_query($mysqli,"DELETE FROM client WHERE NumCli='$postjson[NumCli]'");

				if ($query) $result = json_encode(array('success'=>true));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}

		elseif ($postjson['aksi'] == 'get_datasingle'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM client WHERE NumCli='$postjson[NumCli]'");

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


		elseif ($postjson['aksi'] == 'get_search'){
			$data = array();
			$query = mysqli_query($mysqli,"SELECT * FROM client WHERE NumCli='$postjson[Search]' ORDER BY NumCli DESC");

				while ($row= mysqli_fetch_array($query)){
					$data[]=array(
						'NumCli'=> $row['NumCli'],
						'Nom'=> $row['Nom'],
					);
				}

				if ($query) $result = json_encode(array('success'=>true,'result'=>$data));
				else $result = json_encode(array('success'=>false));
				echo $result; 
		}