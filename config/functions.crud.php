<?php    
    function insert($table,$data=null) {
        global $conn;  // Ensure $conn is accessible within the function
        $command = 'INSERT INTO '.$table;
        $field = $value = null;
        foreach($data as $f => $v) {
            $field	.= ','.$f;
            $value	.= ", '".$v."'";
        }
        $command .=' ('.substr($field,1).')';
        $command .=' VALUES('.substr($value,1).')';
        $exec = mysqli_query($conn, $command);
        ($exec) ? $status = 'OK' : $status = 'NO';
        return $status;
    }
    
    function update($table,$data=null,$where=null) {
        global $conn;  // Ensure $conn is accessible within the function
        $command = 'UPDATE '.$table.' SET ';
        $field = $value = null;
        foreach($data as $f => $v) {
            $field	.= ",".$f."='".$v."'";
        }
        $command .= substr($field,1);
		if($where!=null) {
			foreach($where as $f => $v) {
				$value .= "#".$f."='".$v."'";
			}
			$command .= ' WHERE '.substr($value,1);
			$command = str_replace('#',' AND ',$command);
		}
        $exec = mysqli_query($conn, $command);
        ($exec) ? $status = 'OK' : $status = 'NO';
        return $status;
    }
    
    function delete($table,$where=null) {
        global $conn;  // Ensure $conn is accessible within the function
        $command = 'DELETE FROM '.$table;
		if($where!=null) {
			$value = null;
			foreach($where as $f => $v) {
				$value .= "#".$f."='".$v."'";
			}
			$command .= ' WHERE '.substr($value,1);
			$command = str_replace('#',' AND ',$command);
		}
        $exec = mysqli_query($conn, $command);
        ($exec) ? $status = 'OK' : $status = 'NO';
        return $status;
    }
    
    function fetch($table, $where = null) {
        global $conn;  // Ensure $conn is accessible within the function
        $command = 'SELECT * FROM '.$table;
        if ($where != null) {
            $value = null;
            foreach ($where as $f => $v) {
                $value .= "#".$f."='".$v."'";
            }
            $command .= ' WHERE '.substr($value, 1);
            $command = str_replace('#', ' AND ', $command);
        }
        // Pass the connection as the first argument
        $exec = mysqli_fetch_assoc(mysqli_query($conn, $command));
        return $exec;
    }
    
    
    function select($table,$where=null,$order=null,$limit=null) {
        global $conn;  // Ensure $conn is accessible within the function
        $command = 'SELECT * FROM '.$table;
        if($where!=null) {
            $value = null;
            foreach($where as $f => $v) {
                $value .= "#".$f."='".$v."'";
            }
            $command .= ' WHERE '.substr($value,1);
            $command = str_replace('#',' AND ',$command);
        }
        ($order!=null) ? $command .= ' ORDER BY '.$order :null;
        ($limit!=null) ? $command .= ' LIMIT '.$limit :null;
        $result = array();
        $sql = mysqli_query($conn, $command);
        while($field = mysqli_fetch_assoc($sql)) {
            $result[] = $field;
        }
        return $result;
    }
    
    function rowcount($table, $where = null) {
        global $conn;  // Ensure $conn is accessible within the function
        $command = 'SELECT * FROM '.$table;
        if ($where != null) {
            $value = null;
            foreach ($where as $f => $v) {
                $value .= "#".$f."='".$v."'";
            }
            $command .= ' WHERE '.substr($value, 1);
            $command = str_replace('#', ' AND ', $command);
        }
        // Pass the connection as the first argument
        $result = mysqli_query($conn, $command);
        // Check for a valid result before counting rows
        if ($result) {
            $exec = mysqli_num_rows($result);
        } else {
            // Handle the error if the query fails
            $exec = 0; // or handle error accordingly
        }
        return $exec;
    }
    
    
    function truncate($table) {
        $command = 'TRUNCATE '.$table;
        $exec = mysqli_query($command);
        ($exec) ? $status = 'OK' : $status = 'NO';
        return $status;
    }
    
    // $data = array(
            // 'nis' => '10110072',
            // 'nama' => 'Yunus',
            // 'kelas' => 'XII TKJ 2'
        // );
    // $where  = array(
            // 'nis' => '10110072'
        // );
    // echo insert('siswa',$data);
    // echo update('siswa',$data,$where);
    // echo delete('siswa',$where);
    // $siswa = fetch('siswa',$where);
    // echo $siswa['nama'];
    // echo rowcount('siswa',$where);
    // echo truncate('siswa');
    // $sql = select('siswa',$where);
    // foreach($sql as $field) {
        // echo $field['id_siswa'].' - '.$field['nis'].' - '.$field['nama'].' - '.$field['kelas'].'<br/>';
    // }
	// echo "<pre>";
	// print_r($sql);
?>