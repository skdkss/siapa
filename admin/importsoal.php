<?php
	require("../config/config.default.php");
	require("../config/config.function.php");
	require("../config/class.excelReader.php");
    $no = -1;
    $doc = '';
    $huruf = array('A','B','C','D','E','a','b','c','d','e');
    echo "
        <br/>
        <form action='' method='post' enctype='multipart/form-data'>
            <label>Mata Pelajaran</label><br/>
            <select name='id_mapel' required='true'>
                <option value=''></option>";
                $mapelQ = mysql_query("SELECT * FROM mapel ORDER BY nama ASC");
                while($mapel = mysql_fetch_array($mapelQ)) {
                    echo "<option value='$mapel[id_mapel]'>$mapel[nama]</option>";
                }
                echo "
            </select><br/>
            <label>Paket Soal</label><br/>
            <select name='paket' required='true'>
                <option value='A'>A</option>
                <option value='B'>B</option>
            </select><br/>
            <label>Pilih file</label><br/>
            <input type='file' name='file' required='true'/><br/><br/>
            <input type='submit' name='submit' value='Import' required='true'/><br/>
        </form>
    ";
    if(isset($_POST['submit'])) {
        $id_mapel = $_POST['id_mapel'];
        $paket = $_POST['paket'];
        $file = $_FILES['file']['tmp_name'];
        $file = file_get_contents($file);
        $file = html2str($file);
        $file = explode("\n",$file);
        foreach($file as $str) {
            $ceknum = explode(".",$str);
            (is_numeric($ceknum[0])) ? $doc .= '*' :null;
            (in_array($ceknum[0],$huruf)) ? $doc .= '#' :null;
            $doc .= $str;
        }
        $doc = explode("*",$doc);
        foreach($doc as $str) {
            $no++;
            $str = explode('#',$str);
            if(count($str)>1) {
                $str = str_replace("$no.","",$str);
                $str = str_replace("A.","",$str);
                $str = str_replace("B.","",$str);
                $str = str_replace("C.","",$str);
                $str = str_replace("D.","",$str);
                $str = str_replace("E.","",$str);
                $str = str_replace("a.","",$str);
                $str = str_replace("b.","",$str);
                $str = str_replace("c.","",$str);
                $str = str_replace("d.","",$str);
                $str = str_replace("e.","",$str);
                $soal = trim(nl2br($str[0]));
                $pilA = trim($str[1]);
                $pilB = trim($str[2]);
                $pilC = trim($str[3]);
                $pilD = trim($str[4]);
                $pilE = trim($str[5]);
                $jawaban = trim($str[6]);
                $exec = mysql_query("INSERT INTO soal (id_mapel,paket,nomor,soal,pilA,pilB,pilC,pilD,pilE,jawaban) VALUES ('$id_mapel','$paket','$no','$soal','$pilA','$pilB','$pilC','$pilD','$pilE','$jawaban')");
                ($exec) ? $status = "<font color='green'><b>&check;</b></font>" : $status = "<font color='red'><b>&times;</b></font>";
                echo "
                    $no. $status<br/>
                    $soal<br/>
                    A. $pilA<br/>
                    B. $pilB<br/>
                    C. $pilC<br/>
                    D. $pilD<br/>
                    E. $pilE<br/><br/>
					jawaban. $jawaban
                ";
            }
            echo "<br/>";
        }
    }
?>