<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


function dbconn(){
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
        return $pdo;
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:" . print_r($error, true));
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: $file_name");
    exit();
}

// CSVのファイルを読み込み
function get_csv($csvfile, $mode='sjis')
{
    // ファイル存在確認
    if(!file_exists($csvfile)) return false;
 
    // 文字コードを変換しながら読み込めるようにPHPフィルタを定義
    //      if($mode === 'sjis')  $filter = 'php://filter/read=convert.iconv.cp932%2Futf-8/resource='.$csvfile;
    // else if($mode === 'utf16') $filter = 'php://filter/read=convert.iconv.utf-16%2Futf-8/resource='.$csvfile;
    // else if($mode === 'utf8')  
    $filter = $csvfile;
 
    // SplFileObject()を使用してCSVロード
    $file = new SplFileObject($filter);
    if($mode === 'utf16') $file->setCsvControl("\t");
    $file->setFlags(
        SplFileObject::READ_CSV |
        SplFileObject::SKIP_EMPTY |
        SplFileObject::READ_AHEAD
    );
 
    // 各行を処理
    $records = array();
    foreach ($file as $i => $row)
    {
        // 1行目はキーヘッダ行として取り込み
        if($i===0) {
            foreach($row as $j => $col) $colbook[$j] = $col;
            continue;
        }
 
        // 2行目以降はデータ行として取り込み
        $line = array();
        foreach($colbook as $j=>$col) $line[$colbook[$j]] = @$row[$j];
        $records[] = $line;
    }
    return $records;
}
