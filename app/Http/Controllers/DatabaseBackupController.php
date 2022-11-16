<?php

namespace App\Http\Controllers;

use App\Models\UserActivityLog;
use mysqli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DatabaseBackupController extends Controller
{
    public static function databaseBackup($tables = false, $backup_name)
    {
        //ENTER THE RELEVANT INFO BELOW


        $mysqli = new mysqli('localhost', 'root', 'jl04232001', 'capstone');
        $mysqli->select_db('capstone');
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES');
        while ($row = $queryTables->fetch_row()) {
            $target_tables[] = $row[0];
        }
        if ($tables !== false) {
            $target_tables = array_intersect($target_tables, $tables);
        }
        foreach ($target_tables as $table) {
            $result         =   $mysqli->query('SELECT * FROM ' . $table);
            $fields_amount  =   $result->field_count;
            $rows_num = $mysqli->affected_rows;
            $res            =   $mysqli->query('SHOW CREATE TABLE ' . $table);
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n" . $TableMLine[1] . ";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount; $i++, $st_counter = 0) {
                while ($row = $result->fetch_row()) { //when started (and every after 100 command cycle):
                    if ($st_counter % 100 == 0 || $st_counter == 0) {
                        $content .= "\nINSERT INTO " . $table . " VALUES";
                    }
                    $content .= "\n(";
                    for ($j = 0; $j < $fields_amount; $j++) {
                        $row[$j] = str_replace("\n", "\\n", addslashes($row[$j]));
                        if (isset($row[$j])) {
                            $content .= '"' . $row[$j] . '"';
                        } else {
                            $content .= '""';
                        }
                        if ($j < ($fields_amount - 1)) {
                            $content .= ',';
                        }
                    }
                    $content .= ")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ((($st_counter + 1) % 100 == 0 && $st_counter != 0) || $st_counter + 1 == $rows_num) {
                        $content .= ";";
                    } else {
                        $content .= ",";
                    }
                    $st_counter = $st_counter + 1;
                }
            }
            $content .= "\n\n\n";
        }
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('H-i-s')."_".date('d-m-Y').")__rand".rand(1,11111111).".sql";

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        date_default_timezone_set('Asia/Manila');
        header("Content-disposition: attachment; filename=\"".$backup_name."_".Carbon::now()."\".sql");
        echo $content;
        exit;
    }
    public function index()
    {
        return view('database_backup.index');
    }

    public function exportDatabase(Request $request){

        $validated = $request->validate([
            'password' => 'required',
            'backup_name' => 'required|min:8|max:12',
            
        ]);

        if(!$validated){
            return redirect()->route('database_backup.index')->with('error','Password and Backupname is Required');
        }

        if(!Hash::check($request->password,auth()->user()->password)){
            return redirect()->route('database_backup.index')->with('error','Password is not matched');
        }

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Backup Database',
            'description' => 'Backup name: '.$request->backup_name,
            'date_time'=> now(),
        ]);
    
        
        DatabaseBackupController::databaseBackup($tables = false, $request->backup_name);

        

    }

    

}
